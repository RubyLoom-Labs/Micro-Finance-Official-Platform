{{-- @extends('layouts.layout')
@php
    use Carbon\Carbon;
    $now = Carbon::now();
    require_once resource_path('libs\first_letter_capitalization.php');
    require_once resource_path('libs\every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and Table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!---Cards-->
            <div class="flex lg:w-1/2 lg:h-20 w-full px-2 lg:px-0 py-4 lg:py-0">
                <!--Mobile View:-->
                <div id="topCards" class="grid grid-cols-1 lg:flex gap-2 lg:gap-08 w-full lg:p-0 lg:pb-4">
                    <!--Total Pending Card-->
                    <div id="totalPendingCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-yellow-200">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total Pending</h2>
                            <p class="text-xs text-gray-400">Total pending amount</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">50000000</h1>
                        </div>
                    </div>
                    <!--Total No Paid Card-->
                    <div id="totalNoPaidCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-red-300">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total No Paid</h2>
                            <p class="text-xs text-gray-400">Total no paid amount</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">75843266</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="lg:h-8 lg:pb-4 w-full lg:pl-2 pl-4">
                <ul class="flex text-xs lg:space-x-4 space-x-4">
                    <li id="pendingTab" class="border-b-2 pb-1 border-black cursor-pointer font-semibold">
                        <a href="#" onclick="switchTab('pending')">Pending</a>
                    </li>
                    <li id="noPaidTab" class="border-black text-gray-400 hover:text-gray-700 cursor-pointer">
                        <a href="#" onclick="switchTab('noPaid')">No Paid</a>
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
                    <div id="dateFilter"
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
                    </div>
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
                                class="w-full bg-blue-600 text-white p-2 lg:p-1.5 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center px-4">
                                <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                                    class="h-3 w-3 m-1"> Export
                            </button>
                        </div>
                    </div>
                </div>
                <!--End Top Bar-->

                <!-- Pending Section -->
                <div id="pendingSection" class="pending-content">
                    <!-- Pending Mobile Cards -->
                    <div id="pendingLoanGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                        @if ($allActiveLoans)
                            @foreach ($allActiveLoans as $loans)

                                <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                                    data-name="Dunura Rubasinghe" data-center="center 01">
                                    <div
                                        class="h-8 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ capitalizeEachWord($loans->member->full_name) }}</p>
                                    </div>
                                    @php
                                        $loanTotal = $loans->loan_amount + $loans->interest;
                                        $noPaidAmount = 0;
                                        $paidAmount = 0;
                                        $now = Carbon::now();
                                        if ($loans->installment) {
                                            foreach ($loans->installment as $installment) {
                                                if ($installment->date_and_time < $now) {
                                                    $expected = $installment->installment_amount;
                                                    $paid = $installment->amount;

                                                    if ($paid < $expected) {
                                                        $noPaidAmount += $expected - $paid;
                                                    }
                                                }
                                                $paidAmount += $installment->amount;
                                            }
                                        }
                                        $pendingAmount = 0;
                                        if ($loans->installment) {
                                            foreach ($loans->installment as $installment) {
                                                // Check if installment is in the future
                                                if ($installment->date_and_time > $now) {
                                                    $underpayments = $installment->underpayment;

                                                    if ($underpayments && $underpayments->count() > 0) {
                                                        $underpaidTotal = $underpayments->sum('amount');
                                                        $pendingAmount += max(
                                                            0,
                                                            $installment->installment_amount - $underpaidTotal,
                                                        ); // prevent negative
                                                    } else {
                                                        $pendingAmount += $installment->installment_amount;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                        <div class="grid grid-cols-2 w-full">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Center Name:</p>
                                                <p class="text-gray-700">
                                                    {{ capitalizeEachWord($loans->member->group->center->center_name) }}</p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Loan Balance:</p>
                                                <p class="text-gray-700">Rs.
                                                    {{ number_format($loanTotal - $paidAmount, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 w-full space-y-1">
                                            <div class="text-xs flex items-center space-x-2 bg-yellow-200 p-1 rounded">
                                                <p>Installments:</p>
                                                <p class="text-gray-700 bg-white p-0.5 rounded">{{ str_pad($loans->terms, 3, '0', STR_PAD_LEFT) }}</p>
                                                <p class="text-gray-700">Rs. {{ number_format($loans->installment_price, 2) }}</p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1 bg-yellow-200 p-1 rounded">
                                                <p>Amount:</p>
                                                <p class="text-gray-700">Rs. {{ number_format($loans->loan_amount, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <!-- Pending Table -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="pendingLoanTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">Loan Balance</th>
                                            <th class="py-2 text-left">Installments</th>
                                            <th class="py-2 text-left">Amount</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
                                        @if ($allActiveLoans)
                                            @foreach ($allActiveLoans as $loans)
                                                <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                                    data-member-name="{{ capitalizeEachWord($loans->member->full_name) }}"
                                                    data-center-name=" {{ capitalizeEachWord($loans->member->group->center->center_name) }}"
                                                    data-branch-name="{{ capitalizeEachWord($loans->member->group->center->branch->branch_name) }}"
                                                    data-group-name="{{ capitalizeEachWord($loans->member->group->group_name) }}"
                                                    data-address="{{ capitalizeEachWord($loans->member->address) }}"
                                                    data-loan='@json($loans)'>
                                                    <td class="pl-4 py-2 text-left">
                                                        {{ str_pad($loans->id, 3, '0', STR_PAD_LEFT) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($loans->member->full_name) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($loans->member->group->center->center_name) }}
                                                    </td>
                                                    @php
                                                        $loanTotal = $loans->loan_amount + $loans->interest;
                                                        $pendingAmount = 0;
                                                        if ($loans->installment) {
                                                            foreach ($loans->installment as $installment) {
                                                                // Check if installment is in the future
                                                                if ($installment->date_and_time > $now) {
                                                                    $underpayments = $installment->underpayment;

                                                                    if ($underpayments && $underpayments->count() > 0) {
                                                                        $underpaidTotal = $underpayments->sum('amount');
                                                                        $pendingAmount += max(
                                                                            0,
                                                                            $installment->installment_amount -
                                                                                $underpaidTotal,
                                                                        ); // prevent negative
                                                                    } else {
                                                                        $pendingAmount +=
                                                                            $installment->installment_amount;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <td class="py-2 text-center">Rs.
                                                        {{ number_format($loanTotal - $paidAmount, 2) }}</td>
                                                    <td class="py-2 text-center"><span
                                                            class="bg-yellow-400 p-1 px-4 rounded">Rs.
                                                            {{ number_format($pendingAmount, 2) }}</span> </td>
                                                    <td class="py-2 text-center flex justify-center items-center gap-1">
                                                        <a href="#" class="border rounded hover:bg-green-500">
                                                            <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                                class="h-3 w-3 m-1">
                                                        </a>
                                                        <a href="#" class="border rounded hover:bg-sky-500">
                                                            <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                                alt="Pencil" class="h-3 w-3 m-1">
                                                        </a>
                                                        <a href="#" class="border rounded hover:bg-lime-500">
                                                            <img src="{{ asset('assets/icons/Money.svg') }}"
                                                                alt="Money" class="h-3 w-3 m-1">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- No Paid Section -->
                <div id="noPaidSection" class="no-paid-content hidden">
                    <!-- No Paid Mobile Cards -->
                    <div id="noPaidLoanGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                        <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                            data-name="Dunura Rubasinghe" data-center="center 01">
                            <div
                                class="h-8 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                <p class="text-sm font-semibold text-gray-800">Dunura Rubasinghe</p>
                            </div>
                            <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Center Name:</p>
                                        <p class="text-gray-700">center 01</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Loan Balance:</p>
                                        <p class="text-gray-700">50000000/=</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 w-full space-y-1">
                                    <div class="text-xs flex items-center space-x-2 bg-red-200 p-1 rounded">
                                        <p>Installments:</p>
                                        <p class="text-gray-700 bg-white p-0.5 rounded">12</p>
                                        <p class="text-gray-700">120000/=</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 bg-red-200 p-1 rounded">
                                        <p>Amount:</p>
                                        <p class="text-gray-700">4166666.67/=</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- No Paid Table -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="noPaidLoanTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">Loan Balance</th>
                                            <th class="py-2 text-left">Installments</th>
                                            <th class="py-2 text-left">Amount</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                            data-name="Jane Smith" data-center="Center 02">
                                            <td class="py-2 text-center">001</td>
                                            <td class="py-2 text-left">Jane Smith</td>
                                            <td class="py-2 text-left">Center 02</td>
                                            <td class="py-2 text-left">2000000/=</td>
                                            <td class="py-2 text-left "><span
                                                    class="bg-red-500 p-1 px-4 rounded text-white">8,000/=</span> <span
                                                    class="bg-red-700 p-1 px-2 rounded text-white">01</span></td>
                                            <td class="py-2 text-left "><span
                                                    class="bg-red-500 p-1 px-4 rounded text-white">2,000/=</span></td>
                                            <td class="py-2 text-center flex justify-center items-center gap-1">
                                                <a href="#" class="border rounded hover:bg-green-500">
                                                    <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                        class="h-3 w-3 m-1">
                                                </a>
                                                <a href="#" class="border rounded hover:bg-sky-500">
                                                    <img src="{{ asset('assets/icons/ArrowLineDown.svg') }}"
                                                        alt="Pencil" class="h-3 w-3 m-1">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
        function switchTab(tab) {
            const pendingTab = document.getElementById('pendingTab');
            const noPaidTab = document.getElementById('noPaidTab');
            const pendingSection = document.getElementById('pendingSection');
            const noPaidSection = document.getElementById('noPaidSection');

            if (tab === 'pending') {
                pendingTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                pendingTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                noPaidTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                noPaidTab.classList.add('text-gray-400', 'hover:text-gray-700');
                pendingSection.classList.remove('hidden');
                noPaidSection.classList.add('hidden');
            } else {
                noPaidTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                noPaidTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                pendingTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                pendingTab.classList.add('text-gray-400', 'hover:text-gray-700');
                noPaidSection.classList.remove('hidden');
                pendingSection.classList.add('hidden');
            }
        }

        // Add alternating background colors to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const pendingRows = document.querySelectorAll('#pendingLoanTable tbody tr');
            const noPaidRows = document.querySelectorAll('#noPaidLoanTable tbody tr');

            [pendingRows, noPaidRows].forEach(rows => {
                rows.forEach((row, index) => {
                    row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');
                    row.classList.add('hover:bg-sky-100');
                });
            });
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view - Pending cards
            const pendingCards = document.querySelectorAll('#pendingLoanGrid > div');
            pendingCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const center = card.getAttribute('data-center')?.toLowerCase() || '';
                card.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? 'flex' :
                    'none';
            });

            // Mobile view - No Paid cards
            const noPaidCards = document.querySelectorAll('#noPaidLoanGrid > div');
            noPaidCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const center = card.getAttribute('data-center')?.toLowerCase() || '';
                card.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? 'flex' :
                    'none';
            });

            // Desktop view - Pending table rows
            const pendingTableRows = document.querySelectorAll('#pendingLoanTable tbody tr');
            pendingTableRows.forEach(row => {
                const name = row.getAttribute('data-name')?.toLowerCase() || '';
                const center = row.getAttribute('data-center')?.toLowerCase() || '';
                row.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? '' :
                    'none';
            });

            // Desktop view - No Paid table rows
            const noPaidTableRows = document.querySelectorAll('#noPaidLoanTable tbody tr');
            noPaidTableRows.forEach(row => {
                const name = row.getAttribute('data-name')?.toLowerCase() || '';
                const center = row.getAttribute('data-center')?.toLowerCase() || '';
                row.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? '' :
                    'none';
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
    </script>
@endsection
 --}}
@extends('layouts.layout')

@php
    use Carbon\Carbon;
    $now = Carbon::now();

    // include your helper functions
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');

    // ---------- Top cards totals ----------
    $totalPendingAll = 0.0; // future installments (minus underpayments)
    $totalNoPaidAll = 0.0; // past-due shortfalls

    if (!empty($allActiveLoans)) {
        foreach ($allActiveLoans as $loan) {
            $pendingAmount = 0.0;
            $noPaidAmount = 0.0;

            if (!empty($loan->installment)) {
                foreach ($loan->installment as $inst) {
                    $due = $inst->date_and_time ? Carbon::parse($inst->date_and_time) : null;
                    $expected = (float) ($inst->installment_amount ?? 0);
                    $paid = (float) ($inst->amount ?? 0);

                    // Past-due shortfall
                    if ($due && $due->lt($now)) {
                        if ($paid < $expected) {
                            $noPaidAmount += $expected - $paid;
                        }
                    }

                    // Future pending (minus any underpayments recorded)
                    if ($due && $due->gt($now)) {
                        $underTotal =
                            !empty($inst->underpayment) && $inst->underpayment->count() > 0
                                ? (float) $inst->underpayment->sum('amount')
                                : 0.0;
                        $pendingAmount += max(0.0, $expected - $underTotal);
                    }
                }
            }

            $totalPendingAll += $pendingAmount;
            $totalNoPaidAll += $noPaidAmount;
        }
    }
@endphp

@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and Table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!---Cards-->
            <div class="flex lg:w-1/2 lg:h-20 w-full px-2 lg:px-0 py-4 lg:py-0">
                <!--Mobile View:-->
                <div id="topCards" class="grid grid-cols-1 lg:flex gap-2 w-full lg:p-0 lg:pb-4">
                    <!--Total Pending Card-->
                    <div id="totalPendingCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-yellow-200">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total Pending</h2>
                            <p class="text-xs text-gray-400">Total pending amount</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">
                                {{ number_format($totalPendingAll, 2) }}
                            </h1>
                        </div>
                    </div>
                    <!--Total No Paid Card-->
                    <div id="totalNoPaidCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 bg-red-300">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total No Paid</h2>
                            <p class="text-xs text-gray-400">Total no paid amount</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">
                                {{ number_format($totalNoPaidAll, 2) }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="lg:h-8 lg:pb-4 w-full lg:pl-2 pl-4">
                <ul class="flex text-xs lg:space-x-4 space-x-4">
                    <li id="pendingTab" class="border-b-2 pb-1 border-black cursor-pointer font-semibold">
                        <a href="#" onclick="switchTab('pending')">Pending</a>
                    </li>
                    <li id="noPaidTab" class="border-black text-gray-400 hover:text-gray-700 cursor-pointer">
                        <a href="#" onclick="switchTab('noPaid')">No Paid</a>
                    </li>
                </ul>
            </div>

            <!--Start Table and Mobile Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-h-5/6">
                <!-- Top Bar - Search bar and filter option for both mobile and web -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1 py-4">
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
                    <div id="dateFilter"
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
                    </div>

                    <!--Export + Search -->
                    <div id="dateFilter"
                        class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">
                        <!-- Search Bar -->
                        <div class="w-full text-sm lg:text-xs lg:w-1/2">
                            <input type="text" id="search" placeholder="Search ..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                        <div class="w-full text-sm lg:text-xs lg:w-24">
                            <button id="export" value=""
                                class="w-full bg-blue-600 text-white p-2 lg:p-1.5 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center px-4">
                                <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Download"
                                    class="h-3 w-3 m-1"> Export
                            </button>
                        </div>
                    </div>
                </div>
                <!--End Top Bar-->

                <!-- Pending Section -->
                <div id="pendingSection" class="pending-content">
                    <!-- Pending Mobile Cards -->
                    <div id="pendingLoanGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                        @if (!empty($allActiveLoans))
                            @foreach ($allActiveLoans as $loans)
                                @php
                                    $loanTotal = (float) ($loans->loan_amount + $loans->interest);
                                    $noPaidAmount = 0.0;
                                    $paidAmount = 0.0;
                                    $pendingAmount = 0.0;

                                    if (!empty($loans->installment)) {
                                        foreach ($loans->installment as $installment) {
                                            $due = $installment->date_and_time
                                                ? Carbon::parse($installment->date_and_time)
                                                : null;
                                            $expected = (float) ($installment->installment_amount ?? 0);
                                            $paid = (float) ($installment->amount ?? 0);

                                            if ($due && $due->lt($now)) {
                                                if ($paid < $expected) {
                                                    $noPaidAmount += $expected - $paid;
                                                }
                                            }
                                            if ($due && $due->gt($now)) {
                                                $underpayments = $installment->underpayment;
                                                $underTotal =
                                                    !empty($underpayments) && $underpayments->count() > 0
                                                        ? (float) $underpayments->sum('amount')
                                                        : 0.0;
                                                $pendingAmount += max(0.0, $expected - $underTotal);
                                            }

                                            $paidAmount += $paid;
                                        }
                                    }
                                @endphp

                                <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                                    data-name="{{ strtolower(capitalizeEachWord($loans->member->full_name)) }}"
                                    data-center="{{ strtolower(capitalizeEachWord($loans->member->group->center->center_name)) }}">
                                    <div
                                        class="h-8 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ capitalizeEachWord($loans->member->full_name) }}
                                        </p>
                                    </div>

                                    <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                        <div class="grid grid-cols-2 w-full">
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Center Name:</p>
                                                <p class="text-gray-700">
                                                    {{ capitalizeEachWord($loans->member->group->center->center_name) }}
                                                </p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1">
                                                <p>Loan Balance:</p>
                                                <p class="text-gray-700">Rs.
                                                    {{ number_format($loanTotal - $paidAmount, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 w-full space-y-1">
                                            <div class="text-xs flex items-center space-x-2 bg-yellow-200 p-1 rounded">
                                                <p>Installments:</p>
                                                <p class="text-gray-700 bg-white p-0.5 rounded">
                                                    {{ str_pad($loans->terms, 2, '0', STR_PAD_LEFT) }}</p>
                                                <p class="text-gray-700">Rs.
                                                    {{ number_format($loans->installment_price, 2) }}</p>
                                            </div>
                                            <div class="text-xs flex items-center space-x-1 bg-yellow-200 p-1 rounded">
                                                <p>Amount:</p>
                                                <p class="text-gray-700">Rs. {{ number_format($loans->loan_amount, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div> <!-- /pendingLoanGrid -->

                    <!-- Pending Table -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="pendingLoanTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">Loan Balance</th>
                                            <th class="py-2 text-left">Installments</th>
                                            <th class="py-2 text-left">Amount</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyPending" class="text-gray-800 text-xs font-light bg-white">
                                        @if (!empty($allActiveLoans))
                                            @foreach ($allActiveLoans as $loans)
                                                @php
                                                    $loanTotal = (float) ($loans->loan_amount + $loans->interest);
                                                    $paidAmount = 0.0;
                                                    $pendingAmount = 0.0;

                                                    if (!empty($loans->installment)) {
                                                        foreach ($loans->installment as $installment) {
                                                            $due = $installment->date_and_time
                                                                ? Carbon::parse($installment->date_and_time)
                                                                : null;
                                                            $expected = (float) ($installment->installment_amount ?? 0);
                                                            $paid = (float) ($installment->amount ?? 0);

                                                            if ($due && $due->gt($now)) {
                                                                $underTotal =
                                                                    !empty($installment->underpayment) &&
                                                                    $installment->underpayment->count() > 0
                                                                        ? (float) $installment->underpayment->sum(
                                                                            'amount',
                                                                        )
                                                                        : 0.0;
                                                                $pendingAmount += max(0.0, $expected - $underTotal);
                                                            }

                                                            $paidAmount += $paid;
                                                        }
                                                    }
                                                @endphp
                                                <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                                    data-name="{{ strtolower(capitalizeEachWord($loans->member->full_name)) }}"
                                                    data-center="{{ strtolower(capitalizeEachWord($loans->member->group->center->center_name)) }}"
                                                    data-member-name="{{ capitalizeEachWord($loans->member->full_name) }}"
                                                    data-center-name="{{ capitalizeEachWord($loans->member->group->center->center_name) }}"
                                                    data-branch-name="{{ capitalizeEachWord($loans->member->group->center->branch->branch_name ?? '') }}"
                                                    data-group-name="{{ capitalizeEachWord($loans->member->group->group_name ?? '') }}"
                                                    data-address="{{ capitalizeEachWord($loans->member->address ?? '') }}"
                                                    data-loan='@json($loans)'>
                                                    <td class="pl-4 py-2 text-left">
                                                        {{ str_pad($loans->id, 3, '0', STR_PAD_LEFT) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($loans->member->full_name) }}
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        {{ capitalizeEachWord($loans->member->group->center->center_name) }}
                                                    </td>
                                                    <td class="py-2 text-left">Rs.
                                                        {{ number_format($loanTotal - $paidAmount, 2) }}</td>
                                                    <td class="py-2 text-left">
                                                        <span
                                                            class="bg-yellow-400 p-1 px-4 rounded">{{ str_pad($loans->terms, 2, '0', STR_PAD_LEFT) }}</span>
                                                    </td>
                                                    <td class="py-2 text-left">
                                                        <span class="bg-yellow-400 p-1 px-4 rounded">
                                                            Rs.
                                                            {{ number_format($loans->loan_amount, 2) }}</span>
                                                    </td>
                                                    <td class="py-2 text-center flex justify-center items-center gap-1">
                                                        <a href="#" class="border rounded hover:bg-green-500">
                                                            <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                                class="h-3 w-3 m-1">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /Pending Section -->
                </div>

                <!-- No Paid Section -->
                <div id="noPaidSection" class="no-paid-content hidden">
                    <!-- No Paid Mobile Cards (example placeholder) -->
                    <div id="noPaidLoanGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                        {{-- Populate similarly to Pending if needed --}}
                    </div>

                    <!-- No Paid Table (example placeholder) -->
                    <div class="flex justify-start h-full pt-2">
                        <div id="noPaidLoanTable"
                            class="w-full h-[calc(100vh-300px)] hidden lg:block p-0 overflow-y-auto border-t">
                            <div class="min-w-full">
                                <table class="w-full min-w-max">
                                    <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                        <tr class="uppercase w-full">
                                            <th class="py-2 px-2 text-center">#</th>
                                            <th class="py-2 text-left">Name</th>
                                            <th class="py-2 text-left">Center</th>
                                            <th class="py-2 text-left">Loan Balance</th>
                                            <th class="py-2 text-left">Installments</th>
                                            <th class="py-2 text-left">Amount</th>
                                            <th class="py-2 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyNoPaid" class="text-gray-800 text-xs font-light bg-white">
                                        {{-- Fill with data if required --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /No Paid Section -->

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
        function switchTab(tab) {
            const pendingTab = document.getElementById('pendingTab');
            const noPaidTab = document.getElementById('noPaidTab');
            const pendingSection = document.getElementById('pendingSection');
            const noPaidSection = document.getElementById('noPaidSection');

            if (tab === 'pending') {
                pendingTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                pendingTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                noPaidTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                noPaidTab.classList.add('text-gray-400', 'hover:text-gray-700');
                pendingSection.classList.remove('hidden');
                noPaidSection.classList.add('hidden');
            } else {
                noPaidTab.classList.add('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                noPaidTab.classList.remove('text-gray-400', 'hover:text-gray-700');
                pendingTab.classList.remove('border-b-2', 'pb-1', 'border-black', 'font-semibold');
                pendingTab.classList.add('text-gray-400', 'hover:text-gray-700');
                noPaidSection.classList.remove('hidden');
                pendingSection.classList.add('hidden');
            }
        }

        // Add alternating background colors to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const pendingRows = document.querySelectorAll('#pendingLoanTable tbody tr');
            const noPaidRows = document.querySelectorAll('#noPaidLoanTable tbody tr');
            [pendingRows, noPaidRows].forEach(rows => {
                rows.forEach((row, index) => {
                    row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');
                    row.classList.add('hover:bg-sky-100');
                });
            });
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view - Pending cards
            const pendingCards = document.querySelectorAll('#pendingLoanGrid > div');
            pendingCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const center = card.getAttribute('data-center')?.toLowerCase() || '';
                card.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? 'flex' :
                    'none';
            });

            // Mobile view - No Paid cards
            const noPaidCards = document.querySelectorAll('#noPaidLoanGrid > div');
            noPaidCards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || '';
                const center = card.getAttribute('data-center')?.toLowerCase() || '';
                card.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? 'flex' :
                    'none';
            });

            // Desktop view - Pending table rows
            const pendingTableRows = document.querySelectorAll('#pendingLoanTable tbody tr');
            pendingTableRows.forEach(row => {
                const name = row.getAttribute('data-name')?.toLowerCase() || '';
                const center = row.getAttribute('data-center')?.toLowerCase() || '';
                row.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? '' :
                    'none';
            });

            // Desktop view - No Paid table rows
            const noPaidTableRows = document.querySelectorAll('#noPaidLoanTable tbody tr');
            noPaidTableRows.forEach(row => {
                const name = row.getAttribute('data-name')?.toLowerCase() || '';
                const center = row.getAttribute('data-center')?.toLowerCase() || '';
                row.style.display = (name.includes(searchTerm) || center.includes(searchTerm)) ? '' :
                    'none';
            });
        });

        // Dropdown helpers
        function toggleDropdownBranch() {
            document.getElementById('dropdownMenuBranch').classList.toggle('hidden');
        }

        function selectBranch(value) {
            document.getElementById('selectedOptionBranch').textContent = value.charAt(0).toUpperCase() + value.slice(1);
            document.getElementById('branchSelect').value = value;
            toggleDropdownBranch();
            filterData();
        }

        function toggleDropdownCenter() {
            document.getElementById('dropdownMenuCenter').classList.toggle('hidden');
        }

        function selectCenter(value) {
            document.getElementById('selectedOptionCenter').textContent = value;
            document.getElementById('centerSelect').value = value;
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
    </script>
@endsection
