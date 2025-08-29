<?php

namespace App\Http\Controllers;

use App\Repositories\UserRoleRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;


class UserRoleController extends Controller
{
    protected $userRoleRepository;


    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }
    public function userRolesView()
    {
        try {
            $all_active_user_roles = $this->userRoleRepository->get_all();
            return view('settings/userRole', ['all_active_user_roles' => $all_active_user_roles]);
        } catch (\Exception $e) {
            Log::error('Error getting active user roles: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function createUserRole(Request $request)
    {
        try {
            $request->merge([
                'role_name' => strtolower($request->input('role_name')),
                'description' => strtolower($request->input('description'))
            ]);

            $permissions = $request->input('permissions'); // 👈 Collect permissions array

            $request->validate([
                'role_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('user_roles')->where(function ($query) {
                        return $query->where('status', 'active');
                    }),
                ],
                'description' => 'string',
                'permissions.Dashboard' => 'required|numeric',
                'permissions.Branch Creation' => 'required|numeric',
                'permissions.User Accounts Creation ' => 'required|numeric',
                'permissions.User Roles Creation ' => 'required|numeric',
                'permissions.Centers' => 'required|numeric',
                'permissions.Members' => 'required|numeric',
                'permissions.Income' => 'required|numeric',
                'permissions.Payments' => 'required|numeric',
                'permissions.Reports' => 'required|numeric',
            ]);

            $this->userRoleRepository->create([
                'role_name' => $request['role_name'],
                'description' => $request['description'],
                'branch_id' => $request['branch_id'],
                'payment_date' => $request['payment_day'],
                'status' => 'ACTIVE',

                // Permissions
                'dashboard' => $permissions['Dashboard'],
                'branch_creation' => $permissions['Branch Creation'],
                'user_accounts_creation' => $permissions['User Accounts Creation '],
                'user_role_creation' => $permissions['User Roles Creation '],
                'centers' => $permissions['Centers'],
                'members' => $permissions['Members'],
                'income' => $permissions['Income'],
                'payments' => $permissions['Payments'],
                'reports' => $permissions['Reports'],
            ]);

            return redirect()->back()->with('success', 'User Role created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->with('show_create_center_popup', true)
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {

            Log::error('Error creating user role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function updateUserRole(Request $request)
    {
        try {
            $request->validate([
                'role_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('user_roles')
                        ->ignore($request->id) // Exclude current record by ID
                        ->where(function ($query) {
                            return $query->where('status', 'ACTIVE');
                        }),
                ],
                'dashboard' => 'required|numeric',
                'branch_creation' => 'required|numeric',
                'user_accounts_creation' => 'required|numeric',
                'user_role_creation' => 'required|numeric',
                'centers' => 'required|numeric',
                'members' => 'required|numeric',
                'income' => 'required|numeric',
                'payments' => 'required|numeric',
                'reports' => 'required|numeric',
            ]);

            $userRole = $this->userRoleRepository->search_one('id', $request->id);
            if ($userRole) {
                $userRole->dashboard = $request->dashboard;
                $userRole->branch_creation = $request->branch_creation;
                $userRole->user_accounts_creation = $request->user_accounts_creation;
                $userRole->user_role_creation = $request->user_role_creation;
                $userRole->centers = $request->centers;
                $userRole->members = $request->members;
                $userRole->income = $request->income;
                $userRole->payments = $request->payments;
                $userRole->reports = $request->reports;
                $userRole->save();
                return response()->json(['status' => 'success', 'message' => 'Permissions updated']);
            }
        } catch (ValidationException $e) {
             dd($e);
            return redirect()->back()
                ->with('show_create_center_popup', true)
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
             dd($e);
            Log::error('Error creating user role: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
