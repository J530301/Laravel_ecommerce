<!-- filepath: /c:/Users/SHILOH/laravel_ecommerce/resources/views/auth/login.blade.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in</title>
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/banner-bg.jpg') }}');">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Sign In</h2>
        <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="email" name="email" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2 pl-2" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2 pr-10 pl-2" required>
                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 ">
                        <svg id="password-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <input type="checkbox" id="rememberMe" name="rememberMe" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="rememberMe" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot Password?</a>
            </div>
            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Sign In</button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <button id="toggle-form" class="text-indigo-600 hover:text-indigo-500">Don't have an account? Sign up</button>
        </div>
    </div>

    <!-- Sign Up Form Modal -->
    <div id="signup-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
       <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Sign Up</h2>
        <button type="button" class="text-gray-400 hover:text-gray-600" id="close-signup-modal">&times;</button>
    </div>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
            <select name="role" id="role" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2" required>
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" name="email" id="email" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="signup-password" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2 pr-10" required>
                <button type="button" id="toggle-signup-password" class="absolute inset-y-0 right-0 ">
                    <svg id="signup-password-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="signup-password-confirmation" class="mt-1 block w-full border-black rounded-md shadow-md border-b-2 pr-10" required>
                <button type="button" id="toggle-signup-password-confirmation" class="absolute inset-y-0 right-0  ">
                    <svg id="signup-password-confirmation-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </button>
            </div>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">Sign Up</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        // Toggle password visibility for login form
        $('#toggle-password').on("click", function () {
            let passwordField = $('#password');
            let passwordIcon = $('#password-icon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                passwordIcon.html('<path fill-rule="evenodd" d="M10 2a8 8 0 00-8 8 8 8 0 0016 0 8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-6a1 1 0 112 0 1 1 0 01-2 0z" clip-rule="evenodd" />');
            } else {
                passwordField.attr('type', 'password');
                passwordIcon.html('<path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />');
            }
        });

        // Toggle password visibility for signup form
        $('#toggle-signup-password').on("click", function () {
            let passwordField = $('#signup-password');
            let passwordIcon = $('#signup-password-icon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                passwordIcon.html('<path fill-rule="evenodd" d="M10 2a8 8 0 00-8 8 8 8 0 0016 0 8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-6a1 1 0 112 0 1 1 0 01-2 0z" clip-rule="evenodd" />');
            } else {
                passwordField.attr('type', 'password');
                passwordIcon.html('<path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />');
            }
        });

        // Toggle password visibility for signup confirmation password
        $('#toggle-signup-password-confirmation').on("click", function () {
            let passwordField = $('#signup-password-confirmation');
            let passwordIcon = $('#signup-password-confirmation-icon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                passwordIcon.html('<path fill-rule="evenodd" d="M10 2a8 8 0 00-8 8 8 8 0 0016 0 8 8 0 00-8-8zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-6a1 1 0 112 0 1 1 0 01-2 0z" clip-rule="evenodd" />');
            } else {
                passwordField.attr('type', 'password');
                passwordIcon.html('<path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z" />');
            }
        });

        // Toggle between login and signup forms
        $('#toggle-form').click(function () {
            $('#signup-modal').removeClass('hidden');
        });

        // Close signup modal
        $('#close-signup-modal').click(function () {
            $('#signup-modal').addClass('hidden');
        });
    });
</script>
</body>

</html>