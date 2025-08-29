@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!---Cards-->
            <div class="flex lg:w-1/2 lg:h-20 w-full px-2 lg:px-0 py-4 lg:py-0">
                <!--Mobile View:-->
                <div id="topCards" class="grid grid-cols-1 lg:flex gap-2 lg:gap-08 w-full lg:p-0 lg:pb-4 ">
                    <!--Active Card-->
                    <div id="activeMembers"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-green-300">
                        <div class="flex flex-col w-1/2 ">
                            <h2 class="text-sm font-semibold text-gray-600">Active Members</h2>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">
                                {{ str_pad(optional($allActiveMembers->where('status', 'ACTIVE'))->count(), 2, '0', STR_PAD_LEFT) }}
                            </h1>
                        </div>
                    </div>
                    <!--Inactive Members Card-->
                    <div id="inactiveMembers"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-red-300 ">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Inactive Members</h2>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">
                                {{ str_pad(optional($allActiveMembers->where('status', 'INACTIVE'))->count(), 2, '0', STR_PAD_LEFT) }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="lg:h-8 lg:pb-4 w-full lg:pl-2 pl-4">
                <ul class="flex text-xs lg:space-x-4 space-x-4">
                    <li id="activeTab" class="border-b-2 pb-1 border-black cursor-pointer font-semibold">
                        <a href="#" onclick="switchTab('active')">Active Members</a>
                    </li>
                    <li id="inactiveTab" class="border-black text-gray-400 hover:text-gray-700 cursor-pointer">
                        <a href="#" onclick="switchTab('inactive')">Inactive Members</a>
                    </li>
                </ul>
            </div>

            <!--Start Table and Mobile Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-h-5/6">
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
                        <!--Branch Filter-->
                        <div class="w-full lg:w-1/2">
                            <div class="w-full lg:mb-0 relative text-sm">
                                <select id="branchSelect" name="branch"
                                    class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm lg:text-xs"
                                    onchange="filterData()">
                                    <option class="text-sm" value="">Select Branch</option>
                                    <option value="balangoda">Balangoda</option>
                                    <option value="ella">Ella</option>
                                    <option value="badulla">Badulla</option>
                                    <option value="colombo">Colombo</option>
                                </select>
                                <!-- Custom dropdown trigger -->
                                <div id="dropdownTriggerBranch"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between lg:text-xs"
                                    onclick="toggleDropdownBranch()">
                                    <span id="selectedOptionBranch">Select Branch</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <!-- Custom dropdown menu -->
                                <div id="dropdownMenuBranch"
                                    class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                                    <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="balangoda" onclick="selectBranch('balangoda')">Balangoda</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="ella" onclick="selectBranch('ella')">Ella</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="badulla" onclick="selectBranch('badulla')">Badulla</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="colombo" onclick="selectBranch('colombo')">Colombo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Center Filter-->
                        <div class="w-full lg:w-1/2 flex lg:pr-2">
                            <div class="w-full lg:mb-0 relative text-sm">
                                <select id="centerSelect" name="center"
                                    class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm lg:text-xs"
                                    onchange="filterData()">
                                    <option class="text-sm" value="">Select Center</option>
                                    <option value="Ella Center 01">Ella Center 01</option>
                                    <option value="Center 02">Center 02</option>
                                    <option value="Center 03">Center 03</option>
                                    <option value="Center 04">Center 04</option>
                                </select>
                                <!-- Custom dropdown trigger -->
                                <div id="dropdownTriggerCenter"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between lg:text-xs"
                                    onclick="toggleDropdownCenter()">
                                    <span id="selectedOptionCenter">Select Center</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <!-- Custom dropdown menu -->
                                <div id="dropdownMenuCenter"
                                    class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                                    <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="Ella Center 01" onclick="selectCenter('Ella Center 01')">Ella
                                            Center 01</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="Center 02" onclick="selectCenter('Center 02')">Center 02</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="Center 03" onclick="selectCenter('Center 03')">Center 03</li>
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="Center 04" onclick="selectCenter('Center 04')">Center 04</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Date filter -->
                    {{--  <div id="dateFilter"
                        class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">
                        <div
                            class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                            <label for="startDate" class="m-1">Start Date</label>
                            <input type="date" name="startDate" id="startDate" onchange="filterData()">
                        </div>
                        <div
                            class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                            <label for="endDate" class="m-1">End Date</label>
                            <input type="date" name="endDate" id="endDate" onchange="filterData()">
                        </div>
                    </div> --}}
                    <!--Export Button-->
                    <div id="dateFilter"
                        class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">
                        <!-- Search Bar -->
                        <div class="w-full text-sm lg:text-xs lg:w-1/2">
                            <input type="text" id="search" placeholder="Search ..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                        <div class="w-full text-sm lg:text-xs lg:w-24">
                            <button id="export" value=""
                                class="w-full bg-blue-600 text-white p-2 lg:p-1.5  rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center px-4">
                                <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                                    class="h-3 w-3 m-1 "> Export
                            </button>
                        </div>
                    </div>
                </div>
                <!--End Top Bar-->

                <!-- Active Members Section -->
                <div id="activeSection" class="active-content">
                    <!-- Active Members Mobile Cards -->
                    <div id="activeLoanIssueGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                        @foreach ($allActiveMembers as $member)
                            @if ($member->status == 'ACTIVE')
                                <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                                    data-name="Dunura Rubasinghe" data-NIC="200128574963">
                                    <div
                                        class="h-8 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ capitalizeEachWord($member->full_name) }}
                                        </p>
                                    </div>
                                    <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                        <div class="grid grid-cols-2 w-full">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Center Name:</p>
                                                <p class="text-gray-700">
                                                    {{ capitalizeEachWord($member->group->center->center_name) }}
                                                </p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>NIC:</p>
                                                <p class="text-gray-700">{{ $member->nic_number }}</p>
                                            </div>
                                        </div>
                                        @php
                                            $total_paid_amount = collect(
                                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                    ->installment,
                                            )->sum('amount');
                                            $total_balance =
                                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))
                                                    ->loan_amount +
                                                optional($member->loan->firstWhere('status', 'UNCOMPLETED'))->interest -
                                                $total_paid_amount;
                                        @endphp
                                        <div class="grid grid-cols-1 w-full space-y-1">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Current Loan Price:</p>
                                                <p class="text-gray-700">Rs. {{ number_format($total_balance, 2) }}</p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Loan Start Date:</p>
                                                <p class="text-gray-700">
                                                    {{ $member->loan->firstWhere('status', 'UNCOMPLETED')->issue_date }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>

                    <!-- Active Members Table -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="activeLoanIssueTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max activeTable">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">NIC</th>
                                            <th class="py-2 text-left">Current Loan Price</th>
                                            <th class="py-2 text-left">Loan Start Date</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
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
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($member->full_name) }}
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
                                                    <td class="py-2 text-left">Rs. {{ number_format($total_balance, 2) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ $member->loan->firstWhere('status', 'UNCOMPLETED')->issue_date }}
                                                    </td>
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
                                                        <a href="#"
                                                            class="border rounded hover:bg-lime-500 addNewPaymentModalButton">
                                                            <img src="{{ asset('assets/icons/Plus.svg') }}"
                                                                alt="Pencil" class="h-3 w-3 m-1">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inactive Members Section -->
                <div id="inactiveSection" class="inactive-content hidden">
                    <!-- Inactive Members Mobile Cards -->
                    <div id="inactiveLoanIssueGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">


                        @foreach ($allActiveMembers as $member)
                            @if ($member->status == 'INACTIVE')
                                <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                                    data-name="Dunura Rubasinghe" data-NIC="200128574963">
                                    <div
                                        class="h-8 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ capitalizeEachWord($member->full_name) }}
                                        </p>
                                    </div>
                                    <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                        <div class="grid grid-cols-2 w-full">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Center Name:</p>
                                                <p class="text-gray-700">
                                                    {{ capitalizeEachWord($member->group->center->center_name) }}
                                                </p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>NIC:</p>
                                                <p class="text-gray-700">{{ $member->nic_number }}</p>
                                            </div>
                                        </div>
                                        @php
                                            $latest_completed_loan = optional(
                                                $member->loan
                                                    ->where('status', 'COMPLETED')
                                                    ->sortByDesc('completed_date')
                                                    ->first(),
                                            );

                                        @endphp
                                        <div class="grid grid-cols-1 w-full space-y-1">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Last Loan Price:</p>
                                                <p class="text-gray-700">Rs.
                                                    {{ number_format($latest_completed_loan->loan_amount, 2) }}</p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Loan End Date:</p>
                                                <p class="text-gray-700">
                                                    {{ $latest_completed_loan->completed_date ?? 'NA' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endif
                    @endforeach



                    <!-- Inactive Members Table -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="inactiveLoanIssueTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max inActiveTable">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">NIC</th>
                                            <th class="py-2 text-left">Last Loan Price</th>
                                            <th class="py-2 text-left">Loan End Date</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
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
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($member->full_name) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($member->group->center->center_name) }}
                                                    </td>
                                                    <td class="py-2 text-left">{{ $member->nic_number }}</td>
                                                    @php
                                                        $latest_completed_loan = optional(
                                                            $member->loan
                                                                ->where('status', 'COMPLETED')
                                                                ->sortByDesc('completed_date')
                                                                ->first(),
                                                        );

                                                    @endphp
                                                    <td class="py-2 text-left">Rs.
                                                        {{ number_format($latest_completed_loan->loan_amount, 2) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ $latest_completed_loan->completed_date ?? 'NA' }}
                                                    </td>
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
                                                        <a href="#"
                                                            class="border rounded hover:bg-lime-500 addNewPaymentModalButton">
                                                            <img src="{{ asset('assets/icons/Plus.svg') }}"
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
            // Tab switching functionality
            let isTabActive = 1;

            function switchTab(tab) {
                const activeTab = document.getElementById('activeTab');
                const inactiveTab = document.getElementById('inactiveTab');
                const activeSection = document.getElementById('activeSection');
                const inactiveSection = document.getElementById('inactiveSection');

                if (tab === 'active') {
                    activeTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                    activeTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                    inactiveTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                    inactiveTab.classList.add('text-gray-400', 'hover:text-gray-700');
                    activeSection.classList.remove('hidden');
                    inactiveSection.classList.add('hidden');
                    isTabActive = 1;
                } else {
                    inactiveTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                    inactiveTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                    activeTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                    activeTab.classList.add('text-gray-400', 'hover:text-gray-700');
                    inactiveSection.classList.remove('hidden');
                    activeSection.classList.add('hidden');
                    isTabActive = 0;
                }
            }

            // Add alternating background colors to table rows
            document.addEventListener('DOMContentLoaded', function() {
                const activeRows = document.querySelectorAll('#activeLoanIssueTable tbody tr');
                const inactiveRows = document.querySelectorAll('#inactiveLoanIssueTable tbody tr');

                [activeRows, inactiveRows].forEach(rows => {
                    rows.forEach((row, index) => {
                        row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');
                        row.classList.add('hover:bg-sky-100');
                    });
                });
            });

            // Search functionality
            document.getElementById('search').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                // Mobile view - Active cards
                const activeCards = document.querySelectorAll('#activeLoanIssueGrid > div');
                activeCards.forEach(card => {
                    const name = card.getAttribute('data-name')?.toLowerCase() || '';
                    const nic = card.getAttribute('data-NIC')?.toLowerCase() || '';
                    card.style.display = (name.includes(searchTerm) || nic.includes(searchTerm)) ? 'flex' :
                        'none';
                });

                // Mobile view - Inactive cards
                const inactiveCards = document.querySelectorAll('#inactiveLoanIssueGrid > div');
                inactiveCards.forEach(card => {
                    const name = card.getAttribute('data-name')?.toLowerCase() || '';
                    const nic = card.getAttribute('data-NIC')?.toLowerCase() || '';
                    card.style.display = (name.includes(searchTerm) || nic.includes(searchTerm)) ? 'flex' :
                        'none';
                });

                // Desktop view - Active table rows
                const activeTableRows = document.querySelectorAll('#activeLoanIssueTable tbody tr');
                activeTableRows.forEach(row => {
                    const name = row.getAttribute('data-Name')?.toLowerCase() || '';
                    const nic = row.getAttribute('data-NIC')?.toLowerCase() || '';
                    row.style.display = (name.includes(searchTerm) || nic.includes(searchTerm)) ? '' : 'none';
                });

                // Desktop view - Inactive table rows
                const inactiveTableRows = document.querySelectorAll('#inactiveLoanIssueTable tbody tr');
                inactiveTableRows.forEach(row => {
                    const name = row.getAttribute('data-Name')?.toLowerCase() || '';
                    const nic = row.getAttribute('data-NIC')?.toLowerCase() || '';
                    row.style.display = (name.includes(searchTerm) || nic.includes(searchTerm)) ? '' : 'none';
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
            }
            document.getElementById("export").addEventListener("click", function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Optional: Add title
                doc.setFontSize(14);


                // Create PDF table from HTML table


                // Download PDF
                if (isTabActive === 1) {
                    doc.text("Active Members Report", 14, 15);
                    doc.autoTable({
                        html: '.activeTable', // <- you only have tbody, so use full table selector instead
                        head: [
                            ['#', 'Name', 'Center', 'NIC', 'Current Loan Price', 'Loan Start Date',
                                'Action'
                            ]
                        ],
                        startY: 20,
                        theme: 'grid',
                        styles: {
                            fontSize: 8
                        }
                    });
                    doc.save("active_members_report.pdf");
                } else {
                    doc.text("InActive Members Report", 14, 15);
                    doc.autoTable({
                        html: '.inActiveTable', // <- you only have tbody, so use full table selector instead
                        head: [
                            ['#', 'Name', 'Center', 'NIC', 'Last Loan Price', 'Loan Start Date', 'Action']
                        ],
                        startY: 20,
                        theme: 'grid',
                        styles: {
                            fontSize: 8
                        }
                    });
                    doc.save("inactive_members_report.pdf");
                }
            });
        </script>
    @endsection
