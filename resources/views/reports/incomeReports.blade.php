@extends('layouts.layout')
@php
    use Carbon\Carbon;
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and table View-->
        @php
            $totalLoansAllCenters = $all_active_centers->sum(function ($center) {
                return $center->group->sum(function ($group) {
                    return $group->member->sum(function ($member) {
                        return $member->loan->where('status', 'UNCOMPLETED')->count();
                    });
                });
            });
            $totalIncomeAllCenters = $all_active_centers->sum(function ($center) {
                return $center->group->sum(function ($group) {
                    return $group->member->sum(function ($member) {
                        return $member->loan->sum(function ($loan) {
                            return $loan->installment->sum('installment_amount');
                        });
                    });
                });
            });
            $totalReceivedAllCenters = $all_active_centers->sum(function ($center) {
                return $center->group->sum(function ($group) {
                    return $group->member->sum(function ($member) {
                        return $member->loan->sum(function ($loan) {
                            return $loan->installment->sum(function ($installment) {
                                // if underpayment exists → sum them
                                if ($installment->underpayment && $installment->underpayment->isNotEmpty()) {
                                    return $installment->underpayment->sum('amount');
                                }
                                // else take normal amount
                                return $installment->amount ?? 0;
                            });
                        });
                    });
                });
            });
            $noPaidAllCenters = $totalIncomeAllCenters - $totalReceivedAllCenters;

        @endphp
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!---Cards-->
            <div class="flex w-full lg:h-20 px-2 lg:px-0 py-4 lg:py-0">
                <!--Mobile View:-->
                <div id="topCards" class="grid grid-cols-1 lg:flex gap-2 lg:gap-08 w-full lg:p-0 lg:pb-4">
                    <!--Total Loans Card-->
                    <div id="totalLoansCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 ">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total Loans</h2>
                            <p class="text-xs text-gray-400">All Times</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">
                                {{ str_pad($totalLoansAllCenters, 2, '0', STR_PAD_LEFT) }}</h1>
                        </div>
                    </div>
                    <!--Total Income Card-->
                    <div id="totalLoansCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 ">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total Income</h2>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">Rs.
                                {{ number_format($totalIncomeAllCenters, 2) }}</h1>
                        </div>
                    </div>
                    <!--Total No paid Card-->
                    <div id="totalLoansCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 ">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">No Paid</h2>
                            <p class="text-xs text-gray-400">Total No paid</p>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">Rs.
                                {{ number_format($noPaidAllCenters, 2) }}</h1>
                        </div>
                    </div>
                    <!--Total No paid Card-->
                    <div id="totalLoansCard"
                        class="px-4 py-2 lg:py-8 rounded-lg shadow-sm flex justify-between items-center w-full border border-gray-300 ">
                        <div class="flex flex-col w-1/2">
                            <h2 class="text-sm font-semibold text-gray-600">Total Received</h2>
                        </div>
                        <div class="flex flex-col justify-items-end items-end w-1/2">
                            <h1 class="text-xl md:text-xl font-bold text-right text-gray-600">Rs.
                                {{ number_format($totalReceivedAllCenters, 2) }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!--Start Table and Mobile Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-h-5/6">
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
                    {{-- <form method="GET" id="filterForm" class="w-full">
                        <div id="dateFilter"
                            class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-1/2">
                            <div
                                class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                                <label for="startDate" class="m-1">Start Date</label>
                                <input type="date" name="startDate" id="startDate" value="{{ request('startDate') }}"
                                    onchange="document.getElementById('filterForm').submit();">
                            </div>
                            <div
                                class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                                <label for="endDate" class="m-1">End Date</label>
                                <input type="date" name="endDate" id="endDate" value="{{ request('endDate') }}"
                                    onchange="document.getElementById('filterForm').submit();">
                            </div>
                        </div>
                    </form> --}}
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

                <!-------------CARD------------------------------------------------------------------------------------------------------------>
                <!-- loanIssue Grid card format hidden for lg screens -->
                <div id="loanIssueGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                    <!-- Card for a Laan -->
                    @if ($all_active_centers)
                        @foreach ($all_active_centers as $center)
                            <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                                data-manager="Dunura Rubasinghe" data-center="center 01">

                                @php

                                    $filterStartDate = request()->startDate
                                        ? \Carbon\Carbon::parse(request()->startDate)
                                        : null;
                                    $filterEndDate = request()->endDate
                                        ? \Carbon\Carbon::parse(request()->endDate)
                                        : null;

                                    $totalReceived = $center->group->sum(function ($group) use (
                                        $filterStartDate,
                                        $filterEndDate,
                                    ) {
                                        return $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan->sum(function ($loan) use (
                                                $filterStartDate,
                                                $filterEndDate,
                                            ) {
                                                return $loan->installment->sum(function ($installment) use (
                                                    $filterStartDate,
                                                    $filterEndDate,
                                                ) {
                                                    // If installment has underpayments
                                                    if (
                                                        $installment->underpayment &&
                                                        $installment->underpayment->isNotEmpty()
                                                    ) {
                                                        return $installment->underpayment
                                                            ->filter(function ($underpayment) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                $payedDate = Carbon::parse($underpayment->payed_date);
                                                                return (!$filterStartDate ||
                                                                    $payedDate >= $filterStartDate) &&
                                                                    (!$filterEndDate || $payedDate <= $filterEndDate);
                                                            })
                                                            ->sum('amount'); // Sum filtered underpayments
                                                    }

                                                    $payedDate = Carbon::parse($installment->payed_date);
                                                    if (
                                                        (!$filterStartDate || $payedDate >= $filterStartDate) &&
                                                        (!$filterEndDate || $payedDate <= $filterEndDate)
                                                    ) {
                                                        return $installment->amount;
                                                    }

                                                    return 0; // No match
                                                });
                                            });
                                        });
                                    });

                                    $totalIncome = $center->group->sum(function ($group) use (
                                        $filterStartDate,
                                        $filterEndDate,
                                    ) {
                                        return $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan->sum(function ($loan) use (
                                                $filterStartDate,
                                                $filterEndDate,
                                            ) {
                                                return $loan->installment
                                                    ->filter(function ($installment) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        $date = Carbon::parse($installment->date_and_time);
                                                        return (!$filterStartDate || $date >= $filterStartDate) &&
                                                            (!$filterEndDate || $date <= $filterEndDate);
                                                    })
                                                    ->sum('installment_amount');
                                            });
                                        });
                                    });

                                    $noPaid = $totalIncome - $totalReceived;

                                    $groupsInformation = $center->group->map(function ($group) use (
                                        $filterStartDate,
                                        $filterEndDate,
                                    ) {
                                        // --- Total Active Loans ---
                                        $totalActiveLoans = $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan
                                                ->filter(function ($loan) use ($filterStartDate, $filterEndDate) {
                                                    foreach ($loan->installment as $installment) {
                                                        // Check underpayments
                                                        foreach ($installment->underpayment as $underpayment) {
                                                            $underPayedDate = Carbon::parse($underpayment->payed_date);
                                                            if (
                                                                (!$filterStartDate ||
                                                                    $underPayedDate >= $filterStartDate) &&
                                                                (!$filterEndDate || $underPayedDate <= $filterEndDate)
                                                            ) {
                                                                return true;
                                                            }
                                                        }

                                                        // Check installment payed_date
                                                        $installmentPayedDate = Carbon::parse($installment->payed_date);
                                                        if (
                                                            (!$filterStartDate ||
                                                                $installmentPayedDate >= $filterStartDate) &&
                                                            (!$filterEndDate || $installmentPayedDate <= $filterEndDate)
                                                        ) {
                                                            return true;
                                                        }
                                                    }

                                                    return false;
                                                })
                                                ->count();
                                        });

                                        // --- Total Received ---
                                        $totalReceived = $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan->sum(function ($loan) use (
                                                $filterStartDate,
                                                $filterEndDate,
                                            ) {
                                                return $loan->installment->sum(function ($installment) use (
                                                    $filterStartDate,
                                                    $filterEndDate,
                                                ) {
                                                    // If installment has underpayments
                                                    if (
                                                        $installment->underpayment &&
                                                        $installment->underpayment->isNotEmpty()
                                                    ) {
                                                        return $installment->underpayment
                                                            ->filter(function ($underpayment) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                $payedDate = Carbon::parse($underpayment->payed_date);
                                                                return (!$filterStartDate ||
                                                                    $payedDate >= $filterStartDate) &&
                                                                    (!$filterEndDate || $payedDate <= $filterEndDate);
                                                            })
                                                            ->sum('amount');
                                                    }

                                                    $payedDate = Carbon::parse($installment->payed_date);
                                                    if (
                                                        (!$filterStartDate || $payedDate >= $filterStartDate) &&
                                                        (!$filterEndDate || $payedDate <= $filterEndDate)
                                                    ) {
                                                        return $installment->amount;
                                                    }

                                                    return 0;
                                                });
                                            });
                                        });

                                        $totalIncome = $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan->sum(function ($loan) use (
                                                $filterStartDate,
                                                $filterEndDate,
                                            ) {
                                                return $loan->installment
                                                    ->filter(function ($installment) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        $date = Carbon::parse($installment->date_and_time);
                                                        return (!$filterStartDate || $date >= $filterStartDate) &&
                                                            (!$filterEndDate || $date <= $filterEndDate);
                                                    })
                                                    ->sum('installment_amount');
                                            });
                                        });

                                        return [
                                            'group_id' => $group->id,
                                            'group_name' => capitalizeFirstLetter($group->group_name),
                                            'received' => number_format($totalReceived, 2),
                                            'to_pay' => $totalIncome - $totalReceived,
                                            'total' => $totalIncome,
                                            'active_loans' => $totalActiveLoans,
                                        ];
                                    });

                                    // Optional: convert to array
                                    $groupsInformation = $groupsInformation->values()->toArray();
                                    $totalActiveLoans = $center->group->sum(function ($group) use (
                                        $filterStartDate,
                                        $filterEndDate,
                                    ) {
                                        return $group->member->sum(function ($member) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            return $member->loan
                                                ->filter(function ($loan) use ($filterStartDate, $filterEndDate) {
                                                    // ✅ 1. If any installment is unpaid (payed_date is null)
                                                    if (
                                                        $loan->installment->contains(function ($installment) {
                                                            return $installment->status === 'UNPAYED';
                                                        })
                                                    ) {
                                                        return true;
                                                    }

                                                    // ✅ 2. If any installment payed_date is within selected range
                                                    if (
                                                        $loan->installment->contains(function ($installment) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            if (!$installment->payed_date) {
                                                                return false;
                                                            }
                                                            $payedDate = Carbon::parse($installment->payed_date);
                                                            return (!$filterStartDate ||
                                                                $payedDate >= $filterStartDate) &&
                                                                (!$filterEndDate || $payedDate <= $filterEndDate);
                                                        })
                                                    ) {
                                                        return true;
                                                    }

                                                    // ✅ 3. If any underpayment payed_date is within selected range
                                                    foreach ($loan->installment as $installment) {
                                                        if (
                                                            $installment->underpayment->contains(function (
                                                                $underpayment,
                                                            ) use ($filterStartDate, $filterEndDate) {
                                                                if (!$underpayment->payed_date) {
                                                                    return false;
                                                                }
                                                                $underPayedDate = Carbon::parse(
                                                                    $underpayment->payed_date,
                                                                );
                                                                return (!$filterStartDate ||
                                                                    $underPayedDate >= $filterStartDate) &&
                                                                    (!$filterEndDate ||
                                                                        $underPayedDate <= $filterEndDate);
                                                            })
                                                        ) {
                                                            return true;
                                                        }
                                                    }

                                                    // ✅ 4. If any installment was paid late, and due date is within range
                                                    if (
                                                        $loan->installment->contains(function ($installment) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            if (
                                                                !$installment->payed_date ||
                                                                !$installment->date_and_time
                                                            ) {
                                                                return false;
                                                            }
                                                            $payedDate = Carbon::parse($installment->payed_date);
                                                            $dueDate = Carbon::parse($installment->date_and_time);

                                                            return $dueDate < $payedDate &&
                                                                (!$filterStartDate || $dueDate >= $filterStartDate) &&
                                                                (!$filterEndDate || $dueDate <= $filterEndDate);
                                                        })
                                                    ) {
                                                        return true;
                                                    }

                                                    // ❌ Not active
                                                    return false;
                                                })
                                                ->count(); // Count matched loans
                                        });
                                    });
                                @endphp

                                <div
                                    class="h-10 py-2 flex flex-row items-center justify-center bg-blue-100 rounded-t-md space-x-2">
                                    <p class="text-sm font-normal text-gray-700">Total Income:</p><!--Income Price-->
                                    <p class="text-md font-semibold text-gray-800">Rs. {{ number_format($totalIncome, 2) }}
                                    </p>
                                    <!--Income Price-->
                                </div>
                                <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="grid grid-cols-2 w-full  ">
                                        <div class="text-xs flex items-center space-x-1">
                                            <p>Center Name:</p>
                                            <p class="text-gray-700">{{ capitalizeFirstLetter($center->center_name) }}</p>
                                        </div>
                                        <div class="text-xs flex items-center space-x-1">
                                            <p class="flex items-center"><img src="{{ asset('assets/icons/Users.svg') }}"
                                                    alt="Dashboard Icon" class="h-3 w-3"></p>
                                            <p class="text-gray-700">{{ capitalizeEachWord($center->manager_name) }}</p>
                                            <!--Center manager-->
                                        </div>
                                    </div>


                                </div>



                                {{--  <td id="totalLoanCount" class="py-2 text-left">
                                                    {{ $totalActiveLoans }}
                                                </td> --}}
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Groups:</p>
                                        <p class="text-gray-700">
                                            {{ str_pad($center->group->count() ?? 00, 2, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Total Loans:</p>
                                        <p class="text-gray-700">{{ str_pad($totalActiveLoans, 2, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Received:</p>
                                        <p class="text-gray-700">Rs. {{ number_format($totalReceived, 2) }}</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>No paid:</p>
                                        <p class="text-gray-700">Rs.
                                            {{ number_format($noPaid, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- Sample for a center -->



                </div>

                <!-------------TABLE------------------------------------------------------------------------------------------------------------>
                <!-- CenloanIssueters Grid Table format hidden for mobile screens -->
                <div class="flex justify-start h-full pt-2">
                    <div id="loanIssueTable"
                        class="w-full h-[calc(100vh-270px)]  hidden lg:block p-0 overflow-y-auto border-t">
                        <!--max-h-[calc(70vh-180px)]-->
                        <div class="min-w-full ">
                            <table class="w-full min-w-max incomeTable">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="py-2 px-2 text-center">#</th>
                                        <th class="py-2 text-left">Center Name</th>
                                        {{--                                         <th class="py-2 text-left">Groups</th>
 --}} <th class="py-2 text-left">Center Manager</th>
                                        {{--                                         <th class="py-2 text-left">Total Loans</th>
 --}} <th class="py-2 text-left">Received</th>
                                        <th class="py-2 text-left">No paid</th>
                                        <th class="py-2 text-left">Total Income</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">

                                    @if ($all_active_centers)
                                        @foreach ($all_active_centers as $center)
                                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                                data-center-id="{{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}"
                                                data-branch-name="{{ capitalizeEachWord($center->branch->branch_name) }}"
                                                data-center-name="{{ capitalizeEachWord($center->center_name) }}"
                                                data-manager="{{ capitalizeEachWord($center->manager_name) }}">

                                                <td class="pl-2 py-2 text-left">
                                                    {{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ capitalizeFirstLetter($center->center_name) }}
                                                </td>
                                                {{-- <td class="py-2 text-left">
                                                    {{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}</td> --}}
                                                <td class="py-2 text-left">{{ capitalizeEachWord($center->manager_name) }}
                                                </td>
                                                @php

                                                    $filterStartDate = request()->startDate
                                                        ? \Carbon\Carbon::parse(request()->startDate)
                                                        : null;
                                                    $filterEndDate = request()->endDate
                                                        ? \Carbon\Carbon::parse(request()->endDate)
                                                        : null;

                                                    $totalReceived = $center->group->sum(function ($group) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        return $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan->sum(function ($loan) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                return $loan->installment->sum(function (
                                                                    $installment,
                                                                ) use ($filterStartDate, $filterEndDate) {
                                                                    // If installment has underpayments
                                                                    if (
                                                                        $installment->underpayment &&
                                                                        $installment->underpayment->isNotEmpty()
                                                                    ) {
                                                                        return $installment->underpayment
                                                                            ->filter(function ($underpayment) use (
                                                                                $filterStartDate,
                                                                                $filterEndDate,
                                                                            ) {
                                                                                $payedDate = Carbon::parse(
                                                                                    $underpayment->payed_date,
                                                                                );
                                                                                return (!$filterStartDate ||
                                                                                    $payedDate >= $filterStartDate) &&
                                                                                    (!$filterEndDate ||
                                                                                        $payedDate <= $filterEndDate);
                                                                            })
                                                                            ->sum('amount'); // Sum filtered underpayments
                                                                    }

                                                                    $payedDate = Carbon::parse(
                                                                        $installment->payed_date,
                                                                    );
                                                                    if (
                                                                        (!$filterStartDate ||
                                                                            $payedDate >= $filterStartDate) &&
                                                                        (!$filterEndDate ||
                                                                            $payedDate <= $filterEndDate)
                                                                    ) {
                                                                        return $installment->amount;
                                                                    }

                                                                    return 0; // No match
                                                                });
                                                            });
                                                        });
                                                    });

                                                    $totalIncome = $center->group->sum(function ($group) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        return $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan->sum(function ($loan) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                return $loan->installment
                                                                    ->filter(function ($installment) use (
                                                                        $filterStartDate,
                                                                        $filterEndDate,
                                                                    ) {
                                                                        $date = Carbon::parse(
                                                                            $installment->date_and_time,
                                                                        );
                                                                        return (!$filterStartDate ||
                                                                            $date >= $filterStartDate) &&
                                                                            (!$filterEndDate ||
                                                                                $date <= $filterEndDate);
                                                                    })
                                                                    ->sum('installment_amount');
                                                            });
                                                        });
                                                    });

                                                    $noPaid = $totalIncome - $totalReceived;

                                                    $groupsInformation = $center->group->map(function ($group) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        // --- Total Active Loans ---
                                                        $totalActiveLoans = $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan
                                                                ->filter(function ($loan) use (
                                                                    $filterStartDate,
                                                                    $filterEndDate,
                                                                ) {
                                                                    foreach ($loan->installment as $installment) {
                                                                        // Check underpayments
                                                                        foreach (
                                                                            $installment->underpayment
                                                                            as $underpayment
                                                                        ) {
                                                                            $underPayedDate = Carbon::parse(
                                                                                $underpayment->payed_date,
                                                                            );
                                                                            if (
                                                                                (!$filterStartDate ||
                                                                                    $underPayedDate >=
                                                                                        $filterStartDate) &&
                                                                                (!$filterEndDate ||
                                                                                    $underPayedDate <= $filterEndDate)
                                                                            ) {
                                                                                return true;
                                                                            }
                                                                        }

                                                                        // Check installment payed_date
                                                                        $installmentPayedDate = Carbon::parse(
                                                                            $installment->payed_date,
                                                                        );
                                                                        if (
                                                                            (!$filterStartDate ||
                                                                                $installmentPayedDate >=
                                                                                    $filterStartDate) &&
                                                                            (!$filterEndDate ||
                                                                                $installmentPayedDate <= $filterEndDate)
                                                                        ) {
                                                                            return true;
                                                                        }
                                                                    }

                                                                    return false;
                                                                })
                                                                ->count();
                                                        });

                                                        // --- Total Received ---
                                                        $totalReceived = $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan->sum(function ($loan) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                return $loan->installment->sum(function (
                                                                    $installment,
                                                                ) use ($filterStartDate, $filterEndDate) {
                                                                    // If installment has underpayments
                                                                    if (
                                                                        $installment->underpayment &&
                                                                        $installment->underpayment->isNotEmpty()
                                                                    ) {
                                                                        return $installment->underpayment
                                                                            ->filter(function ($underpayment) use (
                                                                                $filterStartDate,
                                                                                $filterEndDate,
                                                                            ) {
                                                                                $payedDate = Carbon::parse(
                                                                                    $underpayment->payed_date,
                                                                                );
                                                                                return (!$filterStartDate ||
                                                                                    $payedDate >= $filterStartDate) &&
                                                                                    (!$filterEndDate ||
                                                                                        $payedDate <= $filterEndDate);
                                                                            })
                                                                            ->sum('amount');
                                                                    }

                                                                    $payedDate = Carbon::parse(
                                                                        $installment->payed_date,
                                                                    );
                                                                    if (
                                                                        (!$filterStartDate ||
                                                                            $payedDate >= $filterStartDate) &&
                                                                        (!$filterEndDate ||
                                                                            $payedDate <= $filterEndDate)
                                                                    ) {
                                                                        return $installment->amount;
                                                                    }

                                                                    return 0;
                                                                });
                                                            });
                                                        });

                                                        $totalIncome = $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan->sum(function ($loan) use (
                                                                $filterStartDate,
                                                                $filterEndDate,
                                                            ) {
                                                                return $loan->installment
                                                                    ->filter(function ($installment) use (
                                                                        $filterStartDate,
                                                                        $filterEndDate,
                                                                    ) {
                                                                        $date = Carbon::parse(
                                                                            $installment->date_and_time,
                                                                        );
                                                                        return (!$filterStartDate ||
                                                                            $date >= $filterStartDate) &&
                                                                            (!$filterEndDate ||
                                                                                $date <= $filterEndDate);
                                                                    })
                                                                    ->sum('installment_amount');
                                                            });
                                                        });

                                                        return [
                                                            'group_id' => $group->id,
                                                            'group_name' => capitalizeFirstLetter($group->group_name),
                                                            'received' => number_format($totalReceived, 2),
                                                            'to_pay' => $totalIncome - $totalReceived,
                                                            'total' => $totalIncome,
                                                            'active_loans' => $totalActiveLoans,
                                                        ];
                                                    });

                                                    // Optional: convert to array
                                                    $groupsInformation = $groupsInformation->values()->toArray();
                                                @endphp
                                                {{--  <td id="totalLoanCount" class="py-2 text-left">
                                                    {{ $totalActive }}
                                                </td> --}}

                                                <td id="totalReceivedCount" class="py-2 text-left">Rs.
                                                    {{ number_format($totalReceived, 2) }}</td>
                                                <td id="totalNoPaidCount" class="py-2 text-left">Rs.
                                                    {{ number_format($noPaid, 2) }}</td>
                                                <td class="py-2 text-left">Rs. {{ number_format($totalIncome, 2) }}</td>

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
            const cards = document.querySelectorAll('#loanIssueGrid > div');
            cards.forEach(card => {
                const managerName = card.getAttribute('data-manager')?.toLowerCase() || '';
                const centerName = card.getAttribute('data-center')?.toLowerCase() || '';
                const isMatch = managerName.includes(searchTerm) || centerName.includes(searchTerm);
                card.style.display = isMatch ? 'flex' : 'none';
            });

            // Desktop view (table rows)
            const tableRows = document.querySelectorAll('#loanIssueTable tbody tr');
            tableRows.forEach(row => {
                const managerName = row.getAttribute('data-manager')?.toLowerCase() || '';
                const centerName = row.getAttribute('data-center')?.toLowerCase() || '';
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
        document.getElementById("export").addEventListener("click", function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(14);

            doc.text("Income Report", 14, 15);
            doc.autoTable({
                html: '.incomeTable', // <- you only have tbody, so use full table selector instead
                head: [
                    ['#', 'Center Name', 'Center Manager', 'Received', 'No Paid', 'Total Income',
                        'Action'
                    ]
                ],
                startY: 20,
                theme: 'grid',
                styles: {
                    fontSize: 8
                }
            });
            doc.save("income_report.pdf");

        });
    </script>
@endsection
