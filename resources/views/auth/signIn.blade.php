@extends('layouts/mainLayout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex h-screen w-screen bg-gray-900 items-center justify-center "
        style="background-image: url('assets/images/bg.png')">

        <div class="h-full w-full flex md:h-4/6 md:w-4/6 md:rounded-lg md:shadow-lg md:overflow-hidden md:flex-row flex-col">

            <!-- Left side: Logo and Company Name -->
            <div
                class="hidden md:flex  h-full w-full flex-col items-center justify-between p-5 md:w-3/6 bg-gradient-to-r from-blue-100 to-blue-300  md:pt-10 px-10 ">
                <div class="flex mt-8 items-start  h-4/6 ">
                    <img src="{{ asset('assets/images/Logo.png') }}" alt="Primeway Investment Logo" class="h-24 w-auto" />
                </div>
                <div class="flex   items-center justify-left w-full pl-8  h-1/6">
                    <p class="text-blue-900 text-xs">Powered By <a href="#"
                            class="font-medium hover:text-blue-600">RubyLoom Labs</a></p>
                </div>
                <!--<h1 class="text-white text-2xl font-bold mt-4 uppercase">Primeway Investment</h1>-->
            </div>

            <!-- Right side: Sign In Form -->
            <div
                class="h-full w-full flex flex-col items-center justify-center lg:justify-start lg:bg-white p-8 lg:p-16 xl:w-4/6">
                <div class="w-full max-w-md h-4/5 flex flex-col justify-center">
                    <div class="flex justify-center mb-8 md:hidden">
                        <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="h-16" />
                    </div>
                    <!-- Welcome Text -->
                    <h3 class="hidden lg:block text-xl font-bold text-gray-800 mb-2 text-center md:text-left ">Welcome to
                        Primeway Investment</h3>
                    <h3 class="lg:hidden text-lg font-medium  mb-2 text-center md:text-left text-white">Welcome back</h3>
                    <h3 class="lg:hidden  text-md   mb-2 text-center md:text-left text-gray-500">Sign in to Continue</h3>

                    <!-- Error Message Container -->
                    <p id="loginError" class="text-red-500 text-sm mt-2"></p>

                    <form class="mt-2" id="signinForm">
                        <div class="relative my-2 text-sm mb-2">
                            <div class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="h-5 w-5" ...>...</svg>
                            </div>
                            <input type="email" id="email" name="email" placeholder=" Email"
                                class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-900 text-gray-300 lg:bg-white lg:text-gray-800" />
                        </div>
                        <div class="relative my-2 text-sm">
                            <div class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="h-5 w-5" ...>...</svg> <!-- You can replace this with another icon too -->
                            </div>
                            <input type="password" id="password" name="password" placeholder=" Password"
                                class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-900 text-gray-300 lg:bg-white lg:text-gray-800" />

                            <!-- Password Toggle Icon -->
                            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400 cursor-pointer"
                                id="togglePassword">
                                <img id="togglePasswordIcon" src="{{ asset('assets/icons/EyeSlash12.svg') }}"
                                    alt="Toggle Password" class="w-4 h-4">
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 pr-2 mt-12">
                            <input type="checkbox" id="remember" name="remember"
                                class="form-checkbox border-gray-300 rounded bg-" />
                            <label for="remember" class="text-sm lg:text-gray-600 text-gray-500">Remember Me</label>
                        </div>
                        <button id="test"
                            class="w-full bg-blue-600 text-white py-2 text-sm rounded-md hover:bg-blue-700 mt-4">Login</button>
                    </form>
                </div>
                <!--
                                        <p class="text-center text-xs text-gray-500 ">
                                            Don't have an account? <a href="#" class="text-blue-600 font-medium">Register</a>
                                        </p>
                            -->
            </div>
            <div class="lg:hidden flex   items-center lg:justify-left justify-center w-full lg:pl-8  h-1/6">
                <p class="lg:text-blue-900 text-xs text-gray-400">Powered By <a href="#"
                        class="font-medium hover:text-blue-600">RubyLoom Labs</a></p>
            </div>
        </div>
    </div>

    <script>
        // Password toggle functionality
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            const isPassword = password.getAttribute('type') === 'password';
            password.setAttribute('type', isPassword ? 'text' : 'password');
            togglePasswordIcon.src = isPassword ?
                "{{ asset('assets/icons/EyeSlash12.svg') }}" :
                "{{ asset('assets/icons/Eye12.svg') }}";
        });

        const form = document.getElementById('signinForm');
        const loginErrorBox = document.getElementById('loginErrorBox');
        const loginErrorText = document.getElementById('loginErrorText');
        const submitBtn = document.getElementById('test');

        document.getElementById('signinForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const errorContainer = document.getElementById('loginError');
            errorContainer.innerHTML = '';
             try {
                 const response = await fetch('user/login', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'Accept': 'application/json',
                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                             'content')
                     },
                     body: JSON.stringify({
                         email,
                         password
                     })
                 });

                 const data = await response.json();

                 if (response.ok) {
                     window.location.href = data.redirect_to;
                 } else if (response.status === 422 && data.errors) {
                     // Show validation errors
                     for (const field in data.errors) {
                         data.errors[field].forEach(msg => {
                             const p = document.createElement('p');
                             p.classList.add('text-red-500', 'text-sm');
                             p.textContent = msg;
                             errorContainer.appendChild(p);
                         });
                     }
                 } else {
                     // General error (e.g., wrong credentials)
                     errorContainer.textContent = data.message || 'Login failed.';
                 }
             } catch (err) {
                 console.error('Error:', err);
                 errorContainer.textContent = 'Server error. Please try again later.';
             }
        });
    </script>
@endsection
