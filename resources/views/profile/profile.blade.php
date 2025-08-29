@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full max-w-full">
        <div class="flex flex-col h-full w-full">
            <!--Header with Profile and Logout-->
            <div class="flex justify-between items-center rounded-lg mx-4 mt-1 py-1">
                <p class="text-sm text-gray-600 pl-4">Profile</p>
                <button
                    class="flex items-center space-x-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <a href="{{ route('user.logout') }}" class="flex items-center space-x-2">
                        <span class="text-xs">Logout</span>
                    </a> </button>
            </div>

            <!--Details Section-->
            <div class="flex flex-col rounded-lg border bg-gray-50 mx-4 my-1 h-3/5">
                <p class="w-full text-sm text-gray-500 pl-4 pt-3 pb-2">Details</p>
                <hr>
                <div class="flex flex-col lg:flex-row items-center justify-center w-full h-full lg:space-x-6 px-4 ">
                    <!-- Profile Picture Section -->
                    <div class="w-1/5  flex flex-col items-center justify-center rounded-md px-4 lg:py-2 py-8 ">
                        <div
                            class="w-32 h-32 rounded-full border-2 border-dashed border-gray-400 flex justify-center items-center">
                            <div
                                class="w-28 h-28 rounded-full bg-gray-200 border-1 border-gray-300 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <!--<button class="text-sm text-blue-600 hover:text-blue-800 mt-2">Upload photo</button>-->
                        <div class="text-xs  mt-2 text-center hidden">
                            <p class="text-gray-400">Allowed format</p>
                            <p class="text-gray-900">JPG, JPEG, and PNG</p>
                            <p class=" text-gray-400">Max file size</p>
                            <p class="text-gray-900">2MB</p>
                        </div>
                    </div>

                    <!-- Form Fields Section -->
                    <div class="w-full lg:w-2/5 space-y-4 ">
                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">First name</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ capitalizeEachWord(Auth::check() ? Auth::user()->first_name : 'NA') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">Email address</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ Auth::check() ? Auth::user()->email : 'NA' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">Role</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ capitalizeEachWord(Auth::check() ? Auth::user()->user_role->role_name : 'NA') }}</p>
                        </div>
                    </div>

                    <!-- Additional Fields Section -->
                    <div class="w-full lg:w-2/5 space-y-4 py-4 lg:py-0 ">
                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">Last name</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ capitalizeEachWord(Auth::check() ? Auth::user()->last_name : 'NA') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">NIC number</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ Auth::check() ? Auth::user()->nic_number : 'NA' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-normal text-gray-700 mb-1">Phone number</label>
                            <p class="w-full px-3 py-2 text-sm border bg-white border-gray-300 rounded-md text-gray-500">
                                {{ Auth::check() ? Auth::user()->mobile_number_1 : 'NA' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--Password Change Section-->
            {{--  <div class="flex flex-col rounded-lg border bg-gray-50 mx-4 my-2 mb-4 h-2/5 ">
                <p class="w-full text-sm text-gray-500 pl-4 pt-3 pb-2 ">Change Password</p>
                <hr>
                <div class="flex flex-col space-y-4 px-4 pt-00 pb-4 pt-4 h-full justify-center">
                    <div class="w-full lg:w-1/3">
                        <label class="block text-sm font-normal text-gray-700 mb-1 ">Current Password*</label>
                        <input type="password" placeholder="Enter Current Password"
                            class="w-full lg:w-80 pr-4 max-w-sm px-3 lg:py-1.5 py-2  border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-500">
                    </div>

                    <div class="flex lg:space-x-4 flex-col lg:flex-row">
                        <div class="w-full lg:w-2/3 flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
                            <div class="w-full lg:w-1/2">
                                <label class="block text-sm font-normal text-gray-700 mb-1">New Password*</label>
                                <input type="password" placeholder="Enter New Password"
                                    class="w-full lg:w-80 px-3 max-w-sm lg:py-1.5 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-500">
                            </div>
                            <div class="w-full lg:w-1/2">
                                <label class="block text-sm font-normal text-gray-700 mb-1">Confirm Password*</label>
                                <input type="password" placeholder="Enter New Password"
                                    class="w-full lg:w-80 px-3 max-w-sm lg:py-1.5 py-2  border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-500">
                            </div>
                        </div>
                        <!--Button-->
                        <div
                            class="flex lg:justify-end space-x-3  items-end lg:text-xs text-sm lg:w-1/3 w-full justify-center pt-8 lg:pt-0">
                            <button
                                class="px-8 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors w-1/2 lg:w-36">
                                Save
                            </button>
                            <button
                                class="px-8 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors w-1/2 lg:w-36">
                                Edit
                            </button>
                        </div>

                    </div>

                </div>
            </div> --}}
        </div>
    </div>

    <script>
        // Add any JavaScript functionality here if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Profile picture upload functionality
            const uploadBtn = document.querySelector('button[class*="text-blue-600"]');
            if (uploadBtn) {
                uploadBtn.addEventListener('click', function() {
                    // Create file input
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.accept = 'image/jpeg,image/jpg,image/png';
                    fileInput.style.display = 'none';

                    fileInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            // Handle file upload logic here
                            console.log('File selected:', file.name);
                        }
                    });

                    document.body.appendChild(fileInput);
                    fileInput.click();
                    document.body.removeChild(fileInput);
                });
            }

            // Form validation
            const form = document.querySelector('#mainContent');
            if (form) {
                const inputs = form.querySelectorAll('input');
                inputs.forEach(input => {
                    input.addEventListener('blur', function() {
                        if (this.hasAttribute('required') && !this.value.trim()) {
                            this.classList.add('border-red-500');
                        } else {
                            this.classList.remove('border-red-500');
                        }
                    });
                });
            }
        });
    </script>

    <style>
        /* Custom styles for better appearance */
        input:focus,
        select:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Placeholder styling */
        input::placeholder,
        select option:first-child {
            color: #9CA3AF;
        }

        /* Button hover effects */
        button {
            transition: all 0.2s ease-in-out;
        }

        /* File upload area styling */
        .file-upload-area {
            border: 2px dashed #D1D5DB;
            border-radius: 8px;
            transition: border-color 0.2s ease-in-out;
        }

        .file-upload-area:hover {
            border-color: #3B82F6;
        }
    </style>
@endsection
