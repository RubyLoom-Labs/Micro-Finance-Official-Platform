@extends('layouts.layout')
@php
    use Carbon\Carbon;
    $now = Carbon::now();
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!--Start Table and Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-full">
                <!-- Top Bar - Search bar and filter option for both mobile and web -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1">
                    <!-- filter line -->
                    <div id="filterRow"
                        class="flex flex-col lg:flex-row w-full justify-start lg:space-x-2 space-y-2 lg:space-y-0 lg:w-1/2">
                        <!-- Filter Button -->
                        <div class="text-sm lg:w-max lg:space-x-2">
                            <button value=""
                                class="hidden lg:flex bg-white p-2 rounded-lg focus:outline-none border w-8">
                                <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Filter Icon" class="h-4 w-4">
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
                                            data-value="Ella Center 01" onclick="selectCenter('Ella Center 01')">Ella Center
                                            01</li>
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
                    <!-- Search Bar -->
                    <div class="w-full text-sm lg:w-5/12">
                        <input type="text" id="searchMember" placeholder="Search ..."
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 ring-blue-500 bg-white">
                    </div>
                </div>
                <!--CARD SECTION-->
                <div id="memberGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2">
                    <!-- Card for a center -->
                    @php
                        $underpaymentLoans = $allActiveLoans->filter(function ($loan) {
                            $installments = collect($loan->installments ?? $loan->installment)->sortByDesc(
                                'installment_number',
                            );

                            if ($installments->isEmpty()) {
                                return false; // no installments, skip
                            }

                            $lastInstallment = $installments->first();
                            $secondLastInstallment = $installments->skip(1)->first(); // may be null

                            return $loan->status === 'UNCOMPLETED' &&
                                ($lastInstallment->status === 'UNDERPAYED' ||
                                    ($lastInstallment->status === 'UNPAYED' && $secondLastInstallment && $secondLastInstallment->status === 'UNDERPAYED'));
                        });
                    @endphp
                    @foreach ($underpaymentLoans as $loans)
                        <div class="rounded-md shadow flex flex-col justify-between w-full border bg-gray-100 hover:bg-gray-300"
                            data-member="Dunura" data-center="balangoda" data-loan-balance="85955200"
                            data-pending-amount="2000">
                            <div class="h-8 flex flex-col items-center justify-center rounded-t-md">
                                <p class="text-sm font-bold text-gray-800">
                                    {{ capitalizeEachWord($loans->member->full_name) }}</p>
                            </div>
                            <hr>
                            @php
                                $loanTotal = $loans->loan_amount + $loans->interest;
                                $totalPayed = $loans->installment->sum(function ($installment) {
                                    return $installment->underpayment->sum('amount');
                                });

                                $installments = collect($loans->installment)->sortByDesc('installment_number');

                                $lastInstallment = $installments->first();
                                $secondLastInstallment = $installments->skip(1)->first();

                                // assign the installment to use for underpayment calculation
                                $targetInstallment = null;

                                if ($lastInstallment && $lastInstallment->status === 'UNDERPAYED') {
                                    $targetInstallment = $lastInstallment;
                                } elseif (
                                    $lastInstallment->status === 'UNPAYED' &&
                                    $secondLastInstallment &&
                                    $secondLastInstallment->status === 'UNDERPAYED'
                                ) {
                                    $targetInstallment = $secondLastInstallment;
                                }

                                // fallback if no installment meets the condition
                                if ($targetInstallment) {
                                    $underpayment =
                                        $targetInstallment->installment_number * $loans->installment_price -
                                        $totalPayed;
                                } else {
                                    $underpayment = 0; // or handle as needed
                                }
                            @endphp
                            {{-- @php

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
                            @endphp --}}
                            <div
                                class="h-max py-2 px-4 flex flex-col justify-between space-y-1 bg-gray-200 hover:bg-gray-300">
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p class="">Center :</p>
                                        <p class="text-gray-700">
                                            {{ capitalizeEachWord($loans->member->group->center->center_name) }}</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1">
                                        <p class="">Loan Balance :</p>
                                        <p class="text-gray-700">Rs. {{ number_format($loanTotal - $totalPayed, 2) }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p class="">Pending Amount :</p>
                                        <p class="text-gray-700">Rs. {{ number_format($underpayment, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!--TABLE SECTION-->
                <div class="flex justify-start h-full pt-4">
                    <div id="memberGridTable"
                        class="w-full max-h-[calc(100vh-200px)] hidden lg:block p-0 overflow-y-auto border-t">
                        <div class="min-w-full h-full">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="pl-4 py-2 text-left">#</th>
                                        <th class="py-2 text-left">Name</th>
                                        <th class="py-2 text-left">Center</th>
                                        {{--                                         <th class="py-2 text-center">Loan Balance</th>
 --}} <th class="py-2 text-center">Under Payment Balance</th>
                                        {{--                                         <th class="py-2 text-center">Action</th>
 --}}
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white w-full">
                                    @if ($underpaymentLoans)
                                        @foreach ($underpaymentLoans as $loans)
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
                                                {{-- @php
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
                                                                    $pendingAmount += $installment->installment_amount;
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp --}}
                                                @php
                                                    $loanTotal = $loans->loan_amount + $loans->interest;
                                                    $totalPayed = $loans->installment->sum(function ($installment) {
                                                        return $installment->underpayment->sum('amount');
                                                    });

                                                    $installments = collect($loans->installment)->sortByDesc(
                                                        'installment_number',
                                                    );

                                                    $lastInstallment = $installments->first();
                                                    $secondLastInstallment = $installments->skip(1)->first();

                                                    // assign the installment to use for underpayment calculation
                                                    $targetInstallment = null;

                                                    if ($lastInstallment && $lastInstallment->status === 'UNDERPAYED') {
                                                        $targetInstallment = $lastInstallment;
                                                    } elseif (
                                                        $lastInstallment->status === 'UNPAYED' &&
                                                        $secondLastInstallment &&
                                                        $secondLastInstallment->status === 'UNDERPAYED'
                                                    ) {
                                                        $targetInstallment = $secondLastInstallment;
                                                    }

                                                    // fallback if no installment meets the condition
                                                    if ($targetInstallment) {
                                                        $underpayment =
                                                            $targetInstallment->installment_number *
                                                                $loans->installment_price -
                                                            $totalPayed;
                                                    } else {
                                                        $underpayment = 0; // or handle as needed
                                                    }
                                                @endphp
                                                {{-- <td class="py-2 text-center">Rs.
                                                    {{ number_format($loanTotal - $totalPayed, 2) }}</td> --}}
                                                <td class="py-2 text-center"><span
                                                        class="bg-yellow-400 p-1 px-4 rounded">Rs.
                                                        {{ number_format($underpayment, 2) }}</span> </td>
                                               {{--  <td class="py-2 text-center flex justify-center items-center gap-1">
                                                    <a href="#" class="border rounded hover:bg-green-500">
                                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                            class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="#" class="border rounded hover:bg-sky-500">
                                                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                            alt="Pencil" class="h-3 w-3 m-1">
                                                    </a>
                                                    <a href="#" class="border rounded hover:bg-lime-500">
                                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Money"
                                                            class="h-3 w-3 m-1">
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endif
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

        <!-- Second Column: Side view of table view -->
        <div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
            <div id="RowDetailsContent" class="border-b p-4">
                <h1 id="memberNameSlideBar" class="text-md font-medium text-gray-800 mb-1"></h1>
                <h1 id="Manme" class="text-xs text-gray-600 mb-4"><span id="branchNameSlideBar"></span> > <span
                        id="centerNameSlideBar"></span> >
                    <span id="groupNameSlideBar"></span>
                </h1>
                <div class="grid grid-cols-2 gap-y-2">
                    <div>
                        <p for="num01" class="text-xs text-gray-400">Mobile number 01</p>
                        <p id="num01SlideBar" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="num02" class="text-xs text-gray-400">Mobile number 02</p>
                        <p id="num02SlideBar" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="NIC" class="text-xs text-gray-400">NIC</p>
                        <p id="NICSlideBar" class="text-sm"></p>
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
                        <p id="memberAddressSlideBar" class="text-sm mt-0"></p>
                    </div>
                </div>
            </div>
            <div class=" h-full overflow-y-auto max-h-[calc(100vh-350px)]">
                <div class="p-4 pt-1 border-b w-full">
                    <h1 id="" class="text-sm font-medium text-gray-800 mb-1 pb-2">Current Loan Details</h1>
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
                </div>
                <div class="w-full px-4 py-2 text-sm lg:text-xs  bg-gray-200">
                    <div class="grid grid-cols-2 gap-y-2">
                        <div>
                            <p for="LoanAmount" class="text-xs text-gray-400">Total Paid</p>
                            <p id="LoanAmount" class="text-sm">10 000 00</p>
                        </div>
                        <div>
                            <p for="LoanAmount" class="text-xs text-gray-400">balance</p>
                            <p id="LoanAmount" class="text-sm">10 000 00</p>
                        </div>
                    </div>
                </div>
                <!--Installment Card-->
                <div class="w-full text-sm lg:text-xs  p-4  m-0 ">
                    <div class="grid grid-cols-1 gap-y-2">
                        <!-- Main Card -->
                        <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                            <!-- Header Row -->
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                    <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                        <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle"
                                            class="h-3 w-3 transform transition-transform">
                                    </button>
                                </div>
                                <p class="text-xs text-gray-600">3/25/2025 - 10:55AM</p>
                            </div>

                            <!-- Sub Info -->
                            <div class="mt-0 flex justify-between items-center text-xs">
                                <div class="flex items-center space-x-2">
                                    <p class="text-gray-400">Amount</p>
                                    <p class="font-medium text-gray-600">2,000/=</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <p class="text-gray-400">Pay in Date</p>
                                    <p class="text-xs font-medium p-0.5 bg-green-500 rounded px-1">Yes</p>
                                </div>
                            </div>

                            <!-- Collapsible Section -->
                            <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                                <div class="grid gap-3">
                                    <!-- Amount -->
                                    <div class="flex justify-between items-center">
                                        <label for="amount" class="block text-xs font-medium">Amount *</label>
                                        <input type="number" name="amount" id="amount"
                                            class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                    </div>

                                    <!-- Date and File -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label for="payDate" class="block text-xs font-medium">Date *</label>
                                            <input type="date" name="payDate" id="payDate"
                                                class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                        </div>
                                        <div>
                                            <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                            <input type="file" name="bill" id="bill"
                                                class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex justify-end space-x-2 mt-3">
                                        <button type="button"
                                            class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                        <button type="submit"
                                            class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sample -->
                        <!-- Main Card -->
                        <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                            <!-- Header Row -->
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                    <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                        <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle"
                                            class="h-3 w-3 transform transition-transform">
                                    </button>
                                </div>
                                <p class="text-xs text-gray-600">3/25/2025 - 10:55AM</p>
                            </div>

                            <!-- Sub Info -->
                            <div class="mt-0 flex justify-between items-center text-xs">
                                <div class="flex items-center space-x-2">
                                    <p class="text-gray-400">Amount</p>
                                    <p class="font-medium text-gray-600">2,000/=</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <p class="text-gray-400">Pay in Date</p>
                                    <p class="text-xs font-medium p-0.5 bg-green-500 rounded px-1">Yes</p>
                                </div>
                            </div>

                            <!-- Collapsible Section -->
                            <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                                <div class="grid gap-3">
                                    <!-- Amount -->
                                    <div class="flex justify-between items-center">
                                        <label for="amount" class="block text-xs font-medium">Amount *</label>
                                        <input type="number" name="amount" id="amount"
                                            class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                    </div>

                                    <!-- Date and File -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label for="payDate" class="block text-xs font-medium">Date *</label>
                                            <input type="date" name="payDate" id="payDate"
                                                class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                        </div>
                                        <div>
                                            <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                            <input type="file" name="bill" id="bill"
                                                class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex justify-end space-x-2 mt-3">
                                        <button type="button"
                                            class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                        <button type="submit"
                                            class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" p-2 pb-4 border-t">
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
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#tableBody tr');
            rows.forEach((row, index) => {
                row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');
                row.classList.add('hover:bg-sky-100');
            });
        });

        // Search Filter
        document.getElementById('searchMember').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('#memberGrid > div');
            cards.forEach(card => {
                const memberName = card.getAttribute('data-member').toLowerCase();
                card.style.display = memberName.includes(searchTerm) ? 'flex' : 'none';
            });
            const tableRows = document.querySelectorAll('#tableBody tr');
            tableRows.forEach(row => {
                const memberName = row.getAttribute('data-member-name').toLowerCase();
                row.style.display = memberName.includes(searchTerm) ? 'table-row' : 'none';
            });
        });

        // DROPDOWN FOR FILTER
        function toggleDropdownBranch() {
            const dropdownMenu = document.getElementById('dropdownMenuBranch');
            dropdownMenu.classList.toggle('hidden');
        }

        function selectBranch(value) {
            const selectedOption = document.getElementById('selectedOptionBranch');
            selectedOption.textContent = value;
            document.getElementById('branchSelect').value = value;
            document.getElementById('dropdownMenuBranch').classList.add('hidden');
            filterData();
        }

        function toggleDropdownCenter() {
            const dropdownMenu = document.getElementById('dropdownMenuCenter');
            dropdownMenu.classList.toggle('hidden');
        }

        function selectCenter(value) {
            const selectedOption = document.getElementById('selectedOptionCenter');
            selectedOption.textContent = value;
            document.getElementById('centerSelect').value = value;
            document.getElementById('dropdownMenuCenter').classList.add('hidden');
            filterData();
        }

        document.addEventListener('click', function(event) {
            const dropdowns = ['dropdownMenuBranch', 'dropdownMenuCenter'];
            const triggers = ['dropdownTriggerBranch', 'dropdownTriggerCenter'];
            dropdowns.forEach(dropdownId => {
                const dropdown = document.getElementById(dropdownId);
                const trigger = document.getElementById(triggers[dropdowns.indexOf(dropdownId)]);
                if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });

        // Filtering function
        function filterData() {
            const branchFilter = document.getElementById('branchSelect').value.toLowerCase();
            const centerFilter = document.getElementById('centerSelect').value.toLowerCase();

            // Filter cards (mobile view)
            const cards = document.querySelectorAll('#memberGrid > div');
            cards.forEach(card => {
                const branch = card.getAttribute('data-branch')?.toLowerCase() || '';
                const center = card.getAttribute('data-center').toLowerCase();
                let showCard = true;
                if (branchFilter && branch !== branchFilter) showCard = false;
                if (centerFilter && center !== centerFilter) showCard = false;
                card.style.display = showCard ? 'block' : 'none';
            });

            // Filter table rows (desktop view)
            const rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                const branch = row.getAttribute('data-branch-name')?.toLowerCase() || '';
                const center = row.getAttribute('data-center-name').toLowerCase();
                let showRow = true;
                if (branchFilter && branch !== branchFilter) showRow = false;
                if (centerFilter && center !== centerFilter) showRow = false;
                row.style.display = showRow ? 'table-row' : 'none';
            });
        }

        //SECOND COLUMN
        function hideAllSecondColumns() {
            const columns = ['RowDetails'];
            columns.forEach(col => document.getElementById(col).classList.add('hidden'));
            document.getElementById('firstColumn').classList.remove('lg:w-8/12');
            document.getElementById('firstColumn').classList.add('lg:w-full');
        }

        /* document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const row = button.closest('tr');
                const RowDetails = document.getElementById('RowDetails');
                const firstColumn = document.getElementById('firstColumn');

                RowDetails.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                RowDetails.classList.add('lg:flex');

                const memberName = row.getAttribute('data-member-name');
                const centerName = row.getAttribute('data-center-name');
                const branchName = row.getAttribute('data-branch-name');
                const groupName = row.getAttribute('data-group-name');
                const address = row.getAttribute('data-address');
                const loanCount = JSON.parse(row.getAttribute('data-loan'));

                console.log(loanCount);
                document.getElementById('memberNameSlideBar').textContent = memberName;
                document.getElementById('branchNameSlideBar').textContent = branchName;
                document.getElementById('centerNameSlideBar').textContent = centerName;
                document.getElementById('groupNameSlideBar').textContent = groupName;
                document.getElementById('num01SlideBar').textContent = loanCount.member.mobile_number_1;
                document.getElementById('num02SlideBar').textContent = loanCount.member.mobile_number_2;
                document.getElementById('NICSlideBar').textContent = loanCount.member.nic_number;
                document.getElementById('memberAddressSlideBar').textContent = loanCount.member.address;
                document.getElementById('LoanAmountSlideBar').textContent = 'Rs. ' + parseFloat(loanCount
                    .loan_amount).toFixed(2);
                document.getElementById('InterestSlideBar').textContent = 'Rs. ' + parseFloat(loanCount
                    .interest).toFixed(2);
                document.getElementById('IssueDateSlideBar').textContent = loanCount.issue_date;
                document.getElementById('InstallmentSlideBar').textContent = 'Rs. ' + parseFloat(loanCount
                    .installment_price).toFixed(2);
                document.getElementById('TermsSlideBar').textContent = loanCount.terms;
                document.getElementById('DocumentChagersSlideBar').textContent = 'Rs. ' + parseFloat(
                    loanCount.document_charges).toFixed(2);
            });
        }); */

        // Installment Card Toggle
        document.querySelectorAll('.toggle-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.bg-gray-200');
                const details = card.querySelector('.installment-details');
                const icon = this.querySelector('img');
                details.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    </script>
@endsection
