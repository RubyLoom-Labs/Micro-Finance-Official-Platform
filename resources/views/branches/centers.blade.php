@extends('layouts.layout')

@php
    $count_total_members = 0;
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');

    $weekDays = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];
@endphp

@foreach ($all_active_centers as $center)
    @foreach ($center->group as $group)
        @php
            $count_total_members += $group->member->count();
        @endphp
    @endforeach
@endforeach

@section('contents')
    <div id="mainContent" class="flex lg:h-full">
        <!-- First Column -->
        <!--Mobile Cards and table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300  lg:relative ">
            <!-- Add New Branch Modal -->
            <div id="addBranchModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="shadow-xl w-full max-w-md rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Branch</h2>
                    <div class="bg-white rounded-b-lg p-4">
                        <form action="{{ route('branches.createbranch') }}" method="POST">
                            @csrf

                            @error('branch_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div>
                                <label for="branchName" class="block text-xs text-gray-400 mb-1 ml-2">Branch Name</label>
                                <input type="text" name="branch_name" id="branchName" value="{{ old('branch_name') }}"
                                    class="w-full p-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>

                            <div class="flex justify-end space-x-4 mt-4">
                                <button id="cancelBranch" type="button"
                                    class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button id="createBranch" type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add New Center Modal -->
            <div id="addCenterModal"
                class=" inset-0 bg-gray-600 bg-opacity-50 hidden  items-center justify-center z-50 lg:absolute fixed p-4"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-md rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Center</h2>
                    <form action="{{ route('centers.createcenter') }}" method="POST">
                        @csrf
                        <div class="bg-white rounded-b-lg p-4 space-y-4">
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
                            <div>
                                <label for="centerBranch" class="block text-xs text-gray-400 mb-1 ml-2">Branch*</label>
                                <select id="centerBranch" name="branch_id"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required>
                                    <option value="" disabled selected>Select a branch</option>
                                    @foreach ($all_active_branches as $branch_name)
                                        <option value="{{ $branch_name->id }}">
                                            {{ capitalizeFirstLetter($branch_name->branch_name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="centerName" class="block text-xs text-gray-400 mb-1 ml-2">Center Name*</label>
                                <input type="text" id="centerName" placeholder="" name="center_name" required
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div>
                                <label for="paymentDate" class="block text-xs text-gray-400 mb-1 ml-2">Payment Day</label>
                                <select id="centerBranch" name="payment_day"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required>
                                    <option value="" disabled selected>Select a day</option>
                                    @foreach ($weekDays as $day)
                                        <option value={{ $day }}>{{ capitalizeFirstLetter($day) }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <label for="manager" class="block text-xs text-gray-400 mb-1 ml-2">Manager</label>
                                <input type="text" id="manager" placeholder="" name="manager_name"
                                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    required />
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button id="cancelCenter" type="button"
                                    class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <script>
                    window.showCreateCenterPopup = {{ session('show_create_center_popup') ? 'true' : 'false' }};
                </script>
            </div>

            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col justify-between h-full">
                <!-- Top Bar -->
                <div
                    class="flex flex-col w-full space-y-2 p-2 lg:px-2 text-md lg:flex lg:flex-row lg:space-y-0 lg:justify-between lg:items-center lg:p-1">
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
                                @if (Auth::user()->user_role->branch_creation == 1)
                                    <option value="add_new">+ Add New Branch</option>
                                @endif
                                @foreach ($all_active_branches as $branch_name)
                                    <option value={{ $branch_name->branch_name }}>
                                        {{ capitalizeFirstLetter($branch_name->branch_name) }}</option>
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
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

                            <!-- Custom dropdown menu -->
                            <div id="dropdownMenu"
                                class="hidden absolute z-10 w-full bg-white border rounded-lg mt-1 shadow-lg lg:text-xs">
                                <ul class="py-1 px-8 lg:px-4 lg:text-xs">
                                    @if (Auth::user()->user_role->branch_creation == 1)
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value="add_new" id="addBranchButton">+ Add New Branch</li>
                                    @endif
                                    @foreach ($all_active_branches as $branch_name)
                                        <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b lg:text-xs"
                                            data-value={{ $branch_name->branch_name }}>
                                            {{ capitalizeFirstLetter($branch_name->branch_name) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Search Bar -->
                    <div class="w-full text-sm lg:text-xs lg:w-5/12">
                        <input type="text" id="searchCenter" placeholder="Search Center..."
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                    </div>
                    <!-- Add Center Button -->
                    <div class="w-full text-sm lg:text-xs lg:w-3/12">
                        @if (Auth::user()->user_role->centers == 2 || Auth::user()->user_role->centers == 3)
                            <button id="addCenterButton" value="add_new"
                                class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                                + Add Center
                            </button>
                        @endif
                    </div>
                </div>

                <p class="text-center text-xs my-2 text-gray-400 lg:hidden">Total Centers
                    {{ str_pad($all_active_centers->count(), 2, '0', STR_PAD_LEFT) }}</p>

                <!-- Centers Grid card format hidden for lg screens -->
                <div id="centersGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:hidden gap-4 p-2">
                    @foreach ($all_active_centers as $center)
                        <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100 hover:bg-blue-200"
                            data-center="Malwaragoda">
                            <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                <div class="text-xs text-gray-600 text-right">
                                    {{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-sm">{{ capitalizeFirstLetter($center->center_name) }}</div>
                                <div class="text-xs flex items-center space-x-1 text-gray-700">
                                    <p>CM - </p>
                                    <p>{{ capitalizeEachWord($center->manager_name) }}</p>
                                </div>
                                <div class="text-xs flex items-center space-x-1 text-gray-700">
                                    <p>PDay - </p>
                                    <p>{{ capitalizeFirstLetter($center->payment_date) }}</p>
                                </div>
                            </div>
                            <div
                                class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">
                                GROUPS {{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}</div>
                        </div>
                    @endforeach

                </div>

                <!-- Centers Grid Table format hidden for mobile screens -->
                <div class="flex justify-start h-full pt-2">
                    <div id="centersGridTable"
                        class="w-full max-h-[calc(100vh-200px)]  hidden lg:block p-0 overflow-y-auto ">
                        <div class="min-w-full h-full">
                            <table class="w-full min-w-max">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-100 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="pl-2 text-left">
                                            <!--<input type="checkbox" id="select-all"
                                                                                                class="form-checkbox h-4 w-4 text-blue-400 m-1">-->
                                        </th>
                                        <th class="py-2 px-2 text-left">#</th>
                                        <th class="py-2 text-left">Center Name</th>
                                        <th class="py-2 text-left">Groups</th>
                                        <th class="py-2 text-left">Center Manager</th>
                                        <th class="py-2 text-left">Payment Day</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-xs font-light bg-white">
                                    @foreach ($all_active_centers as $center)
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg  view-details"
                                            data-branch-name={{ capitalizeFirstLetter($center->branch->branch_name) }}
                                            data-center-name="{{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }} {{ capitalizeFirstLetter($center->center_name) }}"
                                            data-manager="{{ capitalizeEachWord($center->manager_name) }}"
                                            data-groups={{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}
                                            data-members={{ str_pad($count_total_members, 2, '0', STR_PAD_LEFT) }}
                                            data-payment-day={{ capitalizeFirstLetter($center->payment_date) }}
                                            data-groups-array='@json($center->group)'>
                                            <td class="pl-2 text-left">
                                                <!--<input type="checkbox" name="selected_ids[]" value="1"
                                                                                                    class="form-checkbox h-4 w-4 text-blue-600 m-1">-->
                                            </td>
                                            <td class="py-2 text-left"> {{ str_pad($center->id, 3, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td class="py-2 text-left"> {{ capitalizeFirstLetter($center->center_name) }}
                                            </td>
                                            <td class="py-2 text-left">
                                                {{ str_pad($center->group->count(), 2, '0', STR_PAD_LEFT) }}</td>
                                            <td class="py-2 text-left"> {{ capitalizeEachWord($center->manager_name) }}
                                            </td>
                                            <td class="py-2 text-left"> {{ capitalizeFirstLetter($center->payment_date) }}
                                            </td>
                                            <td class="py-2 text-center flex justify-center items-center gap-1">
                                                <a href="{{ route('center.summary', $center->id) }}"
                                                    class="border rounded hover:bg-green-500">
                                                    <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye"
                                                        class="h-3 w-3 m-1">
                                                </a>
                                                <a href="{{ route('center.summary', $center->id) }}"
                                                    class="border rounded hover:bg-sky-500">
                                                    <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
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

                <div class="hidden mt- mx-4 lg:flex justify-between items-center text-xs text-gray-500">
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
                <h1 id="branchNameExpand" class="text-md font-medium text-gray-800 mb-4"></h1>
                <div class="grid grid-cols-2 gap-y-2">
                    <div>
                        <p for="Cname" class="text-xs text-gray-400">Center Name</p>
                        <p id="Cname" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="Cmanager" class="text-xs text-gray-400">Center Manager</p>
                        <p id="Cmanager" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="Tgroup" class="text-xs text-gray-400">Total Groups</p>
                        <p id="Tgroup" class="text-sm"></p>
                    </div>
                    <div>
                        <p for="TMembers" class="text-xs text-gray-400">Total Members</p>
                        <p id="TMembers" class="text-sm mt-0"></p>
                    </div>
                </div>
            </div>
            <div class="p-4 space-y-4 h-full">
                <div id="groupList" class="space-y-2 flex flex-col justify-start">
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
        document.getElementById('searchCenter').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            // Mobile view (cards)
            const cards = document.querySelectorAll('#centersGrid > div');
            cards.forEach(card => {
                const centerName = card.getAttribute('data-center').toLowerCase();
                card.style.display = centerName.includes(searchTerm) ? 'block' : 'none';
            });

            // Web view (table rows)
            const tableRows = document.querySelectorAll('#centersGridTable tbody tr');
            tableRows.forEach(row => {
                const centerName = row.getAttribute('data-center-name').toLowerCase();
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

        // Row Summey
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
                const branchName = row.getAttribute('data-branch-name');
                const centerName = row.getAttribute('data-center-name');
                const manager = row.getAttribute('data-manager');
                const groups = row.getAttribute('data-groups');
                const members = row.getAttribute('data-members');
                const paymentDay = row.getAttribute('data-payment-day');
                document.getElementById('branchNameExpand').textContent = branchName;
                document.getElementById('Cname').textContent = centerName;
                document.getElementById('Cmanager').textContent = manager;
                document.getElementById('Tgroup').textContent = groups;
                document.getElementById('TMembers').textContent = members;
                const groupsArray = JSON.parse(row.getAttribute('data-groups-array'));
                console.log(groupsArray);
                const groupList = document.getElementById('groupList');
                groupList.innerHTML = ''; // Clear existing

                groupsArray
                    .filter(group => group.status === 'ACTIVE') // ✅ only active groups
                    .forEach(group => {
                        const groupId = String(group.id).padStart(2, '0');

                        const html = `
        <div class="flex justify-between items-center bg-sky-50 border rounded-lg">
            <span class="text-xs font-medium text-gray-600 p-2">${group.group_name}</span>
            <span class="text-xs font-medium text-gray-800 bg-gray-200 p-2 px-8 rounded-lg">${group.member.length}</span>
            <div class="font-medium text-gray-800 px-2 text-xs flex space-x-1">
                <a href="/groupSummary/${groupId}" class="border rounded hover:bg-green-500">
                    <img src="/assets/icons/Eye.svg" alt="Eye" class="h-3 w-3 m-1">
                </a>

            </div>
        </div>
        `;
                        groupList.insertAdjacentHTML('beforeend', html);
                    });


            });
        });
        /* <a href="#" class="border rounded hover:bg-red-500">
                            <img src="/assets/icons/Trash.svg" alt="Trash" class="h-3 w-3 m-1">
                        </a> */
        //Centers
        document.getElementById('addCenterButton').addEventListener('click', () => {

            if (window.innerWidth >= 1024) {
                document.getElementById('addCenterModal').classList.remove('hidden');
                document.getElementById('addCenterModal').classList.add('flex');
                document.getElementById('RowDetails').classList.add('hidden');

                const centersColumn = document.getElementById('centersColumn');
                const firstColumn = document.getElementById('firstColumn');

                // Show second column
                centersColumn.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                centersColumn.classList.add('lg:flex');
            } else {
                // For mobile view, just show the modal
                document.getElementById('addCenterModal').classList.remove('hidden');
                document.getElementById('addCenterModal').classList.add('flex');
            }

        });

        //Branches
        document.getElementById('addBranchButton').addEventListener('click', () => {
            // Handle Add Branch button
            if (window.innerWidth >= 1024) {
                document.getElementById('addBranchModal').classList.remove('hidden');
                document.getElementById('addBranchModal').classList.add('flex');
                document.getElementById('RowDetails').classList.add('hidden');

                const branchesColumn = document.getElementById('branchesColumn');
                const centersColumn = document.getElementById('centersColumn');
                const firstColumn = document.getElementById('firstColumn');

                // Show second column
                branchesColumn.classList.remove('hidden');
                centersColumn.classList.add('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                branchesColumn.classList.add('lg:flex');
            } else {
                // For mobile view, just show the modal
                document.getElementById('addBranchModal').classList.remove('hidden');
                document.getElementById('addBranchModal').classList.add('flex');
            }

        });

        // Handle Cancel buttons
        document.getElementById('cancelBranch').addEventListener('click', () => {
            document.getElementById('addBranchModal').classList.add('hidden');
            hideAllSecondColumns();
        });

        document.getElementById('cancelCenter').addEventListener('click', () => {
            document.getElementById('addCenterModal').classList.add('hidden');
            hideAllSecondColumns();
        });

        // Hide column buttons
        document.getElementById('hideCentersColumn').addEventListener('click', () => {
            hideAllSecondColumns();
        });

        document.getElementById('hideBranchesColumn').addEventListener('click', () => {
            hideAllSecondColumns();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const centerModal = document.getElementById('addCenterModal');

            // Show modal if validation failed
            if (window.showCreateCenterPopup === true && centerModal) {
                centerModal.classList.remove('hidden');
                centerModal.classList.add('flex');
                console.log('Center modal reopened after validation error');
            }

            // Show modal on open button (if applicable)
            const addNewCenterButton = document.getElementById('addNewCenterButton');
            if (addNewCenterButton) {
                addNewCenterButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    centerModal.classList.remove('hidden');
                    centerModal.classList.add('flex');
                });
            }

            // Hide modal on cancel
            const cancelCenterButton = document.getElementById('cancelCenter');
            if (cancelCenterButton) {
                cancelCenterButton.addEventListener('click', function() {
                    centerModal.classList.add('hidden');
                    centerModal.classList.remove('flex');
                    document.getElementById('addNewCenterForm').reset();
                });
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

        /* Ensure first column takes full width when second columns are hidden */
    </style>
@endsection
