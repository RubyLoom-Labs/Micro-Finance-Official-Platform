@extends('layouts.layout')

@section('contents')
<!--NOT Completed -->
<div id="mainContent" class="flex lg:h-full">
    <!-- First Column -->
    <!--Mobile Cards and table View-->
    <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 lg:pt-2 transition-all duration-300 lg:relative space-y-2 px-4">
        <div class="flex flex-col h-full lg:h-auto space-y-2 pb-4">
            <div class="flex w-full justify-between items-center">
                <div class="w-24 text-sm lg:text-xs">
                    <button id="" value="" class="w-full bg-gray-100 text-gray-700 p-1.5 rounded-lg hover:bg-gray-300 focus:outline-none flex items-center pl-4">
                        <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Pencil" class="h-3 w-3 m-1"> Back
                    </button>
                </div>
                <div class="w-40 text-sm lg:text-xs">
                    <button id="getGroupSummary" value="" class="w-full bg-blue-600 text-white p-1.5 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center">
                        <img src="{{ asset('assets/icons/ArrowLineDownWhite.svg') }}" alt="Pencil" class="h-3 w-3 m-1"> Get Summary
                    </button>
                </div>
            </div>

            <!-- Customer Details Card -->
            <div class="flex flex-col lg:flex-row border rounded-lg px-4 p-4 h-full">
                <!-- Customer Details -->
                <div class="w-full lg:w-2/3 h-full">
                    <h1 class="text-md font-medium text-gray-800 mb-2">Customer Details</h1>
                    <div class="grid-cols-1 grid lg:grid-cols-3 lg:gap-y-1 lg:gap-x-4 gap-y-4">
                        <!-- Name -->
                        <div class="">
                            <p class="text-xs text-gray-400">Name</p>
                            <p class="text-sm">
                                <span class="view-mode-customer ">Saman Perera</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="Saman Perera">
                            </p>
                        </div>
                        <!-- NIC -->
                        <div>
                            <p class="text-xs text-gray-400">NIC</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">2525555515151V</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="2525555515151V">
                            </p>
                        </div>
                        <!-- Attach (Images) -->
                        <div>
                            <p class="text-xs text-gray-400">Attach (Images)</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">2 Images</span>
                                <input type="file" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" multiple accept="image/*">
                            </p>
                        </div>
                        <!-- Mobile Number 01 -->
                        <div>
                            <p class="text-xs text-gray-400">Mobile Number 01</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">0712345678</span>
                                <input type="tel" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="0712345678">
                            </p>
                        </div>
                        <!-- Mobile Number 02 -->
                        <div>
                            <p class="text-xs text-gray-400">Mobile Number 02</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">0778765432</span>
                                <input type="tel" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="0778765432">
                            </p>
                        </div>
                        <!-- Address -->
                        <div class="c">
                            <p class="text-xs text-gray-400">Address</p>
                            <p class="text-sm">
                                <span class="view-mode-customer ">123, Main Street, Balangoda</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="123, Main Street, Balangoda">
                            </p>
                        </div>
                        <!-- Branch -->
                        <div>
                            <p class="text-xs text-gray-400">Branch</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">Balangoda</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="Balangoda">
                            </p>
                        </div>
                        <!-- Center -->
                        <div>
                            <p class="text-xs text-gray-400">Center</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">Center Name</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full" value="Center Name">
                            </p>
                        </div>
                        <!-- Group -->
                        <div>
                            <p class="text-xs text-gray-400">Group</p>
                            <p class="text-sm">
                                <span class="view-mode-customer">Group 01</span>
                                <input type="text" class="edit-mode-customer hidden border px-2 py-0.5 rounded w-full " value="Group 01">
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex w-full lg:w-1/3 justify-between lg:justify-end items-end space-x-2 pt-4">
                    <div class="flex flex-row lg:space-x-2 bg-white lg:text-xs w-full justify-end">
                        <!-- Edit -->
                        <button id="editCustomerBtn" class="bg-blue-600 text-white p-1 lg:p-1 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 lg:w-28 w-full lg:mr-0">
                            <img src="{{ asset('assets/icons/PencilSimpleWhite.svg') }}" alt="Edit" class="h-3 w-3 mr-2">
                            <span class="text-sm">Edit</span>
                        </button>
                        <!-- Save -->
                        <button id="saveCustomerBtn" class="bg-green-600 text-white p-1 lg:p-1 rounded-lg hover:bg-green-700 hidden items-center justify-center px-6 lg:w-28 w-full lg:mr-0">
                            <img src="{{ asset('assets/icons/VectorWhite.svg') }}" alt="Save" class="h-3 w-3 mr-2">
                            <span>Save</span>
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
                            <span class="bg-green-400 p-0.5 px-2 rounded text-black text-xs">Active</span>
                        </div>
                        <div class="grid-cols-1 grid lg:grid-cols-3 lg:gap-y-1 lg:gap-x-4 gap-y-4">
                            <!-- Loan Amount -->
                            <div>
                                <p class="text-xs text-gray-400">Loan Amount</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">400000</span>
                                    <input type="number" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="400000">
                                </p>
                            </div>
                            <!-- Interest -->
                            <div>
                                <p class="text-xs text-gray-400">Interest</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">5%</span>
                                    <input type="text" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="5%">
                                </p>
                            </div>
                            <!-- Issue Date -->
                            <div>
                                <p class="text-xs text-gray-400">Issue Date</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">2025.01.01</span>
                                    <input type="date" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="2025-01-01">
                                </p>
                            </div>
                            <!-- Installment -->
                            <div>
                                <p class="text-xs text-gray-400">Installment</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">10000</span>
                                    <input type="number" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="10000">
                                </p>
                            </div>
                            <!-- Terms -->
                            <div>
                                <p class="text-xs text-gray-400">Terms</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">12 Months</span>
                                    <input type="text" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="12 Months">
                                </p>
                            </div>
                            <!-- Document Charges -->
                            <div>
                                <p class="text-xs text-gray-400">Document Charges</p>
                                <p class="text-sm">
                                    <span class="view-mode-loan">5000</span>
                                    <input type="number" class="edit-mode-loan hidden border px-2 py-1 rounded w-full" value="5000">
                                </p>
                            </div>

                        </div>
                        <!-- Action Buttons -->
                    <!--<div id="inactiveActionbuttons" class="flex w-full lg:w-full  justify-between lg:justify-end items-end space-x-2 pt-4 pb-2">
                            <div class="flex flex-row lg:space-x-2 bg-white lg:text-xs w-full justify-end">
                                <button id="Add Loan" class="bg-blue-600 text-white p-1 lg:p-1 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 lg:w-36 w-full lg:mr-0">
                                    <span>+</span>
                                    <span class="ml-2 text-sm">Add Loan</span>
                                </button>
                                
                                <button id="ViewPreviousLoan" class="bg-blue-600 text-white p-1 lg:p-1 rounded-lg hover:bg-blue-700 flex items-center justify-center px-6 lg:w-36 w-full lg:mr-0">
                                    <span></span>
                                    <span class="ml-2 text-xs">View previous Loan</span>
                                </button>
                            </div>
                    </div>-->
                </div>

            </div>

            <!--Balnce Summury--> <!--Need to hide if is memeber is didnt have active loan-->
            <div class="flex flex-col w-full lg:w-1/3 justify-between items-center p-2  rounded-lg border space-y-2">
                <div class="w-full text-sm lg:text-xs flex space-x-2 lg:h-1/2 h-8 justify-center items-center border-black rounded-md  bg-gray-200">
                    <p class="text-sm text-gray-800">Total Paid</p>
                    <p class="text-sm text-gray-600">12 250/=</p>
                </div>
                <div class="w-full text-sm lg:text-xs flex space-x-2 lg:h-1/2 h-8 justify-center items-center  border-black rounded-md bg-gray-200">
                    <p class="text-sm text-gray-800">Balance</p>
                    <p class="text-sm text-gray-600">12 250/=</p>
                </div>
            </div>
        </div>

        <!-- Existing Members Grid and Table -->
        <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-max">
            <!-- Top Bar -->
            <div class="flex flex-col w-full space-y-2 py-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1 lg:pb-2">
                <div class="flex items-center lg:space-x-2 lg:w-10/12 w-full">
                    <!-- Filter Button -->
                    <div class="hidden lg:flex text-sm">
                        <button value="" class="bg-white p-2 rounded-lg focus:outline-none border w-8">
                            <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                        </button>
                    </div>
                    <!-- Search Bar -->
                    <div class="w-full text-sm lg:text-xs lg:w-8/12">
                        <input type="text" id="searchMember" placeholder="Search ..." class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                    </div>
                </div>
                <!-- Summury -->
                <div class="w-full text-sm lg:text-xs lg:w-6/12 flex justify-between items-center">
                    <div class="border bg-white rounded-lg  p-2 px-2">Complete - <span>08</span></div>
                    <div class="border bg-white rounded-lg  p-2 px-2">Pending - <span>09</span></div>
                    <div class="border bg-white rounded-lg  p-2 px-2">Waiting - <span>01</span></div>
                </div>
            </div>
            <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Loan #2 - Installment2/10</p>
            <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Loan Not Available</p>

            <!-- Installment Grid card format hidden for lg screens -->
            <div id="InstallmentGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4   ">
                <!--Card-->
                <div class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4" data-member-name="saman">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-2 py-0.5 border rounded-md">
                            </div>

                            <!-- Date and File -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <label for="payDate" class="block text-xs font-medium w-max">Date *</label>
                                    <input type="date" name="payDate" id="payDate" class="w-2/3  px-2 py-0.5 border rounded-md">
                                </div>
                                <div class="flex justify-between items-center">
                                    <label for="bill" class="block text-xs font-medium w-max">Attach Bill</label>
                                    <input type="file" name="bill" id="bill" class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2 mt-2 text-sm">
                                <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional cards -->
                <div class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4" data-member-name="saman">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-2 py-0.5 border rounded-md">
                            </div>

                            <!-- Date and File -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <label for="payDate" class="block text-xs font-medium w-max">Date *</label>
                                    <input type="date" name="payDate" id="payDate" class="w-2/3  px-2 py-0.5 border rounded-md">
                                </div>
                                <div class="flex justify-between items-center">
                                    <label for="bill" class="block text-xs font-medium w-max">Attach Bill</label>
                                    <input type="file" name="bill" id="bill" class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2 mt-2 text-sm">
                                <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4" data-member-name="saman">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-2 py-0.5 border rounded-md">
                            </div>

                            <!-- Date and File -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <label for="payDate" class="block text-xs font-medium w-max">Date *</label>
                                    <input type="date" name="payDate" id="payDate" class="w-2/3  px-2 py-0.5 border rounded-md">
                                </div>
                                <div class="flex justify-between items-center">
                                    <label for="bill" class="block text-xs font-medium w-max">Attach Bill</label>
                                    <input type="file" name="bill" id="bill" class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2 mt-2 text-sm">
                                <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4" data-member-name="saman">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-2 py-0.5 border rounded-md">
                            </div>

                            <!-- Date and File -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <label for="payDate" class="block text-xs font-medium w-max">Date *</label>
                                    <input type="date" name="payDate" id="payDate" class="w-2/3  px-2 py-0.5 border rounded-md">
                                </div>
                                <div class="flex justify-between items-center">
                                    <label for="bill" class="block text-xs font-medium w-max">Attach Bill</label>
                                    <input type="file" name="bill" id="bill" class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2 mt-2 text-sm">
                                <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg shadow-sm flex flex-col justify-between w-full bg-gray-200 border hover:bg-gray-200 py-2 px-4" data-member-name="saman">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                            <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-2 py-0.5 border rounded-md">
                            </div>

                            <!-- Date and File -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                                <div class="flex justify-between items-center w-full">
                                    <label for="payDate" class="block text-xs font-medium w-max">Date *</label>
                                    <input type="date" name="payDate" id="payDate" class="w-2/3  px-2 py-0.5 border rounded-md">
                                </div>
                                <div class="flex justify-between items-center">
                                    <label for="bill" class="block text-xs font-medium w-max">Attach Bill</label>
                                    <input type="file" name="bill" id="bill" class="w-2/3  px-2 py-0.5 border rounded-md text-sm bg-white">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2 mt-2 text-sm">
                                <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <th class="py-2 text-left">Pay in day</th>
                                <th class="py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 text-xs font-light bg-white">
                            <!-- Row -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-member-id="1" data-member-name="Saman" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #1</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left"><span class="bg-green-400 p-0.5 px-2 rounded text-black text-xs">Yes</span></td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            <!-- Additional Rows -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-group-id="1" data-member-name="Group 01" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #2</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left"><span class="bg-green-400 p-0.5 px-2 rounded text-black text-xs">Yes</span></td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            <!-- Additional Rows -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-group-id="1" data-member-name="Group 01" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #3</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left"><span class="bg-red-400 p-0.5 px-2 rounded text-black text-xs">No</span></td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            </tr>
                            <!-- Additional Rows -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-group-id="1" data-member-name="Group 01" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #3</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left"><span class="bg-red-400 p-0.5 px-2 rounded text-black text-xs">No</span></td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            </tr>
                            <!-- Additional Rows -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-group-id="1" data-member-name="Group 01" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #78</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left"><span class="bg-red-400 p-0.5 px-2 rounded text-black text-xs">No</span></td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            </tr>
                            <!-- Additional Rows -->
                            <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details" data-group-id="1" data-member-name="Group 01" data-members="04" data-received="40000" data-center="Malwaragoda">
                                <td class="py-2 pl-4 text-left">Installment #3</td>
                                <td class="py-2 text-left">Center</td>
                                <td class="py-2 text-left">154782452v</td>
                                <td class="py-2 text-left">
                                    <span class="bg-yellow-400 p-0.5 px-2 rounded text-black text-xs flex w-8 justify-center items-center">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </span>
                                </td>
                                <td class="py-2 text-center flex justify-center items-center gap-1">
                                    <a href="#" class="border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="#" class="border rounded hover:bg-lime-500">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </td>
                            </tr>
                            </tr>

                            <!-- Repeat rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Column: Row Details -->
<div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
    <div id="RowDetailsContent" class=" p-4">
        <div class="flex w-full justify-between">
            <div class="w-2/3">
                <div class="flex items-baseline space-x-2">
                    <h1 id="memberNameShow" class="text-md font-medium text-gray-800 "></h1>
                    <!--Member Status-->
                    <p id="activeMemberStatus" class="items-center">
                        <span class="bg-green-400 p-0.5 px-1 rounded text-black text-xs">Active</span>
                    </p>
                    <!--<p id="inactiveMemberStatus" class="items-center hidden">
                        <span class="bg-red-400 p-0.5 px-1 rounded text-black text-xs">Inactive</span>
                    </p>-->
                </div>
                <h1 id="memberName" class="text-xs text-gray-600 mb-2"><span id="branchNameShow"></span> > <span
                        id="centerNameShow"></span> >
                    <span id="groupNameShow"></span>
                </h1>
            </div>
            <div class="flex justify-end w-1/3 h-8">
                <button id="closeButton" value="" class=" bg-red-400 text-white rounded-lg hover:bg-red-500 focus:outline-none flex items-center text-xs px-4 py-0.5">
                    Close
                </button>
            </div>
        </div>



    </div>
    <!--<div class="inactiveMemberDetails hidden space-y-4 h-full ">
            <div class="p-4 pt-2 border-b w-full">
                <h1 id="" class="text-sm font-medium text-gray-800 mb-1">Current Loan Details</h1>
                <div class="grid grid-cols-3 gap-y-2">
                    <div>
                        <p for="LoanAmount" class="text-xs text-gray-400">Loan Amount</p>
                        <p id="LoanAmount" class="text-sm">10 000 00</p>
                    </div>
                    <div>
                        <p for="Interest" class="text-xs text-gray-400">Interest</p>
                        <p id="Interest" class="text-sm">15%</p>
                    </div>
                    <div>
                        <p for="IssueDate" class="text-xs text-gray-400">Issue Date</p>
                        <p id="IssueDate" class="text-sm">2025/06/12</p>
                    </div>
                    <div>
                        <p for="Installment" class="text-xs text-gray-400">Installment</p>
                        <p id="Installment" class="text-sm">10</p>
                    </div>
                    <div>
                        <p for="Terms" class="text-xs text-gray-400">Terms</p>
                        <p id="Terms" class="text-sm">Terms</p>
                    </div>
                    <div>
                        <p for="DocumentChagers" class="text-xs text-gray-400">Document Chagers</p>
                        <p id="DocumentChagers" class="text-sm">-</p>
                    </div>

                </div>
                <div class="w-full text-sm lg:text-xs  pt-4">
                    <button id="addLoanButton" value="add_new_loan"
                        class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        + Add Loan
                    </button>
                </div>
            </div>
        </div>-->
    <h1 id="" class="text-sm font-medium text-gray-800  pl-4 py-2 border-b border-t">Previous Loan Details</h1>
    <div class="activeMemberDetails previousLoan overflow-y-auto h-[calc(100vh-500px)] ">
        <div class="pt-0  w-full">
            <!--Collection-->
            <div class="w-full text-sm lg:text-xs px-4 py-2 m-0 pt-0">
                <!--Card Gri-->
                <div class="grid grid-cols-1 gap-y-2">
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>1</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>2</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>3</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>4</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>4</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>
                    <!--  Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">laon # <span>4</span></p>
                            </div>
                            <p class="text-xs text-gray-600"></p>
                        </div>

                        <!-- Sub Info -->
                        <div class="mt-0 flex justify-between items-center text-xs">
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Amount</p>
                                <p class="font-medium text-gray-600">2,000/=</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-gray-400">Complete Date</p>
                                <p class="font-medium text-gray-600">3/25/2025</p>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>

    <h1 id="" class="text-sm font-medium text-gray-800  pl-4 bg py-2  border-b border-t">Current Loan Details</h1>
    <div class="activeMemberDetails currentloan  overflow-y-auto h-[calc(100vh-350px)] pb-4 ">
        <div class=" pt-0 border-b w-full">
            <!-- Installment Cards -->
            <div class="w-full text-sm lg:text-xs p-4 m-0 pt-0 ">
                <div class="grid grid-cols-1 gap-y-2">
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <p class="text-xs font-medium p-0.5 bg-yellow-500 rounded px-1">Pending</p>
                            </div>
                        </div>

                        <!-- Collapsible Section -->
                        <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                            <div class="grid gap-3">
                                <!-- Amount -->
                                <div class="flex justify-between items-center">
                                    <label for="amount" class="block text-xs font-medium">Amount *</label>
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <p class="text-xs font-medium p-0.5 bg-yellow-500 rounded px-1">Pending</p>
                            </div>
                        </div>

                        <!-- Collapsible Section -->
                        <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                            <div class="grid gap-3">
                                <!-- Amount -->
                                <div class="flex justify-between items-center">
                                    <label for="amount" class="block text-xs font-medium">Amount *</label>
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <p class="text-xs font-medium p-0.5 bg-yellow-500 rounded px-1">Pending</p>
                            </div>
                        </div>

                        <!-- Collapsible Section -->
                        <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                            <div class="grid gap-3">
                                <!-- Amount -->
                                <div class="flex justify-between items-center">
                                    <label for="amount" class="block text-xs font-medium">Amount *</label>
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <p class="text-xs font-medium p-0.5 bg-red-500 rounded px-1">No</p>
                            </div>
                        </div>

                        <!-- Collapsible Section -->
                        <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                            <div class="grid gap-3">
                                <!-- Amount -->
                                <div class="flex justify-between items-center">
                                    <label for="amount" class="block text-xs font-medium">Amount *</label>
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Card -->
                    <div class="bg-gray-200 py-2 px-4 rounded-lg shadow-sm">
                        <!-- Header Row -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <p class="text-sm text-gray-600">Installment # <span>7</span></p>
                                <button class="toggle-details-btn p-1 rounded hover:bg-sky-200">
                                    <img src="{{ asset('assets/icons/CaretDown.svg') }}" alt="Toggle" class="h-3 w-3 transform transition-transform">
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
                                <p class="text-xs font-medium p-0.5 bg-yellow-500 rounded px-1">Pending</p>
                            </div>
                        </div>

                        <!-- Collapsible Section -->
                        <div class="installment-details mt-2 hidden border-t border-gray-600 pt-2">
                            <div class="grid gap-3">
                                <!-- Amount -->
                                <div class="flex justify-between items-center">
                                    <label for="amount" class="block text-xs font-medium">Amount *</label>
                                    <input type="number" name="amount" id="amount" class="w-2/3 mt-1 px-3 py-1 border rounded-md">
                                </div>

                                <!-- Date and File -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="payDate" class="block text-xs font-medium">Date *</label>
                                        <input type="date" name="payDate" id="payDate" class="w-full mt-1 px-3 py-1.5 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="bill" class="block text-xs font-medium">Attach Bill</label>
                                        <input type="file" name="bill" id="bill" class="w-full mt-1 px-2 py-1 border rounded-md text-sm bg-white">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-2 mt-3">
                                    <button type="button" class="cancel-btn bg-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="save-btn bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
            document.querySelectorAll('.edit-mode-customer').forEach(el => el.classList.remove('hidden'));
            editCustomerBtn.classList.add('hidden');
            saveCustomerBtn.classList.remove('hidden');
            saveCustomerBtn.classList.add('flex');
        });

        saveCustomerBtn.addEventListener('click', () => {
            document.querySelectorAll('.edit-mode-customer').forEach((input, i) => {
                if (input.type !== 'file') {
                    const value = input.value;
                    document.querySelectorAll('.view-mode-customer')[i].textContent = value;
                } else {
                    const files = input.files;
                    document.querySelectorAll('.view-mode-customer')[i].textContent = files.length > 0 ? `${files.length} Images` : 'No Images';
                }
            });
            document.querySelectorAll('.view-mode-customer').forEach(el => el.classList.remove('hidden'));
            document.querySelectorAll('.edit-mode-customer').forEach(el => el.classList.add('hidden'));
            saveCustomerBtn.classList.add('hidden');
            editCustomerBtn.classList.remove('hidden');
            console.log("Customer details saved successfully.");
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
                const memberName = row.getAttribute('data-member-name');
                const centerName = row.getAttribute('data-center');
                // Mock data for demonstration (replace with actual data fetching if needed)
                const mockMemberData = {
                    mobile_number_1: '0712345678',
                    mobile_number_2: '0778765432',
                    nic_number: '154782452v',
                    address: '123, Main Street, Balangoda',
                    group: {
                        group_name: row.getAttribute('data-member-name')
                    },
                    branch_name: 'Balangoda'
                };

                document.getElementById('memberNameShow').textContent = memberName;
                document.getElementById('branchNameShow').textContent = mockMemberData.branch_name;
                document.getElementById('centerNameShow').textContent = centerName;
                document.getElementById('groupNameShow').textContent = mockMemberData.group.group_name;
                document.getElementById('phonenum01').textContent = mockMemberData.mobile_number_1;
                document.getElementById('phonenum02').textContent = mockMemberData.mobile_number_2;
                document.getElementById('nicNumberShow').textContent = mockMemberData.nic_number;
                document.getElementById('memberAddressShow').textContent = mockMemberData.address;
            });
        });
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