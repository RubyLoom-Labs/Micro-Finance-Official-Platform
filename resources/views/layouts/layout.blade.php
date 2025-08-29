@extends('layouts.mainLayout')

@section('content')
    <div class="flex h-full w-full bg-white">
        <!--Side Bar-->
        <div class="hidden lg:flex">
            @include('shared.sidebar')
        </div>

        <!-- Main Content -->
        <main class="flex-1 lg:flex flex-col w-full h-full lg:p-0 lg:max-h-full lg:overflow-hidden">
            <!-- Topbar -->
            @include('shared.navbar')
            <!-- Mobile Dropdown -->

            @include('shared.mobiledropdown')

            <!-- Main Content Area -->
            @yield('contents')


        </main>

    </div>

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
                        const otherArrow = otherSubmenu.previousElementSibling.querySelector(
                            '.arrow');
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
    </script>

    </body>
