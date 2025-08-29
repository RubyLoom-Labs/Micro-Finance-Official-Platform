<?php

namespace App\Http\Controllers;

use App\Repositories\InstallmentRepository;
use App\Repositories\LoanRepository;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LoanController extends Controller
{
    protected $loanRepository;
    protected $memberRepository;
    protected $installmentRepository;
    public function __construct(LoanRepository $loanRepository, MemberRepository $memberRepository, InstallmentRepository $installmentRepository)
    {
        $this->loanRepository = $loanRepository;
        $this->memberRepository = $memberRepository;
        $this->installmentRepository = $installmentRepository;
    }
    public function viewUncompletedLoans()
    {
        $getActiveLoans = $this->loanRepository->search_many('status', 'UNCOMPLETED');
        return view('payments/payments', [
            'allActiveLoans' => $getActiveLoans
        ]);
    }
    public function viewPendingLoans()
    {
        $getActiveLoans = $this->loanRepository->search_many('status', 'UNCOMPLETED');
        return view('payments/pending', [
            'allActiveLoans' => $getActiveLoans
        ]);
    }
    public function viewNoPaidLoans()
    {
        $getActiveLoans = $this->loanRepository->search_many('status', 'UNCOMPLETED');
        return view('payments/noPaid', [
            'allActiveLoans' => $getActiveLoans
        ]);
    }
    public function loanIssueReportView()
    {
        $getActiveLoans = $this->loanRepository->search_many('status', 'UNCOMPLETED');
        return view('reports/loneIssue', [
            'allActiveLoans' => $getActiveLoans
        ]);
    }
    public function pendingLoanReportView()
    {
        $getActiveLoans = $this->loanRepository->search_many('status', 'UNCOMPLETED');
        return view('reports/pendingPaymentsReport', [
            'allActiveLoans' => $getActiveLoans
        ]);
    }

    public function createLoan($memberId, Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|gt:0',
            'interest_rate' => 'required|numeric|gt:0',
            'interest' => 'required|numeric|gt:0',
            'terms' => 'required|integer|min:1',
            'installment_amount' => 'required|numeric|gt:0',
            'issue_date' => 'required|date',
            'document_charges' => 'numeric|gt:0',
            'guarantor_name' => 'required|string',
            'image_1' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);
        try {
            $guarantorFullName = strtolower($request->input('guarantor_name'));
            $image1Path = $request->file('image_1')->store("members/images/loanDocument/{$memberId}", 'public');
            $isCreateLoan =  $this->loanRepository->create([
                'guarantor' => $guarantorFullName,
                'document_charges' => $request->document_charges,
                'loan_amount' => $request->loan_amount,
                'image_1' => $image1Path,
                'installment_price' => $request->installment_amount,
                'issue_date' => $request->issue_date,
                'interest_rate' => $request->interest_rate,
                'terms' => $request->terms,
                'interest' => $request->interest,
                'status' => 'UNCOMPLETED',
                'member_id' => $memberId

            ]);
            if ($isCreateLoan) {

                $loanId =  $this->loanRepository->search_one(['status' => 'UNCOMPLETED', 'member_id' => $memberId])->id;
                $startDate = Carbon::parse($request->issue_date);
                $now = Carbon::now();
                for ($i = $request->terms; $i >= 1; $i--) {
                    $installmentDate = $startDate->copy()->addDays(7 * ($i))->setTime($now->hour, $now->minute, $now->second);
                    $this->installmentRepository->create([
                        'installment_number' => $i,
                        'date_and_time' => $installmentDate->toDateTimeString(),
                        'amount' => 0,
                        'installment_amount' => $request->installment_amount,
                        'loan_id' => $loanId,
                        'status' => 'UNPAYED'
                    ]);
                }
                $this->memberRepository->update($memberId, 'status', 'ACTIVE');
                $this->memberRepository->update($memberId, 'image_2', $image1Path);
            }
            return redirect()->back()->with('success', 'Member created successfully.');
        } catch (\Exception $e) {

            Log::error('Error creating loan: ' . $e->getMessage());
            return redirect()->back()
                ->with('show_create_popup', true)
                ->withInput()
                ->withErrors(['error' => 'Unexpected error occurred']);
        }
    }
}
