@extends('layouts.mainLayout')

@section('content')

<div class="flex h-screen w-screen bg-white">

    <div class="hidden md:flex">

        <!-- Sidebar (Hidden on Mobile by Default) -->
        <aside id="sidebar" class="w-52 bg-gray-64 border-r transition-all duration-300 md:block ">
            <div class="p-4 flex flex-col justify-between h-full">
                <!-- Sidebar Menu -->
                <div class="pb-4 flex items-center justify-center">
                    <img src="{{ asset('assets/images/Logo.png') }}" alt="Company Logo" class="h-8 w-24 rounded-full full-logo">
                    <img src="{{ asset('assets/images/SmallLogo.png') }}" alt="Small Company Logo" class="h-8 w-8 rounded-full small-logo hidden">
                </div>
                <!-- Sidebar Navigation -->
                <nav class="h-full overflow-hidden pt-0">
                    <ul class="space-y-2 content-start min-h-full  overflow-hidden text-xs">
                        <!-- Dashboard -->
                        <li>
                            <a href="#" class="flex items-center p-2 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2 active:bg-gray-200">
                                <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4 ">
                                <span class="sidebar-text">Dashboard</span>
                            </a>
                        </li>
                        <!-- Branches (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-gray-100 active:bg-gray-200 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/Users.svg') }}" alt="Branches Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Branches</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Branches -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                                <li>
                                    <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/MapPinLine.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Centers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/Users.svg') }}" alt="Members Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Members</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/Timer.svg') }}" alt="Recently Added Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Recently Added</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/IdentificationBadge.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Member Summery</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Income (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-gray-100 active:bg-gray-200 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/CurrencyDollar.svg') }}" alt="Income Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Income</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Income -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Report Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Income Report</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/CurrencyCircleDollar.svg') }}" alt="Collections Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Collections</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/pay01.svg') }}" alt="Under Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Under Payments Added</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payments (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-gray-100 active:bg-gray-200 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Payments</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Payments -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Pending</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/MinusCircle.svg') }}" alt="No Paid Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">No Paid</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Reports (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-gray-100 active:bg-gray-200 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/IdentificationCard.svg') }}" alt="Reports Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Reports</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Reports -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/ChartBarHorizontal.svg') }}" alt="Lone Issue Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Lone Issue</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Income</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Pending Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/Lockers.svg') }}" alt="Center Managers Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Center Managers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/UserGear.svg') }}" alt="Member Managers Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Member Managers</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-gray-100 active:bg-gray-200 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Settings</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Settings -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/UserSwitch.svg') }}" alt="User Account Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">User Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100 active:bg-gray-200">
                                        <img src="{{ asset('assets/icons/UserList.svg') }}" alt="User Logs Icon" class="h-4 w-4">
                                        <span class="sidebar-text-mini">User Logs</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- User Avatar -->
                <div class="h-12 px-2 content-end sidebar-toggle">
                    <div class="flex items-center space-x-2 border border-blue-300 rounded-full text-small username ">
                        <img src="{{ asset('icons/Users.png') }}" alt="User Avatar" class=" h-6 w-6 rounded-full bg-blue-800 border border-blue-300">
                        <span class="text-xs sidebar-text">Dunura Hansaja</span>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <div class="h-full w-full">

        <!-- Mobile Dropdown (Hidden by Default) -->
        <div id="mobileSidebar" class="absolute max-h-fit top-16 bottom-5 mac-h-1/2 w-60 inset-0 shadow md:hidden hidden ml-4 mt-2 rounded-xl bg-gray-200">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4 ">
                    <div class="text-xl font-bold ">Company Name</div>
                    <button id="closeMobileMenu" class="text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="  ">
                    <ul class="space-y-1 min-h-full  overflow-y-scroll  scrollbar-hide scroll-smooth">

                        <!-- Dashboard -->
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 w-full rounded-lg hover:bg-gray-50 sidebar-toggle space-x-2">
                                <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4 ">
                                <span class="sidebar-text">Dashboard</span>
                            </a>
                        </li>
                        <!-- Branches (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/Users.svg') }}" alt="Branches Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Branches</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Branches -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-44">
                                <li>
                                    <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/MapPinLine.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Centers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/Users.svg') }}" alt="Members Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Members</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/Timer.svg') }}" alt="Recently Added Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Recently Added</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/IdentificationBadge.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Member Summery</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Income (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/CurrencyDollar.svg') }}" alt="Income Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Income</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Income -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Report Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Income Report</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/CurrencyCircleDollar.svg') }}" alt="Collections Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Collections</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/pay01.svg') }}" alt="Under Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Under Payments Added</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payments (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Payments</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Payments -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Pending</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/MinusCircle.svg') }}" alt="No Paid Icon" class="h-4 w-4">
                                        <span class="sidebar-text">No Paid</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Reports (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/IdentificationCard.svg') }}" alt="Reports Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Reports</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Reports -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/ChartBarHorizontal.svg') }}" alt="Lone Issue Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Lone Issue</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Income</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Payments Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Pending Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/Lockers.svg') }}" alt="Center Managers Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Center Managers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/UserGear.svg') }}" alt="Member Managers Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Member Managers</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings (with Submenu) -->
                        <li>
                            <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                                    <span class="sidebar-text">Settings</span>
                                </div>
                                <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Submenu for Settings -->
                            <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-44">
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/UserSwitch.svg') }}" alt="User Account Icon" class="h-4 w-4">
                                        <span class="sidebar-text">User Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                                        <span class="sidebar-text">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/UserList.svg') }}" alt="User Logs Icon" class="h-4 w-4">
                                        <span class="sidebar-text">User Logs</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!----------------------------------------------------------------------------------------------------------->
        <!-- Main Content -->
        <main class="flex-1  md:flex flex-col w-full h-full md:p-0">
            <!-- Topbar -->
            <header class=" bg-gray-200 border-b p-4 flex justify-between items-center md:p-4 md:space-x-4 md:bg-white">
                <!-- Hamburger Menu Icon(Mobile) -->
                <button id="mobileMenuButton" class="md:hidden text-gray-600 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <!-- Logo -->
                <div class="text-xl font-bold hidden">Company Name</div>

                <!--  Icon -->
                <button id="sidebarToggleButton" class="text-gray-600 pr-4 hidden md:block">
                    <img src="{{ asset('assets/icons/Sidebar.svg') }}" alt="Sidebar Icon" class="h-5 w-5">
                </button>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 mx-4 text-xs">
                    <div class="relative w-11/12 ">
                        <input type="text" placeholder="Search..." class="w-full px-4 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  bg-gray-50">
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 pr-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2.828-4.828A7.962 7.962 0 0018 10a8 8 0 10-8 8c1.657 0 3.175-.51 4.414-1.414l4.586 4.586z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Notifications and User -->
                <div class="flex items-center space-x-4 md:space-x-6 pr-4 ">
                    <!-- Notifications Icon -->
                    <button class="text-gray-600 hidden md:block">
                        <img src="{{ asset('assets/icons/ClockCounterClockwise.svg') }}" alt="Sidebar Icon" class="h-5 w-5">
                    </button>
                    <!-- Notifications Icon -->
                    <button class="text-gray-600">
                        <img src="{{ asset('assets/icons/Bell.svg') }}" alt="Sidebar Icon" class="h-5 w-5">
                    </button>
                    <!-- User Avatar -->
                    <div class="flex items-center space-x-2 md:hidden">
                        <img src="{{ asset('images/user.png') }}" alt="User Avatar" class="h-7 w-7 rounded-full bg-blue-900">
                        <span class="hidden">Dunura Hansaja</span>
                    </div>
                </div>
            </header>

            <div class="flex md:h-full">
                <div class="w-full md:w-8/12 h-full p-2 md:border-r md:p-4">
                    <div class="p-0 border-0  md:py-2 md:bg-sky-50 md:border rounded-lg flex flex-col justify-between h-full ">
                        <!-- Top Menu -->
                        <div class="flex flex-col w-full space-y-2 p-2 md:px-2 text-md md:flex md:flex-row md:space-y-0 md:justify-between md:items-center md:p-1">
                            <!-- Filter Button -->
                            <div class="hidden md:flex text-sm ">
                                <button value="" class=" bg-white p-2 rounded-lg focus:outline-none border  w-8">
                                    <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4">
                                </button>
                            </div>
                            <!-- Branch Selector and Add Center Button -->
                            <div class="  flex flex-col md:flex-row justify-between items-center w-full md:justify-normal md:items-baseline md:w-3/12 ">
                                <div class="w-full md:mb-0 relative text-sm ">
                                    <!-- Hidden native select for form submission -->
                                    <select id="branchSelect" name="branch" class="w-full absolute p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white appearance-none hidden text-sm md:text-xs">
                                        <option class="text-sm" value="">Select Branch</option>
                                        <option value="add_new">+ Add New Branch</option>
                                        <option value="balangoda">Balangoda</option>
                                        <option value="ella">Ella</option>
                                        <option value="badulla">Badulla</option>
                                        <option value="colombo">Colombo</option>
                                    </select>

                                    <!-- Custom dropdown trigger -->
                                    <div id="dropdownTrigger" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white cursor-pointer flex items-center justify-between md:text-xs" onclick="toggleDropdown()">
                                        <span id="selectedOption">Select Branch</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>

                                    <!-- Custom dropdown menu -->
                                    <div id="dropdownMenu" class="hidden absolute z-10 w-full  bg-white border rounded-lg mt-1 shadow-lg  md:text-xs">
                                        <ul class="py-1 px-8 md:px-4 md:text-xs">
                                            <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b md:text-xs" data-value="add_new">+ Add New Branch</li>
                                            <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b md:text-xs" data-value="balangoda">Balangoda</li>
                                            <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b md:text-xs" data-value="ella">Ella</li>
                                            <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b md:text-xs" data-value="badulla">Badulla</li>
                                            <li class="px-4 py-2 text-sm text-center hover:bg-gray-100 cursor-pointer border-b md:text-xs" data-value="colombo">Colombo</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Bar -->
                            <div class="w-full text-sm  md:text-xs md:w-5/12 ">
                                <input type="text" id="searchCenter" placeholder="Search Center..." class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white " />
                            </div>

                            <!-- Add Center Button -->
                            <div class="w-full text-sm md:text-xs md:w-3/12  ">
                                <button value="add_new" class="w-full bg-blue-600 text-white  p-2  rounded-lg hover:bg-blue-700 focus:outline-none ">
                                    + Add Center
                                </button>
                            </div>
                        </div>
                        <!--END Top Menu -->

                        <p class="text-center text-xs my-2 text-gray-400 md:hidden">Total Centers 10</p>

                        <!-- Centers Grid card format hidden for lg screens-->
                        <div id="centersGrid" class="grid grid-cols-2 sm:grid-cols-2 md:hidden gap-4 p-2">
                            <!-- Center Card 1 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100 hover:bg-blue-200" data-center="Malwaragoda">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">002</div>
                                    <div class="text-sm">Malwaragoda</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Tuesday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Tuesday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 04</div>
                            </div>

                            <!-- Center Card 2 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100" data-center="Malwaragoda">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">002</div>
                                    <div class="text-sm">Malwaragoda</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Tuesday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Tuesday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 04</div>
                            </div>

                            <!-- Center Card 3 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100" data-center="Colombo">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">003</div>
                                    <div class="text-sm">Colombo</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Wednesday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Wednesday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 05</div>
                            </div>

                            <!-- Center Card 4 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100" data-center="Badulla">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">004</div>
                                    <div class="text-sm">Badulla</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Monday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Monday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 06</div>
                            </div>

                            <!-- Center Card 5 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100" data-center="Ella">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">005</div>
                                    <div class="text-sm">Ella</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Friday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Friday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 03</div>
                            </div>

                            <!-- Center Card 6 -->
                            <div class="rounded-lg shadow flex flex-col justify-between w-full bg-blue-100" data-center="Balangoda">
                                <div class="h-24 py-2 px-4 flex flex-col justify-between space-y-1">
                                    <div class="text-xs text-gray-600 text-right">006</div>
                                    <div class="text-sm">Balangoda</div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Thursday</p>
                                    </div>
                                    <div class="text-xs flex items-center space-x-1 text-gray-700">
                                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                        <p>Thursday</p>
                                    </div>
                                </div>
                                <div class="h-8 flex items-center justify-center text-sm font-semibold bg-blue-50 text-gray-700">GROUPS 02</div>
                            </div>
                        </div>
                        <!--End Centers Grid Mobile version-->

                        <!-- Centers Grid Table format hidden for mobile screens-->
                        <div id="centersGrid" class="w-full h-full hidden md:block p-0 pt-2">
                            <table class="min-w-full rounded ">
                                <thead class="w-full text-gray-700 text-xs font-light">
                                    <tr class="uppercase w-full ">
                                        <th class="py-2  text-center">
                                            <input type="checkbox" id="select-all" class="form-checkbox h-4 w-4 text-blue-400 m-1">
                                        </th>
                                        <th class="py-2 px-2 text-center">#</th>
                                        <th class="py-2 text-left">Center Name</th>
                                        <th class="py-2 text-left">Groups</th>
                                        <th class="py-2 text-left">Center Manager</th>
                                        <th class="py-2 text-left">Payment Day</th>
                                        <th class="py-2 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-gray-800 text-xs font-light bg-white">
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600 ">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left ">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600 ">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left ">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600 ">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left ">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-sky-100 cursor-pointer rounded-lg">
                                        <td class="py-2 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                        </td>
                                        <td class="py-2 text-center">001</td>
                                        <td class="py-2 text-left">Center Name</td>
                                        <td class="py-2 text-left">Groups</td>
                                        <td class="py-2 text-left">Center Manager</td>
                                        <td class="py-2 text-left">Payment Day</td>
                                        <td class="py-2 text-center flex justify-center items-center gap-1">
                                            <a href="{}" class=" border rounded hover:bg-green-500">
                                                <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                            </a>
                                            <a href="{}" class=" border rounded hover:bg-sky-500">
                                                <img src="{{ asset('assets/icons/PencilSimple.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>


                        <div class="hidden mt-4 mx-4 md:flex justify-between items-center text-xs text-gray-500">
                            <span>1-10 of 87</span>

                            <div class="flex justify-center items-center">
                                <div class="pr-8">
                                    <select class="rounded bg-sky-50">
                                        <option>10</option>
                                        <option>20</option>
                                        <option>50</option>
                                    </select>
                                    <span>Rows per page</span>
                                </div>
                                <button class="px-1 py-1 bg-gray-200 rounded">
                                    <img src="{{ asset('assets/icons/CaretRight.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                </button>
                                <span class="px-2 text-xs">1/15</span>
                                <button class="px-1 py-1 bg-gray-200 rounded">
                                    <img src="{{ asset('assets/icons/CaretRight.svg') }}" alt="Dashboard Icon" class="h-3 w-3">
                                </button>
                            </div>
                        </div>
                        <!--End Centers Grid-->

                    </div>
                </div>

                <div class="hidden h-full w-2/6  md:flex flex-col justify-between">
                    <div class="border-b p-4">
                        <h1 class="text-md font-medium text-gray-800 mb-4">Balangoda</h1>
                        <div class="grid grid-cols-2 gap-y-2">
                            <div>
                                <p for="Cname" class="text-xs text-gray-400">Center Name</p>
                                <p id="Cname" class="text-sm">001 Center Name</p>
                            </div>
                            <div>
                                <p for="Cmanager" class="text-xs text-gray-400">Center Manager</p>
                                <p id="Cmanager" class="text-sm">Center Manager</p>
                            </div>
                            <div>
                                <p for="Tgroup" class="text-xs text-gray-400">Total Groups</p>
                                <p id="Tgroup" class="text-sm">Total Groups</p>
                            </div>
                            <div>
                                <p for="TMembers" class="text-xs text-gray-400">Total Members</p>
                                <p id="TMembers" class="text-sm mt-0">Center Members</p>
                            </div>
                        </div>

                    </div>
                    <div class="p-4 space-y-4 h-full">
                        <div class="space-y-2 flex flex-col justify-start ">
                            <div class="flex justify-between items-center bg-sky-50 border rounded-lg ">
                                <span class="text-xs font-medium text-gray-600  p-2 ">Group 01</span>
                                <span class="text-xs font-medium text-gray-800 bg-gray-200  p-2 px-8 rounded-lg ">06</span>
                                <div class="font-medium text-gray-800  px-2 text-xs flex space-x-1">
                                    <a href="{}" class=" border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="{}" class=" border rounded hover:bg-red-500">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center bg-sky-50 border rounded-lg ">
                                <span class="text-xs font-medium text-gray-600  p-2 ">Group 01</span>
                                <span class="text-xs font-medium text-gray-800 bg-gray-200  p-2 px-8 rounded-lg ">06</span>
                                <div class="font-medium text-gray-800  px-2 text-xs flex space-x-1">
                                    <a href="{}" class=" border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="{}" class=" border rounded hover:bg-red-500">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center bg-sky-50 border rounded-lg ">
                                <span class="text-xs font-medium text-gray-600  p-2 ">Group 01</span>
                                <span class="text-xs font-medium text-gray-800 bg-gray-200  p-2 px-8 rounded-lg ">06</span>
                                <div class="font-medium text-gray-800  px-2 text-xs flex space-x-1">
                                    <a href="{}" class=" border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="{}" class=" border rounded hover:bg-red-500">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center bg-sky-50 border rounded-lg ">
                                <span class="text-xs font-medium text-gray-600  p-2 ">Group 01</span>
                                <span class="text-xs font-medium text-gray-800 bg-gray-200  p-2 px-8 rounded-lg ">06</span>
                                <div class="font-medium text-gray-800  px-2 text-xs flex space-x-1">
                                    <a href="{}" class=" border rounded hover:bg-green-500">
                                        <img src="{{ asset('assets/icons/Eye.svg') }}" alt="Eye" class="h-3 w-3 m-1">
                                    </a>
                                    <a href="{}" class=" border rounded hover:bg-red-500">
                                        <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Pencil" class="h-3 w-3 m-1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-sm md:text-xs border-t p-4">
                        <button value="add_group" class=" bg-blue-600 text-white  p-2  rounded-lg hover:bg-blue-700 focus:outline-none w-full">
                            + Add Group
                        </button>
                    </div>

                </div>
            </div>
            <!--End Of card -->

            <!--Models-->
            <!-- Add New Branch Modal -->
            <div id="addBranchModal" class="fixed inset-0 bg-gray-600 hidden  bg-opacity-50 items-center justify-center z-50">
                <div class="shadow-xl w-80 rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add New Branch</h2>
                    <div class="bg-white rounded-b-lg p-4 ">
                        <form action="" method="get">
                            <div>
                                <label for="branchName" class="block text-xs text-gray-400 mb-1 ml-2">Branch Name</label>
                                <input type="text" id="branchName" placeholder="" class="w-full p-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <!--Button Area-->
                            <div class="flex justify-end space-x-4 mt-4">
                                <button id="cancelBranch" class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button id="createBranch" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add New Center Modal -->
            <div id="addCenterModal" class="fixed inset-0 bg-gray-600 hidden bg-opacity-50 items-center justify-center z-50">
                <div class="bg-white shadow-xl w-80 rounded-lg">
                    <h2 class="text-md bg-blue-100 rounded-t-lg p-4">Add new Center</h2>
                    <form>
                        <div class="bg-white rounded-b-lg p-4 space-y-4 ">
                            <div>
                                <label for="centerBranch" class="block text-xs text-gray-400 mb-1 ml-2">Branch*</label>
                                <input type="text" id="centerBranch" placeholder="" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div>
                                <label for="centerName" class="block text-xs text-gray-400 mb-1 ml-2">Center Name*</label>
                                <input type="text" id="centerName" placeholder="" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div>
                                <label for="paymentDate" class="block text-xs text-gray-400 mb-1 ml-2">Payment Date</label>
                                <input type="date" id="paymentDate" placeholder="" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <div>
                                <label for="manager" class="block text-xs text-gray-400 mb-1 ml-2">Manager</label>
                                <input type="text" id="manager" placeholder="" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                            </div>
                            <!--Button Area-->
                            <div class="flex justify-end space-x-4 mt-4">
                                <button id="cancelCenter" class="px-6 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 focus:outline-none text-sm">
                                    Cancel
                                </button>
                                <button id="createCenter" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none text-sm">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </main>

    </div>
