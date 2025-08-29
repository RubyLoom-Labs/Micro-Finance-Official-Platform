@extends('layouts.layout')
@php
    $count_total_members = 0;
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');

    $weekDays = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];
@endphp
@section('contents')
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="mainContent" class="flex lg:h-full">
        <!-- First Column -->
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300  lg:relative space-y-2">

            <!-- Add New Group Modal -->
            <div id="addGroupModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-md rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Group</h2>
                    <form id="addGroupForm" method="POST" action="{{ route('groups.creategroup') }}">
                        @csrf
                        <div class="bg-white rounded-b-lg p-4 space-y-4">
                            <div>
                                <label for="groupBranch" class="block text-xs text-gray-400 mb-1 ml-2">Branch*</label>
                                <input type="text" id="groupBranch" placeholder=""
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    value="{{ capitalizeEachWord($center_details->branch->branch_name) }}" disabled />
                                <input type="hidden" name="branch_id" value="{{ $center_details->branch->id }}" />

                            </div>
                            <div>
                                <label for="groupCenter" class="block text-xs text-gray-400 mb-1 ml-2">Center Name*</label>
                                <input type="text" id="groupCenter" placeholder=""
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    value="{{ capitalizeEachWord($center_details->center_name) }}" disabled />
                                <input type="hidden" name="center_id" value="{{ $center_details->id }}" />
                            </div>
                            <div>
                                <label for="groupName" class="block text-xs text-gray-400 mb-1 ml-2">Group Name*</label>
                                <input type="text" id="groupName" placeholder="" name="group_name"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div>
                                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
                                    {{--                                     <label class="block text-xs text-gray-400 mb-1 ml-2 ">Members</label>
 --}} <div class="flex justify-start items-center lg:justify-end">
                                        <button type="button" id="addExistingMember"
                                            class="text-blue-600  ml-2 text-xs">{{-- Add Existing Member --}} </button>
                                        {{-- <span class="ml-2"> |</span> --}}
                                        <button type="button" id="addNewMember" class="text-blue-600  ml-2  text-xs">
                                            {{--  New Members --}}</button>
                                    </div>
                                </div>
                                {{--  <div id="memberSelection"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm mt-2 flex flex-col">
                                    <span id="selectedMembers">No members selected</span>

                                </div> --}}
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button type="button" id="cancelGroup"
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

            <!-- Add Existing Member Modal -->
            <div id="addExistingMemberModal"
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
            </div>

            <!-- Add New Member Modal -->
            <div id="addNewMemberModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Member</h2>
                    <form id="addNewMemberForm">
                        <div class="bg-white rounded-b-lg p-4 space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="newMemberBranch"
                                    class="block text-xs text-gray-400 mb-1 ml-2 w-36">Branch*</label>
                                <input type="text" id="newMemberBranch" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberCenter" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Center
                                    Name*</label>
                                <input type="text" id="newMemberCenter" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberGroup" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Group
                                    Name*</label>
                                <input type="text" id="newMemberGroup" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberFullName" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Full
                                    Name*</label>
                                <input type="text" id="newMemberFullName" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex justify-between w-full space-x-4">
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile01" class="block text-xs text-gray-400 mb-1 ml-2">Mobile
                                        Number 01</label>
                                    <input type="tel" id="newMemberMobile01" placeholder=""
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile02" class="block text-xs text-gray-400 mb-1 ml-2">Mobile
                                        Number 02</label>
                                    <input type="tel" id="newMemberMobile02" placeholder=""
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberAddress"
                                    class="block text-xs text-gray-400 mb-1 ml-2 w-36">Address?</label>
                                <input type="text" id="newMemberAddress" placeholder=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div class="flex justify-between">
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberNIC"
                                        class="block text-xs text-gray-400 mb-1 ml-2 w-36">NIC</label>
                                    <input type="text" id="newMemberNIC" placeholder=""
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="w-1/2 flex items-center space-x-4 pl-8">
                                    <label class="text-xs text-gray-400 w-1/2"><input type="radio"
                                            name="newMemberGender" value="Male" class="p-1 " /> Male</label>
                                    <label class="text-xs text-gray-400 w-1/2"><input type="radio"
                                            name="newMemberGender" value="Female" class="p-1 " /> Female</label>

                                </div>
                            </div>
                            <div class="flex justify-between items-center space-x-4">
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                    <input type="file" id="newMemberImage"
                                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                    <input type="file" id="newMemberImage"
                                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                        required />
                                </div>
                            </div>
                            <div class="flex justify-end space-x-4 mt-2">
                                <button type="button" id="cancelNewMember"
                                    class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button type="submit" id="createNewMember"
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
                    <div class="w-40 text-sm lg:text-xs ">
                        <button id="getGroupSummary" value=""
                            class="w-full bg-blue-600 text-white p-1 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center">
                            <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                                class="h-3 w-3 m-1"> Get Center Summary
                        </button>
                    </div>

                </div>
                <form action="{{ route('centers.updateCenter', ['centerId' => $center_details->id]) }}" method="POST">
                    @csrf
                    <div class="flex flex-col lg:flex-row border rounded-lg py-4 px-4 h-full ">
                        <!-- Center Details -->
                        <div class="w-full lg:w-2/3 h-full">
                            <h1 class="text-md font-medium text-gray-800 mb-2">Center Details</h1>
                            <div class="grid-cols-2 grid lg:grid-cols-3 gap-y-2 gap-x-4">
                                <!-- Name -->
                                <div>
                                    <p class="text-xs text-gray-400">Name</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeEachWord($center_details->center_name) }}</span>
                                        <span id="center_id_span" class="hidden">{{ $center_details->id }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            name="center_name"
                                            value="{{ capitalizeEachWord($center_details->center_name) }}" required>
                                    </p>
                                </div>

                                <!-- Center Manager -->
                                <div>
                                    <p class="text-xs text-gray-400">Center Manager</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeEachWord($center_details->manager_name) }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            name="manager_name"
                                            value="{{ capitalizeEachWord($center_details->manager_name) }}" required>
                                    </p>
                                </div>

                                <!-- Branch -->
                                <div>
                                    <p class="text-xs text-gray-400">Branch</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeEachWord($center_details->branch->branch_name) }}</span>
                                        <input type="text" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value={{ capitalizeEachWord($center_details->branch->branch_name) }} disabled
                                            required>
                                    </p>
                                </div>

                                <!-- Total Group -->
                                <div>
                                    <p class="text-xs text-gray-400">Total Group</p>
                                    <p class="text-sm">
                                        <span class="view-mode">
                                            {{ str_pad($center_details->group->count(), 2, '0', STR_PAD_LEFT) }}</span>
                                        <input type="number" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value={{ str_pad($center_details->group->count(), 2, '0', STR_PAD_LEFT) }}
                                            disabled>
                                    </p>
                                </div>

                                <!-- Total Members -->
                                <div class="lg:block">
                                    <p class="text-xs text-gray-400">Total Members</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ str_pad($center_details->group->sum(fn($g) => $g->member->count()), 2, '0', STR_PAD_LEFT) }}</span>
                                        <input type="number" class="edit-mode hidden border px-2 py-1 rounded w-full"
                                            value={{ str_pad($center_details->group->sum(fn($g) => $g->member->count()), 2, '0', STR_PAD_LEFT) }}
                                            disabled>
                                    </p>
                                </div>

                                <!-- Payment Date -->
                                <div>
                                    <p class="text-xs text-gray-400">Payment Date</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode">{{ capitalizeFirstLetter($center_details->payment_date) }}</span>
                                        <select id="centerBranch" name="payment_day"
                                            class="edit-mode hidden border px-2 py-1 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                            required>
                                            <option value="{{ $center_details->payment_date }}" selected>
                                                {{ capitalizeFirstLetter($center_details->payment_date) }}
                                            </option>
                                            @foreach ($weekDays as $day)
                                                @if ($day != $center_details->payment_date)
                                                    <option value="{{ $day }}">{{ capitalizeFirstLetter($day) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
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
                </form>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal"
                    class="fixed inset-0  items-center justify-center bg-black bg-opacity-40 hidden z-50 h-full">
                    <div class="bg-white p-6 rounded-lg shadow-md text-center w-1/2 lg:w-1/3 h-30">
                        <p class="text-md font-semibold mb-4">Are you sure you want to delete this group?</p>
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
                            <input type="text" id="searchGroup" placeholder="Search Group..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                    </div>
                    <!-- Add Center Button -->
                    <div class="w-full text-sm lg:text-xs lg:w-3/12">
                        <button id="addGroupButton" value="add_new"
                            class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                            + Add Group
                        </button>
                    </div>
                </div>

                <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Total Groups
                    {{ str_pad($center_details->group->count(), 2, '0', STR_PAD_LEFT) }}
                </p>

                <!-- Centers Grid card format hidden for lg screens -->
                <div id="centersGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:hidden gap-4 p-2">
                    @foreach ($center_details->group as $group)
                        <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100 hover:bg-blue-200"
                            data-group="Group02">
                            <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                <div class="text-xs text-gray-600 text-right">{{ capitalizeEachWord($group->group_name) }}
                                </div>

                                <div class="text-xs flex items-center space-x-1 text-gray-700">
                                    <img src="{{ asset('assets/icons/Users.svg') }}" alt="Dashboard Icon"
                                        class="h-3 w-3">
                                    <p>Total Members -
                                        <span>{{ str_pad($group->member->count(), 2, '0', STR_PAD_LEFT) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">
                                25
                                000</div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-start h-full ">
                    <!-- Grid Table format hidden for mobile screens -->
                    <div id="centersGridTable"
                        class="w-full max-h-[calc(100vh-400px)] hidden lg:block p-0  overflow-y-auto">
                        <div class="min-w-full ">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="py-2 text-center">#</th>
                                        <th class="py-2 text-left">Group Name</th>
                                        <th class="py-2 text-left">Members</th>
                                        <th class="py-2 text-left">Total Received </th>
                                        <th class="py-2 text-left">Center</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-xs font-light bg-white">
                                    @foreach ($center_details->group as $group)
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                            data-group-id={{ str_pad($group->id, 3, '0', STR_PAD_LEFT) }}
                                            data-group-name="{{ capitalizeEachWord($group->group_name) }}"
                                            data-members="{{ str_pad($group->member->count(), 2, '0', STR_PAD_LEFT) }}"
                                            data-received="40000"
                                            data-center="{{ capitalizeFirstLetter($center_details->center_name) }}"
                                            data-center-manager="{{ capitalizeEachWord($center_details->manager_name) }}"
                                            data-member='@json($group->member)'>
                                            <td class="py-2 text-center">{{ str_pad($group->id, 3, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td class="py-2 text-left">{{ capitalizeEachWord($group->group_name) }}</td>
                                            <td class="py-2 text-left">
                                                {{ str_pad($group->member->count(), 2, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td class="py-2 text-left">400000 </td>
                                            <td class="py-2 text-left">
                                                {{ capitalizeFirstLetter($center_details->center_name) }}
                                            </td>
                                            <td class="py-2 text-center flex justify-center items-center gap-1">
                                                <a href="{{ url('/groupSummary/' . $group->id) }}"
                                                    class="border rounded hover:bg-green-500">
                                                    <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                        class="h-3 w-3 m-1">
                                                </a>
                                                {{-- <a href="#" class="border rounded hover:bg-red-500">
                                                    <img src="{{ asset('assets/icons/Trash.svg') }}" alt="Pencil"
                                                        class="h-3 w-3 m-1">
                                                </a> --}}
                                                <a href="#" class="border rounded hover:bg-sky-500">
                                                    <img src="{{ asset('assets/icons/ArrowLineDown.svg') }}"
                                                        alt="Pencil" class="h-3 w-3 m-1">
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
                <h1 id="groupNameSlideBar" class="text-md font-medium text-gray-800 mb-4">--</h1>
                <div class="grid grid-cols-2 gap-y-2">
                    <div>
                        <p for="Cmanager" class="text-xs text-gray-400">Center Manager</p>
                        <p id="CmanagerSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Gcenter" class="text-xs text-gray-400">Center</p>
                        <p id="GcenterSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Gmembers" class="text-xs text-gray-400">Members</p>
                        <p id="GmembersSlideBar" class="text-sm">--</p>
                    </div>
                    <div>
                        <p for="Greceived" class="text-xs text-gray-400">Total Balance</p>
                        <p id="GreceivedSlideBar" class="text-sm">--</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 p-4 ">
                <div class="w-full text-sm lg:text-xs">
                    <button id="getGroupSummary" value=""
                        class="w-full bg-blue-600 text-white py-1 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center">
                        <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                            class="h-3 w-3 m-1"> Get Group Summary
                    </button>
                </div>
            </div>
            <div class="p-4 space-y-4 h-full">
                <div id="memberList" class="space-y-2 flex flex-col justify-start">

                </div>
            </div>
        </div>

        <!-- Second Column: Centers -->
        <div id="centersColumn" class="hidden  h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
            <div id="centersColumnContent" class="border-b p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-md font-medium text-gray-800 mb-4">Centers</h1>
                    <button id="hideCentersColumn"
                        class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none text-xs">
                        Hide
                    </button>
                </div>
                <div id="centersList" class="space-y-2">
                    <!-- Dynamic center list will be populated here -->
                </div>
            </div>
        </div>

        <!-- Second Column: Branches -->
        <div id="branchesColumn" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
            <div id="branchesColumnContent" class="border-b p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-md font-medium text-gray-800 mb-4">Branches</h1>
                    <button id="hideBranchesColumn"
                        class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none text-xs">
                        Hide
                    </button>
                </div>
                <div id="branchesList" class="space-y-2">
                    <!-- Dynamic branch list will be populated here -->
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


        // Search Filter for both mobile and web views
        document.getElementById('searchGroup').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view (cards)
            const cards = document.querySelectorAll('#centersGrid > div');
            cards.forEach(card => {
                const centerName = card.getAttribute('data-group').toLowerCase();
                card.style.display = centerName.includes(searchTerm) ? 'block' : 'none';
            });

            // Web view (table rows)
            const tableRows = document.querySelectorAll('#centersGridTable tbody tr');
            tableRows.forEach(row => {
                const centerName = row.getAttribute('data-group-name').toLowerCase();
                row.style.display = centerName.includes(searchTerm) ? 'table-row' : 'none';
            });
        });


        //----------------------------------------------------------------

        // Sample data for existing members (replace with your actual data source)


        let selectedMembers = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Open Add Group Modal
            document.getElementById('addGroupButton').addEventListener('click', function() {
                document.getElementById('addGroupModal').classList.remove('hidden');
                document.getElementById('addGroupModal').classList.add('flex');
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
                document.getElementById('selectedMembers').textContent = selectedMembers.map(m => m.name)
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
            document.getElementById('cancelGroup').addEventListener('click', function() {
                console.log("hi");
                document.getElementById('addGroupModal').classList.add('hidden');
                document.getElementById('addGroupForm').reset();
                selectedMembers = [];
                document.getElementById('selectedMembers').textContent = 'No members selected';
            });

            // Create Group
            document.getElementById('createGroup').addEventListener('click', function(e) {
                e.preventDefault();
                if (!document.getElementById('groupBranch').value || !document.getElementById('groupCenter')
                    .value || !document.getElementById('groupName').value) {
                    alert("All fields marked with * are required.");
                    return;
                }
                if (selectedMembers.length < 3 || selectedMembers.length > 6) {
                    alert("A group must have between 3 and 6 members.");
                    return;
                }
                alert("Group created successfully with " + selectedMembers.length + " members!");
                document.getElementById('addGroupModal').classList.add('hidden');
                document.getElementById('addGroupForm').reset();
                selectedMembers = [];
                document.getElementById('selectedMembers').textContent = 'No members selected';
            });

            // Row Details
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.view-details').forEach(button => {
                    button.addEventListener('click', (e) => {
                        console.log(test);
                        e.preventDefault();
                        const row = button.closest('tr');
                        const RowDetails = document.getElementById('RowDetails');
                        const firstColumn = document.getElementById('firstColumn');

                        RowDetails.classList.remove('hidden');
                        firstColumn.classList.remove('lg:w-full');
                        firstColumn.classList.add('lg:w-8/12');
                        RowDetails.classList.add('lg:flex');

                        const groupName = row.getAttribute('data-group-name');
                        const members = row.getAttribute('data-members');
                        const received = row.getAttribute('data-received');
                        const center = row.getAttribute('data-center');
                        const center_manager = row.getAttribute('data-center-manager');

                        document.getElementById('groupNameSlideBar').textContent =
                            groupName;
                        document.getElementById('CmanagerSlideBar').textContent =
                            center_manager;
                        document.getElementById('GcenterSlideBar').textContent = center;
                        document.getElementById('GmembersSlideBar').textContent = members;
                        document.getElementById('GreceivedSlideBar').textContent = received;
                        const membersArray = JSON.parse(row.getAttribute('data-member'));
                        console.log(membersArray);
                        const memberList = document.getElementById('memberList');
                        memberList.innerHTML = ''; // Clear existing

                        membersArray.forEach(member => {
                            const groupId = String(member.id).padStart(2, '0');

                            const html = `
        <div class="flex justify-between items-center bg-sky-50 shadow-sm border rounded-lg">
                        <div class="flex flex-col p-2">
                            <span class="text-xs font-medium text-gray-600 ">${member.full_name}</span>
                            <span class="text-xs font-normal text-gray-600 ">${member.nic_number}</span>
                        </div>
                        <span class="text-xs font-medium text-gray-800 bg-gray-200 p-4 px-8 rounded-lg">5820145/=</span>
                        <div class="font-medium text-gray-800 px-2 text-xs flex space-x-1">
                            <a href="#" class="border rounded hover:bg-green-500">
                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                            </a>
                            /* <a href="#" class="border rounded hover:bg-red-500">
                                <img src="{{ asset('assets/icons/Trash.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                            </a> */
                        </div>
                    </div>
    `;
                            memberList.insertAdjacentHTML('beforeend', html);
                        });

                    });
                });

            });

            // Helper function
            function hideAllSecondColumns() {
                const columns = ['RowDetails', 'centersColumn', 'branchesColumn'];
                columns.forEach(col => document.getElementById(col).classList.add('hidden'));
                document.getElementById('firstColumn').classList.remove('lg:w-8/12');
                document.getElementById('firstColumn').classList.add('lg:w-full');
            }

            document.getElementById('hideCentersColumn').addEventListener('click',
                hideAllSecondColumns);
            document.getElementById('hideBranchesColumn').addEventListener('click',
                hideAllSecondColumns);
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

        // Cneter Details edit and delete functionality
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
        const centerId = document.getElementById('center_id_span').innerText.trim();
        confirmDelete.addEventListener(
            'click', () => {
                console.log(centerId);
                fetch(`/centers/delete/${centerId}`, {
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
                        alert("Something went wrong!");

                    });
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
