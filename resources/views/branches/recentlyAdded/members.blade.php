@extends('layouts.layout')

@section('contents')
<div id="mainContent" class="flex lg:h-full">
    <!-- First Column -->
    <!--Mobile Cards and table View-->
    <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300  lg:relative ">

        <!-- Add New Member Modal -->
        <div id="addNewMemberModal" class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4" style="width: 100%; height: 100%;">
            <div class="bg-white shadow-xl w-full max-w-lg rounded-lg">
                <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Member</h2>
                <form id="addNewMemberForm">
                    <div class="bg-white rounded-b-lg p-4 space-y-4">
                        <div class="flex items-center space-x-4">
                            <label for="newMemberBranch" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Branch*</label>
                            <input type="text" id="newMemberBranch" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="newMemberCenter" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Center Name*</label>
                            <input type="text" id="newMemberCenter" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="newMemberGroup" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Group Name*</label>
                            <input type="text" id="newMemberGroup" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                        </div>

                    </div>
                    <div>
                        <p class="text-xs text-gray-500 px-4 text-center">member details:</p>
                        <hr>
                    </div>
                    <div class="bg-white rounded-b-lg p-4 space-y-4">

                        <div class="flex items-center space-x-4">
                            <label for="newMemberFullName" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Full Name*</label>
                            <input type="text" id="newMemberFullName" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                        </div>
                        <div class="flex flex-col lg:flex-row lg:justify-between w-full lg:space-x-4 space-y-2 lg:space-y-0">
                            <div class="lg:w-1/2 flex items-center space-x-4">
                                <label for="newMemberMobile01" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Mobile Number 01</label>
                                <input type="tel" id="newMemberMobile01" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div class="lg:w-1/2 flex items-center space-x-4">
                                <label for="newMemberMobile02" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Mobile Number 02</label>
                                <input type="tel" id="newMemberMobile02" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="newMemberAddress" class="block text-xs text-gray-400 mb-1 ml-2 w-36">Address?</label>
                            <input type="text" id="newMemberAddress" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2 flex items-center space-x-4">
                                <label for="newMemberNIC" class="block text-xs text-gray-400 mb-1 ml-2 w-36">NIC</label>
                                <input type="text" id="newMemberNIC" placeholder="" class="w-full p-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div class="w-1/2 flex items-center space-x-4  pl-4">
                                <label class="text-xs text-gray-400 w-1/2 flex space-x-1">
                                    <input type="radio" name="newMemberGender" value="Male" class="p-1 " />
                                    <p>Male</p>
                                </label>
                                <label class="text-xs text-gray-400 w-1/2 flex space-x-1">
                                    <input type="radio" name="newMemberGender" value="Female" class="p-1 " />
                                    <p>Female</p>
                                </label>

                            </div>
                        </div>
                        <div class="flex justify-between items-center space-x-4">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                <input type="file" id="newMemberImage" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1 ml-2">Image*</label>
                                <input type="file" id="newMemberImage" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required />
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 mt-2">
                            <button type="button" id="cancelNewMember" class="px-6 py-1 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                Cancel
                            </button>
                            <button type="submit" id="createNewMember" class="px-6 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="h-8 pb-4 ">
            <ul class="flex text-xs space-x-4">
                <li class="border-b-2 pb-1 border-black  "><a href="http://">New Members</a></li>
                <li class=" border-black text-gray-400 hover:text-gray-700"><a href="http://">New Loan</a></li>
                <li class=" border-black text-gray-400 hover:text-gray-700"><a href="http://">New Centers</a></li>
                <li class=" border-black text-gray-400 hover:text-gray-700"><a href="http://">New Groups</a></li>
            </ul>
        </div>
        <!--Content-->
        <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-[calc(100vh-115px)] ">
            <!-- Top Bar -->
            <div class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1">
                <!-- Filter Button -->
                <div class="hidden lg:flex text-sm">
                    <button value="" class="bg-white p-2 rounded-lg focus:outline-none border w-8">
                        <img src="{{ asset('assets/icons/Funnel.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                    </button>
                </div>
                <!-- Hidden native select for form submission -->
                <div class="flex flex-col lg:flex-row justify-between items-center w-full lg:justify-normal lg:items-baseline lg:w-3/12">
                    <div class="w-full lg:mb-0 relative text-sm">
                        <select id="branchSelect" name="branch" class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm lg:text-xs">
                            <option class="text-sm" value="">Select Branch</option>
                            <option value="add_new">+ Add New Branch</option>
                            <option value="balangoda">Balangoda</option>
                            <option value="ella">Ella</option>
                            <option value="badulla">Badulla</option>
                            <option value="colombo">Colombo</option>
                        </select>
                        <!-- Custom dropdown trigger -->
                        <div id="dropdownTrigger" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between lg:text-xs" onclick="toggleDropdown()">
                            <span id="selectedOption">Select Branch</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <!-- Custom dropdown menu -->
                        <div id="dropdownMenu" class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                            <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs" data-value="add_new" id="addBranchButton">+ Add New Branch</li>
                                <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs" data-value="balangoda">Balangoda</li>
                                <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs" data-value="ella">Ella</li>
                                <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs" data-value="badulla">Badulla</li>
                                <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs" data-value="colombo">Colombo</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Search Bar -->
                <div class="w-full text-sm lg:text-xs lg:w-5/12">
                    <input type="text" id="searchMember" placeholder="Search Member..." class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                </div>
                <!-- Add Member Button -->
                <div class="w-full text-sm lg:text-xs lg:w-3/12">
                    <button id="addNewMemberButton" value="add_new_member" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        + Add Member
                    </button>
                </div>
            </div>

            <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Total member 10</p>

            <!-- member Grid card format hidden for lg screens -->
            <div id="memberGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-2 p-2">
                <!-- Example Member Card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="Dunura Hansaja">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">Dunura Hansaja <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>
                <!-- Additional card -->
                <div class="rounded-lg shadow flex flex-row justify-between w-full bg-blue-100 hover:bg-blue-200" data-member="K A Perera ">
                    <div class=" py-2 px-4 flex flex-col justify-center space-y-">
                        <div class="text-sm">K A Perera <span>- Malwaragoda</span></div>
                        <div class="text-xs flex items-center space-x-1 text-gray-700">
                            <p>ID Number</p>
                        </div>
                    </div>
                    <div class="py-2 px-4 flex flex-col justify-center space-y-1">
                        <div class="text-sm font-bold">20 000/=</div>
                    </div>
                </div>


            </div>

            <!-- member Grid Table format hidden for mobile screens -->
            <div class="flex justify-start h-full pt-2">
                <div id="memberGridTable" class="w-full max-h-[calc(100vh-210px)]  hidden lg:block p-0 overflow-y-auto">
                    <div class="min-w-full ">
                        <table class="w-full min-w-max">
                            <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                <tr class="uppercase w-full">
                                    <th class="py-2 text-center">#</th>
                                    <th class="py-2 text-left">Name</th>
                                    <th class="py-2 text-left">Center</th>
                                    <th class="py-2 text-left">NIC</th>
                                    <th class="py-2 text-center">Loan Balance</th>
                                    <th class="py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 text-xs font-light bg-white w-full">
                                <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details" data-member-id="1" data-member-name="Kinura" data-center-name="Maharagama" data-NIC="20001589432" data-loan-balance="20000" data-num01="0719865324" data-num02="879652314">
                                    <td class="py-2 text-center">001</td>
                                    <td class="py-2 text-left">Kinura</td>
                                    <td class="py-2 text-left">waththegedra</td>
                                    <td class="py-2 text-left">20015896423</td>
                                    <td class="py-2 text-center">2000</td>
                                    <td class="py-2 text-center flex justify-center items-center gap-1">
                                        <a href="#" class="border rounded hover:bg-green-500">
                                            <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                        </a>
                                        <a href="#" class="border rounded hover:bg-sky-500">
                                            <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                        </a>
                                        <a href="#" class="border rounded hover:bg-lime-500">
                                            <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                        </a>
                                    </td>
                                </tr>
                                <!-- Additional rows with placeholder data -->
                                <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details" data-member-id="1" data-member-name="Dunura Hansja" data-center-name="Maharagama" data-NIC="20001589432" data-loan-balance="20000" data-num01="0719865324" data-num02="078658923">

                                    <td class="py-2 text-center">001</td>
                                    <td class="py-2 text-left">Dunura hansaja</td>
                                    <td class="py-2 text-left">waththegedra</td>
                                    <td class="py-2 text-left">20015896423</td>
                                    <td class="py-2 text-center">12000</td>
                                    <td class="py-2 text-center flex justify-center items-center gap-1">
                                        <a href="#" class="border rounded hover:bg-green-500">
                                            <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                        </a>
                                        <a href="#" class="border rounded hover:bg-sky-500">
                                            <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                        </a>
                                        <a href="#" class="border rounded hover:bg-lime-500">
                                            <img src="{{ asset('assets/icons/Money.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                        </a>
                                    </td>
                                </tr>


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
                    <button id="prevPage" class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <img src="{{ asset('assets/icons/CaretLeft.svg') }}" alt="Previous" class="h-3 w-3">
                    </button>
                    <span id="pageIndicator" class="px-2 text-xs">1/15</span>
                    <button id="nextPage" class="px-1 py-1 bg-gray-200 rounded hover:bg-sky-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <img src="{{ asset('assets/icons/CaretRight.svg') }}" alt="Next" class="h-3 w-3">
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Second Column: Row Details -->
    <div id="RowDetails" class="hidden h-full lg:w-4/12 flex-col justify-between transition-all duration-300">
        <div id="RowDetailsContent" class="border-b p-4">
            <h1 id="memberName" class="text-md font-medium text-gray-800 mb-1">Name</h1>
            <h1 id="memberName" class="text-xs text-gray-600 mb-4"><span>Branch</span> > <span>Center</span> > <span>Group</span></h1>
            <div class="grid grid-cols-2 gap-y-2">
                <div>
                    <p for="num01" class="text-xs text-gray-400">Mobile number 01</p>
                    <p id="num01" class="text-sm">+94 78 659823</p>
                </div>
                <div>
                    <p for="num02" class="text-xs text-gray-400">Mobile number 02</p>
                    <p id="num02" class="text-sm">+94 78 659428</p>
                </div>
                <div>
                    <p for="NIC" class="text-xs text-gray-400">NIC</p>
                    <p id="NIC" class="text-sm">2459876314</p>
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
                    <p id="memberAddress" class="text-sm mt-0">Balngoda,Sri lanka</p>
                </div>
            </div>
        </div>
        <div class=" space-y-4 h-full ">
            <div class="p-4 border-b w-full">
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
                    <button id="addLoanButton" value="add_new_loan" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        + Add Loan
                    </button>
                </div>
            </div>
        </div>
        <div class=" p-4 border-t">
            <div class="w-full text-sm lg:text-xs  pt-4">
                <button id="ViewFullDetail" value="" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                    View Full Detail
                </button>
            </div>

        </div>

    </div>
