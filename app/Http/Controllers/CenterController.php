<?php

namespace App\Http\Controllers;

use App\Repositories\BranchRepository;
use App\Repositories\CenterRepository;
use App\Repositories\GroupRepository;
use App\Repositories\MemberRepository;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CenterController extends Controller
{
    protected $centerRepository;
    protected $branchRepository;
    protected $groupRepository;
    protected $memberRepository;

    public function __construct(CenterRepository $centerRepository, BranchRepository $branchRepository, GroupRepository $groupRepository, MemberRepository $memberRepository)
    {
        $this->centerRepository = $centerRepository;
        $this->branchRepository = $branchRepository;
        $this->groupRepository = $groupRepository;
        $this->memberRepository = $memberRepository;
    }
    public function createCenter(Request $request)
    {
        try {
            $request->merge([
                'center_name' => strtolower($request->input('center_name')),
                'manager_name' => strtolower($request->input('manager_name'))
            ]);
            $request->validate([
                'center_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('centers')->where(function ($query) {
                        return $query->where('status', 'active');
                    }),
                ],
                'branch_id' => 'required|string|regex:/^[0-9]+$/',
                'payment_day' => 'required|in:MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY',
                'manager_name' => 'required|string|max:255'
            ]);

            $this->centerRepository->create(['center_name' => $request['center_name'], 'manager_name' => $request['manager_name'], 'branch_id' => $request['branch_id'], 'payment_date' => $request['payment_day'], 'status' => 'ACTIVE']);

            return redirect()->back()->with('success', 'Branch created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->with('show_create_center_popup', true)
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error creating center: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function getAllActiveCenters()
    {
        try {
            $all_active_centers = $this->centerRepository->get_all();
            $all_active_branches =  $this->branchRepository->get_all();
            return View('branches.centers', ['all_active_centers' => $all_active_centers, 'all_active_branches' => $all_active_branches]);
        } catch (\Exception $e) {
            Log::error('Error getting active centers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function incomeView()
    {
        try {
            $all_active_centers = $this->centerRepository->get_all();
            $all_active_branches =  $this->branchRepository->get_all();
            return View('income.incomeReport', ['all_active_centers' => $all_active_centers, 'all_active_branches' => $all_active_branches]);
        } catch (\Exception $e) {
            Log::error('Error getting active centers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

     public function incomeReportView()
    {
        try {
            $all_active_centers = $this->centerRepository->get_all();
            $all_active_branches =  $this->branchRepository->get_all();
            return View('reports.incomeReports', ['all_active_centers' => $all_active_centers, 'all_active_branches' => $all_active_branches]);
        } catch (\Exception $e) {
            Log::error('Error getting active centers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function collectionView()
    {
        try {
            $all_active_centers = $this->centerRepository->get_all();
            $all_active_branches =  $this->branchRepository->get_all();
            return View('income.collections', ['all_active_centers' => $all_active_centers, 'all_active_branches' => $all_active_branches]);
        } catch (\Exception $e) {
            Log::error('Error getting active centers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function underPaymentView()
    {
        try {
            $all_active_centers = $this->centerRepository->get_all();
            $all_active_branches =  $this->branchRepository->get_all();
            return View('income.underPayments', ['all_active_centers' => $all_active_centers, 'all_active_branches' => $all_active_branches]);
        } catch (\Exception $e) {
            Log::error('Error getting active centers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function getCentersByBranch($branchId)
    {
        try {
            $centers = $this->centerRepository->search_many('branch_id', $branchId);
            return response()->json($centers);
        } catch (\Exception $e) {
            Log::error('Error getting center: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function viewCenterSummary($centerId)
    {
        try {
            $centerDetails = $this->centerRepository->search_one('id', $centerId);
            return View('branches.centerSummary', ['center_details' => $centerDetails]);
        } catch (\Exception $e) {
            Log::error('Error getting center summary: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function deleteCenter($centerId)
    {
        try {
            $this->centerRepository->update($centerId, 'status', 'INACTIVE');
            $selectGroups = $this->groupRepository->search_many('center_id', $centerId);
            if (!empty($selectGroups) && is_iterable($selectGroups)) {
                foreach ($selectGroups as $group) {
                    $this->groupRepository->update($group->id, 'status', 'INACTIVE');
                    $selectMembers = $this->memberRepository->search_many('group_id', $group->id);
                    if (!empty($selectMembers) && is_iterable($selectMembers)) {
                        foreach ($selectMembers as $member) {
                            $this->memberRepository->update($member->id, 'status', 'TERMINATED');
                        }
                    }
                }
            }


            return response()->json(['message' => 'Center Delete successfully.']);
        } catch (\Exception $e) {
            Log::error('Error delete center: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function  updateCenter($centerId, Request $request)
    {
        try {
            $request->merge([
                'center_name' => strtolower($request->input('center_name')),
                'manager_name' => strtolower($request->input('manager_name'))
            ]);
            $request->validate([
                'center_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('centers')->ignore($centerId)->where(function ($query) {
                        return $query->where('status', 'ACTIVE');
                    }),
                ],
                'payment_day' => 'required|in:MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY',
                'manager_name' => 'required|string|max:255'
            ]);
            $this->centerRepository->update($centerId, 'center_name', $request->center_name);
            $this->centerRepository->update($centerId, 'manager_name', $request->manager_name);
            $this->centerRepository->update($centerId, 'payment_date', $request->payment_day);
            return redirect()->back()->with('success', 'Center updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error update center: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
