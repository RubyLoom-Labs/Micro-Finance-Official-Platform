@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="mainContent" class="flex lg:h-full">
        <!-- First Column -->
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300  lg:relative space-y-2">

            <!-- Add New Member Modal -->
            {{--  <div id="addMemberModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-md rounded-lg ">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add Member</h2>
                    <form id="addmemberForm">
                        <div class="bg-white rounded-b-lg p-4 space-y-4">
                            <div class="flex justify-center space-x-4 mt-4">
                                <button type="button" id="addExistingMember"
                                    class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Add Existing Member
                                </button>
                                <button type="button" id="addNewMember"
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none text-sm">
                                    Add New Member
                                </button>
                            </div>
                            <div class="flex justify-center items-end pt-8">
                                <button type="button" id="cancelMember"
                                    class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sx">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <!-- Add Existing Member Modal -->
            {{--  <div id="addExistingMemberModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-md rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add Existing Members</h2>
                    <div class="bg-white rounded-b-lg p-4 space-y-4">
                        <div>
                            <input type="text" id="searchExistingMembers" placeholder="Search members..."
                                class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        </div>
                        <div id="existingMembersList" class="max-h-40 overflow-y-auto space-y-2 text-sm">
                            <!-- Dynamic member list will be populated here -->
                        </div>
                        <div class="flex justify-end space-x-4 mt-4">
                            <button type="button" id="cancelExistingMember"
                                class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                Cancel
                            </button>
                            <button type="button" id="okExistingMember"
                                class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Add New Member Modal -->
            <div id="addNewMemberModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Member</h2>
                    <form id="addNewMemberForm" method="POST" action="{{ route('members.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white rounded-b-lg p-4 space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="newMemberBranch"
                                    class="block text-xs text-gray-400 mb-1 ml-2 w-36">Branch*</label>
                                <input type="text" id="newMemberBranch" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    value={{ capitalizeFirstLetter($group_details->center->branch->branch_name) }}
                                    disabled />
                            </div>
                            <input type="hidden" name="branch_id" value="{{ $group_details->center->branch->id }}" />
                            <div class="flex items-center space-x-4">
                                <label for="newMemberCenter" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Center
                                    Name*</label>
                                <input type="text" id="newMemberCenter" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    value={{ capitalizeFirstLetter($group_details->center->center_name) }} disabled />
                            </div>
                            <input type="hidden" name="center_id" value="{{ $group_details->center->id }}" />
                            <div class="flex items-center space-x-4">
                                <label for="newMemberGroup" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Group
                                    Name*</label>
                                <input type="text" id="newMemberGroup" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    value="{{ capitalizeFirstLetter($group_details->group_name) }}" disabled />
                            </div>
                            <input type="hidden" name="group_id" value="{{ $group_details->id }}" />
                            <div class="flex items-center space-x-4">
                                <label for="newMemberFullName" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Full
                                    Name*</label>
                                <input type="text" id="newMemberFullName" placeholder="" name="memberFullName"
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex justify-between w-full space-x-4">
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile01" class="block text-xs text-gray-400 mb-1 ml-2">Mobile
                                        Number 01</label>
                                    <input type="tel" id="newMemberMobile01" placeholder="" name="memberPhoneNumber01"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile02" class="block text-xs text-gray-400 mb-1 ml-2">Mobile
                                        Number 02</label>
                                    <input type="tel" id="newMemberMobile02" placeholder="" name="memberPhoneNumber02"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberAddress"
                                    class="block text-xs text-gray-400 mb-1 ml-2 w-36">Address</label>
                                <input type="text" id="newMemberAddress" placeholder="" name="memberAddress"
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div class="flex justify-between">
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberNIC" class="block text-xs text-gray-400 mb-1 ml-2 w-36">NIC</label>
                                    <input type="text" id="newMemberNIC" placeholder="" name="memberNicNumber"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="w-1/2 flex items-center space-x-4 pl-8">
                                    <label class="text-xs text-gray-400 w-1/2"><input type="radio" name="memberGender"
                                            value="Male" class="p-1 " /> Male</label>
                                    <label class="text-xs text-gray-400 w-1/2"><input type="radio" name="memberGender"
                                            value="Female" class="p-1 " /> Female</label>

                                </div>
                            </div>
                            <div class="flex justify-between items-center ">

                                <label class="block text-xs text-gray-400 mb-1 ml-2 mr-2">Image*</label>
                                <input type="file" id="newMemberImage" name="memberImage01"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />

                                {{-- <div>
                                    <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                    <input type="file" id="newMemberImage"
                                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                        required />
                                </div> --}}
                            </div>
                            <div class="flex justify-end space-x-4 mt-2">
                                <button type="button" id="cancelNewMember"
                                    class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-col h-full lg:h-auto space-y-4 pb-4">
                <div class="flex w-full justify-between iteam-center">
                    <div class="w-24 text-sm lg:text-xs  ">
                        <button id="getGroupSummary" value="" onclick="window.history.back();"
                            class="w-full bg-gray-100 text-gray-700 p-1 rounded-lg hover:bg-gray-300 focus:outline-none flex  items-center pl-4">
                            <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Pencil" class="h-3 w-3 m-1"> Back
                        </button>
                    </div>
                    {{-- <div class="w-40 text-sm lg:text-xs ">
                        <button id="getGroupSummary" value=""
                            class="w-full bg-blue-600 text-white p-1 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center">
                            <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                                class="h-3 w-3 m-1"> Get Group Summary
                        </button>
                    </div> --}}

                </div>
                <form action="{{ route('groups.updateGroup', ['groupId' => $group_details->id]) }}" method="POST">
                    @csrf
                    <div class="flex flex-col lg:flex-row border rounded-lg py-4 px-4 h-full ">
                        <!-- Center Details -->
                        <div class="w-full lg:w-2/3 h-full">
                            <h1 class="text-md font-medium text-gray-800 mb-2">Group Details</h1>
                            <div class="grid-cols-2 grid lg:grid-cols-3 gap-y-2 gap-x-4">
                                <!-- Name -->
                                <div>
                                    <p class="text-xs text-gray-400">Name</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeFirstLetter($group_details->group_name) }}</span>
                                        <span id="group_id_span" class="hidden">{{ $group_details->id }}</span>

                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            name="group_name"
                                            value="{{ capitalizeFirstLetter($group_details->group_name) }}">
                                    </p>
                                </div>

                                <!-- Center Manager -->
                                <div>
                                    <p class="text-xs text-gray-400">Center</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeFirstLetter($group_details->center->center_name) }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value="{{ capitalizeFirstLetter($group_details->center->center_name) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Branch -->
                                <div>
                                    <p class="text-xs text-gray-400">Branch</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeFirstLetter($group_details->center->branch->branch_name) }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value="{{ capitalizeFirstLetter($group_details->center->branch->branch_name) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Total Group -->
                                <div>
                                    <p class="text-xs text-gray-400">Center Manager</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeEachWord($group_details->center->manager_name) }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value="{{ capitalizeEachWord($group_details->center->manager_name) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Total Members -->
                                <div class="lg:block">
                                    <p class="text-xs text-gray-400">Total Members</p>
                                    <p class="text-sm">
                                        <span class="view-mode">
                                            {{ str_pad($group_details->member->count(), 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                        <input type="number" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value="{{ str_pad($group_details->member->count(), 2, '0', STR_PAD_LEFT) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Payment Date -->
                                <div>
                                    <p class="text-xs text-gray-400">Payment Date</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeFirstLetter($group_details->center->payment_date) }}</span>
                                        <input class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value="{{ capitalizeFirstLetter($group_details->center->payment_date) }}"
                                            disabled>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex w-full lg:w-1/3 justify-between lg:justify-end items-end space-x-2 pt-4 ">
                            <div class="flex flex-row lg:space-x-2 bg-white lg:text-xs w-full justify-end">
                                <!-- Edit -->
                                <button id="editBtn" type="button"
                                    class="bg-blue-600 text-white p-1 lg:p-2 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 w-1/2 lg:w-28 mr-2 lg:mr-0">
                                    <img src="{{ asset('assets/icons/PencilSimpleWhite.svg') }}" alt="Edit"
                                        class="h-3 w-3 mr-2">
                                    <span>Edit</span>
                                </button>

                                <!-- Save -->
                                <button id="saveBtn" type="submit"
                                    class="bg-green-600 text-white p-1 lg:p-2 rounded-lg hover:bg-green-700 hidden  items-center justify-center px-6 w-1/2 lg:w-28  mr-2 lg:mr-0">
                                    <img src="{{ asset('assets/icons/VectorWhite.svg') }}" alt="Save"
                                        class="h-3 w-3 mr-2">
                                    <span>Save</span>
                                </button>

                                <!-- Delete -->
                                <button id="deleteBtn" type="button"
                                    class="bg-red-600 text-white p-1 lg:p-2 rounded-lg hover:bg-red-700 flex items-center justify-center px-4 w-1/2 lg:w-28">
                                    <img src="{{ asset('assets/icons/TrashWhite.svg') }}" alt="Delete"
                                        class="h-3 w-3 mr-2">
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteModal"
                        class="fixed inset-0  items-center justify-center bg-black bg-opacity-40 hidden z-50 h-full">
                        <div class="bg-white p-6 rounded-lg shadow-md text-center w-1/3 h-30">
                            <p class="text-md font-semibold mb-4">Are you sure you want to delete this Group?</p>
                            <div class="flex justify-center space-x-4">
                                <button id="cancelDelete"
                                    class="bg-gray-300 text-black p-2 rounded-lg hover:bg-gray-500 flex items-center px-4 text-xs">
                                    <span>Cancel</span>
                                </button>
                                <button id="confirmDelete"
                                    class="bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 flex items-center px-4 text-xs">
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-max ">

                <!-- Top Bar -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1">
                    <div class="flex items-center  lg:space-x-2 w-full">
                        <!-- Filter Button -->
                        <div class="hidden lg:flex text-sm ">
                            <button value="" class="bg-white p-2 rounded-lg focus:outline-none border w-8">
                                <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                            </button>
                        </div>

                        <!-- Search Bar -->
                        <div class="w-full text-sm lg:text-xs lg:w-5/12">
                            <input type="text" id="searchMember" placeholder="Search Member..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                    </div>
                    <!-- Add Center Button -->
                    <div class="w-full text-sm lg:text-xs lg:w-3/12">
                        @if (Auth::user()->user_role->members == 2 || Auth::user()->user_role->members == 3)
                            <button id="addMemberButton" value="add_new"
                                class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                                + Add Memeber
                            </button>
                        @endif
                    </div>
                </div>

                <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Total members
                    {{ str_pad($group_details->member->count(), 2, '0', STR_PAD_LEFT) }}</p>

                <div id="membersGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4 p-2">
                    @foreach ($group_details->member as $member)
                        <a href="{{ url('/memberSummery/' . $member->id) }}" class="block">
                            <div
                                class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-100 border hover:bg-gray-200">
                                <div class=" py-2 px-4 flex flex-row justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-left">
                                        <p class="text-sm font-bold  text-gray-700">
                                            {{ capitalizeEachWord($member->full_name) }} <span> -
                                                {{ capitalizeFirstLetter($group_details->center->center_name) }} </span>
                                        </p>
                                        <p class="text-xs font- text-gray-400">{{ $member->nic_number }} </p>
                                    </div>

                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <p class="text-sm font-bold  text-gray-700">11515155</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <!-- Centers Grid card format hidden for lg screens -->


                <div class="flex justify-start h-full ">
                    <!-- Grid Table format hidden for mobile screens -->
                    <div id="membersGridTable"
                        class="w-full max-h-[calc(100vh-400px)] hidden lg:block p-0  overflow-y-auto">
                        <div class="min-w-full ">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="py-2 text-center">#</th>
                                        <th class="py-2 text-left">Name</th>
                                        <th class="py-2 text-left">Status</th>
                                        <th class="py-2 text-left">Center</th>
                                        <th class="py-2 text-left">NIC </th>
                                        <th class="py-2 text-left">Loan Balance</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-xs font-light bg-white">
                                    <!-- AROW -->
                                    @foreach ($group_details->member as $member)
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                            data-member-id={{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                                            data-member-name='{{ capitalizeEachWord($member->full_name) }}'
                                            data-center-name='{{ capitalizeFirstLetter($group_details->center->center_name) }}'
                                            data-group-name='{{ capitalizeEachWord($group_details->group_name) }}'
                                            data-branch-name='{{ capitalizeFirstLetter($group_details->center->branch->branch_name) }}'
                                            data-received="40000" data-member-object='@json($member)'>
                                            <td class="py-2 text-center">
                                                {{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                        </div>
                        </td>
                        <td class="py-2 text-left">{{ capitalizeEachWord($member->full_name) }}</td>
                        @if ($member->status == 'ACTIVE')
                            <td id="activeMemberStatus" class="items-center">
                                <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                            </td>
                        @else
                            <td id="inactiveMemberStatus" class="items-center ">
                                <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                            </td>
                        @endif


                        <td class="py-2 text-left">{{ capitalizeFirstLetter($group_details->center->center_name) }}</td>
                        <td class="py-2 text-left"> {{ $member->nic_number }}</td>
                        @php
                            $total_paid_amount = collect(
                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))->installment,
                            )->sum('amount');
                            $total_balance =
                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))->loan_amount +
                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))->interest -
                                $total_paid_amount;
                        @endphp
                        <td class="py-2 text-left">Rs. {{ number_format($total_balance, 2) }}</td>
                        <td class="py-2 text-center flex justify-center items-center gap-1">
                            <a href="{{ url('/memberSummery/' . $member->id) }}"
                                class="border rounded hover:bg-green-500">
                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                            </a>
                            <a href="#" class="border rounded hover:bg-sky-500">
                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil"
                                    class="h-3 w-3 m-1">
                            </a>
                            <a href="#" class="border rounded hover:bg-lime-500">
                                <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                            </a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="hidden mt-4 mx-4 lg:flex justify-between items-center text-xs text-gray-500">
                <span>1-10 of 87</span>
                <div class="flex justify-center items-center">
                    <div class="pr-8">
                        <select class="rounded bg-sky-50">
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                        </select>
                        <span>Rows per page</span>
                    </div>
                    <button class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200">
                        <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                    </button>
                    <span class="px-2 text-xs">1/15</span>
                    <button class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200">
                        <img src="{{ asset('assets/icons/CaretRight.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Column: Row Details -->
    <div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
        <div id="RowDetailsContent" class="border-b p-4">
            <div class="flex items-baseline space-x-2">
                <h1 id="memberNameSlideBar" class="text-md font-medium text-gray-800 mb-1">--</h1>
                <h1 id="memberIdShow" class="text-md font-medium text-gray-800 hidden"></h1>
                <p id="activeMemberStatus" class="items-center">
                    <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                </p>
                <p id="inactiveMemberStatus" class="items-center hidden">
                    <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                </p>
            </div>

            <h1 id="memberName" class="text-xs text-gray-600 mb-4"><span id="branchNameSlideBar">--</span> > <span
                    id="centerNameSlideBar">--</span> >
                <span id="groupNameSlideBar">--</span>
            </h1>
            <div class="grid grid-cols-2 gap-y-2">
                <div>
                    <p for="num01" class="text-xs text-gray-400">Mobile number 01</p>
                    <p id="num01SlideBar" class="text-sm">--</p>
                </div>
                <div>
                    <p for="num02" class="text-xs text-gray-400">Mobile number 02</p>
                    <p id="num02SlideBar" class="text-sm">--</p>
                </div>
                <div>
                    <p for="NIC" class="text-xs text-gray-400">NIC</p>
                    <p id="nicSlideBar" class="text-sm">--</p>
                </div>
                <div>
                    <p for="Attach" class="text-xs text-gray-400">Attach</p>
                    <p id="Attach" class="text-sm flex">
                        <a href="#" class="border rounded hover:bg-green-500">
                            <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                        </a>
                        <span class="ml-2">Img.pn</span>
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-y-2 mt-2">
                <div>
                    <p for="memberAddress" class="text-xs text-gray-400">Address</p>
                    <p id="memberAddressSlideBar" class="text-sm mt-0">--</p>
                </div>
            </div>
        </div>
        <div class=" space-y-4 h-full ">
            <div class="p-4 border-b w-full">
                <h1 id="" class="text-sm font-medium text-gray-800 mb-1">Current Loan Details</h1>
                <div class="grid grid-cols-3 gap-y-2">
                    <div>
                        <p for="LoanAmount" class="text-xs text-gray-400">Loan Amount</p>
                        <p id="LoanAmountSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Interest" class="text-xs text-gray-400">Interest</p>
                        <p id="InterestSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="IssueDate" class="text-xs text-gray-400">Issue Date</p>
                        <p id="IssueDateSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Installment" class="text-xs text-gray-400">Installment</p>
                        <p id="InstallmentSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Terms" class="text-xs text-gray-400">Terms</p>
                        <p id="TermsSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="DocumentChagers" class="text-xs text-gray-400">Document Chagers</p>
                        <p id="DocumentChagersSlideBar" class="text-sm">--</p>
                    </div>

                </div>
                <div class="w-full text-sm lg:text-xs  pt-4">
                    <button id="addLoanButton"
                        class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        + Add Loan
                    </button>
                </div>
            </div>
        </div>
        <div class=" p-4 border-t">
            <div class="w-full text-sm lg:text-xs  pt-4">
                <button id="ViewFullDetail"
                    class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                    View Full Detail
                </button>

            </div>

        </div>

    </div>

    </div>

    <script>
        // Add alternating background colors to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#centersGridTable tbody tr');
            rows.forEach((row, index) => {
                // Add alternating background colors
                row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');

                // Ensure hover color overrides the background
                row.classList.add('hover:bg-sky-100');
            });
        });
        document.getElementById('addLoanButton').addEventListener('click', function() {
            console.log("hi")
            const memberId = document.getElementById('memberIdShow').textContent;
            const url = `{{ route('member.summary', ['memberId' => 'MEMBER_ID_PLACEHOLDER']) }}`.replace(
                'MEMBER_ID_PLACEHOLDER', memberId);
            window.location.href = url;
        });
        // Search Filter for both mobile and web views
        document.getElementById('searchMember').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view (cards)
            const cards = document.querySelectorAll('#membersGrid > div');
            cards.forEach(card => {
                const memberName = card.getAttribute('data-member-name').toLowerCase();
                card.style.display = memberName.includes(searchTerm) ? 'block' : 'none';
            });

            // Web view (table rows)
            const tableRows = document.querySelectorAll('#membersGridTable tbody tr');
            tableRows.forEach(row => {
                const memberName = row.getAttribute('data-member-name').toLowerCase();
                row.style.display = memberName.includes(searchTerm) ? 'table-row' : 'none';
            });
        });

        //Group Details edit and delete functionality
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        const deleteModal = document.getElementById('deleteModal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');

        editBtn.addEventListener('click', () => {
            document.querySelectorAll('.view-mode').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.edit-mode').forEach(el => el.classList.remove('hidden'));
            editBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
            saveBtn.classList.add('flex');
        });


        deleteBtn.addEventListener('click', () => {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        });

        cancelDelete.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });
        const groupId = document.getElementById('group_id_span').innerText.trim();
        confirmDelete.addEventListener(
            'click', () => {
                fetch(`/groups/delete/${groupId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        deleteModal.classList.add('hidden');
                        alert(data.message);
                        const viewCenterBladeUrl = "{{ route('centers.viewblade') }}";
                        window.location.href = viewCenterBladeUrl;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert(error);

                    });
            });

        let select_member_id = '';
        // Row Summey
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', (e) => {
                const row = button.closest('tr');
                const RowDetails = document.getElementById('RowDetails');
                const firstColumn = document.getElementById('firstColumn');

                // Show second column
                RowDetails.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                RowDetails.classList.add('lg:flex');

                // Update second column content
                const member_name = row.getAttribute('data-member-name');
                const center_name = row.getAttribute('data-center-name');
                const branch_name = row.getAttribute('data-branch-name');
                const group_name = row.getAttribute('data-group-name');
                const memberObject = JSON.parse(row.getAttribute('data-member-object'));
                console.log(memberObject.address);
                select_member_id = memberObject.id;
                if (memberObject.status === 'INACTIVE') {
                    document.getElementById('activeMemberStatus').classList.add('hidden');
                    document.getElementById('inactiveMemberStatus').classList.remove('hidden');
                    document.getElementById('addLoanButton').classList.remove('hidden');

                }
                if (memberObject.status === 'ACTIVE') {
                    document.getElementById('activeMemberStatus').classList.remove('hidden');
                    document.getElementById('inactiveMemberStatus').classList.add('hidden');
                    document.getElementById('addLoanButton').classList.add('hidden');
                }

                document.getElementById('memberNameSlideBar').textContent = member_name;
                document
                    .getElementById('branchNameSlideBar').textContent = branch_name;
                document
                    .getElementById('centerNameSlideBar').textContent = center_name;
                document
                    .getElementById('groupNameSlideBar').textContent = group_name;
                document
                    .getElementById('num01SlideBar').textContent = memberObject.mobile_number_1;
                document
                    .getElementById('num02SlideBar').textContent = memberObject.mobile_number_2;
                document.getElementById(
                    'nicSlideBar').textContent = memberObject.nic_number;
                document.getElementById(
                    'memberAddressSlideBar').textContent = memberObject.address;
                document.getElementById('memberIdShow').textContent = memberObject.id;
                const uncompletedLoan = memberObject.loan.find(loan => loan.status === 'UNCOMPLETED');
                console.log(uncompletedLoan);
                document.getElementById('LoanAmountSlideBar').textContent =
                    uncompletedLoan ? 'Rs. ' + parseFloat(uncompletedLoan.loan_amount).toFixed(2) :
                    '--';
                document.getElementById('InterestSlideBar').textContent =
                    uncompletedLoan ? 'Rs. ' + parseFloat(uncompletedLoan.interest).toFixed(2) :
                    '--';
                document.getElementById('IssueDateSlideBar').textContent =
                    uncompletedLoan ? uncompletedLoan.issue_date : '--';
                document.getElementById('InstallmentSlideBar').textContent =
                    uncompletedLoan ? 'Rs. ' + parseFloat(uncompletedLoan.installment_price).toFixed(2) :
                    '--';
                document.getElementById('TermsSlideBar').textContent =
                    uncompletedLoan ? uncompletedLoan.terms : '--';
                document.getElementById('DocumentChagersSlideBar').textContent =
                    uncompletedLoan ? 'Rs. ' + parseFloat(uncompletedLoan.document_charges).toFixed(2) :
                    '--';
            });
        });
        document.getElementById('ViewFullDetail').addEventListener('click', () => {
            window.location.href = `/memberSummery/${select_member_id}`;
        });

        // Add Member Modal
        const existingMembers = [{
                id: 1,
                name: "John Doe",
                nic: "982563142V"
            },
            {
                id: 2,
                name: "Jane Smith",
                nic: "983214567V"
            },
            {
                id: 3,
                name: "Saman Perera",
                nic: "981234567V"
            },
            {
                id: 4,
                name: "Kamal Silva",
                nic: "980123456V"
            },
            {
                id: 5,
                name: "Nimal Fernando",
                nic: "984321567V"
            }
        ];

        let selectedMembers = [];
        document.addEventListener('DOMContentLoaded', function() {
            // Open Add Group Modal
            document.getElementById('addMemberButton').addEventListener('click', function() {
                document.getElementById('addNewMemberModal').classList.remove('hidden');
                document.getElementById('addNewMemberModal').classList.add('flex');
            });

            // Add Existing Member Modal
            document.getElementById('addExistingMember').addEventListener('click', function() {
                document.getElementById('addExistingMemberModal').classList.remove('hidden');
                document.getElementById('addExistingMemberModal').classList.add('flex');
                renderExistingMembers();
            });

            document.getElementById('searchExistingMembers').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                renderExistingMembers(searchTerm);
            });

            document.getElementById('okExistingMember').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll(
                    '#existingMembersList input[type="checkbox"]:checked');
                const newSelections = Array.from(checkboxes).map(cb => ({
                    id: cb.value,
                    name: cb.getAttribute('data-name'),
                    nic: cb.getAttribute('data-nic'),
                    type: 'existing'
                }));

                selectedMembers = [...selectedMembers, ...newSelections];
                if (selectedMembers.length > 6) {
                    selectedMembers = selectedMembers.slice(0, 6); // Limit to 6
                    alert("Maximum 6 members allowed. Excess members removed.");
                }
                document.getElementById('selectedMembers').textContent = selectedMembers.map(m => m
                        .name)
                    .join(', ') || 'No members selected';
                document.getElementById('addExistingMemberModal').classList.add('hidden');
            });

            document.getElementById('cancelExistingMember').addEventListener('click', function() {
                document.getElementById('addExistingMemberModal').classList.add('hidden');
            });

            // Add New Member Modal
            document.getElementById('addNewMember').addEventListener('click', function() {
                document.getElementById('addNewMemberModal').classList.remove('hidden');
                document.getElementById('addNewMemberModal').classList.add('flex');
            });

            document.getElementById('cancelNewMember').addEventListener('click', function() {
                document.getElementById('addNewMemberModal').classList.add('hidden');
            });

            document.getElementById('createNewMember').addEventListener('click', function(e) {
                e.preventDefault();
                const newMember = {
                    branch: document.getElementById('newMemberBranch').value,
                    center: document.getElementById('newMemberCenter').value,
                    group: document.getElementById('newMemberGroup').value,
                    fullName: document.getElementById('newMemberFullName').value,
                    mobile01: document.getElementById('newMemberMobile01').value,
                    mobile02: document.getElementById('newMemberMobile02').value,
                    address: document.getElementById('newMemberAddress').value,
                    nic: document.getElementById('newMemberNIC').value,
                    gender: document.querySelector('input[name="newMemberGender"]:checked')?.value,
                    image: document.getElementById('newMemberImage').files[0],
                    type: 'new'
                };

                if (!newMember.fullName || !newMember.image) {
                    alert("Full Name and Image are required.");
                    return;
                }

                selectedMembers.push(newMember);
                if (selectedMembers.length > 6) {
                    selectedMembers.pop();
                    alert("Maximum 6 members allowed. This member was not added.");
                } else {
                    document.getElementById('selectedMembers').textContent = selectedMembers.map(m => m
                        .fullName || m.name).join(', ') || 'No members selected';
                }
                document.getElementById('addNewMemberModal').classList.add('hidden');
                document.getElementById('addNewMemberForm').reset();
            });

            // Cancel Group Modal
            document.getElementById('cancelMember').addEventListener('click', function() {
                document.getElementById('addMemberModal').classList.add('hidden');
                document.getElementById('addmemberForm').reset();
                selectedMembers = [];
                document.getElementById('selectedMembers').textContent = 'No members selected';
            });

            function renderExistingMembers(searchTerm = '') {
                const list = document.getElementById('existingMembersList');
                list.innerHTML = '';
                const filteredMembers = existingMembers.filter(m => m.name.toLowerCase().includes(searchTerm));
                filteredMembers.forEach(member => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center justify-between';
                    div.innerHTML = `
            <span>${member.name} (${member.nic})</span>
            <input type="checkbox" value="${member.id}" data-name="${member.name}" data-nic="${member.nic}" class="form-checkbox h-4 w-4 text-blue-600 m-1">
        `;
                    list.appendChild(div);
                });
            }

        });
    </script>

    <style>
        /* Override any flex properties for hidden columns */
        #RowDetails.hidden,
        #centersColumn.hidden,
        #branchesColumn.hidden {
            display: none !important;
            visibility: hidden !important;
            width: 0 !important;
            min-width: 0 !important;
            flex: 0 !important;
        }

        /* Ensure first column takes full width when second columns are hidden */
    </style>
@endsection