</div>

<style>
    /* Logo toggle */
    #sidebar.w-20 .full-logo {
        display: none;
    }

    #sidebar.w-20 .small-logo {
        display: block;
    }

    #sidebar .full-logo {
        display: block;
    }

    #sidebar .small-logo {
        display: none;
    }

    /* Hide text and arrows in small sidebar */
    #sidebar.w-20 .sidebar-text,
    #sidebar.w-20 .sidebar-arrow {
        display: none;
    }

    /* Center icons in small sidebar */
    #sidebar.w-20 .flex.items-center {
        justify-content: center;
    }

    /* Ensure submenu is visible and styled for both sidebar sizes */
    #sidebar .submenu {
        left: 100%;
        top: 0;
        z-index: 10;
    }

    #sidebar.w-20 .submenu {
        position: absolute;
        left: 100%;
        top: 0;
        z-index: 100;
        width: 11rem;
        /* w-44 */
    }

    #sidebar.w-20 .submenu {
        left: 4rem;
        /* Adjust based on small sidebar width */
    }

    #sidebar.w-20 .username {
        border: none;
        /* Adjust based on small sidebar width */
    }

    /* Active state styling */
    .active {
        background-color: #e5e7eb !important;
        /* gray-200 */
        font-weight: 600;
    }
</style>


