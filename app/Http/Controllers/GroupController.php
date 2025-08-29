<?php

namespace App\Http\Controllers;

use App\Repositories\GroupRepository;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $memberRepository;

    public function __construct(GroupRepository $groupRepository, MemberRepository $memberRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->memberRepository = $memberRepository;
    }

    public function getGroupsByCenter($centerId)
    {
        $groups = $this->groupRepository->search_many('center_id', $centerId);
        return response()->json($groups);
    }

    public function viewGroupSummary($groupId)
    {
        try {
            $groupDetails = $this->groupRepository->search_one('id', $groupId);
            return View('branches.groupSummary', ['group_details' => $groupDetails]);
        } catch (\Exception $e) {
            Log::error('Error getting center summary: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function createGroup(Request $request)
    {
        try {
            $request->merge([
                'group_name' => strtolower($request->input('group_name')),
            ]);
            $request->validate([
                'center_id' => 'required|string|regex:/^[0-9]+$/',
                'branch_id' => 'required|string|regex:/^[0-9]+$/',
                'group_name' => 'required|string|max:255'
            ]);
            $this->groupRepository->create(['group_name' => $request['group_name'], 'center_id' => $request['center_id'], 'branch_id' => $request['branch_id'],  'status' => 'ACTIVE']);

            return redirect()->back()->with('success', 'Group created successfully.');
        } catch (ValidationValidationException $e) {
            session()->flash('show_create_popup', true);
            Log::error('Validation Error creating group: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating group: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function deleteGroup($groupId)
    {
        try {
            $this->groupRepository->update($groupId, 'status', 'INACTIVE');
            $selectMembers = $this->memberRepository->search_many('group_id', $groupId);
            if (!empty($selectMembers) && is_iterable($selectMembers)) {
                foreach ($selectMembers as $member) {
                    if (is_object($member)) {
                        $this->memberRepository->update($member->id, 'status', 'TERMINATED');
                    }
                }
            }

            return response()->json(['message' => 'Group Delete successfully.']);
        } catch (\Exception $e) {
            Log::error('Error delete group: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function  updateGroup($groupId, Request $request)
    {
        try {
            $request->merge([
                'group_name' => strtolower($request->input('group_name'))
            ]);
            $request->validate([
                'group_name' => 'required|string|max:255'
            ]);
            $this->groupRepository->update($groupId, 'group_name', $request->group_name);
            return redirect()->back()->with('success', 'Group updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error update group: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
