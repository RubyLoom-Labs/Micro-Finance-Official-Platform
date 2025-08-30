@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <!--NOT Completed -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="mainContent" class="flex lg:h-full">
        <!-- First Column -->
        <!--Mobile Cards and table View-->
        <div id="firstColumn"
            class="w-full h-full p-2 lg:border-r lg:p-4 lg:pt-2 transition-all duration-300 lg:relative space-y-2 px-4">

            <!-- Add New Loan Modal -->
            <div id="addLoanModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items- justify-center lg:absolute z-50  p-4 pb-0"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-2xl rounded-lg h-max">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4 font-">Add new Loan
                        ({{ capitalizeEachWord($member_details->full_name) }})</h2>
                    <form action="{{ route('loans.createLoan', ['memberId' => $member_details->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white rounded-b-lg p-4 space-y-2 pb-0">
                            <div class="grid grid-cols-1 gap-1">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1 ml-1">Loan Amount*</label>
                                    <input type="number" id="newLoanAmount" name="loan_amount"
                                        class="no-spinner w-full p-2 border rounded-lg text-sm" required step="0.01">
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Interest Rate (%)*</label>
                                        <input type="number" id="newLoanInterestRate" name="interest_rate"
                                            class="no-spinner w-full p-2 border rounded-lg text-sm" step="0.01" disabled
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Interest</label>
                                        <input type="number" id="newLoanInterestAmount" name="interest"
                                            class="no-spinner w-full p-2 border rounded-lg text-sm" step="0.01" disabled
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Terms*</label>
                                        <input type="number" id="newLoanTerm" name="terms"
                                            class="no-spinner w-full p-2 border rounded-lg text-sm" required disabled>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Installment*</label>
                                        <input type="number" id="newLoanInstallment" name="installment_amount"
                                            class="w-full p-2 border rounded-lg text-sm bg-gray-100 text-gray-500 cursor-not-allowed pointer-events-none no-spinner"
                                            step="0.01" required readonly>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Issue Date*</label>
                                        <input type="date" id="newLoanIssueDate" name="issue_date"
                                            class="w-full p-2 border rounded-lg text-sm" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Document Charges*</label>
                                        <input type="number" name="document_charges"
                                            class="no-spinner w-full p-2 border rounded-lg text-sm" step="0.01">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Image*</label>
                                        <input type="file" name="image_1" class="w-full p-2 border rounded-lg text-sm"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1 ml-1">Image</label>
                                        <input type="file" class="w-full p-2 border rounded-lg text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs text-gray-500 mb-1 ml-1">Guarantor*</label>
                                    <input type="text" name="guarantor_name" class="w-full p-2 border rounded-lg text-sm"
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


            <div class="flex flex-col h-full lg:h-auto space-y-2 pb-4">
                <div class="flex w-full justify-between items-center">
                    <div class="w-24 text-sm lg:text-xs">
                        <button id="" value="" onclick="window.history.back();"
                            class="w-full bg-gray-100 text-gray-700 p-1.5 rounded-lg hover:bg-gray-300 focus:outline-none flex items-center pl-4">
                            <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Pencil" class="h-3 w-3 m-1"> Back
                        </button>
                    </div>
                    <div class="w-40 text-sm lg:text-xs">
                        <button id="getGroupSummary" value=""
                            class="w-full bg-blue-600 text-white p-1.5 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center">
                            <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil"
                                class="h-3 w-3 m-1"> Get Summary
                        </button>
                    </div>
                </div>


                <!-- Customer Details Card -->
                <form action="{{ route('members.updateMember', ['memberId' => $member_details->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col lg:flex-row border rounded-lg px-4 p-4 h-full">

                        <!-- Customer Details -->
                        <div class="w-full lg:w-2/3 h-full">
                            <h1 class="text-md font-medium text-gray-800 mb-2">Customer Details</h1>
                            <div class="grid-cols-1 grid lg:grid-cols-3 lg:gap-y-1 lg:gap-x-4 gap-y-4">

                                <!-- Name -->
                                <div>
                                    <p class="text-xs text-gray-400">Name</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->full_name) }}</span>
                                        <input type="text" name="full_name"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ old('full_name', capitalizeEachWord($member_details->full_name)) }}"
                                            required>
                                        <span id="member_id_span" class="hidden">{{ $member_details->id }}</span>
                                        @error('full_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </p>
                                </div>

                                <!-- NIC -->
                                <div>
                                    <p class="text-xs text-gray-400">NIC</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->nic_number) }}</span>
                                        <input type="text" name="nic_number"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ old('nic_number', capitalizeEachWord($member_details->nic_number)) }}"
                                            required>
                                        @error('nic_number')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </p>
                                </div>

                                <!-- Attach (Images) -->
                                <div>
                                    <p class="text-xs text-gray-400">Attach (Images)</p>
                                    <p class="text-sm">
                                        <span class="view-mode-customer"></span>
                                        <input type="file" name="attachments[]"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" multiple
                                            accept="image/*">
                                    </p>
                                </div>

                                <!-- Mobile Number 01 -->
                                <div>
                                    <p class="text-xs text-gray-400">Mobile Number 01</p>
                                    <p class="text-sm">
                                        <span class="view-mode-customer">{{ $member_details->mobile_number_1 }}</span>
                                        <input type="tel" name="mobile_number_1"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ old('mobile_number_1', $member_details->mobile_number_1) }}"
                                            required>
                                        @error('mobile_number_1')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </p>
                                </div>

                                <!-- Mobile Number 02 -->
                                <div>
                                    <p class="text-xs text-gray-400">Mobile Number 02</p>
                                    <p class="text-sm">
                                        <span class="view-mode-customer">{{ $member_details->mobile_number_2 }}</span>
                                        <input type="tel" name="mobile_number_2"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ old('mobile_number_2', $member_details->mobile_number_2) }}"
                                            required>
                                        @error('mobile_number_2')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </p>
                                </div>

                                <!-- Address -->
                                <div>
                                    <p class="text-xs text-gray-400">Address</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->address) }}</span>
                                        <input type="text" name="address"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ old('address', capitalizeEachWord($member_details->address)) }}"
                                            required>
                                        @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    </p>
                                </div>

                                <!-- Branch (Read-only) -->
                                <div>
                                    <p class="text-xs text-gray-400">Branch</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->group->center->branch->branch_name) }}</span>
                                        <input type="text"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ capitalizeEachWord($member_details->group->center->branch->branch_name) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Center (Read-only) -->
                                <div>
                                    <p class="text-xs text-gray-400">Center</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->group->center->center_name) }}</span>
                                        <input type="text"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ capitalizeEachWord($member_details->group->center->center_name) }}"
                                            disabled>
                                    </p>
                                </div>

                                <!-- Group (Read-only) -->
                                <div>
                                    <p class="text-xs text-gray-400">Group</p>
                                    <p class="text-sm">
                                        <span
                                            class="view-mode-customer">{{ capitalizeEachWord($member_details->group->group_name) }}</span>
                                        <input type="text"
                                            class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full"
                                            value="{{ capitalizeEachWord($member_details->group->group_name) }}" disabled>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex w-full lg:w-1/3 justify-between lg:justify-end items-end space-x-2 pt-4">
                            <div class="flex flex-row lg:space-x-2 bg-white lg:text-xs w-full justify-end">
                                <!-- Edit -->
                                <button id="editCustomerBtn" type="button"
                                    class="bg-blue-600 text-white p-1 lg:p-1 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 lg:w-28 w-full lg:mr-0">
                                    <img src="{{ asset('assets/icons/PencilSimpleWhite.svg') }}" alt="Edit"
                                        class="h-3 w-3 mr-2">
                                    <span class="text-sm">Edit</span>
                                </button>
                                <!-- Save -->
                                <button id="saveCustomerBtn" type="submit"
                                    class="bg-green-600 text-white p-1 lg:p-1 rounded-lg hover:bg-green-700 hidden items-center justify-center px-6 lg:w-28 w-full lg:mr-0">
                                    <img src="{{ asset('assets/icons/VectorWhite.svg') }}" alt="Save"
                                        class="h-3 w-3 mr-2">
                                    <span>Save</span>
                                </button>
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
                <div id="deleteModal"
                    class="fixed inset-0  items-center justify-center bg-black bg-opacity-40 hidden z-50 h-full">
                    <div class="bg-white p-6 rounded-lg shadow-md text-center w-1/2 lg:w-1/3 h-30">
                        <p class="text-md font-semibold mb-4">Are you sure you want to delete this member?</p>
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

                <!-- Current Loan Card -->
                <div class="flex flex-col lg:flex-row h-full lg:space-x-2 space-y-2 lg:space-y-0">
                    <!-- Current Loan Details -->
                    <div class="flex  lg:w-2/3 ">
                        <div class="w-full h-full border rounded-lg    py-2 px-4">
                            <div class="flex items-baseline space-x-2">
                                <h1 class="text-md font-medium text-gray-800 mb-2">Current Loan</h1>
                                @if ($member_details->loan->contains('status', 'UNCOMPLETED'))
                                    <span class="bg-green-400 p-0.5 px-2 rounded text-black text-xs">Active</span>
                                @else
                                    <span class="bg-red-400 p-0.5 px-2 rounded text-black text-xs">Inctive</span>
                                @endif
                            </div>
                            <div class="grid-cols-1 grid lg:grid-cols-3 lg:gap-y-1 lg:gap-x-4 gap-y-4">
                                <!-- Loan Amount -->
                                <div>
                                    <p class="text-xs text-gray-400">Loan Amount</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            Rs.
                                            {{ number_format(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->loan_amount, 2) ?? '__' }}</span>
                                        <input type="number"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="400000">
                                    </p>
                                </div>
                                <!-- Interest -->
                                <div>
                                    <p class="text-xs text-gray-400">Interest</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            Rs.
                                            {{ number_format(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->interest, 2) ?? '__' }}
                                        </span> <input type="text"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="5%">
                                    </p>
                                </div>
                                <!-- Issue Date -->
                                <div>
                                    <p class="text-xs text-gray-400">Issue Date</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            {{ optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->issue_date ?? '__' }}
                                        </span> <input type="date"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full"
                                            value="2025-01-01">
                                    </p>
                                </div>
                                <!-- Installment -->
                                <div>
                                    <p class="text-xs text-gray-400">Installment</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            Rs.
                                            {{ number_format(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment_price, 2) ?? '__' }}
                                        </span> <input type="number"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="10000">
                                    </p>
                                </div>
                                <!-- Terms -->
                                <div>
                                    <p class="text-xs text-gray-400">Terms</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            {{ optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->terms ?? '__' }}
                                        </span> <input type="text"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full"
                                            value="12 Months">
                                    </p>
                                </div>
                                <!-- Document Charges -->
                                <div>
                                    <p class="text-xs text-gray-400">Document Charges</p>
                                    <p class="text-sm">
                                        <span class="view-mode-loan">
                                            Rs.
                                            {{ number_format(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->document_charges, 2) ?? '__' }}
                                        </span> <input type="number"
                                            class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="5000">
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!--Balnce Summury--> <!--Need to hide if is memeber is didnt have active loan-->
                    <div class="flex flex-col w-full lg:w-1/3 justify-between items-center p-2  rounded-lg border ">
                        <div class="w-full h-full space-y-2">
                            <div
                                class="w-full text-sm lg:text-xs flex   space-x-2 lg:h-1/2  h-8 justify-center items-center border-black rounded-md  bg-gray-200">
                                <p class="text-sm text-gray-800">Total Paid</p>
                                <p class="text-sm text-gray-600">Rs.
                                    {{ number_format(collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->sum('amount'), 2) }}
                                </p>
                            </div>
                            @php
                                $total_paid_amount = collect(
                                    optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment,
                                )->sum('amount');
                                $total_balance =
                                    optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->loan_amount +
                                    optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->interest -
                                    $total_paid_amount;
                            @endphp
                            <div
                                class="w-full text-sm lg:text-xs flex space-x-2 lg:h-1/2 h-8 justify-center items-center  border-black rounded-md bg-gray-200">
                                <p class="text-sm text-gray-800">Balance</p>
                                <p class="text-sm text-gray-600">Rs. {{ number_format($total_balance, 2) }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full justify-between">
                            <!-- Action Buttons -->
                            <div id="inactiveActionbuttons"
                                class="flex  w-full lg:w-full  justify-between lg:justify-end items-end pt-4 pb-0">
                                <div
                                    class="flex flex-col lg:flex-row  lg:space-col lg:space-x-2 space-y-2 lg:space-y-0 bg-white lg:text-xs w-full justify-end">
                                    <!-- Edit -->
                                    @php
                                        $isDisabled = $member_details->loan->contains('status', 'UNCOMPLETED');
                                    @endphp
                                    <button id="addLoanButton" @if ($isDisabled) disabled @endif
                                        class="p-1 lg:p-1 px-6 lg:w-1/2 w-full lg:mr-0 rounded-lg flex items-center justify-center h-8
                                                             text-white {{ $isDisabled ? 'bg-blue-400 opacity-50 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}">
                                        <span>+</span>
                                        <span class="ml-2 text-xs">Add Loan</span>
                                    </button>
                                    <!-- Edit -->
                                    <button id="ViewPreviousLoan"
                                        class="bg-blue-600 text-white p-1 lg:p-1 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 lg:w-1/2 w-full lg:mr-0 h-8">
                                        <span></span>
                                        <span class="ml-2 text-xs">View previous Loan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Existing Members Grid and Table -->
                <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-max">
                    <!-- Top Bar -->
                    <div
                        class="flex flex-col w-full space-y-2 py-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1 lg:pb-2">
                        <div class="flex items-center lg:space-x-2 lg:w-6/12 w-full">
                            <!-- Filter Button -->
                            <div class="hidden lg:flex text-sm">
                                <button value="" class="bg-white p-2 rounded-lg focus:outline-none border w-8">
                                    <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon"
                                        class="h-4 w-4">
                                </button>
                            </div>
                            <!-- Search Bar -->
                            <div class="w-full text-sm lg:text-xs lg:w-full pr-4">
                                <input type="text" id="searchMember" placeholder="Search ..."
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                            </div>
                        </div>
                        <!-- Summury -->
                        <div class="w-full text-sm lg:text-xs lg:w-6/12 flex justify-between items-center space-x-4">
                            <div class="border bg-white rounded-lg  p-2 px-2 w-1/3 text-center ">Complete - <span>
                                    {{ str_pad(collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->where('status', 'PAYED')->count(),2,'0',STR_PAD_LEFT) }}
                                </span></div>

                            <div class="border bg-white rounded-lg  p-2 px-2 w-1/3 text-center">Under Paid - <span>
                                    {{ str_pad(collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->where('status', 'UNDERPAYED')->count(),2,'0',STR_PAD_LEFT) }}
                                </span></div>
                            <div class="border bg-white rounded-lg  p-2 px-2 w-1/3 text-center">No Paid - <span>
                                    {{ str_pad(collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->where('status', 'NOPAYED')->count(),2,'0',STR_PAD_LEFT) }}
                                </span></div>
                        </div>
                    </div>
                    <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Loan
                        #{{ optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->id }} - Installment
                        {{ collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->where('status', 'PAYED')->count() }}/{{ collect(optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment)->count() }}
                    </p>
                    @if (!$member_details->loan->contains('status', 'UNCOMPLETED'))
                        <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Loan Not Available</p>
                    @endif

                    <!-- Installment Grid card format hidden for lg screens -->
                    <div id="InstallmentGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4   ">
                        @if ($member_details->loan->firstWhere('status', 'UNCOMPLETED'))
                            <!--Card-->
                            @foreach (optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment->sortBy('installment_number') as $installement)
                                <div class="rounded-lg shadow-sm flex flex-col w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4"
                                    data-member-name="saman">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm text-gray-600">Installment #
                                                <span>{{ $installement->installment_number }}</span>
                                            </p>
                                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle"
                                                    class="h-3 w-3 transform transition-transform">
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-600">{{ $installement->date_and_time }}</p>
                                    </div>
                                    <!-- Sub Info -->
                                    <div class="mt-0 flex justify-between items-center text-xs">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Payed Amount</p>
                                            <p class="font-medium text-gray-600">Rs.
                                                {{ number_format($installement->amount, 2) }}({{ number_format($installement->installment_amount, 2) }})
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Status</p>
                                            @if ($installement->status == 'PAYED')
                                                <span
                                                    class="bg-green-400 p-0.5 px-2 rounded text-white text-xs">PAID</span>
                                            @elseif ($installement->status == 'UNDERPAYED')
                                                <span class="bg-yellow-400 p-0.5 px-2 rounded text-white text-xs">UNDER
                                                    PAID</span>
                                            @elseif ($installement->status == 'NOPAYED')
                                                <span class="bg-red-400 p-0.5 px-2 rounded text-white text-xs">NO
                                                    PAID</span>
                                            @else
                                                <span
                                                    class="bg-blue-400 p-0.5 px-2 rounded text-white text-xs">ONGOING</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Collapsible Section -->
                                    <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                                        <form
                                            action="{{ route('installments.updateInstallment', ['loanId' => $member_details->loan->firstWhere('status', 'UNCOMPLETED')->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @if ($errors->any())
                                                <div
                                                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
                                                    <ul class="text-sm">
                                                        @foreach ($errors->all() as $error)
                                                            <li>• {{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="grid gap-3">

                                                <!-- Amount -->
                                                <div class="flex justify-between items-center">
                                                    <label for="amount" class="block text-xs font-medium">Amount
                                                        *</label>
                                                    @if ($installement->status != 'UNPAYED')
                                                        <span>Rs. {{ number_format($installement->amount, 2) }}</span>
                                                    @else
                                                        <input type="text" name="amount" id="amount"
                                                            class="w-2/3 mt-1 px-2 py-0.5 border rounded-md" required>
                                                    @endif
                                                </div>

                                                <!-- Date and File -->
                                                <div class="flex justify-between items-center">
                                                    <label for="bill" class="block text-xs font-medium w-max">Attach
                                                        Bill</label>
                                                    @if ($installement->status != 'UNPAYED')
                                                        {{-- <button>View</button> --}}
                                                    @else
                                                        <input type="file" name="bill" id="bill"
                                                            class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                                    @endif

                                                </div>
                                                <!-- Buttons -->
                                                <div class="flex justify-end space-x-2 mt-2 text-sm">
                                                    <button type="button"
                                                        class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- Grid Table format hidden for mobile screens -->
                <div id="InstallmentsGridTable" class="w-full h-[calc(100vh-510px)] hidden lg:block p-0 overflow-y-auto">
                    <div class="min-w-full">
                        <table class="w-full min-w-max">
                            <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                <tr class="uppercase w-full">
                                    <th class="py-2 pl-4 text-left">Installment</th>
                                    <th class="py-2 text-left">Amount</th>
                                    <th class="py-2 text-left">Date & time</th>
                                    <th class="py-2 text-left">Status</th>
                                    <th class="py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 text-xs font-light bg-white">
                                <!-- Row -->
                                @if ($member_details->loan->firstWhere('status', 'UNCOMPLETED'))
                                    @foreach (optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment->sortBy('installment_number') as $installement)
                                        <tr
                                            class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details">
                                            <td class="py-2 pl-4 text-left">Installment #
                                                {{ $installement->installment_number }}
                                            </td>
                                            <td class="py-2 text-left">Rs. {{ $installement->amount }}</td>
                                            <td class="py-2 text-left">{{ $installement->date_and_time }}</td>
                                            <td class="py-2 text-left">
                                                @if ($installement->status == 'PAYED')
                                                    <span
                                                        class="bg-green-400 p-0.5 px-2 rounded text-white text-xs">PAID</span>
                                                @elseif ($installement->status == 'UNDERPAYED')
                                                    <span class="bg-yellow-400 p-0.5 px-2 rounded text-white text-xs">UNDER
                                                        PAID</span>
                                                @elseif ($installement->status == 'NOPAYED')
                                                    <span class="bg-red-400 p-0.5 px-2 rounded text-white text-xs">NO
                                                        PAID</span>
                                                @else
                                                    <span
                                                        class="bg-blue-400 p-0.5 px-2 rounded text-white text-xs">ONGOING</span>
                                                @endif
                                            </td>
                                            <td class="py-2 text-center flex justify-center items-center gap-1">
                                                <a href="#" class="border rounded hover:bg-green-500">
                                                    <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                        class="h-3 w-3 m-1">
                                                </a>
                                                <a href="#" class="border rounded hover:bg-lime-500">
                                                    <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil"
                                                        class="h-3 w-3 m-1">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <!-- Repeat rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Column: Row Details -->
    <!-- Second Column: Row Details -->
    <div id="RowDetails" class="hidden h-[100vh] lg:w-4/12 flex-col justify-start transition-all duration-300">
        <div id="RowDetailsContent" class="p-4">
            <div class="flex w-full justify-between">
                <div class="w-2/3">
                    <div class="flex items-baseline space-x-2">
                        <h1 id="memberNameShow" class="text-md font-medium text-gray-800">
                            {{ capitalizeEachWord($member_details->full_name) }}
                        </h1>
                        <!--Member Status-->
                        @if ($member_details->status === 'ACTIVE')
                            <p id="activeMemberStatus" class="items-center">
                                <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                            </p>
                        @elseif ($member_details->status === 'INACTIVE')
                            <p id="inactiveMemberStatus" class="items-center">
                                <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                            </p>
                        @endif
                    </div>
                    <h1 id="memberName" class="text-xs text-gray-600 mb-2"><span id="branchNameShow">
                            {{ capitalizeEachWord($member_details->group->center->branch->branch_name) }}</span> > <span
                            id="centerNameShow">{{ capitalizeEachWord($member_details->group->center->center_name) }}</span>
                        >
                        <span id="groupNameShow">{{ capitalizeEachWord($member_details->group->group_name) }}</span>
                    </h1>
                </div>
                <div class="flex justify-end w-1/3 h-4">
                    <button id="closeButton" value="" class="p-1 rounded ">
                        <img src="{{ asset('assets/icons/X.svg') }}" alt="Close" class="h-4 w-4">
                    </button>
                </div>
            </div>
        </div>

        <!-- Previous Loan Details -->
        <div class="flex items-center justify-start pl-4 py-2 border-b border-t bg-gray-100">
            <h1 class="text-sm font-medium text-gray-800">Previous Loan Details</h1>
            <button id="togglePreviousLoan" class="toggle-details-btn p-1 ml-4 rounded hover:bg-sky-200">
                <img src="{{ asset('assets/icons/CaretDownNew.svg') }}" alt="Toggle"
                    class="h-3 w-3 transform transition-transform">
            </button>
        </div>
        <div id="previousLoanDetails"
            class="activeMemberDetails previousLoan overflow-y-auto h-[calc(100vh-230px)] bg-slate-50 hidden">
            <div class="pt-0 w-full">
                <div class="w-full text-sm lg:text-xs px-4 py-2 m-0 pt-0">
                    <div class="grid grid-cols-1 gap-y-2">
                        @foreach ($member_details->loan as $loan)
                            @if ($loan->status === 'COMPLETED')
                                <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm text-gray-600">Loan # <span>{{ $loan->id }}</span></p>
                                        </div>
                                        <p class="text-xs text-gray-600"></p>
                                    </div>
                                    <div class="mt-0 flex justify-between items-center text-xs">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Amount</p>
                                            <p class="font-medium text-gray-600">Rs.
                                                {{ number_format($loan->loan_amount, 2) }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Complete Date</p>
                                            <p class="font-medium text-gray-600">{{ $loan->completed_date }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-0 flex justify-between items-center text-xs">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-[#ff0000]" style="color: rgb(227, 64, 64)">Under Payment</p>
                                            <p class="font-medium "style="color: red;">
                                                {{ str_pad(collect(optional($loan->installment)->where('status', 'UNDERPAYED'))->count(), 2, '0', STR_PAD_LEFT) }}

                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400" style="color: rgb(227, 64, 64)">No Paid</p>
                                            <p class="font-medium"style="color: red;">
                                                {{ str_pad(collect(optional($loan->installment)->where('status', 'NOPAYED'))->count(), 2, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @php
            function ordinal($number)
            {
                $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
                if ($number % 100 >= 11 && $number % 100 <= 13) {
                    return $number . 'th';
                }
                return $number . $ends[$number % 10];
            }
            $lastPayedIndex = -1;
            if ($member_details->loan->firstWhere('status', 'UNCOMPLETED')) {
                foreach (
                    optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment->sortBy(
                        'installment_number',
                    )
                    as $installment
                ) {
                    if ($installment->status === 'PAYED') {
                        $lastPayedIndex = $installement->installment_number;
                    }
                }
            }
        @endphp
        <!-- Current Loan Details -->
        <div class="flex items-center justify-start pl-4 py-2 border-b border-t bg-gray-100">
            <h1 class="text-sm font-medium text-gray-800">Current Loan Details</h1>
            <button id="toggleCurrentLoan" class="toggle-details-btn p-1 ml-4 rounded hover:bg-sky-200">
                <img src="{{ asset('assets/icons/CaretDownNew.svg') }}" alt="Toggle"
                    class="h-3 w-3 transform transition-transform rotate-180">
            </button>
        </div>
        <div id="currentLoanDetails"
            class="activeMemberDetails currentLoan overflow-y-auto h-[calc(100vh-210px)] pb-4 bg-slate-50">
            <div class=" border-b w-full pt-4">
                <div class="w-full text-sm lg:text-xs p-4 m-0 pt-0">
                    <div class="grid grid-cols-1 gap-y-2">
                        @if ($member_details->loan->firstWhere('status', 'UNCOMPLETED'))
                            @foreach (optional($member_details->loan->firstWhere('status', 'UNCOMPLETED'))->installment->sortBy('installment_number') as $installement)
                                @php
                                    // Enabled only the next one after last PAYED
                                    $isEnabled = $installement->installment_number === $lastPayedIndex + 1;
                                    $isCompleted = $installement->installment_number <= $lastPayedIndex;
                                @endphp

                                <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm ">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm text-gray-600">Installment #
                                                <span>{{ $installement->installment_number }}</span>
                                                @if ($installement->status == 'PAYED')
                                                    <span
                                                        class="bg-green-400 p-0.5 px-2 rounded text-white text-xs">PAID</span>
                                                @elseif ($installement->status == 'UNDERPAYED')
                                                    <span class="bg-yellow-400 p-0.5 px-2 rounded text-white text-xs">UNDER
                                                        PAID</span>
                                                @elseif ($installement->status == 'NOPAYED')
                                                    <span class="bg-red-400 p-0.5 px-2 rounded text-white text-xs">NO
                                                        PAID</span>
                                                @else
                                                    <span
                                                        class="bg-blue-400 p-0.5 px-2 rounded text-white text-xs">ONGOING</span>
                                                @endif
                                            </p>
                                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                                <img src="{{ asset('assets/icons/CaretDownNew.svg') }}" alt="Toggle"
                                                    class="h-3 w-3 transform transition-transform">
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-600">{{ $installement->payed_date }}</p>
                                    </div>
                                    <div class="mt-2 flex justify-between items-center text-xs">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Payed Amount</p>
                                            <p class="font-medium text-gray-600">Rs.
                                                {{ number_format($installement->amount, 2) }}
                                                ({{ number_format($installement->installment_amount, 2) }})
                                            </p>
                                        </div>
                                        {{-- <div class="flex items-center space-x-2">
                                            <p class="text-gray-400">Pay in Date</p>
                                            @if ($installement->pay_in_date)
                                                <p class="text-xs font-medium p-0.5 bg-green-500 rounded px-1">Yes</p>
                                            @else
                                                @if (\Carbon\Carbon::parse($installement->date_and_time)->lt(now()))
                                                    <p class="text-xs font-medium p-0.5 bg-red-500 rounded px-1">No</p>
                                                @else
                                                    <p class="text-xs font-medium p-0.5 bg-yellow-500 rounded px-1">Pending
                                                    </p>
                                                @endif
                                            @endif
                                        </div> --}}
                                    </div>

                                    <div class="installment-details mt-2 hidden  pt-2">
                                        @if (!empty($installement->underpayment) && $installement->underpayment->count() > 0)
                                            @foreach ($installement->underpayment as $underpayment)
                                                <div class="grid gap-2 w-full border-b mb-2">
                                                    <div class="flex justify-center items-baseline">
                                                        <p class="text-gray-400 w-20"> {{ ordinal($loop->iteration) }}
                                                        </p>
                                                        <hr class="w-full border-gray-400">
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <p class="font-medium w-16"> Amount *</p>
                                                        <p class="font-medium text-gray-400">Rs.
                                                            {{ number_format($underpayment->amount, 2) }}</p>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <p class="font-medium w-16">Date *</p>
                                                        <p class="font-medium text-gray-400">
                                                            {{ $underpayment->payed_date }}</p>
                                                    </div>
                                                    {{--  <div class="flex items-center space-x-2">
                                                        <p class="font-medium w-16"> Bill *</p>
                                                        <p class="font-medium text-gray-400">bill.png</p>
                                                    </div> --}}
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($installement->status == 'UNPAYED')
                                            <form
                                                action="{{ route('installments.updateInstallment', ['loanId' => $loan->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @if ($errors->any())
                                                    <div
                                                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
                                                        <ul class="text-sm">
                                                            @foreach ($errors->all() as $error)
                                                                <li>• {{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="grid gap-1">
                                                    <div class="flex justify-between items-center">
                                                        <label for="amount" class="block text-xs font-medium">Amount
                                                            *</label>
                                                        <input type="number" name="amount" id="amount"
                                                            value="{{ old('amount') }}"
                                                            class="no-spinner w-2/3 mt-1 px-3 py-1 border rounded-md sp"
                                                            required step="0.01">
                                                    </div>
                                                    {{-- <div class="flex justify-between items-center w-full space-x-2">
                                                        <div class="flex w-2/3 items-center space-x-2">
                                                            <label for="bill" name="image_1"
                                                                class="block text-xs font-medium">Date *</label>

                                                            <p>{{ $installement->payed_date }}</p>

                                                        </div> --}}

                                                    {{-- <div class="flex w-1/3">
                                                        @if ($installement->status == 'PAYED')
                                                            <p></p>
                                                        @else
                                                            <input type="file" name="image_1" id="bill"
                                                                class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                                        @endif
                                                    </div> --}}
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-3">
                                                    <button type="button"
                                                        class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                                </div>

                                    </div>
                                    </form>
                            @endif
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        // Add alternating background colors to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#InstallmentsGridTable tbody tr');
            rows.forEach((row, index) => {
                row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');
                row.classList.add('hover:bg-sky-100');
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
                const tableRows = document.querySelectorAll('#InstallmentsGridTable tbody tr');
                tableRows.forEach(row => {
                    const memberName = row.getAttribute('data-member-name').toLowerCase();
                    row.style.display = memberName.includes(searchTerm) ? 'table-row' : 'none';
                });
            });

            // Customer Details edit and save functionality
            const editCustomerBtn = document.getElementById('editCustomerBtn');
            const saveCustomerBtn = document.getElementById('saveCustomerBtn');

            editCustomerBtn.addEventListener('click', () => {
                document.querySelectorAll('.view-mode-customer').forEach(el => el.classList.add('hidden'));
                document.querySelectorAll('.edit-mode-customer').forEach(el => el.classList.remove(
                    'hidden'));
                editCustomerBtn.classList.add('hidden');
                saveCustomerBtn.classList.remove('hidden');
                saveCustomerBtn.classList.add('flex');
            });



            // Helper function to hide all second columns
            function hideAllSecondColumns() {
                const columns = ['RowDetails', 'centersColumn', 'branchesColumn'];
                columns.forEach(col => {
                    const element = document.getElementById(col);
                    if (element) element.classList.add('hidden');
                });

                const firstColumn = document.getElementById('firstColumn');
                firstColumn.classList.remove('lg:w-8/12');
                firstColumn.classList.add('lg:w-full');
            }

            // Back button to close second column
            const backButton = document.getElementById('closeButton');

            backButton.addEventListener('click', () => {
                hideAllSecondColumns();
            });
            const deleteBtn = document.getElementById('deleteBtn');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');

            deleteBtn.addEventListener('click', () => {
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
            cancelDelete.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
            });
            const memberId = document.getElementById('member_id_span').innerText.trim();
            confirmDelete.addEventListener(
                'click', () => {
                    fetch(`/members/delete/${memberId}`, {
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
            // Row Details click handler
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent default link behavior

                    const row = button.closest('tr');
                    const RowDetails = document.getElementById('RowDetails');
                    const firstColumn = document.getElementById('firstColumn');

                    // Hide other columns and show RowDetails
                    hideAllSecondColumns();
                    RowDetails.classList.remove('hidden');
                    firstColumn.classList.remove('lg:w-full');
                    firstColumn.classList.add('lg:w-8/12');
                    RowDetails.classList.add('lg:flex');

                    // Update second column content with data from the row
                    /*  const memberName = row.getAttribute('data-member-name');
                     const branchName = row.getAttribute('data-branch');
                     const groupName = row.getAttribute('data-group');
                     const centerName = row.getAttribute('data-center');
                     const memberObject = JSON.parse(row.getAttribute('data-memberObject')); */
                    // Mock data for demonstration (replace with actual data fetching if needed)

                    /* document.getElementById('memberNameShow').textContent = memberName;
                    document.getElementById('branchNameShow').textContent = branchName;
                    document.getElementById('centerNameShow').textContent = centerName;
                    document.getElementById('groupNameShow').textContent = groupName;
                    if (memberObject.status === 'INACTIVE') {
                        document.getElementById('activeMemberStatus').classList.add('hidden');
                        document.getElementById('inactiveMemberStatus').classList.remove('hidden');
                    } */
                });
            });
            const viewPreviousLoanBtn = document.getElementById('ViewPreviousLoan');
            viewPreviousLoanBtn.addEventListener('click', (e) => {

                const RowDetails = document.getElementById('RowDetails');
                const firstColumn = document.getElementById('firstColumn');

                // Hide other columns and show RowDetails
                hideAllSecondColumns();
                RowDetails.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                RowDetails.classList.add('lg:flex');

                // Update second column content with data from the row
                /* const memberName = row.getAttribute('data-member-name');
                const branchName = row.getAttribute('data-branch');
                const groupName = row.getAttribute('data-group');
                const centerName = row.getAttribute('data-center');
                const memberObject = JSON.parse(row.getAttribute('data-memberObject')); */
                // Mock data for demonstration (replace with actual data fetching if needed)

                /*  document.getElementById('memberNameShow').textContent = memberName;
                 document.getElementById('branchNameShow').textContent = branchName;
                 document.getElementById('centerNameShow').textContent = centerName;
                 document.getElementById('groupNameShow').textContent = groupName;
                 if (memberObject.status === 'INACTIVE') {
                     document.getElementById('activeMemberStatus').classList.add('hidden');
                     document.getElementById('inactiveMemberStatus').classList.remove('hidden');
                 } */
            });

        });

        // Toggle Previous and Current Loan Details with mutual exclusivity
        document.addEventListener('DOMContentLoaded', function() {
            const togglePreviousLoanBtn = document.getElementById('togglePreviousLoan');
            const previousLoanDetails = document.getElementById('previousLoanDetails');
            const toggleCurrentLoanBtn = document.getElementById('toggleCurrentLoan');
            const currentLoanDetails = document.getElementById('currentLoanDetails');

            togglePreviousLoanBtn.addEventListener('click', () => {
                const isPreviousHidden = previousLoanDetails.classList.contains('hidden');
                if (isPreviousHidden) {
                    previousLoanDetails.classList.remove('hidden');
                    currentLoanDetails.classList.add('hidden');
                    togglePreviousLoanBtn.querySelector('img').classList.add('rotate-180');
                    toggleCurrentLoanBtn.querySelector('img').classList.remove('rotate-180');
                } else {
                    previousLoanDetails.classList.add('hidden');
                    togglePreviousLoanBtn.querySelector('img').classList.remove('rotate-180');
                }
            });

            toggleCurrentLoanBtn.addEventListener('click', () => {
                const isCurrentHidden = currentLoanDetails.classList.contains('hidden');
                if (isCurrentHidden) {
                    currentLoanDetails.classList.remove('hidden');
                    previousLoanDetails.classList.add('hidden');
                    toggleCurrentLoanBtn.querySelector('img').classList.add('rotate-180');
                    togglePreviousLoanBtn.querySelector('img').classList.remove('rotate-180');
                } else {
                    currentLoanDetails.classList.add('hidden');
                    toggleCurrentLoanBtn.querySelector('img').classList.remove('rotate-180');
                }
            });

            // Ensure Current Loan Details is open by default
            currentLoanDetails.classList.remove('hidden');
            toggleCurrentLoanBtn.querySelector('img').classList.add('rotate-180');
        });

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

        //Loan
        document.getElementById('addLoanButton').addEventListener('click', () => {
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
        });

        document.getElementById('cancelLoan').addEventListener('click', () => {
            document.getElementById('addLoanModal').classList.add('hidden');
            document.getElementById('addLoanModal').classList.remove('flex');
        });


        const loanInput = document.getElementById("newLoanAmount");
        const interestRateInput = document.getElementById("newLoanInterestRate");
        const interestAmountInput = document.getElementById("newLoanInterestAmount");
        const loanTermInput = document.getElementById("newLoanTerm");
        const installmentInput = document.getElementById("newLoanInstallment");

        function enableFieldsIfLoanEntered() {
            const loan = parseFloat(loanInput.value);
            const validLoan = !isNaN(loan) && loan > 0;

            interestRateInput.disabled = !validLoan;
            interestAmountInput.disabled = !validLoan;

            if (!validLoan) {
                interestRateInput.value = "";
                interestAmountInput.value = "";
            }
        }

        function enableFieldsIfInterestEntered() {
            const interest = parseFloat(interestRateInput.value);
            const validInterest = !isNaN(interest) && interest > 0;

            loanTermInput.disabled = !validInterest;

            if (!validInterest) {
                loanTermInput.value = "";
                installmentInput.value = "";
            }
        }

        function calculateInterestFromRate() {
            const loan = parseFloat(loanInput.value);
            const rate = parseFloat(interestRateInput.value.replace('%', ''));

            if (!isNaN(loan) && !isNaN(rate)) {
                const interest = (loan * rate) / 100;
                interestAmountInput.value = interest.toFixed(2);
            } else {
                interestAmountInput.value = '';
            }
        }

        function calculateRateFromInterest() {
            const loan = parseFloat(loanInput.value);
            const interest = parseFloat(interestAmountInput.value);

            if (!isNaN(loan) && loan > 0 && !isNaN(interest)) {
                const rate = (interest / loan) * 100;
                interestRateInput.value = rate.toFixed(2);
            } else {
                interestRateInput.value = '';
            }
        }

        function calculateInstallmentFromTerms() {
            const loan = parseFloat(loanInput.value);
            const interest = parseFloat(interestAmountInput.value);
            const terms = parseInt(loanTermInput.value);
            if (!isNaN(loan) && !isNaN(interest) && !isNaN(terms)) {
                const installment = (loan + interest) / terms;
                installmentInput.value = installment.toFixed(2);
            } else {
                installmentInput.value = '';
            }
        }
        loanInput.addEventListener("input", () => {
            enableFieldsIfLoanEntered();
            calculateInterestFromRate();
            interestRateInput.value = '';
            interestAmountInput.value = '';
            loanTermInput.value = '';
            installmentInput.value = '';
            loanTermInput.disabled = true;
        });
        interestRateInput.addEventListener("input", () => {
            enableFieldsIfInterestEntered();
            calculateInstallmentFromTerms();
            loanTermInput.value = '';
            installmentInput.value = '';
        })
        interestAmountInput.addEventListener("input", () => {
            enableFieldsIfInterestEntered();
            calculateInstallmentFromTerms();
            loanTermInput.value = '';
            installmentInput.value = '';
        })
        interestRateInput.addEventListener("input", calculateInterestFromRate);
        interestAmountInput.addEventListener("input", calculateRateFromInterest);
        loanTermInput.addEventListener("input", calculateInstallmentFromTerms);
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
    </style>
@endsection
