<?php

namespace App\Http\Controllers;

use App\Repositories\InstallmentRepository;
use App\Repositories\LoanRepository;
use App\Repositories\MemberRepository;
use App\Repositories\UnderpaymentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstallmentController extends Controller
{
    protected $installmentRepository;
    protected $memberRepository;
    protected $underpaymentRepository;
    protected $loanRepository;
    public function __construct(InstallmentRepository $installmentRepository, MemberRepository $memberRepository, UnderpaymentRepository $underpaymentRepository, LoanRepository $loanRepository)
    {
        $this->installmentRepository = $installmentRepository;
        $this->memberRepository = $memberRepository;
        $this->underpaymentRepository = $underpaymentRepository;
        $this->loanRepository = $loanRepository;
    }
    public function updateInstallment($loanId, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'image_1' => 'file|image|mimes:jpeg,png,jpg',
        ]);

        try {

            $relatedLoan = $this->loanRepository->search_one(['status' => 'UNCOMPLETED', 'id' => $loanId]);
            $relatedInstallment = $this->installmentRepository->search_many('loan_id', $loanId);
            $maxInstallment = $relatedInstallment->sortByDesc('installment_number')->first();
            if (!$maxInstallment) {
                Log::error('Not found installment');
                return redirect()->back()->with('error', 'Not found first installment');
            }
            $installmentDate = Carbon::parse($maxInstallment->date_and_time);
            $total_price_until_now = $maxInstallment->installment_amount * $maxInstallment->installment_number;
            $total_price_paid_until_now = $relatedInstallment->sum('amount');
            if (Carbon::now() <= $installmentDate->copy()->addDays(7)) {
                $totalCount = $maxInstallment->amount + $request->amount;
                if (($total_price_paid_until_now + $request->amount) >= $relatedLoan->loan_amount) {
                    $this->installmentRepository->update($maxInstallment->id, 'status', 'PAYED');
                    $this->loanRepository->update($relatedLoan->id, 'status', 'COMPLETED');
                    $this->memberRepository->update($relatedLoan->member_id, 'status', 'INACTIVE');
                }
                $this->installmentRepository->update($maxInstallment->id, 'amount', $totalCount);
                $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $maxInstallment->id, 'payed_date' => Carbon::now()]);
            } else if (Carbon::now() > $installmentDate->copy()->addDays(7)) {
                $endDate = $installmentDate->copy()->addDays(7);
                $diffInDays = Carbon::now()->diffInDays($endDate);
                $weeksCount = intdiv($diffInDays, 7);
                if ($weeksCount > 0) {
                    if (($total_price_until_now - $total_price_paid_until_now) >= $maxInstallment->installment_amount) {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'NOPAYED');
                    } else if (
                        0 < ($total_price_until_now - $total_price_paid_until_now)
                        && ($total_price_until_now - $total_price_paid_until_now) < $maxInstallment->installment_amount
                    ) {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'UNDERPAYED');
                    } else {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'PAYED');
                    }
                    for ($i = 1; $i <= $weeksCount; $i++) {

                        $total_price_until_now = $maxInstallment->installment_amount * ($maxInstallment->installment_number + $i);
                        if (($total_price_until_now - $total_price_paid_until_now) >= $maxInstallment->installment_amount) {
                            $this->installmentRepository->create([
                                'installment_number' => $maxInstallment->installment_number + $i,
                                'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7 * $i),
                                'amount' => 0,
                                'installment_amount' => $maxInstallment->installment_amount,
                                'loan_id' => $loanId,
                                'status' => 'NOPAYED'
                            ]);
                        } else if (
                            0 < ($total_price_until_now - $total_price_paid_until_now)
                            && ($total_price_until_now - $total_price_paid_until_now) < $maxInstallment->installment_amount
                        ) {
                            $this->installmentRepository->create([
                                'installment_number' => $maxInstallment->installment_number + $i,
                                'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7 * $i),
                                'amount' => 0,
                                'installment_amount' => $maxInstallment->installment_amount,
                                'loan_id' => $loanId,
                                'status' => 'UNDERPAYED'
                            ]);
                        } else {
                            $this->installmentRepository->create([
                                'installment_number' => $maxInstallment->installment_number + $i,
                                'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7 * $i),
                                'amount' => 0,
                                'installment_amount' => $maxInstallment->installment_amount,
                                'loan_id' => $loanId,
                                'status' => 'PAYED'
                            ]);
                        }
                    }
                    $total_price_until_now = $maxInstallment->installment_amount * ($maxInstallment->installment_number + $weeksCount);
                    if (($total_price_paid_until_now + $request->amount) >= $relatedLoan->loan_amount) {
                        $this->installmentRepository->create([
                            'installment_number' => $maxInstallment->installment_number + $weeksCount + 1,
                            'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7 * ($weeksCount + 1)),
                            'amount' => $request->amount,
                            'installment_amount' => $maxInstallment->installment_amount,
                            'loan_id' => $loanId,
                            'status' => 'UNPAYED'
                        ]);
                        $this->loanRepository->update($relatedLoan->id, 'status', 'COMPLETED');
                        $this->memberRepository->update($relatedLoan->member_id, 'status', 'INACTIVE');
                    } else {
                        $this->installmentRepository->create([
                            'installment_number' => $maxInstallment->installment_number + $weeksCount + 1,
                            'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7 * ($weeksCount + 1)),
                            'amount' => $request->amount,
                            'installment_amount' => $maxInstallment->installment_amount,
                            'loan_id' => $loanId,
                            'status' => 'UNPAYED'
                        ]);
                    }
                    $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $maxInstallment->installment_number + $weeksCount + 1, 'payed_date' => Carbon::now()]);
                } else {
                    if (($total_price_paid_until_now + $request->amount) >= $relatedLoan->loan_amount) {
                        $this->installmentRepository->create([
                            'installment_number' => $maxInstallment->installment_number + 1,
                            'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7),
                            'amount' => $request->amount,
                            'installment_amount' => $maxInstallment->installment_amount,
                            'loan_id' => $loanId,
                            'status' => 'PAYED'
                        ]);
                        $this->loanRepository->update($relatedLoan->id, 'status', 'COMPLETED');
                        $this->memberRepository->update($relatedLoan->member_id, 'status', 'INACTIVE');
                    } else {
                        $this->installmentRepository->create([
                            'installment_number' => $maxInstallment->installment_number + 1,
                            'date_and_time' => Carbon::parse($maxInstallment->date_and_time)->copy()->addDays(7),
                            'amount' => $request->amount,
                            'installment_amount' => $maxInstallment->installment_amount,
                            'loan_id' => $loanId,
                            'status' => 'UNPAYED'
                        ]);
                    }

                    $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $maxInstallment->installment_number + 1, 'payed_date' => Carbon::now()]);
                    if (($total_price_until_now - $total_price_paid_until_now) >= $maxInstallment->installment_amount) {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'NOPAYED');
                    } else if (
                        0 < ($total_price_until_now - $total_price_paid_until_now)
                        && ($total_price_until_now - $total_price_paid_until_now) < $maxInstallment->installment_amount
                    ) {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'UNDERPAYED');
                    } else {
                        $this->installmentRepository->update($maxInstallment->id, 'status', 'PAYED');
                    }
                }
            }
            return  redirect()->back()->with('success', 'Installment updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating installment: ' . $e->getMessage());
            return redirect()->back()
                /* ->with('show_create_popup', true) */
                ->withInput()
                ->withErrors(['error' => 'Unexpected error occurred']);
        }
    }
}
