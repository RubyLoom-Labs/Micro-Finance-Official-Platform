@extends('layouts.layout')

@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!-- First Column -->
        <!--Mobile Cards and table View-->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300  lg:relative ">

            <!-- Add New Member Modal -->
            <div id="addNewMemberModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg max-h-[90vh] overflow-y-auto">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Member</h2>
                    <form id="addNewMemberForm" method="POST" action="{{ route('members.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-500 border border-red-700 text-white px-4 py-2 rounded mb-4">
                                <strong>There were some errors:</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="bg-white rounded-b-lg p-4 space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="newMemberCenter" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Branch Name*
                                </label>
                                <select id="centerBranch" name="branch_id"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required>
                                    <option value="" disabled selected>Select a branch</option>
                                    @foreach ($allBranches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ capitalizeFirstLetter($branch->branch_name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberCenter" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Center
                                    Name*</label>
                                <select id="newMemberCenter" name="center_id"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required>
                                    <option value="" disabled selected>Select a center</option>
                                </select>
                            </div>

                            <div class="flex items-center space-x-4">
                                <label for="newMemberGroup" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Group
                                    Name*</label>
                                <select id="newMemberGroup" name="group_id"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required>
                                    <option value="" disabled selected>Select a group</option>
                                </select>
                            </div>


                        </div>
                        <div>
                            <p class="text-xs text-gray-500 px-4 text-center">member details:</p>
                            <hr>
                        </div>
                        <div class="bg-white rounded-b-lg p-4 space-y-4">

                            <div class="flex items-center space-x-4">
                                <label for="newMemberFullName" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Full
                                    Name*</label>
                                <input type="text" name="memberFullName" id="newMemberFullName" placeholder=""
                                    value="{{ old('memberFullName') }}"
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div
                                class="flex flex-col lg:flex-row lg:justify-between w-full lg:space-x-4 space-y-2 lg:space-y-0">
                                <div class="lg:w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile01" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Mobile
                                        Number 01</label>
                                    <input type="tel" name="memberPhoneNumber01" id="newMemberMobile01" placeholder=""
                                        value="{{ old('memberPhoneNumber01') }}"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="lg:w-1/2 flex items-center space-x-4">
                                    <label for="newMemberMobile02" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Mobile
                                        Number 02</label>
                                    <input type="tel" name="memberPhoneNumber02" id="newMemberMobile02" placeholder=""
                                        value="{{ old('memberPhoneNumber02') }}"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <label for="newMemberAddress"
                                    class="block text-xs text-gray-400 mb-1 ml-2 w-36">Address?</label>
                                <input type="text" name="memberAddress" id="newMemberAddress" placeholder=""
                                    value="{{ old('memberAddress') }}"
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div class="flex justify-between">
                                <div class="w-1/2 flex items-center space-x-4">
                                    <label for="newMemberNIC" class="block text-xs text-gray-400 mb-1 ml-2 w-36">NIC</label>
                                    <input type="text" id="newMemberNIC" name="memberNicNumber" placeholder=""
                                        value="{{ old('memberNicNumber') }}"
                                        class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                                </div>
                                <div class="w-1/2 flex items-center space-x-4  pl-4">
                                    <label class="text-xs text-gray-400 w-1/2 flex space-x-1">
                                        <input type="radio" name="memberGender" value="Male" class="p-1 "
                                            value="{{ old('memberGender') }}" />
                                        <p>Male</p>
                                    </label>
                                    <label class="text-xs text-gray-400 w-1/2 flex space-x-1">
                                        <input type="radio" name="memberGender" value="Female" class="p-1 "
                                            value="{{ old('memberGender') }}" />
                                        <p>Female</p>
                                    </label>

                                </div>
                            </div>
                            <div class="flex justify-between items-center space-x-4">

                                <label class="block text-xs text-gray-400 mb-1 ml-2">Image </label>
                                <input type="file" id="newMemberImage1" name="memberImage01"
                                    value="{{ old('memberImage01') }}"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />

                                {{-- <div>
                                <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                <input type="file" id="newMemberImage2" name="memberImage02"
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

                <script>
                    window.showCreatePopup = {{ session('show_create_popup') ? 'true' : 'false' }};
                </script>

            </div>

            <div id="addNewPaymentModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-lg rounded-lg max-h-[90vh] overflow-y-auto">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add installment (Name)</h2>
                    <form id="addNewPaymentForm" method="POST" action="" enctype="multipart/form-data">

                        <div class="bg-white rounded-b-lg p-4 space-y-2">

                            <div class="flex items-center space-x-4">
                                <label for="Amount" class="block text-xs text-gray-400 mb-0 ml-2 w-36">
                                    Amount*</label>
                                <input type="number" name="amount" id="Amount" value=""
                                    class="no-spinner w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            {{-- <div class="flex items-center space-x-4">
                                <label for="newMemberAddress"
                                    class="block text-xs text-gray-400 mb-0 ml-2 w-36">Date</label>
                                <input type="date" name="date" id="date" placeholder="" value=""
                                    class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
 --}}
                            <div class="flex justify-end space-x-4 mt-2 pt-4">
                                <button type="button" id="cancelNewPayment"
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

            <!-- Add New Loan Modal -->
            <div id="addLoanModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center lg:absolute z-50 fixed p-4 pb-0"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-3xl rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4 font-">Add new Loan (Member Name)</h2>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="bg-white rounded-b-lg p-4 space-y-2 pb-0">
                            <div class="grid grid-cols-1 gap-1">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1 ml-1">Loan Amount*</label>
                                    <input type="number" placeholder="10 000"
                                        class="w-full p-2 border rounded-lg text-sm" required>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Interest Rate*</label>
                                        <input type="text" placeholder="10%"
                                            class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Interest</label>
                                        <input type="number" placeholder="1 000"
                                            class="w-full p-2 border rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Terms*</label>
                                        <input type="number" placeholder="18"
                                            class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Installment*</label>
                                        <input type="number" placeholder="12 000"
                                            class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Issue Date*</label>
                                        <input type="date" class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Document Charges*</label>
                                        <input type="text" placeholder="Type"
                                            class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Image*</label>
                                        <input type="file" class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Image</label>
                                        <input type="file" class="w-full p-2 border rounded-lg text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs text-gray-500 mb-1 ml-1">Guarantor*</label>
                                    <input type="text" placeholder="Type" class="w-full p-2 border rounded-lg text-sm"
                                        required>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-4 pt-2">
                                <button id="cancelLoan" type="button"
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


            <!-- Tab Navigation -->
            <div class="lg:h-8 lg:pb-4 w-full pl-4">
                <ul class="flex text-xs lg:space-x-4 space-x-4">
                    <li id="activeTab" class="border-b-2 pb-1 border-black cursor-pointer">
                        <a href="#" onclick="switchTab('active')">Active Members</a>
                    </li>
                    <li id="inactiveTab" class="border-black text-gray-400 hover:text-gray-700 cursor-pointer">
                        <a href="#" onclick="switchTab('inactive')">Inactive Members</a>
                    </li>
                </ul>
            </div>

            <!--Content-->
            <div
                class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-[calc(100vh-115px)]">
                <!-- Top Bar -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1 gap-2">
                    <!-- Filter Button -->
                    <div class="hidden lg:flex text-sm">
                        <button value="" class="bg-white p-2 rounded-lg focus:outline-none border w-8">
                            <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                        </button>
                    </div>
                    <!-- Hidden native select for form submission -->
                    <div
                        class="flex flex-col lg:flex-row justify-between items-center w-full lg:justify-normal lg:items-baseline lg:w-3/12">
                        <div class="w-full lg:mb-0 relative text-sm">
                            <select id="branchSelect" name="branch"
                                class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm lg:text-xs">
                                <option class="text-sm" value="">Select Branch</option>
                                @foreach ($allBranches as $branch)
                                    <option value="add_new">{{ capitalizeFirstLetter($branch->branch_name) }}</option>
                                @endforeach
                            </select>
                            <!-- Custom dropdown trigger -->
                            <div id="dropdownTrigger"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between lg:text-xs"
                                onclick="toggleDropdown()">
                                <span id="selectedOption">Select Branch</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>

                            <!-- Custom dropdown menu -->
                            <div id="dropdownMenu"
                                class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                                <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                    {{-- <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                        data-value="add_new" id="addBranchButton">+ Add New Branch</li> --}}
                                    @foreach ($allBranches as $branch)
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="balangoda">{{ capitalizeFirstLetter($branch->branch_name) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Center Filter -->
                    <div
                        class="flex flex-col lg:flex-row justify-between items-center w-full lg:justify-normal lg:items-baseline lg:w-3/12">
                        <div class="w-full lg:mb-0 relative text-sm">
                            <select id="centerSelect" name="branch"
                                class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm lg:text-xs">
                                <option class="text-sm" value="">Select Center</option>

                                <option value="add_new"></option>

                            </select>
                            <!-- Custom dropdown trigger -->
                            <div id="dropdownTriggerCenter"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between lg:text-xs"
                                onclick="toggleDropdownCenter()">
                                <span id="selectedOptionCenter">Select Center</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>

                            <!-- Custom dropdown menu fro centers-->
                            <div id="dropdownMenuCenters"
                                class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                                <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                    <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                        data-value-center="balangoda">Center 01</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Search Bar -->
                    <div class="w-full text-sm lg:text-xs lg:w-5/12">
                        <input type="text" id="searchMember" placeholder="Search Member..."
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                    </div>
                    <!-- Add Member Button -->
                    <div class="w-full text-sm lg:text-xs lg:w-3/12">
                        @if (Auth::user()->user_role->members == 2 || Auth::user()->user_role->members == 3)
                            <button id="addNewMemberButton" value="add_new_member"
                                class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                                + Add Member
                            </button>
                        @endif
                    </div>
                </div>

                <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Total member {{ $allActiveMembers->count() }}
                </p>

                <!-- member Grid card format hidden for lg screens -->
                <div id="memberGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:hidden gap-2 p-2">
                    @foreach ($allActiveMembers as $member)
                        <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100 hover:bg-blue-200"
                            data-member="{{ $member->full_name }}">
                            <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                                <div class="text-sm font-medium">{{ $member->full_name }}<span>
                                    </span></div>
                                <div class="text-xs flex flex-col text-gray-700">
                                    <p>{{ $member->group->center_name }}</p>
                                    <p>{{ $member->nic_number }}</p>
                                </div>
                            </div>
                            <div
                                class="py-1 px-4 flex flex-col justify-center iteam-center space-y-1 w-full bg-blue-200 rounded">
                                <div class="text-sm font-bold text-center">20 000/=</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- member Grid Table format hidden for mobile screens -->
                <div class="flex justify-start h-full pt-2">
                    <div class="w-full max-h-[calc(100vh-210px)]  hidden lg:block p-0 overflow-y-auto">
                        <div class="min-w-full ">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <!--<th class="pl-2 text-left">
                                                                                                                                                                                                                                                                                                                                    <input type="checkbox" id="select-all"
                                                                                                                                                                                                                                                                                                                                        class="form-checkbox h-4 w-4 text-blue-400 m-1">
                                                                                                                                                                                                                                             </th>-->
                                        <th class="py-2 text-center">#</th>
                                        <th class="py-2 text-left">Name</th>
                                        <th class="py-2 text-left">Center</th>
                                        <th class="py-2 text-left">NIC</th>
                                        <th class="py-2 text-left">Loan Balance</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="activeMemberTable" class="text-gray-800 text-xs font-light bg-white w-full">
                                    @foreach ($allActiveMembers as $member)
                                        @if ($member->status == 'ACTIVE')
                                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                                data-member-id={{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                                                data-member-fullname='{{ capitalizeEachWord($member->full_name) }}'
                                                data-branchname='{{ capitalizeEachWord($member->group->center->branch->branch_name) }}'
                                                data-center-name='{{ capitalizeEachWord($member->group->center->center_name) }}'
                                                data-group-name='{{ capitalizeEachWord($member->group->group_name) }}'
                                                data-member_id='{{ $member->nic_number }}' data-loan-balance="20000"
                                                data-member='@json($member)'>
                                                <!--<td class="pl-2 text-left">
                                                                                                                                                                                                                                                                                                                                        <input type="checkbox" name="selected_ids[]" value="1"
                                                                                                                                                                                                                                                                                                                                            class="form-checkbox h-4 w-4 text-blue-600 m-1">
                                                                                                                                                                                                                                                                                                                                    </td>-->
                                                <td class="py-2 text-center">
                                                    {{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="py-2 text-left">{{ capitalizeEachWord($member->full_name) }}
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ capitalizeEachWord($member->group->center->center_name) }}
                                                </td>
                                                <td class="py-2 text-left">{{ $member->nic_number }}</td>
                                                @php
                                                    $total_paid_amount = collect(
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->installment,
                                                    )->sum('amount');
                                                    $total_balance =
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->loan_amount +
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->interest -
                                                        $total_paid_amount;
                                                @endphp
                                                <td class="py-2 text-left">Rs. {{ number_format($total_balance, 2) }}</td>
                                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                                    <a href="{{ url('/memberSummery/' . $member->id) }}"
                                                        class="border rounded hover:bg-green-500">
                                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                            class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="{{ url('/memberSummery/' . $member->id) }}"
                                                        class="border rounded hover:bg-sky-500">
                                                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                            alt="Pencil" class="h-3 w-3 m-1">
                                                    </a>
                                                    @if (Auth::user()->user_role->loans == 1)
                                                        <a
                                                            class="border rounded hover:bg-lime-500 addNewPaymentModalButton">
                                                            <img src="{{ asset('assets/icons/Plus.svg') }}"
                                                                alt="Pencil" class="h-3 w-3 m-1">
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!-- Add more rows as needed -->
                                </tbody>
                                <tbody id="inactiveMemberTable"
                                    class="text-gray-800 text-xs font-light bg-white w-full hidden">
                                    @foreach ($allActiveMembers as $member)
                                        @if ($member->status == 'INACTIVE')
                                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                                data-member-id={{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                                                data-member-fullname='{{ capitalizeEachWord($member->full_name) }}'
                                                data-branchname='{{ capitalizeEachWord($member->group->center->branch->branch_name) }}'
                                                data-center-name='{{ capitalizeEachWord($member->group->center->center_name) }}'
                                                data-group-name='{{ capitalizeEachWord($member->group->group_name) }}'
                                                data-member_id='{{ $member->nic_number }}' data-loan-balance="20000"
                                                data-member='@json($member)'>
                                                <!--<td class="pl-2 text-left">
                                                                                                                                                                                                                                                                                                                                        <input type="checkbox" name="selected_ids[]" value="1"
                                                                                                                                                                                                                                                                                                                                            class="form-checkbox h-4 w-4 text-blue-600 m-1">
                                                                                                                                                                                                                                                                                                                                    </td>-->
                                                <td class="py-2 text-center">
                                                    {{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="py-2 text-left">{{ capitalizeEachWord($member->full_name) }}
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ capitalizeEachWord($member->group->center->center_name) }}
                                                </td>
                                                <td class="py-2 text-left">{{ $member->nic_number }}</td>
                                                @php
                                                    $total_paid_amount = collect(
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->installment,
                                                    )->sum('amount');
                                                    $total_balance =
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->loan_amount +
                                                        optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                            ->interest -
                                                        $total_paid_amount;
                                                @endphp
                                                <td class="py-2 text-left">Rs. {{ number_format($total_balance, 2) }}</td>
                                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                                    <a href="{{ url('/memberSummery/' . $member->id) }}"
                                                        class="border rounded hover:bg-green-500">
                                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                            class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="{{ url('/memberSummery/' . $member->id) }}"
                                                        class="border rounded hover:bg-sky-500">
                                                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                            alt="Pencil" class="h-3 w-3 m-1">
                                                    </a>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="hidden mt-2 mx-4 lg:flex justify-between items-center text-xs text-gray-500">
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

        <!-- Second Column: Row Details -->
        <div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
            <div id="RowDetailsContent" class="border-b p-4">
                <div class="flex items-baseline space-x-2">
                    <h1 id="memberNameShow" class="text-md font-medium text-gray-800 "></h1>
                    <h1 id="memberIdShow" class="text-md font-medium text-gray-800 hidden"></h1>
                    <!--Member Status-->
                    <p id="activeMemberStatus" class="items-center">
                        <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                    </p>
                    <p id="inactiveMemberStatus" class="items-center hidden">
                        <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                    </p>
                </div>
                <h1 id="memberName" class="text-xs text-gray-600 mb-4"><span id="branchNameShow"></span> > <span
                        id="centerNameShow"></span> >
                    <span id="groupNameShow"></span>
                </h1>
                <div class="grid grid-cols-2 gap-y-2">
                    <div>
                        <p for="num01" class="text-xs text-gray-400">Mobile number 01</p>
                        <p id="phonenum01" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="num02" class="text-xs text-gray-400">Mobile number 02</p>
                        <p id="phonenum02" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="NIC" class="text-xs text-gray-400">NIC</p>
                        <p id="nicNumberShow" class="text-sm"></p>
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
                        <p id="memberAddressShow" class="text-sm mt-0"></p>
                    </div>
                </div>
            </div>
            <div class="activeMemberDetails h-full overflow-y-auto max-h-[calc(100vh-350px)]">
                <div class="p-4 pt-0 border-b w-full">
                    <h1 id="" class="text-sm font-medium text-gray-800 mb-1">Current Loan Details</h1>
                    <div class="grid grid-cols-3 gap-y-2">
                        <div>
                            <p for="LoanAmount" class="text-xs text-gray-400">Loan Amount</p>
                            <p id="LoanAmountSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="Interest" class="text-xs text-gray-400">Interest</p>
                            <p id="InterestSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="IssueDate" class="text-xs text-gray-400">Issue Date</p>
                            <p id="IssueDateSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="Installment" class="text-xs text-gray-400">Installment</p>
                            <p id="InstallmentSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="Terms" class="text-xs text-gray-400">Terms</p>
                            <p id="TermsSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="DocumentChagers" class="text-xs text-gray-400">Document Chagers</p>
                            <p id="DocumentChagersSlideBar" class="text-sm"></p>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 py-2 text-sm lg:text-xs  bg-gray-200">
                    <div class="grid grid-cols-2 gap-y-2">
                        <div>
                            <p for="LoanAmount" class="text-xs text-gray-400">Total Paid</p>
                            <p id="LoanPaidSlideBar" class="text-sm"></p>
                        </div>
                        <div>
                            <p for="LoanAmount" class="text-xs text-gray-400">balance</p>
                            <p id="LoanBalanceAmountSlideBar" class="text-sm"></p>
                        </div>
                    </div>
                </div>
                <div class="w-full text-sm lg:text-xs  pt-4 px-4 hidden" id="addLoanButtonDiv">
                    <button id="addLoanButton"
                        class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        + Add Loan
                    </button>
                </div>
                <!-- Installment Cards -->
                <div class="w-full text-sm lg:text-xs p-4 m-0">
                    <div class="grid grid-cols-1 gap-y-2" id="installmentCardContainer">

                    </div>
                </div>
            </div>
            <div class=" p-4 pt-2 border-t">
                <div class="w-full text-sm lg:text-xs  pt-2">
                    <button id="ViewFullDetail" value=""
                        class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        View Full Detail
                    </button>
                </div>

            </div>

        </div>



    </div>

    <script>
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.toggle-details-btn');
            if (button) {
                const card = button.closest('.bg-gray-200');
                const details = card.querySelector('.installment-details');
                const icon = button.querySelector('img');
                if (details && icon) {
                    details.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                }
            }
        });
        document.getElementById('addLoanButton').addEventListener('click', function() {
            console.log("hi")
            const memberId = document.getElementById('memberIdShow').textContent;
            const url = `{{ route('member.summary', ['memberId' => 'MEMBER_ID_PLACEHOLDER']) }}`.replace(
                'MEMBER_ID_PLACEHOLDER', memberId);
            window.location.href = url;
        });
        document.addEventListener('click', function(event) {
            const cancelButton = event.target.closest('.cancel-btn');
            if (cancelButton) {
                const card = cancelButton.closest('.bg-gray-200');
                const details = card.querySelector('.installment-details');
                const form = card.querySelector('.installment-form');
                const icon = card.querySelector('.toggle-details-btn img');
                if (details && form && icon) {
                    form.reset();
                    details.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        });
        document.addEventListener('submit', function(event) {
            const form = event.target.closest('.installment-form');
            if (form) {
                event.preventDefault();
                const card = form.closest('.bg-gray-200');
                const amountInput = form.querySelector('input[name="amount"]');
                const payDateInput = form.querySelector('input[name="payDate"]');
                const billInput = form.querySelector('input[name="bill"]');
                const details = card.querySelector('.installment-details');
                const icon = card.querySelector('.toggle-details-btn img');
                if (!amountInput.value || !payDateInput.value) {
                    alert('Please fill in all required fields (Amount and Date).');
                    return;
                }
                console.log({
                    installmentId: form.getAttribute('data-installment-id'),
                    amount: amountInput.value,
                    payDate: payDateInput.value,
                    bill: billInput.files[0] ? billInput.files[0].name : 'No file uploaded'
                });
                form.reset();
                details.classList.add('hidden');
                icon.classList.remove('rotate-180');
                alert('Installment data saved (front-end placeholder).');
            }
        });
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

        document.getElementById('centerBranch').addEventListener('change', function() {
            const branchId = this.value;
            const centerSelect = document.getElementById('newMemberCenter');

            // Clear existing options
            centerSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';

            fetch(`/centers/${branchId}`)
                .then(response => response.json())
                .then(data => {
                    centerSelect.innerHTML = '<option value="" disabled selected>Select a center</option>';
                    data.forEach(center => {
                        const option = document.createElement('option');
                        option.value = center.id;
                        option.textContent = center.center_name.charAt(0).toUpperCase() + center
                            .center_name.slice(1).toLowerCase();
                        centerSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    centerSelect.innerHTML =
                        '<option value="" disabled selected>Error loading centers</option>';
                    console.error('Error:', error);
                });
        });
        const centerDropdown = document.getElementById('newMemberCenter');
        const groupDropdown = document.getElementById('newMemberGroup');

        centerDropdown.addEventListener('change', function() {
            const centerId = this.value;
            groupDropdown.innerHTML = '<option value="" disabled selected>Loading...</option>';

            fetch(`/groups/${centerId}`)
                .then(response => response.json())
                .then(data => {
                    groupDropdown.innerHTML = '<option value="" disabled selected>Select a group</option>';
                    data.forEach(group => {
                        const option = document.createElement('option');
                        console.log(group)
                        option.value = group.id;
                        option.textContent = group.group_name.charAt(0).toUpperCase() + group.group_name
                            .slice(1).toLowerCase();
                        groupDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching groups:', error);
                    groupDropdown.innerHTML =
                        '<option value="" disabled selected>Error loading groups</option>';
                });
        });
        // Search Filter
        document.getElementById('searchMember').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('#memberGrid > div');
            const tableRows = document.querySelectorAll('#memberGridTable tbody tr');

            cards.forEach(card => {
                const memberName = card.getAttribute('data-member').toLowerCase();
                card.style.display = memberName.includes(searchTerm) ? 'flex' : 'none';
            });

            tableRows.forEach(row => {
                const memberName = row.getAttribute('data-member-fullname').toLowerCase();
                row.style.display = memberName.includes(searchTerm) ? 'table-row' : 'none';
            });
        });


        //Branches----------------
        //Coustom dropdown
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        }

        document.querySelectorAll('#dropdownMenu li').forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const selectedOption = document.getElementById('selectedOption');
                selectedOption.textContent = this.textContent;
                document.getElementById('branchSelect').value = value;
                document.getElementById('dropdownMenu').classList.add('hidden');

                // Trigger modal for "Add New Branch"
                if (value === 'add_new') {
                    document.getElementById('addBranchModal').classList.remove('hidden');
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const trigger = document.getElementById('dropdownTrigger');
            if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        //centers---------------
        // Toggle dropdown menu centers
        function toggleDropdownCenter() {
            const dropdownMenu = document.getElementById('dropdownMenuCenters');
            dropdownMenu.classList.toggle('hidden');
        }

        document.querySelectorAll('#dropdownMenuCenters li').forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value-center');
                const selectedOptionCenter = document.getElementById('selectedOptionCenter');
                selectedOptionCenter.textContent = this.textContent;
                document.getElementById('centerSelect').value = value;
                document.getElementById('dropdownMenuCenters').classList.add('hidden');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenuCenters');
            const trigger = document.getElementById('dropdownTriggerCenter');
            if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Handle dropdown selection
        document.querySelectorAll('#dropdownMenu li').forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const text = item.textContent;
                document.getElementById('selectedOption').textContent = text;
                document.getElementById('branchSelect').value = value;
                document.getElementById('dropdownMenu').classList.add('hidden');

                if (value === 'add_new') {
                    document.getElementById('addBranchModal').classList.remove('hidden');
                }
            });
        });

        //check box selection
        /*document.getElementById('select-all').addEventListener('change', function(e) {
            let checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
        });

        // Checkbox handling
        document.querySelectorAll('input[name="selected_ids[]"]').forEach(checkbox => {
            checkbox.addEventListener('click', function(e) {
                e.stopPropagation();

                if (this.id !== 'select-all') {
                    // Update "select all" status
                    const allCheckboxes = document.querySelectorAll(
                        'input[name="selected_ids[]"]:not(#select-all)');
                    const allChecked = [...allCheckboxes].every(cb => cb.checked);
                    document.getElementById('select-all').checked = allChecked;
                }
            });
        });*/


        // Helper function to hide all second columns
        function hideAllSecondColumns() {
            const columns = ['RowDetails', 'centersColumn', 'branchesColumn'];
            columns.forEach(col => document.getElementById(col).classList.add('hidden'));

            document.getElementById('firstColumn').classList.remove('lg:w-8/12');
            document.getElementById('firstColumn').classList.add('lg:w-full');

        }
        let select_member_id = '';
        // Row Summey
        let selected_loan_id = null;
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
                const member_fullname = row.getAttribute('data-member-fullname');
                const branch_name = row.getAttribute('data-branchname');
                const center_name = row.getAttribute('data-center-name');
                const group_name = row.getAttribute('data-group-name');
                const member_id = row.getAttribute('data-member-id');
                const memberData = JSON.parse(row.getAttribute('data-member'));
                const uncompletedLoan = memberData.loan.find(loan => loan.status === 'UNCOMPLETED');

                // Check if the clicked element is the payment button
                if (e.target.closest('.addNewPaymentModalButton')) {
                    console.log("test");
                    selected_loan_id = uncompletedLoan.id;
                    e.preventDefault();
                    e.stopPropagation(); // Prevent event from bubbling up to the parent row
                    const paymentModal = document.getElementById('addNewPaymentModal');
                    paymentModal.classList.remove('hidden');
                    paymentModal.classList.add('flex');

                    return; // Do nothing, let the payment button's event listener handle it
                }


                select_member_id = memberData.id;
                document.getElementById('memberNameShow').textContent = member_fullname;
                document.getElementById('memberIdShow').textContent = member_id;
                document.getElementById('branchNameShow').textContent = branch_name;
                document.getElementById('centerNameShow').textContent = center_name;
                document.getElementById('groupNameShow').textContent = group_name;
                document.getElementById('phonenum01').textContent = memberData.mobile_number_1;
                document.getElementById('phonenum02').textContent = memberData.mobile_number_2;
                document.getElementById('nicNumberShow').textContent = memberData.nic_number;
                document.getElementById('memberAddressShow').textContent = memberData.address;
                const addLoanButtonDiv = document.getElementById('addLoanButtonDiv');

                if (memberData.status === 'INACTIVE') {
                    document.getElementById('activeMemberStatus').classList.add('hidden');
                    document.getElementById('inactiveMemberStatus').classList.remove('hidden');
                    addLoanButtonDiv.classList.remove('hidden');
                }
                if (memberData.status === 'ACTIVE') {
                    document.getElementById('activeMemberStatus').classList.remove('hidden');
                    document.getElementById('inactiveMemberStatus').classList.add('hidden');
                    addLoanButtonDiv.classList.add('hidden');
                }
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
                if (uncompletedLoan) {
                    const total_paid = uncompletedLoan.installment ?
                        uncompletedLoan.installment.reduce((sum, item) => sum + parseFloat(item.amount),
                            0) :
                        0;
                    const balance_amount = Number(uncompletedLoan.loan_amount) + Number(uncompletedLoan
                            .interest) -
                        Number(total_paid);

                    const formatted_paid = 'Rs. ' + total_paid.toFixed(2);
                    const formatted_balance = 'Rs. ' + balance_amount.toFixed(2);

                    document.getElementById('LoanPaidSlideBar').textContent = formatted_paid;
                    document.getElementById('LoanBalanceAmountSlideBar').textContent = formatted_balance;
                } else {
                    // Reset values if no loan
                    document.getElementById('LoanPaidSlideBar').textContent = '--';
                    document.getElementById('LoanBalanceAmountSlideBar').textContent = '--';
                }
                if (uncompletedLoan && uncompletedLoan.installment?.length > 0) {
                    console.log('hiii');
                    const container = document.getElementById('installmentCardContainer');
                    container.innerHTML = ''; // Clear previous cards


                    uncompletedLoan.installment.forEach((installment, index) => {
                        const card = document.createElement('div');
                        card.className = "bg-gray-200 py-2 px-4 rounded-lg shadow-sm";
                        const payedDate = new Date(installment.date_and_time);
                        const now = new Date();
                        let statusLabel = '';

                        if (installment.status === 'PAYED') {
                            statusLabel =
                                `<p class="text-xs font-medium p-0.5 bg-green-400 rounded text-white px-1">PAID</p>`;
                        } else if (installment.status === 'NOPAYED') {
                            statusLabel =
                                `<p class="text-xs font-medium p-0.5 bg-red-400 rounded text-white px-1">No PAID</p>`;
                        } else if (installment.status === 'UNDERPAYED') {
                            statusLabel =
                                `<p class="text-xs font-medium p-0.5 bg-yellow-400 rounded text-white px-1">UNDER PAID</p>`;
                        } else {
                            statusLabel =
                                `<p class="text-xs font-medium p-0.5 bg-blue-400 rounded text-white px-1">ONGOING</p>`;
                        }


                        let amountInputHTML = '';
                        if (installment.status === 'UNPAYED') {
                            amountInputHTML = `
        <div class="flex justify-between items-center">
            <label for="amount" class="block text-xs font-medium">Amount *</label>
            <input type="text" name="amount"  class="w-2/3 mt-1 px-3 py-1 border rounded-md">
        </div>
    `;
                        } else {
                            amountInputHTML = `
        <div class="flex justify-between items-center">
            <label for="amount" class="block text-xs font-medium">Amount *</label>
            <span>Rs. ${parseFloat(installment.amount).toFixed(2)} </span>
        </div>
    `;
                        };

                        let billInputHTML = '';
                        if (installment.status === 'UNPAYED') {
                            billInputHTML = `
        <div class="flex justify-between items-center">
                                       <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                            <input type="file" name="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
        </div>
    `;
                        } else {
                            billInputHTML = `
        <div class="flex justify-between items-center">
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
        </div>
    `;
                        };

                        let btnInputHTML = '';
                        if (installment.status === 'UNPAYED') {
                            btnInputHTML = `
        <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
    `;
                        } else {
                            btnInputHTML = `
    `;
                        };
                        card.innerHTML = `
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-gray-600">Installment # <span>${installment.installment_number}</span></p>
                    <button class="toggle-details-btn p-1 hidden rounded hover:bg-sky-200">
                        <img src="/assets/icons/CaretDown.svg" alt="Toggle"
                            class="h-3 w-3 transform transition-transform">
                    </button>
                </div>
                <p class="text-xs text-gray-600">${installment.date_and_time}</p>
            </div>

            <div class="mt-0 flex justify-between items-center text-xs">
                <div class="flex items-center space-x-2">
                    <p class="text-gray-400">Payed Amount</p>
                    <p class="font-medium text-gray-600"> Rs. ${parseFloat(installment.amount).toFixed(2)}(${parseFloat(installment.installment_amount).toFixed(2)})</p>
                </div>
                <div class="flex items-center space-x-2">
                    <p class="text-gray-400">Status</p>
                    ${statusLabel}
                </div>
            </div>
            <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                <div class="grid gap-3">
                    ${amountInputHTML}
                    <div class="grid gap-3">
                       ${billInputHTML}
                    </div>
                    <div class="flex justify-end space-x-2 mt-3">
                    ${btnInputHTML}
                    </div>
                </div>
            </div>
        `;

                        container.appendChild(card);
                    });






                } else {
                    document.getElementById('installmentCardContainer').innerHTML =
                        '<p class="text-sm text-gray-500">No Installments Found</p>';
                }
                /* memberData.group.center.branch.branch_name */
                ;

                /*   document.getElementById('branchName').textContent = 'test';
                  document.getElementById('Cname').textContent = centerName;
                  document.getElementById('Cmanager').textContent = manager;
                  document.getElementById('Tgroup').textContent = groups;
                  document.getElementById('Tmember').textContent = member; */
            });
        });
        document.getElementById('ViewFullDetail').addEventListener('click', () => {
            window.location.href = `/memberSummery/${select_member_id}`;
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize selectedmember array
            window.selectedmember = window.selectedmember || [];

            const modal = document.getElementById('addNewMemberModal');

            // Show modal if server set a flag (via Blade)
            if (modal && window.showCreatePopup === true) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                console.log('Modal reopened after validation error');
            }

            // Open modal on Add button click
            const addNewMemberButton = document.getElementById('addNewMemberButton');
            if (addNewMemberButton) {
                addNewMemberButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }
            document.getElementById('cancelNewPayment').addEventListener('click', function() {
                console.log("tets");
                const paymentModal = document.getElementById('addNewPaymentModal');
                paymentModal.classList.add('hidden');
                paymentModal.classList.remove('flex');
                document.getElementById('addNewPaymentForm').reset();
            });
            document.getElementById('addNewPaymentForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                if (!selected_loan_id) {
                    alert("Loan ID not found!");
                    return;
                }
                console.log(selected_loan_id);
                const form = e.target;
                const formData = new FormData(form);
                console.log(formData);
                try {
                    const response = await fetch(`/installments/update/${selected_loan_id}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: formData
                    });
                    console.log("test");
                    if (response.ok) {
                        const data = await response.json();
                        if (data.success) {

                            alert(data.message);
                            window.location.reload();
                            // Close modal & reset form
                            form.reset();
                            const paymentModal = document.getElementById('addNewPaymentModal');
                            paymentModal.classList.add('hidden');
                            paymentModal.classList.remove('flex');

                            // Optionally, update the table row dynamically
                        }
                    } else {
                        console.error("Error:", await response.text());
                    }
                } catch (err) {
                    alert(err);
                    console.error("Request failed:", err);
                }
            });


            // Close modal on Cancel button click
            const cancelNewMemberButton = document.getElementById('cancelNewMember');
            if (cancelNewMemberButton) {
                cancelNewMemberButton.addEventListener('click', function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.getElementById('addNewMemberForm').reset();
                });
            }
        });


        // Handle Cancel buttons
        if (document.getElementById('cancelBranch')) {
            document.getElementById('cancelBranch').addEventListener('click', () => {
                document.getElementById('addBranchModal').classList.add('hidden');
                hideAllSecondColumns();
            });
        };
        if (document.getElementById('cancelCenter')) {
            document.getElementById('cancelCenter').addEventListener('click', () => {
                document.getElementById('addCenterModal').classList.add('hidden');
                hideAllSecondColumns();
            });
        };

        // Hide column buttons
        if (document.getElementById('hideCentersColumn')) {
            document.getElementById('hideCentersColumn').addEventListener('click', () => {
                hideAllSecondColumns();
            });
        };
        if (document.getElementById('hideBranchesColumn')) {
            document.getElementById('hideBranchesColumn').addEventListener('click', () => {
                hideAllSecondColumns();
            });
        };



        // Tab Navigation
        function switchTab(tabType) {
            const activeTab = document.getElementById('activeTab');
            const inactiveTab = document.getElementById('inactiveTab');
            const activeMemberDetails = document.querySelector('.activeMemberDetails');
            const memberCount = document.getElementById('memberCount');
            const memberGrid = document.getElementById('memberGrid');
            const memberGridTable = document.getElementById('memberGridTable');
            const inactiveMemberTable = document.getElementById('inactiveMemberTable');
            const activeMemberTable = document.getElementById('activeMemberTable');
            activeTab.className = 'border-black text-gray-400 hover:text-gray-700 cursor-pointer';
            inactiveTab.className = 'border-black text-gray-400 hover:text-gray-700 cursor-pointer';


            if (tabType === 'active') {
                // Style active tab
                activeTab.className = 'border-b-2 pb-1 border-black cursor-pointer';
                // Show active member details and status
                activeMemberDetails.classList.remove('hidden');
                inactiveMemberTable.classList.add('hidden');
                activeMemberTable.classList.remove('hidden');
                // Update member count
                if (memberCount) {
                    memberCount.textContent =
                        `Total active members: ${memberGrid.querySelectorAll('div[data-member]:not(.inactive-member)').length}`;
                }
                // Show active members, hide inactive
                allMobileMembers.forEach(member => {
                    member.classList.toggle('hidden', member.classList.contains('inactive-member'));
                });
                allTableRows.forEach(row => {
                    row.classList.toggle('hidden', row.classList.contains('inactive-member'));
                });
            } else if (tabType === 'inactive') {
                console.log("hello");
                // Style inactive tab
                inactiveTab.className = 'border-b-2 pb-1 border-black cursor-pointer';
                inactiveMemberTable.classList.remove('hidden');
                activeMemberTable.classList.add('hidden');


                firstColumn.classList.add('lg:w-full');
                // Update member count
                if (memberCount) {
                    memberCount.textContent =
                        `Total inactive members: ${memberGrid.querySelectorAll('div.inactive-member').length}`;
                }
            }

            // Update RowDetails based on selected member (if any)
            const selectedRow = memberGridTable.querySelector('tr.view-details:not(.hidden)');
            if (selectedRow) {
                updateRowDetails(selectedRow);
            }
        }

        //Loan
        /* document.getElementById('addLoanButton').addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                document.getElementById('addLoanModal').classList.remove('hidden');
                document.getElementById('addLoanModal').classList.add('flex');

                // Optional: Adjust layout if you're using side-by-side columns
                const loansColumn = document.getElementById('loansColumn');
                const firstColumn = document.getElementById('firstColumn');
                if (loansColumn && firstColumn) {
                    loansColumn.classList.remove('hidden');
                    firstColumn.classList.remove('lg:w-full');
                    firstColumn.classList.add('lg:w-8/12');
                    loansColumn.classList.add('lg:flex');
                }
            } else {
                document.getElementById('addLoanModal').classList.remove('hidden');
                document.getElementById('addLoanModal').classList.add('flex');
            }
        }); */

        document.getElementById('cancelLoan').addEventListener('click', () => {
            document.getElementById('addLoanModal').classList.add('hidden');
            document.getElementById('addLoanModal').classList.remove('flex');
        });
        // Payment Modal Functionality


        // Close payment modal when cancel button is clicked
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
