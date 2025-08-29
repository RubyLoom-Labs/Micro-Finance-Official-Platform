<?php

namespace App\Http\Controllers;

use App\Repositories\InstallmentRepository;
use App\Repositories\LoanRepository;
use App\Repositories\MemberRepository;
use App\Repositories\UnderpaymentRepository;
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
    public function updateInstallment($installmentId, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'image_1' => 'file|image|mimes:jpeg,png,jpg',
        ]);

        try {

            $relatedInstallment = $this->installmentRepository->search_one('id', $installmentId);
            if (!$relatedInstallment) {
                Log::error('Not found installment');
                return redirect()->back()->with('error', 'Not found installment');
            }
            $totalCount = $relatedInstallment->amount + $request->amount;
            if ($totalCount > $relatedInstallment->installment_amount) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['amount' => 'The entered amount exceeds the remaining installment amount.']);
            } elseif ($totalCount == $relatedInstallment->installment_amount) {
                $this->installmentRepository->update($installmentId, 'status', 'PAYED');
                $now = now();
                $installmentDateTime = $relatedInstallment->date_and_time;
                if ($now->gt($installmentDateTime)) {
                    $this->installmentRepository->update($installmentId, 'pay_in_date', false);
                } else {
                    $this->installmentRepository->update($installmentId, 'pay_in_date', true);
                }
                $this->installmentRepository->update($installmentId, 'payed_date', $now);
                if ($request->amount < $relatedInstallment->installment_amount) {
                    $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $installmentId, 'payed_date' => $now]);
                }
                if ($relatedInstallment->loan->terms == $relatedInstallment->installment_number) {
                    $this->memberRepository->update($relatedInstallment->loan->member->id, 'status', 'INACTIVE');
                    $this->loanRepository->update($relatedInstallment->loan->id, 'status', 'COMPLETED');
                }
            } else {
                $now = now();
                if ($request->file('image_1')) {
                    $image1Path = $request->file('image_1')->store("members/images/underpaymentDocument/{$installmentId}/{$now}", 'public');
                    $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $installmentId, 'payed_date' => $now, 'bill_image' => $image1Path]);
                } else {
                    $this->underpaymentRepository->create(['amount' => $request->amount, 'installment_id' => $installmentId, 'payed_date' => $now]);
                }
            }
            if ($request->file('image_1')) {
                $image1Path = $request->file('image_1')->store("members/images/installmentDocument/{$installmentId}", 'public');
                $this->installmentRepository->update($installmentId, 'bill_image', $image1Path);
            }
            $this->installmentRepository->update($installmentId, 'amount',  $totalCount);
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
