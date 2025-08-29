@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">

            <!-- Add New User Modal -->
            <div id="addNewUserModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg border border-blue-400">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Create New User</h2>
                    <form action="{{ route('user.create') }}" method="POST" id="addNewMemberForm" class="p-4 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-center mb-4">
                            <div class="relative">
                                <img src="https://via.placeholder.com/100" alt="User Profile"
                                    class="rounded-full w-24 h-24 object-cover border-2 border-gray-300 bg-gray-800">
                                <label for="newMemberImage"
                                    class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </label>
                                <input type="file" name="userImage01" id="newMemberImage" class="hidden"
                                    accept="image/*" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Name*</label>
                                <div class="flex w-full space-x-2">
                                    <input type="text" name="first_name" id="newMemberFirstName" placeholder="1st name"
                                        required
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 ">
                                    <input type="text" name="last_name" id="newMemberLastName" placeholder="2nd name"
                                        required
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 ">
                                </div>
                            </div>
                            <div class="flex space-x-4 items-center ">
                                <label class="block text-xs text-gray-700 w-1/3">Email*</label>
                                <input type="email" name="email" id="newMemberEmail" placeholder="Enter Email"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 "
                                    required>

                            </div>
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Default Password*</label>
                                <input type="password" name="password" id="newMemberPassword" placeholder="password"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 "
                                    required>
                            </div>

                            <label class="block text-xs text-gray-400 w-full text-center border-b pb-1"></label>
                            <div class="space-y-2">

                                <div
                                    class="flex w-full lg:space-x-4 space-y-2 lg:space-y-0 items-center flex-col lg:flex-row">
                                    <div class="flex space-x-4 lg:w-1/2 w-full  items-center">
                                        <label class="block text-xs text-gray-700 w-1/3">NIC Number*</label>
                                        <input name="nic_number" type="text" id="newMemberNIC" placeholder="type"
                                            class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 "
                                            required>
                                    </div>
                                    <div class="flex space-x-4 lg:w-1/2 w-full  items-center">
                                        <label class="block text-xs text-gray-700 ">Mobile Number 01*</label>
                                        <input name="phoneNumber01" type="tel" id="newMemberMobile01" placeholder="type"
                                            class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300  hover:border-gray-400 "
                                            required>
                                    </div>
                                </div>
                                {{--  <div class="flex w-full lg:space-x-4 space-y-2 lg:space-y-0 items-center flex-col lg:flex-row">
                                <!-- First file input -->
                                <div class="lg:w-1/2 w-full">
                                    <label class="flex items-center justify-center border border-gray-300 rounded-md w-full h-8 cursor-pointer hover:border-gray-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-xs text-gray-700">Attach image</span>
                                        <input type="file" class="hidden">
                                    </label>
                                </div>

                                <!-- Second file input -->
                                <div class="lg:w-1/2 w-full">
                                    <label class="flex items-center justify-center border border-gray-300  hover:border-gray-400  rounded-md w-full h-8 cursor-pointertransition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-xs text-gray-700">Attach image</span>
                                        <input type="file" class="hidden">
                                    </label>
                                </div>
                            </div> --}}


                                <label class="block text-xs text-gray-400 w-full text-center border-b pb-1"></label>
                                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0 w-full">
                                    <label class="block text-xs text-gray-700 sm:w-1/3">Role*</label>
                                    <select id="newMemberRole" required name="role_id"
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 border-gray-300 hover:border-gray-400 focus:ring-blue-500 text-xs">
                                        <option value="" disabled selected>Select a role</option>
                                        @foreach ($all_active_user_roles as $user_role)
                                            <option value={{ $user_role->id }}>
                                                {{ capitalizeEachWord($user_role->role_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-2">
                            <button type="button" id="cancelNewMember"
                                class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">Cancel</button>
                            <button type="submit" id="createNewMember"
                                class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">Create</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div id="editUserModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg border border-blue-400">
                    <h2 class="text-md bg-blue-200 rounded-t-lg p-4">Edit User Details</h2>
                    <form id="editMemberForm" class="p-4 space-y-6">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="flex justify-center mb-4">
                            <div class="relative">
                                <img id="editMemberProfileImage" src="https://via.placeholder.com/100" alt="User Profile"
                                    class="rounded-full w-24 h-24 object-cover border-2 border-gray-300 bg-gray-200">
                                <label for="editMemberImage"
                                    class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </label>
                                <input type="file" id="editMemberImage" class="hidden" accept="image/*" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Name*</label>
                                <div class="flex w-full space-x-2">
                                    <input type="text" id="editMemberFirstName" placeholder="1st name"
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400">
                                    <input type="text" id="editMemberLastName" placeholder="2nd name"
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400">
                                    <input class="hidden" type="text" id="editMemberId">

                                </div>
                            </div>
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Email*</label>
                                <input type="email" id="editMemberEmail" placeholder="Enter Email"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                    required>
                            </div>
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Password</label>
                                <div class="w-full flex items-center space-x-2">
                                    <input type="text" id="editMemberPassword"
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                        disabled>
                                    <button type="button" id="togglePasswordVisibility"
                                        class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                                        <svg id="passwordEyeIcon" class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <label class="block text-xs text-gray-400 w-full text-center border-b pb-1"></label>
                            <div class="space-y-2">
                                <div
                                    class="flex w-full lg:space-x-4 space-y-2 lg:space-y-0 items-center flex-col lg:flex-row">
                                    <div class="flex space-x-4 lg:w-1/2 w-full items-center">
                                        <label class="block text-xs text-gray-700 w-1/3">NIC Number*</label>
                                        <input type="text" id="editMemberNIC" placeholder="type"
                                            class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                            required>
                                    </div>
                                    <div class="flex space-x-4 lg:w-1/2 w-full items-center">
                                        <label class="block text-xs text-gray-700">Mobile Number 01*</label>
                                        <input type="tel" id="editMemberMobile01" placeholder="type"
                                            class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                            required>
                                    </div>
                                </div>
                                {{-- <div
                                    class="flex w-full lg:space-x-4 space-y-2 lg:space-y-0 items-center flex-col lg:flex-row">
                                    <!-- First file input -->
                                    <div class="lg:w-1/2 w-full">
                                        <label
                                            class="flex items-center justify-center border border-gray-300 rounded-md w-full h-8 cursor-pointer hover:border-gray-400 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="text-xs text-gray-700">Attach image</span>
                                            <input type="file" class="hidden">
                                        </label>
                                    </div>
                                    <!-- Second file input -->
                                    <div class="lg:w-1/2 w-full">
                                        <label
                                            class="flex items-center justify-center border border-gray-300 hover:border-gray-400 rounded-md w-full h-8 cursor-pointer transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="text-xs text-gray-700">Attach image</span>
                                            <input type="file" class="hidden">
                                        </label>
                                    </div>
                                </div> --}}
                                <label class="block text-xs text-gray-400 w-full text-center border-b pb-1"></label>
                                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0 w-full">
                                    <label class="block text-xs text-gray-700 sm:w-1/3">Role*</label>
                                    <select id="editMemberRole" required
                                        class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 border-gray-300 hover:border-gray-400 focus:ring-blue-500 text-xs">
                                        <option value="" disabled>Select a role</option>
                                        @foreach ($all_active_user_roles as $user_role)
                                            <option value={{ $user_role->id }}>
                                                {{ capitalizeEachWord($user_role->role_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 mt-2">
                            <button type="button" id="cancelEditMember"
                                class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">Cancel</button>
                            <button type="submit" id="saveEditMember"
                                class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete User Modal -->
            <div id="deleteUserModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg border border-red-400">
                    <h2 class="text-md bg-red-200 rounded-t-lg p-4">Confirm Delete</h2>
                    <div class="p-4 space-y-6">
                        <p class="text-sm text-gray-700">Are you sure you want to delete this user? This action cannot be
                            undone.</p>
                        <input type="hidden" id="deleteUserId">
                        <div class="flex justify-end space-x-4 mt-2">
                            <button type="button" id="cancelDeleteUser"
                                class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">Cancel</button>
                            <button type="button" id="confirmDeleteUser"
                                class="px-6 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none text-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password Modal -->
            <div id="changePasswordModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg border border-blue-400">
                    <h2 class="text-md bg-blue-200 rounded-t-lg p-4">Change Password</h2>
                    <form id="changePasswordForm" class="p-4 space-y-6">
                        <p id="passwordChangeError" class="text-red-500 text-xs"></p>
                        <input type="text" class="hidden" id="changePasswordUserId">
                        <div class="space-y-2">
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Current Password*</label>
                                <input type="password" id="currentPassword" placeholder="Enter current password"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                    required>
                            </div>
                            <div class="flex justify-center items-center w-full">
                                <p class="text-xs text-gray-400 w-28 p-1">New Password</p>
                                <hr class="border-gray-200 w-full ">
                            </div>
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">New Password*</label>
                                <input type="password" id="newPassword" placeholder="Enter new password"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                    required>
                            </div>
                            <div class="flex space-x-4 items-center">
                                <label class="block text-xs text-gray-700 w-1/3">Confirm Password*</label>
                                <input type="password" id="confirmPassword" placeholder="Confirm new password"
                                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs border-gray-300 hover:border-gray-400"
                                    required>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 mt-2">
                            <button type="button" id="cancelChangePassword"
                                class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">Cancel</button>
                            <button type="submit" id="saveChangePassword"
                                class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!--Start Table and Mobile Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-full">
                <!--lg:h-5/6-->
                <!-- Top Bar - Search bar and filter option for both mobile and web -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1 py-4 lg-py-0">
                    <!-- Filter line -->
                    <div id="filterRow"
                        class="flex flex-col lg:flex-row w-full justify-start lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">
                        <!-- Filter Button -->
                        <div class="text-sm lg:w-max lg:space-x-2">
                            <button value=""
                                class="hidden lg:flex bg-white p-2 rounded-lg focus:outline-none border w-8">
                                <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                            </button>
                        </div>
                        <!-- Search Bar -->
                        <div class="w-full text-sm lg:text-xs lg:w-full">
                            <input type="text" id="search" placeholder="Search ..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                    </div>
                    <!--Export Button-->
                    <div id="dateFilter"
                        class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">

                        <div class="w-full text-sm lg:text-xs lg:w-36">
                            <button id="addNewMember" value=""
                                class="w-full bg-blue-600 text-white p-2 lg:p-1.5  rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center px-4">
                                + Creat New User
                            </button>
                        </div>

                    </div>
                </div>
                <!--End Top Bar-->

                <!-------------CARD------------------------------------------------------------------------------------------------------------>
                <!-- User Grid card format hidden for lg screens -->
                <div id="userGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                    @foreach ($all_active_users as $user)
                        <div class="rounded-lg shadow-sm border border-gray-200 p-4 pt-2 bg-gray-100 w-full space-y-2 text-xs"
                            data-name="John Doe" data-NIC="200123456789">
                            <div class="flex justify-between items-center border-b pb-2">
                                <div class="flex space-x-4 items-center">
                                    <div class="h-8 w-8 rounded-full bg-black"></div>
                                    <div class="flex flex-col space-y-0">
                                        <p class="font-semibold text-gray-700 text-lg ">
                                            {{ capitalizeEachWord($user->first_name) }}
                                            {{ capitalizeEachWord($user->last_name) }}</p>
                                        <div class="flex space-x-1">
                                            <p class="text-gray-600">2025-07-01 <span>07.23 AM</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-4 items-center">
                                    @if ($user->status == 'ACTIVE')
                                        <p id="activeMemberStatus" class="items-center">
                                            <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                                        </p>
                                    @else
                                        <p id="inactiveMemberStatus" class="items-center hidden">
                                            <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                                        </p>
                                    @endif

                                </div>
                            </div>
                            <!--Second-->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pb-2">
                                <div class="flex space-x-1">
                                    <p class="font-semibold text-gray-700">Email:</p>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                </div>

                                <div class="flex space-x-1">
                                    <p class="font-semibold text-gray-700">Phone:</p>
                                    <p class="text-gray-600">{{ $user->mobile_number_1 }}</p>
                                </div>
                                <div class="flex space-x-1">
                                    <p class="font-semibold text-gray-700">NIC:</p>
                                    <p class="text-gray-600">{{ $user->nic_number }}</p>
                                </div>
                                @php
                                    $selected_role =
                                        $all_active_user_roles->firstWhere('id', $user->user_role_id)->role_name ?? '';
                                @endphp
                                <div class="flex space-x-2 items-center">
                                    <p class="font-semibold text-gray-700">Role:</p>
                                    <p class="text-gray-600"><span
                                            class="bg-yellow-600 p-0.5 px-2 rounded-md text-white text-xs inline-block text-center min-w-[100px] justify-items-center ">
                                            {{ capitalizeEachWord($selected_role) }}</span></p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 border-t pt-4">
                                <div class="flex justify-between items-center text-sm space-x-2">
                                    <a href="#"
                                        class="border rounded-lg hover:bg-blue-700 bg-blue-600 flex-shrink-0 edit-user px-4 py-1 text-white">
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="border rounded-lg hover:bg-red-700 bg-red-600 flex-shrink-0 delete-user px-4 py-1 text-white">
                                        Delete
                                    </a>
                                    <a href="#"
                                        class="border rounded-lg hover:bg-green-700 bg-green-600 flex-shrink-0 change-password px-4 py-1 text-white">
                                        Password Change
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-------------TABLE------------------------------------------------------------------------------------------------------------>
                <!-- Centers Grid Table format hidden for mobile screens -->
                <div class="flex justify-start h-full pt-2">
                    <div id="userTable" class="w-full h-[calc(100vh-270px)] hidden lg:block p-0 overflow-y-auto border-t">
                        <div class="min-w-full overflow-x-auto">
                            <table class="w-full min-w-[900px]"> <!-- Added min-width to prevent crushing -->
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="py-2 text-center w-12">#</th>
                                        <th class="py-2 pl-2 text-left min-w-[140px]">Name</th>
                                        <th class="py-2 text-left min-w-[120px]">Email</th>
                                        <th class="py-2 text-left min-w-[100px]">Last Seen</th>
                                        <th class="py-2 text-left min-w-[110px]">Phone Number</th>
                                        <th class="py-2 text-left min-w-[100px]">NIC Number</th>
                                        <th class="py-2 text-center min-w-[120px]">Role</th>
                                        <th class="py-2 text-center w-16">Active</th>
                                        <th class="py-2 text-center w-24">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
                                    @foreach ($all_active_users as $user)
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                            data-name="Dunura" data-NIC="20028596427">
                                            <td class="py-2 text-center"> {{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td class="py-2 pl-2 text-left">
                                                <div class="flex space-x-2 items-center">
                                                    <div class="bg-black rounded-full h-6 w-6 flex-shrink-0"></div>
                                                    <span class="truncate">{{ capitalizeEachWord($user->first_name) }}
                                                        {{ capitalizeEachWord($user->last_name) }}</span>
                                                    <p class="hidden lastNameHidden">
                                                        {{ capitalizeEachWord($user->last_name) }}</p>
                                                    <p class="hidden firstNameHidden">
                                                        {{ capitalizeEachWord($user->first_name) }}</p>
                                                    <p class="hidden userRoleIdHidden">
                                                        {{ capitalizeEachWord($user->user_role_id) }}</p>
                                                    <p class="hidden userIdHidden">
                                                        {{ $user->id }}</p>
                                                </div>
                                            </td>
                                            <td class="py-2 text-left">
                                                <span class="hidden" id="user_id_span">{{ $user->id }}</span>
                                                <span class="truncate block emailHidden">{{ $user->email }}</span>
                                            </td>
                                            <td class="py-2 text-left">
                                                <div class="flex space-x-2 text-xs">
                                                    <span class="date">2025.08.07</span>
                                                    <span class="time text-gray-500">07.45 AM</span>
                                                </div>
                                            </td>
                                            <td class="py-2 text-left">
                                                <span class="truncate block">{{ $user->mobile_number_1 }}</span>
                                            </td>
                                            <td class="py-2 text-left">
                                                <span class="truncate block">{{ $user->nic_number }}</span>
                                            </td>
                                            <td class="py-2 text-center">
                                                @php
                                                    $selected_role =
                                                        $all_active_user_roles->firstWhere('id', $user->user_role_id)
                                                            ->role_name ?? '';
                                                @endphp

                                                <span
                                                    class="bg-blue-600 p-1 px-2 rounded-md text-white text-xs inline-block text-center min-w-[100px]">
                                                    {{ capitalizeEachWord($selected_role) }}
                                                </span>
                                            </td>
                                            <td class="py-2 text-center">
                                                @if ($user->status == 'ACTIVE')
                                                    <p id="activeMemberStatus" class="items-center">
                                                        <span
                                                            class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                                                    </p>
                                                @else
                                                    <p id="inactiveMemberStatus" class="items-center hidden">
                                                        <span
                                                            class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                                                    </p>
                                                @endif


                                            </td>
                                            <td class="py-2 text-center">
                                                <div class="flex justify-center items-center gap-1">
                                                    <a href="#"
                                                        class="border rounded hover:bg-blue-700 flex-shrink-0 edit-user">
                                                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                            alt="Edit" class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="#"
                                                        class="border rounded hover:bg-red-500 flex-shrink-0 delete-user">
                                                        <img src="{{ asset('assets/icons/Trash.svg') }}" alt="Delete"
                                                            class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="#"
                                                        class="border rounded hover:bg-yellow-500 flex-shrink-0 change-password">
                                                        <img src="{{ asset('assets/icons/Lock.svg') }}"
                                                            alt="Change Password" class="h-3 w-3 m-1">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="hidden mt-4 mx-4 lg:flex justify-between items-center text-xs text-gray-500">
                    <span id="paginationRange">1-10 of 87</span>
                    <div class="flex justify-center items-center">
                        <div class="pr-8">
                            <select id="rowsPerPage" class="rounded bg-sky-50 text-xs">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                            <span>Rows per page</span>
                        </div>
                        <button id="prevPage"
                            class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Previous" class="h-3 w-3">
                        </button>
                        <span id="pageIndicator" class="px-2 text-xs">1/15</span>
                        <button id="nextPage"
                            class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <img src="{{ asset('assets/icons/CaretRight.svg') }}" alt="Next" class="h-3 w-3">
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Add alternating background colors to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#loanIssueTable tbody tr');
            rows.forEach((row, index) => {
                // Add alternating background colors
                row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');

                // Ensure hover color overrides the background
                row.classList.add('hover:bg-sky-100');
            });
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view (cards)
            const cards = document.querySelectorAll('#userGrid > div');
            cards.forEach(card => {
                const managerName = card.getAttribute('data-name')?.toLowerCase() || '';
                const centerName = card.getAttribute('data-NIC')?.toLowerCase() || '';
                const isMatch = managerName.includes(searchTerm) || centerName.includes(searchTerm);
                card.style.display = isMatch ? 'block' : 'none';
            });

            // Desktop view (table rows)
            const tableRows = document.querySelectorAll('#userTable tbody tr');
            tableRows.forEach(row => {
                const managerName = row.getAttribute('data-name')?.toLowerCase() || '';
                const centerName = row.getAttribute('data-NIC')?.toLowerCase() || '';
                const isMatch = managerName.includes(searchTerm) || centerName.includes(searchTerm);
                row.style.display = isMatch ? '' : 'none';
            });
        });

        // Toggle Branch Dropdown
        function toggleDropdownBranch() {
            const dropdownMenu = document.getElementById('dropdownMenuBranch');
            dropdownMenu.classList.toggle('hidden');
        }

        // Select Branch Option
        function selectBranch(value) {
            const selectedOption = document.getElementById('selectedOptionBranch');
            const selectElement = document.getElementById('branchSelect');
            selectedOption.textContent = value.charAt(0).toUpperCase() + value.slice(1);
            selectElement.value = value;
            toggleDropdownBranch();
            filterData();
        }

        // Toggle Center Dropdown
        function toggleDropdownCenter() {
            const dropdownMenu = document.getElementById('dropdownMenuCenter');
            dropdownMenu.classList.toggle('hidden');
        }

        // Select Center Option
        function selectCenter(value) {
            const selectedOption = document.getElementById('selectedOptionCenter');
            const selectElement = document.getElementById('centerSelect');
            selectedOption.textContent = value;
            selectElement.value = value;
            toggleDropdownCenter();
            filterData();
        }

        // Placeholder filterData function
        function filterData() {
            const branch = document.getElementById('branchSelect').value;
            const center = document.getElementById('centerSelect').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            console.log('Filtering data:', {
                branch,
                center,
                startDate,
                endDate
            });
            // Implement actual filtering logic here
            // For example, filter the table or cards based on these values
        }

        function toggleActive(element) {
            element.classList.toggle('active');

            // Get user info for backend update
            const isActive = element.classList.contains('active');
            const row = element.closest('tr');
            const userId = row.querySelector('td:first-child').textContent;

            console.log(`User ${userId} is now ${isActive ? 'active' : 'inactive'}`);
        }

        // Add New Member Modal
        document.getElementById('addNewMember').addEventListener('click', function() {
            document.getElementById('addNewUserModal').classList.remove('hidden');
            document.getElementById('addNewUserModal').classList.add('flex');
        });

        document.getElementById('cancelNewMember').addEventListener('click', function() {
            document.getElementById('addNewUserModal').classList.add('hidden');
        });

        // Add event listeners to edit buttons (Updated for both table and card views)
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a.edit-user');
            if (!target) return;

            e.preventDefault();
            const container = target.closest('tr') || target.closest('div');

            let name, email, phone, nic, role, password, id;

            console.log("hi");
            if (container.tagName === 'TR') {
                first_name = container.querySelector('.firstNameHidden').textContent.trim();
                last_name = container.querySelector('.lastNameHidden').textContent.trim();
                id = container.querySelector('.userIdHidden').textContent.trim();
                email = container.querySelector('.emailHidden').textContent.trim();
                phone = container.querySelector('td:nth-child(5) span').textContent.trim();
                nic = container.querySelector('td:nth-child(6) span').textContent.trim();
                role = container.querySelector('.userRoleIdHidden').textContent.trim();
                password = target.dataset.password;
            } else if (container.tagName === 'DIV') {
                name = container.querySelector('div:nth-child(1) div:nth-child(1) p:nth-child(2)').textContent
                    .trim();
                email = container.querySelector('div:nth-child(2) div:nth-child(1) p:nth-child(2)').textContent
                    .trim();
                phone = container.querySelector('div:nth-child(2) div:nth-child(2) p:nth-child(2)').textContent
                    .trim();
                nic = container.getAttribute('data-NIC') || '';
                role = container.querySelector('div:nth-child(2) div:nth-child(4) span').textContent.trim();
                password = '********'; // Placeholder, adjust as needed
            }
            console.log(role);

            // Populate edit modal fields
            document.getElementById('editMemberId').value = id || '';
            document.getElementById('editMemberFirstName').value = first_name || '';
            document.getElementById('editMemberLastName').value = last_name || '';
            document.getElementById('editMemberEmail').value = email || '';
            document.getElementById('editMemberNIC').value = nic || '';
            document.getElementById('editMemberMobile01').value = phone || '';
            document.getElementById('editMemberRole').value = role || 0;
            document.getElementById('editMemberPassword').value = password || '********';
            document.getElementById('editMemberPassword').type = 'password';

            /*  console.log('Populating edit modal with:', {
                 userId,
                 firstName,
                 lastName,
                 email,
                 nic,
                 phone,
                 role,
                 password
             }); */

            // Show edit modal
            document.getElementById('editUserModal').classList.remove('hidden');
            document.getElementById('editUserModal').classList.add('flex');
        });

        // Toggle password visibility
        document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('editMemberPassword');
            const eyeIcon = document.getElementById('passwordEyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        });

        // Cancel edit modal
        document.getElementById('cancelEditMember').addEventListener('click', function() {
            document.getElementById('editUserModal').classList.add('hidden');
            document.getElementById('editUserModal').classList.remove('flex');
        });
        const userId = document.getElementById('user_id_span').innerText.trim();

        const confirmDelete = document.getElementById('confirmDeleteUser');
        confirmDelete.addEventListener(
            'click', () => {
                fetch(`/userAccount/delete/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('deleteUserModal').classList.add('hidden');
                        document.getElementById('deleteUserModal').classList.remove('flex');
                        alert(data.message);
                        const viewCenterBladeUrl = "{{ route('user.viewblade') }}";
                        window.location.href = viewCenterBladeUrl;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert(error);

                    });
            });
        // Save edit modal form
        document.getElementById('editMemberForm').addEventListener('submit', function(e) {

            const formData = new FormData();
            formData.append('id', document.getElementById('editMemberId').value);
            formData.append('first_name', document.getElementById('editMemberFirstName').value);
            formData.append('last_name', document.getElementById('editMemberLastName').value);
            formData.append('email', document.getElementById('editMemberEmail').value);
            formData.append('password', document.getElementById('editMemberPassword').value);
            formData.append('nic', document.getElementById('editMemberNIC').value);
            formData.append('mobile', document.getElementById('editMemberMobile01').value);
            formData.append('role_id', document.getElementById('editMemberRole').value);
            const imageFile = document.getElementById('editMemberImage').files[0];
            if (imageFile) {
                formData.append('userImage01', imageFile); // Must match the name used in your Laravel controller
            }

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('user.update') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    body: formData
                })
                .then(response => response.json().then(data => ({
                    status: response.status,
                    body: data
                })))
                .then(({
                    status,
                    body
                }) => {
                    if (status >= 200 && status < 300) {
                        console.log('User updated successfully:', body);
                        document.getElementById('editUserModal').classList.add('hidden');
                        document.getElementById('editUserModal').classList.remove('flex');
                        alert(body.message || 'User updated successfully');

                        // Optional: redirect or reload
                        const viewBladeUrl = "{{ route('user.viewblade') }}";
                        window.location.href = viewBladeUrl;
                    } else {
                        console.error('Update failed:', body);
                        alert('Error: ' + (body.message || 'Update failed'));
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('An unexpected error occurred');
                });
        });


        // Change Password Modal
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a.change-password');
            if (!target) return;

            e.preventDefault();
            const container = target.closest('tr') || target.closest('div');
            const userId = container.querySelector('.userIdHidden').textContent.trim();

            // Populate change password modal with user ID
            document.getElementById('changePasswordUserId').value = userId;

            // Show change password modal
            document.getElementById('changePasswordModal').classList.remove('hidden');
            document.getElementById('changePasswordModal').classList.add('flex');
        });

        document.getElementById('cancelChangePassword').addEventListener('click', function() {
            document.getElementById('changePasswordModal').classList.add('hidden');
            document.getElementById('changePasswordModal').classList.remove('flex');
        });

        document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const errorContainer = document.getElementById('passwordChangeError');
            errorContainer.textContent = '';

            const userId = document.getElementById('changePasswordUserId').value.trim();
            const currentPassword = document.getElementById('currentPassword').value.trim();
            const newPassword = document.getElementById('newPassword').value.trim();
            const confirmPassword = document.getElementById('confirmPassword').value.trim();

            if (!userId || !currentPassword || !newPassword || !confirmPassword) {
                errorContainer.textContent = 'All fields are required.';
                return;
            }

            if (newPassword !== confirmPassword) {
                errorContainer.textContent = 'New password and confirm password do not match.';
                return;
            }

            try {
                const response = await fetch('/userAccount/updatepw', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        current_password: currentPassword,
                        new_password: newPassword
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        const firstErrorKey = Object.keys(data.errors)[0];
                        const firstErrorMessage = data.errors[firstErrorKey][0];
                        errorContainer.textContent = firstErrorMessage;
                    } else {
                        errorContainer.textContent = data.message || 'Something went wrong.';
                    }
                    return;
                }

                alert(data.message || 'Password changed successfully!');
                document.getElementById('changePasswordModal').classList.add('hidden');
                document.getElementById('changePasswordModal').classList.remove('flex');
                document.getElementById('changePasswordForm').reset();

            } catch (err) {
                console.error('Error:', err);
                errorContainer.textContent = err.message || 'Server error. Please try again.';
            }
        });


        // Delete User Modal
        document.addEventListener('click', function(e) {
            const target = e.target.closest('a.delete-user');
            if (!target) return;

            e.preventDefault();
            const container = target.closest('tr') || target.closest('div');
            const userId = target.getAttribute('data-id');

            // Populate delete modal with user ID
            document.getElementById('deleteUserId').value = userId;

            // Show delete modal
            document.getElementById('deleteUserModal').classList.remove('hidden');
            document.getElementById('deleteUserModal').classList.add('flex');
        });

        document.getElementById('cancelDeleteUser').addEventListener('click', function() {
            document.getElementById('deleteUserModal').classList.add('hidden');
            document.getElementById('deleteUserModal').classList.remove('flex');
        });
    </script>
    <style>
        .toggle-switch {
            width: 36px;
            height: 20px;
            background-color: #ef4444;
            /* Red color when inactive */
            border-radius: 10px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle-switch.active {
            background-color: #16a34a;
            /* Green color when active */
        }

        .toggle-switch .toggle-slider {
            width: 16px;
            height: 16px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(16px);
        }
    </style>
@endsection
