<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userRepository;
    protected $userRoleRepository;



    public function __construct(UserRepository $userRepository, UserRoleRepository $userRoleRepository)
    {
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    public function createUser(Request $request)
    {
        try {
            $request->merge([
                'first_name' => strtolower($request->input('first_name')),
                'last_name' => strtolower($request->input('last_name')),
            ]);

            $request->validate([
                'email' => [
                    'required',
                    'string',
                    Rule::unique('users')
                ],
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'password' => 'required|string|min:8',
                'nic_number' => 'required|string',
                'phoneNumber01' => 'required|string|regex:/^[0-9]+$/',
                'role_id' => 'required|numeric',
                'userImage01' => 'file|image|mimes:jpeg,png,jpg',
            ]);
            if ($request->file('userImage01')) {
                $image1Path = $request->file('userImage01')->store('users/ppImages', 'public');
                $this->userRepository->create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'nic_number' => $request['nic_number'],
                    'mobile_number_1' => $request['phoneNumber01'],
                    'user_role_id' => $request['role_id'],
                    'payment_date' => $request['payment_day'],
                    'image' => $image1Path,
                    'status' => 'ACTIVE',
                ]);
            } else {
                $this->userRepository->create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'nic_number' => $request['nic_number'],
                    'mobile_number_1' => $request['phoneNumber01'],
                    'user_role_id' => $request['role_id'],
                    'payment_date' => $request['payment_day'],
                    'status' => 'ACTIVE',
                ]);
            }


            return redirect()->back()->with('success', 'User created successfully.');
        } catch (ValidationException $e) {
            dd($e);
            return redirect()->back()
                ->with('show_create_center_popup', true)
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            dd($e);

            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function usersView()
    {
        try {

            $all_active_users = $this->userRepository->get_all();
            $all_active_user_roles = $this->userRoleRepository->get_all();
            return view('settings/userAccount', ['all_active_users' => $all_active_users, 'all_active_user_roles' => $all_active_user_roles]);
        } catch (\Exception $e) {
            Log::error('Error getting active user roles: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function updateUser(Request $request)
    {
        try {
            $request->merge([
                'first_name' => strtolower($request->input('first_name')),
                'last_name' => strtolower($request->input('last_name')),
            ]);
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    Rule::unique('users')
                        ->ignore($request->id) // Ignore the current user's ID
                        ->where(function ($query) {
                            return $query->where('status', 'ACTIVE');
                        }),
                ],
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'nic' => 'required|string',
                'mobile' => 'required|string|regex:/^[0-9]+$/',
                'role_id' => 'required|numeric',
                'userImage01' => 'file|image|mimes:jpeg,png,jpg',

            ]);


            $user = $this->userRepository->search_one('id', $request->id);
            if ($request->file('userImage01')) {
                $image1Path = $request->file('userImage01')->store('users/ppImages', 'public');
                $user->image = $image1Path;
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->nic_number = $request->nic;
            $user->mobile_number_1 = $request->mobile;
            $user->user_role_id = $request->role_id;
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'User updated successfully']);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->with('show_create_center_popup', true)
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function deleteUser($userId)
    {
        try {
            $this->userRepository->update($userId, 'status', 'INACTIVE');
            return response()->json(['message' => 'User Delete successfully.']);
        } catch (\Exception $e) {
            Log::error('Error delete user: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function  updatePwUser(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8',
                'user_id' => 'required|exists:users,id',
            ]);

            $user = $this->userRepository->search_one('id', $request->user_id);
            if (!$user) {
                return response()->json(['status' => 'failed', 'message' => 'User not found'], 404);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => 'Current password is incorrect.'], 422);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Password changed successfully']);
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt to log the user in
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $request->session()->regenerate(); // Prevent session fixation

                return response()->json([
                    'status' => 'success',
                    'redirect_to' => route('dashboard')
                ]);
            }

            // If login failed
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ], 401);
        } catch (ValidationException $e) {
            // Return validation errors
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log and return a generic error
            Log::error('Login error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
