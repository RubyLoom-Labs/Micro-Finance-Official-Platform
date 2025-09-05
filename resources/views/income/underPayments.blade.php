@extends('layouts.layout')
@php
    use Carbon\Carbon;
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">
            <!---Cards-->
            <!--<div class="flex w-full lg:h-1/6">

                                                                                                <div id="topCards" class="grid grid-cols-1 lg:flex gap-2 lg:gap-08 w-full p-2 lg:p-0 lg:pb-4">

                                                                                                    <div id="totalLoan" class="bg-gray-100 px-4 py-2 lg:py-1 rounded-lg shadow-sm flex justify-between items-center w-full border" data-branch="balangoda">
                                                                                                        <div class="flex flex-col w-1/2">
                                                                                                            <h2 class="text-sm font-semibold text-gray-600">Total Loans</h2>
                                                                                                            <p class="text-sm text-gray-400">Balangoda</p>
                                                                                                        </div>
                                                                                                        <div class="flex flex-col justify-items-end items-end w-1/2">
                                                                                                            <h1 class="text-xl md:text-lg font-semibold text-right text-gray-600">05</h1>
                                                                                                        </div>

                                                                                                    <div id="totalToReceive" class="bg-gray-100 px-4 py-2 lg:py-1 rounded-lg shadow-sm flex justify-between items-center w-full border" data-branch="ella">
                                                                                                        <div class="flex flex-col w-1/2">
                                                                                                            <h2 class="text-sm font-semibold text-gray-600">To Receive</h2>
                                                                                                            <p class="text-sm text-gray-400">Ella</p>
                                                                                                        </div>
                                                                                                        <div class="flex flex-col justify-items-end items-end w-1/2">
                                                                                                            <h1 class="text-xl md:text-lg font-semibold text-right text-gray-600">180000/=</h1>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>-->

            <!--Start Table and Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between lg:h-full">
                <!--lg:h-5/6-->
                <!-- Top Bar - Search bar and filter option for both mobile and web -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1">
                    <!-- Filter line -->
                    <div id="filterRow"
                        class="flex flex-col lg:flex-row w-full justify-start lg:space-x-2 space-y-2 lg:space-y-0 lg:w-1/2">
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
                    @php
                        $defaultStartDate = \Carbon\Carbon::today()->subDays(7)->format('Y-m-d');
                        $defaultEndDate = \Carbon\Carbon::today()->format('Y-m-d');
                        $filterStartDate = request()->startDate
                            ? \Carbon\Carbon::parse(request()->startDate)
                            : \Carbon\Carbon::parse($defaultStartDate);

                        $filterEndDate = request()->endDate
                            ? \Carbon\Carbon::parse(request()->endDate)
                            : \Carbon\Carbon::parse($defaultEndDate);
                    @endphp
                    <form method="GET" id="filterForm" class="w-full">
                        <div id="dateFilter"
                            class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-1/2">
                            <div
                                class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                                <label for="startDate" class="m-1">Start Date</label>
                                <input type="date" name="startDate" id="startDate"
                                    value="{{ request('startDate', $defaultStartDate) }}"
                                    onchange="document.getElementById('filterForm').submit();">
                            </div>
                            <div
                                class="w-full lg:w-1/2 p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white flex items-center justify-between text-sm lg:text-xs">
                                <label for="endDate" class="m-1">End Date</label>
                                <input type="date" name="endDate" id="endDate"
                                    value="{{ request('endDate', $defaultEndDate) }}"
                                    onchange="document.getElementById('filterForm').submit();">
                            </div>
                        </div>
                    </form>
                </div>
                <!--End Top Bar-->

                <!-------------CARD------------------------------------------------------------------------------------------------------------>
                <!-- Centers Grid card format hidden for lg screens -->
                <div id="centersGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2">
                    <!-- Card for a center -->
                    @foreach ($all_active_centers as $center)
                        @php
                             $filterStartDate = request()->startDate
                                    ? \Carbon\Carbon::parse(request()->startDate)
                                    : null;
                                $filterEndDate = request()->endDate ? \Carbon\Carbon::parse(request()->endDate) : null;
                            $selectedLoans = $center->group
                                    ->flatMap(function ($group) {
                                        return $group->member->flatMap(function ($member) {
                                            return $member->loan;
                                        });
                                    })
                                    ->filter(function ($loan) use ($filterStartDate, $filterEndDate) {
                                        $issueDate = \Carbon\Carbon::parse($loan->issue_date);
                                        $completedDate = $loan->completed_date
                                            ? \Carbon\Carbon::parse($loan->completed_date)
                                            : null;

                                        return // Case 1: issue_date within range
                                            ($filterStartDate &&
                                                $filterEndDate &&
                                                $issueDate->between($filterStartDate, $filterEndDate)) ||
                                                // Case 2: completed_date within range
                                                ($completedDate &&
                                                    $filterStartDate &&
                                                    $filterEndDate &&
                                                    $completedDate->between($filterStartDate, $filterEndDate)) ||
                                                // Case 3: issued before start and still active during the range
                                                ($filterStartDate &&
                                                    $issueDate->lt($filterStartDate) &&
                                                    (!$completedDate || $completedDate->gt($filterStartDate)));
                                    });

                                $totalActiveLoans = $selectedLoans->count();
                            $totalReceived = $center->group->sum(function ($group) use (
                                $filterStartDate,
                                $filterEndDate,
                            ) {
                                return $group->member->sum(function ($member) use ($filterStartDate, $filterEndDate) {
                                    return $member->loan->sum(function ($loan) use ($filterStartDate, $filterEndDate) {
                                        return $loan->installment->sum(function ($installment) use (
                                            $filterStartDate,
                                            $filterEndDate,
                                        ) {
                                            // Only consider underpayments
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
                                                        return (!$filterStartDate || $payedDate >= $filterStartDate) &&
                                                            (!$filterEndDate || $payedDate <= $filterEndDate);
                                                    })
                                                    ->sum('amount');
                                            }

                                            return 0; // No underpayments = no received amount
                                        });
                                    });
                                });
                            });
                        @endphp
                        <div class="rounded-md shadow flex flex-col justify-between w-full bg-blue-200 hover:bg-blue-300"
                            data-center="Malwaragoda" data-branch="balangoda">
                            <div class="h-12 flex flex-col items-center justify-center bg-blue-100 rounded-t-md">
                                <p class="text-sm font-bold text-gray-800">{{ capitalizeEachWord($center->center_name) }}
                                </p>
                                <div class="text-xs flex items-center space-x-1">
                                    <img src="{{ asset('assets/icons/Users.svg') }}" alt="Dashboard Icon"
                                        class="h-3 w-3">
                                    <p class="text-gray-700">{{ capitalizeEachWord($center->manager_name) }}</p>
                                </div>
                            </div>
                            <div class="h-max py-2 px-4 flex flex-col justify-between space-y-1">
                                <div class="grid grid-cols-2 w-full">
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Groups Count:</p>
                                        <p class="text-gray-700">
                                            {{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1">
                                        <p>Total Loans:</p>
                                        <p class="text-gray-700">{{ str_pad($totalActiveLoans, 2, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                                <div class="text-xs flex items-center space-x-1">
                                    <p>To Receive:</p>
                                    <p class="text-gray-700">Rs. {{ number_format($totalReceived, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-------------TABLE------------------------------------------------------------------------------------------------------------>
                <!-- Centers Grid Table format hidden for mobile screens -->
                <div class="flex justify-start h-full pt-2">
                    <div id="centersGridTable"
                        class="w-full max-h-[calc(70vh-180px)] hidden lg:block p-0 overflow-y-auto border-t">
                        <div class="min-w-full h-full">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="pl-2 text-left">
                                            <input type="checkbox" id="select-all"
                                                class="form-checkbox h-4 w-4 text-blue-400 m-1">
                                        </th>
                                        <th class="py-2 px-2 text-left">#</th>
                                        <th class="py-2 text-left">Center Name</th>
                                        <th class="py-2 text-left">Center Manager</th>
                                        <th class="py-2 text-left">Groups</th>
                                        <th class="py-2 text-left">Total Loans</th>
                                        <th class="py-2 text-left">To Receive</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
                                    @php
                                        $groupsInformation = [];
                                    @endphp
                                    @if ($all_active_centers)
                                        @foreach ($all_active_centers as $center)
                                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                                data-center-id="{{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}"
                                                data-branch-name="{{ capitalizeEachWord($center->branch->branch_name) }}"
                                                data-center-name="{{ capitalizeEachWord($center->center_name) }}"
                                                data-manager="{{ capitalizeEachWord($center->manager_name) }}">
                                                <td class="pl-2 text-left">
                                                    <input type="checkbox" name="selected_ids[]" value="1"
                                                        class="form-checkbox h-4 w-4 text-blue-600 m-1">
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ capitalizeFirstLetter($center->center_name) }}
                                                </td>
                                                <td class="py-2 text-left">{{ capitalizeEachWord($center->manager_name) }}
                                                </td>
                                                <td class="py-2 text-left">
                                                    {{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}</td>
                                                @php

                                                    $filterStartDate = request()->startDate
                                                        ? \Carbon\Carbon::parse(request()->startDate)
                                                        : null;
                                                    $filterEndDate = request()->endDate
                                                        ? \Carbon\Carbon::parse(request()->endDate)
                                                        : null;
                                                    $totalActiveLoans = $center->group->sum(function ($group) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
                                                        return $group->member->sum(function ($member) use (
                                                            $filterStartDate,
                                                            $filterEndDate,
                                                        ) {
                                                            return $member->loan
                                                                ->filter(function ($loan) use (
                                                                    $filterStartDate,
                                                                    $filterEndDate,
                                                                ) {
                                                                    // ✅ 1. If any installment is unpaid (payed_date is null)
                                                                    if (
                                                                        $loan->installment->contains(function (
                                                                            $installment,
                                                                        ) {
                                                                            return $installment->status === 'UNPAYED';
                                                                        })
                                                                    ) {
                                                                        return true;
                                                                    }

                                                                    // ✅ 2. If any installment payed_date is within selected range
                                                                    if (
                                                                        $loan->installment->contains(function (
                                                                            $installment,
                                                                        ) use ($filterStartDate, $filterEndDate) {
                                                                            if (!$installment->payed_date) {
                                                                                return false;
                                                                            }
                                                                            $payedDate = Carbon::parse(
                                                                                $installment->payed_date,
                                                                            );
                                                                            return (!$filterStartDate ||
                                                                                $payedDate >= $filterStartDate) &&
                                                                                (!$filterEndDate ||
                                                                                    $payedDate <= $filterEndDate);
                                                                        })
                                                                    ) {
                                                                        return true;
                                                                    }

                                                                    // ✅ 3. If any underpayment payed_date is within selected range
                                                                    foreach ($loan->installment as $installment) {
                                                                        if (
                                                                            $installment->underpayment->contains(
                                                                                function ($underpayment) use (
                                                                                    $filterStartDate,
                                                                                    $filterEndDate,
                                                                                ) {
                                                                                    if (!$underpayment->payed_date) {
                                                                                        return false;
                                                                                    }
                                                                                    $underPayedDate = Carbon::parse(
                                                                                        $underpayment->payed_date,
                                                                                    );
                                                                                    return (!$filterStartDate ||
                                                                                        $underPayedDate >=
                                                                                            $filterStartDate) &&
                                                                                        (!$filterEndDate ||
                                                                                            $underPayedDate <=
                                                                                                $filterEndDate);
                                                                                },
                                                                            )
                                                                        ) {
                                                                            return true;
                                                                        }
                                                                    }

                                                                    // ✅ 4. If any installment was paid late, and due date is within range
                                                                    if (
                                                                        $loan->installment->contains(function (
                                                                            $installment,
                                                                        ) use ($filterStartDate, $filterEndDate) {
                                                                            if (
                                                                                !$installment->payed_date ||
                                                                                !$installment->date_and_time
                                                                            ) {
                                                                                return false;
                                                                            }
                                                                            $payedDate = Carbon::parse(
                                                                                $installment->payed_date,
                                                                            );
                                                                            $dueDate = Carbon::parse(
                                                                                $installment->date_and_time,
                                                                            );

                                                                            return $dueDate < $payedDate &&
                                                                                (!$filterStartDate ||
                                                                                    $dueDate >= $filterStartDate) &&
                                                                                (!$filterEndDate ||
                                                                                    $dueDate <= $filterEndDate);
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
                                                                    // Only consider underpayments
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

                                                                    return 0; // No underpayments = no received amount
                                                                });
                                                            });
                                                        });
                                                    });

                                                    $groupsInformation = $center->group->map(function ($group) use (
                                                        $filterStartDate,
                                                        $filterEndDate,
                                                    ) {
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
                                                                    // Only consider underpayments that fall within the date range
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

                                                                    // If no underpayment, return 0
                                                                    return 0;
                                                                });
                                                            });
                                                        });

                                                        return [
                                                            'group_id' => $group->id,
                                                            'group_name' => capitalizeFirstLetter($group->group_name),
                                                            'received' => number_format($totalReceived, 2),
                                                        ];
                                                    });

                                                    // Optional: convert to array
                                                    $groupsInformation = $groupsInformation->values()->toArray();
                                                @endphp
                                                <td id="totalLoanCount" class="py-2 text-left">{{ $totalActiveLoans }}
                                                </td>
                                                <td id="totalReceivedCount" class="py-2 text-left">Rs.
                                                    {{ number_format($totalReceived, 2) }}</td>
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

        <!-- Second Column: Side view of table view -->
        <div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col transition-all duration-300 overflow-y-auto">
            <div id="RowDetailsContent" class="border-b p-4 h-2/8">
                <h1 id="branchNameSlideBar" class="text-md font-medium text-gray-800 mb-4"></h1>
                <div class="grid grid-cols-2 gap-y-2">
                    <div>
                        <p for="Cname" class="text-xs text-gray-400">Center Name</p>
                        <p id="CnameSlideBar" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="Cmanager" class="text-xs text-gray-400">Center Manager</p>
                        <p id="CmanagerSlideBar" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="toReceive" class="text-xs text-gray-400">To Receive</p>
                        <p id="toReceiveSlideBar" class="text-sm mt-0">-</p>
                    </div>
                </div>
            </div>
            <!--Group List-->
            <div id="groupListContainer" class="p-4 overflow-auto h-5/8 max-h-[calc(100vh-250px)] space-y-2">
                <h1 class="text-md font-medium text-gray-800 mb-4">Group List</h1>

            </div>


        </div>
    </div>

    <script>
        const groupsInformation = @json($groupsInformation);

        //TABLE------------------------------------------------------------------------
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

        // DROPDOWN FOR FILTER-----------------------------------------------------------
        // Custom dropdown Branch
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

        // Custom dropdown Centers
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

        // Close dropdown when clicking outside
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
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            // Filter cards (mobile view)
            const cards = document.querySelectorAll('#centersGrid > div');
            cards.forEach(card => {
                const branch = card.getAttribute('data-branch').toLowerCase();
                const center = card.getAttribute('data-center').toLowerCase();
                const date = card.getAttribute('data-date') || '2025-01-01'; // Default date if not present

                let showCard = true;
                if (branchFilter && branch !== branchFilter) showCard = false;
                if (centerFilter && center !== centerFilter) showCard = false;
                if (startDate && new Date(date) < new Date(startDate)) showCard = false;
                if (endDate && new Date(date) > new Date(endDate)) showCard = false;

                card.style.display = showCard ? 'block' : 'none';
            });

            // Filter table rows (desktop view)
            const rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                const branch = row.getAttribute('data-branch-name').toLowerCase();
                const center = row.getAttribute('data-center-name').toLowerCase();
                const date = row.getAttribute('data-date');

                let showRow = true;
                if (branchFilter && branch !== branchFilter) showRow = false;
                if (centerFilter && center !== centerFilter) showRow = false;
                if (startDate && new Date(date) < new Date(startDate)) showRow = false;
                if (endDate && new Date(date) > new Date(endDate)) showRow = false;

                row.style.display = showRow ? 'table-row' : 'none';
            });
        }

        //SECOND COLUMN------------------------------------------------------------
        // Helper function to hide all second columns
        function hideAllSecondColumns() {
            const columns = ['RowDetails'];
            columns.forEach(col => document.getElementById(col).classList.add('hidden'));

            document.getElementById('firstColumn').classList.remove('lg:w-8/12');
            document.getElementById('firstColumn').classList.add('lg:w-full');
        }

        function renderGroupList(groups) {
            const container = document.getElementById('groupListContainer');

            // Clear previous entries
            container.innerHTML = `
        <h1 class="text-md font-medium text-gray-800 mb-4">Group List</h1>
    `;

            // Loop through each group and add card
            groups.forEach(group => {
                const card = document.createElement('div');
                card.className = "border bg-sky-50 flex justify-between items-center p-2 px-4 rounded-lg";

                card.innerHTML = `
           <div>
                        <p class="text-xs font-bold text-gray-600">${group.group_name}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">To Receive</p>
                        <p class="text-xs font-medium text-gray-600">Rs. ${group.received}</p>
                    </div>
        `;

                container.appendChild(card);
            });
        }
        // Row Summary Details
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const row = button.closest('tr');
                const RowDetails = document.getElementById('RowDetails');
                const firstColumn = document.getElementById('firstColumn');

                RowDetails.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                RowDetails.classList.add('lg:flex');

                document.getElementById('dateFilter').classList.add('lg:hidden');
                document.getElementById('filterRow').classList.remove('lg:w-1/2');

                const branchName = row.getAttribute('data-branch-name');
                const centerName = row.getAttribute('data-center-name');
                const manager = row.getAttribute('data-manager');
                const loanCount = document.getElementById('totalLoanCount').textContent;
                const received = document.getElementById('totalReceivedCount').textContent;
                document.getElementById('branchNameSlideBar').textContent = branchName;
                document.getElementById('CnameSlideBar').textContent = centerName;
                document.getElementById('CmanagerSlideBar').textContent = manager;
                document.getElementById('toReceiveSlideBar').textContent = received;
                document.querySelectorAll('.view-details').forEach(button => {



                    renderGroupList(groupsInformation);

                });
            });
        });
    </script>
@endsection