<script>
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    mobileMenuButton.addEventListener('click', () => {
        mobileSidebar.classList.toggle('hidden');
    });

    closeMobileMenu.addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
    });

    // Sidebar Toggle (Desktop)
    const sidebar = document.getElementById('sidebar');
    const sidebarToggleButton = document.getElementById('sidebarToggleButton');

    sidebarToggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('w-20');
        sidebar.classList.toggle('w-52');
        const arrows = sidebar.querySelectorAll('.arrow');
        arrows.forEach(arrow => arrow.classList.toggle('hidden'));
        const submenus = sidebar.querySelectorAll('.submenu');
        submenus.forEach(submenu => submenu.classList.add('hidden')); // Close submenus on toggle
    });

    // Sidebar Submenu Toggle (for both mobile and web)
    const sidebarToggles = document.querySelectorAll('.sidebar-toggle');

    sidebarToggles.forEach(toggle => {
        toggle.addEventListener('click', (event) => {
            const submenu = toggle.nextElementSibling;
            const arrow = toggle.querySelector('.arrow');
            const isMinimized = sidebar.classList.contains('w-20');

            // Close all other submenus
            const allSubmenus = document.querySelectorAll(' .submenu');
            allSubmenus.forEach(otherSubmenu => {
                if (otherSubmenu !== submenu) {
                    otherSubmenu.classList.add('hidden');
                    const otherArrow = otherSubmenu.previousElementSibling.querySelector('.arrow');
                    if (otherArrow) otherArrow.classList.remove('rotate-180');
                }
            });

            // Toggle the current submenu
            submenu.classList.toggle('hidden');
            if (arrow) arrow.classList.toggle('rotate-180');

            // Position submenu next to the clicked button in minimized state
            if (isMinimized && submenu.classList.contains('hidden') === false) {
                const toggleRect = toggle.getBoundingClientRect();
                const sidebarRect = sidebar.getBoundingClientRect();
                submenu.style.top = `${toggleRect.top - sidebarRect.top}px`;
            }
        });
    });

    // Active Page Highlighting
    document.addEventListener('DOMContentLoaded', () => {
        const currentPath = window.location.pathname;
        const links = document.querySelectorAll('#sidebar a, #mobileSidebar a');

        links.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    });

    //------------------------//

    // Show/Hide Add Branch Modal
    document.getElementById('branchSelect').addEventListener('change', function() {
        if (this.value === 'add_new') {
            document.getElementById('addBranchModal').classList.remove('hidden');
            document.getElementById('addBranchModal').classList.add('flex');
        }
    });

    document.getElementById('cancelBranch').addEventListener('click', function() {
        document.getElementById('addBranchModal').classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('branchSelect').value = '';
    });

    document.getElementById('createBranch').addEventListener('click', function() {
        const branchName = document.getElementById('branchName').value;
        if (branchName) {
            const option = document.createElement('option');
            option.value = branchName.toLowerCase();
            option.text = branchName;
            document.getElementById('branchSelect').appendChild(option);
            document.getElementById('branchSelect').value = branchName.toLowerCase();
            document.getElementById('addBranchModal').classList.add('hidden');
            document.getElementById('branchName').value = '';
        }
    });

    // Show/Hide Add Center Modal
    document.querySelector('button[value="add_new"]').addEventListener('click', function() {
        document.getElementById('addCenterModal').classList.remove('hidden');
        document.getElementById('addCenterModal').classList.add('flex');
    });

    document.getElementById('cancelCenter').addEventListener('click', function() {
        document.getElementById('addCenterModal').classList.add('hidden');
        document.getElementById('centerBranch').value = '';
        document.getElementById('centerName').value = '';
        document.getElementById('paymentDate').value = '';
        document.getElementById('manager').value = '';
    });

    document.getElementById('createCenter').addEventListener('click', function() {
        const branch = document.getElementById('centerBranch').value;
        const centerName = document.getElementById('centerName').value;
        if (branch && centerName) {
            // Add logic to handle new center creation (e.g., update UI or send to server)
            console.log('New Center Added:', {
                branch,
                centerName,
                paymentDate: document.getElementById('paymentDate').value,
                manager: document.getElementById('manager').value
            });
            document.getElementById('addCenterModal').classList.add('hidden');
            document.getElementById('centerBranch').value = '';
            document.getElementById('centerName').value = '';
            document.getElementById('paymentDate').value = '';
            document.getElementById('manager').value = '';
        }
    });


    // Search Filter
    document.getElementById('searchCenter').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const cards = document.querySelectorAll('#centersGrid > div');
        cards.forEach(card => {
            const centerName = card.getAttribute('data-center').toLowerCase();
            if (centerName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
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

    //check box selection
    document.getElementById('select-all').addEventListener('change', function(e) {
        let checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>


@endsection