</div>


<script>
    // Add alternating background colors to table rows
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('#memberGridTable tbody tr');
        rows.forEach((row, index) => {
            // Add alternating background colors
            row.classList.add(index % 2 === 0 ? 'bg-white' : 'bg-gray-100');

            // Ensure hover color overrides the background
            row.classList.add('hover:bg-sky-100');
        });
    });

    // Search Filter for both mobile and web views
    document.getElementById('searchMember').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        // Mobile view (cards)
        const cards = document.querySelectorAll('#memberGrid > div');
        cards.forEach(card => {
            const centerName = card.getAttribute('data-member').toLowerCase();
            card.style.display = centerName.includes(searchTerm) ? 'flex' : 'none';
        });

        // Web view (table rows)
        const tableRows = document.querySelectorAll('#memberGridTable tbody tr');
        tableRows.forEach(row => {
            const centerName = row.getAttribute('data-member-name').toLowerCase();
            row.style.display = centerName.includes(searchTerm) ? 'table-row' : 'none';
        });
    });

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

        // Toggle dropdown menu
    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }

    //Add New Member Modle
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize selectedmember array
        window.selectedmember = window.selectedmember || [];

        // Add New Member Modal
        const addNewMemberButton = document.getElementById('addNewMemberButton');
        if (addNewMemberButton) {
            addNewMemberButton.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = document.getElementById('addNewMemberModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    console.log('Add Member modal opened'); // Debug log
                } else {
                    console.error('Modal #addNewMemberModal not found');
                }
            });
        } else {
            console.error('Button #addNewMember not found');
        }

        // Cancel New Member Modal
        const cancelNewMemberButton = document.getElementById('cancelNewMember');
        if (cancelNewMemberButton) {
            cancelNewMemberButton.addEventListener('click', function() {
                const modal = document.getElementById('addNewMemberModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.getElementById('addNewMemberForm').reset(); // Reset form fields
                    console.log('Add Member modal closed');
                }
            });
        }

        // Submit New Member Form
        const createNewMemberButton = document.getElementById('createNewMember');
        if (createNewMemberButton) {
            createNewMemberButton.addEventListener('click', function(e) {
                e.preventDefault();
                const form = document.getElementById('addNewMemberForm');
                if (form) {
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

                    if (window.selectedmember.length >= 6) {
                        window.selectedmember.pop();
                        alert("Maximum 6 members allowed. This member was not added.");
                    } else {
                        window.selectedmember.push(newMember);
                        const selectedMemberElement = document.getElementById('selectedmember');
                        if (selectedMemberElement) {
                            selectedMemberElement.textContent = window.selectedmember.map(m => m.fullName || m.name).join(', ') || 'No member selected';
                        } else {
                            console.warn('Element #selectedmember not found');
                        }
                    }

                    const modal = document.getElementById('addNewMemberModal');
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        form.reset();
                        console.log('Member added, modal closed');
                    }
                }
            });
        }
    });

    // Helper function to hide all second columns
    function hideAllSecondColumns() {
        const columns = ['RowDetails', 'centersColumn', 'branchesColumn'];
        columns.forEach(col => document.getElementById(col).classList.add('hidden'));

        document.getElementById('firstColumn').classList.remove('lg:w-8/12');
        document.getElementById('firstColumn').classList.add('lg:w-full');

    }

    // Row Summey
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior
            const row = button.closest('tr');
            const RowDetails = document.getElementById('RowDetails');
            const firstColumn = document.getElementById('firstColumn');

            // Show second column
            RowDetails.classList.remove('hidden');
            firstColumn.classList.remove('lg:w-full');
            firstColumn.classList.add('lg:w-8/12');
            RowDetails.classList.add('lg:flex');

            // Update second column content
            const memberName = row.getAttribute('data-member-name');
            const num01 = row.getAttribute('data-num01');
            const num02 = row.getAttribute('data-num02');
            const NIC = row.getAttribute('data-NIC');
            const groups = row.getAttribute('data-groups');
            const member = row.getAttribute('data-member');
            const paymentDay = row.getAttribute('data-payment-day');

            document.getElementById('memberName').textContent = memberName;
            document.getElementById('num01').textContent = num01;
            document.getElementById('num02').textContent = num01;
            document.getElementById('NIC').textContent = NIC;
            document.getElementById('Cmanager').textContent = manager;
            document.getElementById('Tgroup').textContent = groups;
            document.getElementById('Tmember').textContent = member;
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