@extends('layouts.layout')
@php
    require_once resource_path('libs/first_letter_capitalization.php');
    require_once resource_path('libs/every_word_first_letter_capitalization.php');
@endphp
@section('contents')
    <div id="mainContent" class="flex h-screen">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--Mobile Cards and Table View-->
        <div id="firstColumn" class="w-full h-full p-2 lg:border-r lg:p-4 transition-all duration-300 lg:relative lg:py-4">

            <!--Modal-->
            <div id="addRoleModal"
                class="inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 lg:absolute fixed px-4 py-2 overflow-y-auto"
                style="width: 100%; height: 100%;">
                <div class="bg-white shadow-xl w-full max-w-4xl rounded-lg p-0 h-full sm:h-max pb-2">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4 ">Create New Role</h2>
                    <form action="{{ route('userRoles.create') }}" method="POST" class="w-full">
                        <div class="bg-white rounded-b-lg p-4 space-y-4 w-full ">
                            @csrf
                            <!-- Role name -->
                            <div class="grid grid-cols-1  gap-2 w-full ">
                                <div class="flex w-full">
                                    <label class=" text-xs text-gray-500 mb-1 ml-1 w-1/3">Role Name*</label>
                                    <input type="text" placeholder="Admin" class="w-2/3 p-2 border rounded-lg text-sm "
                                        name="role_name" required>
                                </div>
                                <div class="flex w-full">
                                    <label class=" text-xs text-gray-500 mb-1 ml-1 w-1/3">Descriptions*</label>
                                    <textarea rows="2" placeholder="Descriptions ......" class="w-2/3 p-2 border rounded-lg text-sm resize-none"
                                        name="description" required></textarea>
                                </div>
                            </div>

                            <!-- Permissions Title -->
                            <div class="pt-1">
                                <div class="text-sm font-medium text-gray-600 mb-2 flex items-center justify-between">
                                    <span>Permissions</span>
                                    <a href="#" class="text-blue-600 hover:underline text-xs">(Fill this all)</a>
                                </div>

                                <!-- Permissions Grid -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                                    @php
                                        $modules = [
                                            'Dashboard',
                                            'Branch Creation',
                                            'User Accounts Creation ',
                                            'User Roles Creation ','Income', 'Payments', 'Reports','Loans','User Logs'
                                        ];

                                        $modulesMultiple = ['Centers', 'Groups','Members' ];

                                    @endphp
                                    @foreach ($modules as $module)
                                        <div
                                            class="flex items-center justify-between border p-2 py-1 rounded-md bg-gray-100 mb-2">
                                            <span class="text-xs text-gray-700 rounded-md w-1/3">{{ $module }}</span>
                                            <select name="permissions[{{ $module }}]"
                                                class="rounded-md py-0.5 text-xs bg-gray-800 text-white w-2/3" required>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>

                                            </select>
                                        </div>
                                    @endforeach
                                    @foreach ($modulesMultiple as $module)
                                        <div
                                            class="flex items-center justify-between border p-2 py-1 rounded-md bg-gray-100 mb-2">
                                            <span class="text-xs text-gray-700 rounded-md w-1/3">{{ $module }}</span>
                                            <select name="permissions[{{ $module }}]"
                                                class="rounded-md py-0.5 text-xs bg-gray-800 text-white w-2/3" required>
                                                <option value="0">None</option>
                                                <option value="1">View</option>
                                                <option value="2">View+Edit</option>
                                                <option value="3">View+Edit+Delete</option>
                                            </select>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="flex justify-end space-x-4 pt-2">
                                <button id="cancelRole" type="button"
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


            <!--Start Table and Mobile Card Views-->
            <div class="p-0 border-0 lg:py-2 lg:bg-sky-50 lg:border rounded-lg flex flex-col h-full">
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
                        <!-- Search Bar -->
                        <div class="w-full text-sm lg:text-xs lg:w-full">
                            <input type="text" id="search" placeholder="Search ..."
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" />
                        </div>
                    </div>
                    <!--Export Button-->
                    <div id="dateFilter"
                        class="flex flex-col lg:flex-row w-full justify-end lg:space-x-2 space-y-2 lg:space-y-0 lg:w-2/6">
                        <div class="w-full text-sm lg:text-xs lg:w-36">
                            <button id="addRoleButton" value=""
                                class="w-full bg-blue-600 text-white p-2 lg:p-1.5 rounded-lg hover:bg-blue-700 focus:outline-none flex justify-center px-4">
                                + Create New Role
                            </button>
                        </div>

                    </div>
                </div>
                <!--End Top Bar-->

                <!-------------CARD------------------------------------------------------------------------------------------------------------>
                <!-- User Grid card format hidden for lg screens -->
                <div id="userGrid" class="grid grid-cols-1 sm:grid-cols-1 lg:hidden gap-4 p-2 pt-4">
                    @foreach ($all_active_user_roles as $user_role)
                        <!-- Card -->
                        <div class="rounded-lg shadow-sm border border-gray-200 p-4 pt-2 bg-gray-100 w-full space-y-2 text-xs"
                            data-role="Admin">
                            <div class="flex justify-between items-center border-b pb-2">
                                <div class="flex flex-col space-y-0">
                                    <p class="font-semibold text-gray-700 text-lg">
                                        {{ capitalizeEachWord($user_role->role_name) }}
                                    </p>
                                </div>
                                <div class="flex flex-col space-y-0">
                                    <p class="font-semibold text-gray-700 text-lg bg-white px-2 rounded-md">05</p>
                                </div>
                            </div>
                            <!--Actions-->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pt-1 w-full">
                                <div class="flex justify-between items-center text-sm space-x-2 w-full">
                                    <a href="#"
                                        class="border rounded-lg hover:bg-blue-700 bg-blue-600 flex-shrink-0 edit-user px-4 py-1 text-white w-1/2 text-center">
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="border rounded-lg hover:bg-red-700 bg-red-600 flex-shrink-0 delete-user px-4 py-1 text-white w-1/2 text-center">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-------------TABLE------------------------------------------------------------------------------------------------------------>
                <!-- Centers Grid Table format hidden for mobile screens -->
                <div class="flex-1">
                    <div id="userTable" class="w-full overflow-y-auto border-t" style="max-height: calc(100vh - 200px);">
                        <div class="min-w-full">
                            <table class="w-full">
                                <thead class="w-full text-gray-700 text-xs font-light bg-gray-200 sticky top-0">
                                    <tr class="uppercase w-full">
                                        <th class="py-2 pl-8 text-left w-1/3">Role</th>
                                        <th class="py-2 text-center w-1/2">Active Users</th>
                                        <th class="py-2 text-center w-40">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-800 text-xs font-light bg-white">
                                    @foreach ($all_active_user_roles as $user_role)
                                        <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg view-details"
                                            data-userrole='@json($user_role)'
                                            data-role-name="{{ capitalizeEachWord($user_role->role_name) }}">
                                            <td class="py-2 pl-8 text-left">
                                                {{ capitalizeEachWord($user_role->role_name) }}
                                            </td>
                                            <td class="py-2 text-center">
                                                {{ str_pad(
                                                    $user_role->users->filter(function ($user) {
                                                            return $user->status === 'ACTIVE';
                                                        })->count(),
                                                    2,
                                                    '0',
                                                    STR_PAD_LEFT,
                                                ) }}
                                            </td>
                                            <td class="py-2 text-center">
                                                <div class="flex justify-center items-center gap-1">
                                                    <a href="#"
                                                        class="border rounded hover:bg-blue-700 flex-shrink-0 edit-user"
                                                        data-id="001">
                                                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}"
                                                            alt="Edit" class="h-3 w-3 m-1">
                                                    </a>
                                                    {{-- <a href="#"
                                                        class="border rounded hover:bg-red-500 flex-shrink-0 delete-user">
                                                        <img src="{{ asset('assets/icons/Trash.svg') }}" alt="Delete"
                                                            class="h-3 w-3 m-1">
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mx-4 lg:flex justify-between items-center text-xs text-gray-500">
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
            <!--01 ROW-->
            <div class="bg h-1/6 border-b p-4 overflow-y-scroll">
                <div class="flex space-x-2 items-center">
                    <h1 id="RoleNameSlideBar" class="text-lg font-medium text-gray-800"></h1>
                    <h1 id="RoleNameIdSlideBar" class="hiddem"></h1>
                    <!--Pencil-->
                    <a href="#" class="border rounded hover:bg-green-500">
                        <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-y-2 mt-2">
                    <div>
                        <p for="memberAddress" class="text-xs text-gray-400">Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Et sed ullam laudantium tempora distinctio veniam natus earum,</p>
                    </div>
                </div>
            </div>
            <!--02 ROW-->
            <div class="bg h-2/6 overflow-y-scroll border-b">
                <div class="px-4 w-full h-1/8 overflow-y-auto">
                    <div class="flex justify-between items-center">
                        <h1 class="text-sm font-medium text-gray-700 py-2">Users</h1>
                        <h1 id="usersCount"
                            class="text-sm font-medium text-gray-700 rounded-md bg-gray-100 p-1 px-8 border"></h1>
                    </div>
                    <div id="usersList" class="grid grid-cols-1 gap-y-2 pt-2">

                    </div>
                </div>
            </div>
            <!--03 ROW-->
            <div class="bg- h-2/6 overflow-y-scroll border-b pt-2">
                <div class="px-4 w-full">
                    <h1 class="text-sm font-medium text-gray-700 mb-1">Permissions</h1>
                </div>
                <!-- Permissions Cards Grid -->
                <div id="userRoleList" class="grid grid-cols-1 gap-y-2 py-2 p-4">

                </div>
            </div>
            <!--04 ROW-->
            <div class="bg-white h-0.5/6 flex justify-start items-start px-4 pb-4">
                <div class="w-full text-sm lg:text-xs ">
                    <button id="ViewFullDetail" value=""
                        class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Helper function to hide all second columns
        function hideAllSecondColumns() {
            const columns = ['RowDetails', 'centersColumn', 'branchesColumn'];
            columns.forEach(col => document.getElementById(col).classList.add('hidden'));

            document.getElementById('firstColumn').classList.remove('lg:w-8/12');
            document.getElementById('firstColumn').classList.add('lg:w-full');
        }

        // Row Summary
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const row = button.closest('tr');
                const userRole = JSON.parse(row.getAttribute('data-userrole'));
                const userRoleName = row.getAttribute('data-role-name');
                const RowDetails = document.getElementById('RowDetails');
                const firstColumn = document.getElementById('firstColumn');
                const usersCount = document.getElementById('usersCount');
                console.log(userRole);
                // Show second column
                document.getElementById('RoleNameSlideBar').textContent = userRoleName;
                document.getElementById('RoleNameIdSlideBar').textContent = userRole.id;
                const userRoleList = document.getElementById('userRoleList');
                const usersList = document.getElementById('usersList');
                usersList.innerHTML = '';
                userRoleList.innerHTML = '';
                const binaryPermissions = [
                    'dashboard',
                    'branch_creation',
                    'user_accounts_creation',
                    'user_role_creation',
                    'income',
                    'payments',
                    'reports',
                    'user_logs',
                    'loans'
                ];

                const multiLevelPermissions = [
                    'centers',
                    'groups',
                    'members'
                ];

                // Label maps
                const binaryLabels = {
                    0: 'No',
                    1: 'Yes'
                };

                const multiLabels = {
                    0: 'None',
                    1: 'View',
                    2: 'View+Edit',
                    3: 'View+Edit+Delete'
                };
                usersCount.textContent = userRole.users.filter(user => user.status === 'ACTIVE').length ??
                    00;
                if (userRole.users.length > 0) {
                    userRole.users.filter(user => user.status === 'ACTIVE').forEach((user) => {
                        const html = ` <div
                            class="w-full bg-gray-100 border flex justify-start items-center py-1.5 px-4 rounded-md space-x-2 h-10">
                            <div class="bg-black rounded-full h-6 w-6 flex-shrink-0"></div>
                            <span class="truncate text-xs text-gray-700">${user.first_name} ${user.last_name}</span>
                        </div>`;
                        usersList.insertAdjacentHTML('beforeend', html);
                    })
                }


                // Render binary permission cards
                binaryPermissions.forEach((key) => {
                    const value = userRole[key];
                    const label = binaryLabels[value] ?? 'Unknown';

                    const html = `
  <div class="w-full bg-gray-100 border flex justify-between items-center py-1.5 px-4 rounded-md space-x-2 h-10">
    <span class="truncate text-xs text-gray-700 w-1/3 capitalize">${key.replace(/_/g, ' ')}</span>
    <div class="relative w-2/3 h-full">
      <select name="${key}" data-key="${key}" class="permission-select w-full h-full px-3 py-1 text-xs rounded-md bg-white border focus:outline-none">
        ${Object.entries(binaryLabels).map(([k, v]) => `
                              <option value="${k}" ${parseInt(value) === parseInt(k) ? 'selected' : ''}>${v}</option>
                            `).join('')}
      </select>
    </div>
  </div>
`;


                    userRoleList.insertAdjacentHTML('beforeend', html);
                });

                // Render multi-level permission cards
                multiLevelPermissions.forEach((key) => {
                    const value = userRole[key];
                    const label = multiLabels[value] ?? 'Unknown';

                    const html = `
  <div class="w-full bg-gray-100 border flex justify-between items-center py-1.5 px-4 rounded-md space-x-2 h-10">
    <span class="truncate text-xs text-gray-700 w-1/3 capitalize">${key.replace(/_/g, ' ')}</span>
    <div class="relative w-2/3 h-full">
      <select name="${key}" data-key="${key}" class="permission-select w-full h-full px-3 py-1 text-xs rounded-md bg-white border focus:outline-none">
        ${Object.entries(multiLabels).map(([k, v]) => `
                              <option value="${k}" ${parseInt(value) === parseInt(k) ? 'selected' : ''}>${v}</option>
                            `).join('')}
      </select>
    </div>
  </div>
`;


                    userRoleList.insertAdjacentHTML('beforeend', html);
                });



                RowDetails.classList.remove('hidden');
                firstColumn.classList.remove('lg:w-full');
                firstColumn.classList.add('lg:w-8/12');
                RowDetails.classList.add('lg:flex');
            });
        });

        // Dropdown initialization
        document.querySelectorAll('.dropdown-trigger').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdownId = this.getAttribute('data-target');
                const dropdownMenu = document.getElementById(dropdownId);
                dropdownMenu.classList.toggle('hidden');
            });
        });

        function selectOption(dropdownId, value, bgColor) {
            const selectedOption = document.getElementById(`selected-option-${dropdownId.split('-')[1]}`);
            const trigger = document.querySelector(`[data-target="${dropdownId}"]`);
            selectedOption.textContent = value;
            trigger.className =
                'bg-gray-800 rounded-md h-full w-full flex justify-between items-center px-3 py-1 cursor-pointer';
            trigger.classList.add(bgColor);
            document.getElementById(dropdownId).classList.add('hidden');
            console.log('Selected option:', value, 'with background:', bgColor, 'for dropdown:', dropdownId);
        }
        document.getElementById('ViewFullDetail').addEventListener('click', async (e) => {
            e.preventDefault();

            const roleName = document.getElementById('RoleNameSlideBar').textContent;
            const id = document.getElementById('RoleNameIdSlideBar').textContent;
            const selects = document.querySelectorAll('.permission-select');

            const data = {};
            selects.forEach(select => {
                const key = select.getAttribute('data-key');
                const value = select.value;
                data[key] = value;
            });

            // Include role name or role ID if needed
            data['role_name'] = roleName;
            data['id'] = id;
            try {
                const response = await fetch('/userRole/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.status === 'success') {
                    alert('Permissions updated successfully!');
                } else {
                    alert('Update failed.');
                }
            } catch (err) {
                console.error(err);
                alert('An error occurred.');
            }
        });

        //Modle
        document.getElementById('addRoleButton').addEventListener('click', () => {
            document.getElementById('addRoleModal').classList.remove('hidden');
            document.getElementById('addRoleModal').classList.add('flex');
        });

        document.getElementById('cancelRole').addEventListener('click', () => {
            document.getElementById('addRoleModal').classList.add('hidden');
            document.getElementById('addRoleModal').classList.remove('flex');
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
        #mainContent {
            height: 100vh;
            overflow: hidden;
        }

        #firstColumn {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        #userTable {
            flex: 1 1 auto;
            overflow-y: auto;
        }
    </style>
@endsection
