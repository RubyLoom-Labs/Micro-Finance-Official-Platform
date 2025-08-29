@extends('layouts.mainLayout')

@section('content')

<div class="flex h-screen w-screen bg-gray-100 items-center justify-center">

    <div class="h-full w-full flex md:h-5/6 md:w-4/6 md:rounded-lg md:shadow-lg md:overflow-hidden md:flex-row flex-col">

        <!-- Left side: Logo and Company Name -->
        <div class="hidden md:block  h-full w-full  flex-col items-center justify-center p-5 md:w-1/2 bg-blue-600 md:pt-10 px-10 ">
            <div class="flex mt-8">
                <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="h-12" />
            </div>
            <h1 class="text-white text-2xl font-bold mt-4 uppercase">Primeway Investment</h1>
        </div>

        <!-- Right side: Sign In Form -->
        <div class="h-full w-full flex flex-col items-center justify-between bg-white p-5 md:w-1/2">
            <div class="w-full max-w-md h-4/5 flex flex-col justify-center mt-8">
                <div class="flex justify-center mb-4 md:hidden">
                    <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="h-12" />
                </div>
                <h2 class="text-center text-2xl font-semibold text-blue-700 md:text-left md:text-3xl md:font-bold pt-8 md:pt-0">Hello!</h2>
                <p class="text-center text-md text-gray-600 mt-2 md:text-left ">Sign up to continue</p>

                <!-- Error Message Container -->
                <p id="signupErrorMessage" class="text-center text-sm text-red-500 mt-8 lg:mt-2 hidden "></p>

                <form class="mt-12 lg:mt-6" id="signupForm" method="POST" action="">
                    <div class="relative my-2 text-sm">
                        <div class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" ...>...</svg>
                        </div>
                        <input type="email" id="email" name="email" placeholder=" Email" class="w-full px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="relative my-2 text-sm">
                        <div class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" ...>...</svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder=" Password" class="w-full px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <div class="absolute inset-y-0 right-3 flex items-center text-gray-400 cursor-pointer" id="togglePassword">
                            👁️
                        </div>
                    </div>
                    <div class="relative my-2 text-sm">
                        <div class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" ...>...</svg>
                        </div>
                        <input type="password" id="conformPassword" name="conformPassword" placeholder=" Confirm Password" class="w-full px-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <div class="absolute inset-y-0 right-3 flex items-center text-gray-400 cursor-pointer" id="toggleconformPassword">
                            👁️
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 pr-2 mt-8">
                        <input type="checkbox" id="remember" name="remember" class="form-checkbox border-gray-300 rounded" />
                        <label for="remember" class="text-sm text-gray-600">I accept the
                            <a href="#" class=" text-blue-700 right-0 top-full mt-2 ">Terms of Use </a>
                            &
                            <a href="#" class=" text-blue-700 right-0 top-full mt-2 "> Privacy Policy</a>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 mt-4">Sign up</button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-500 ">
                Already have an account? <a href="#" class="text-blue-600 font-medium">Sign In</a>
            </p>

        </div>
    </div>
</div>

<script>
    // Password toggle functionality
    const togglePassword = document.getElementById('togglePassword');
    const toggleconformPassword = document.getElementById('toggleconformPassword');
    const password = document.getElementById('password');
    const conformPassword = document.getElementById('conformPassword');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
    toggleconformPassword.addEventListener('click', function() {
        const type = conformPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        conformPassword.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    // Mock frontend validation for email and password, check Conformation password
    const signupForm = document.getElementById('signupForm');
    const signupErrorMessage = document.getElementById('signupErrorMessage');

    signupForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('conformPassword').value;

        // Basic frontend validation
        if (!email.includes('@')) {
            signupErrorMessage.textContent = 'Invalid Email!';
            signupErrorMessage.classList.remove('hidden');
        } else if (password.length < 6) {
            signupErrorMessage.textContent = 'Password must be at least 6 characters!';
            signupErrorMessage.classList.remove('hidden');
        } else if (password !== confirmPassword) {
            signupErrorMessage.textContent = 'Passwords do not match!';
            signupErrorMessage.classList.remove('hidden');
        } else {
            signupErrorMessage.textContent = '';
            signupErrorMessage.classList.add('hidden');
            console.log('Signup form would submit to backend now.');
            // signupForm.submit(); // Uncomment this when backend is ready
        }
    });
</script>

@endsection