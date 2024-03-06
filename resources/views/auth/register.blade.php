{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    </style>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form id="register" method="POST" action="{{ route('register') }}" class="p-5">
                    @csrf
                    <h3 class="mb-4">Register</h3>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="Phone" class="form-label">Phone:</label>
                        <input type="tel" class="form-control" id="Phone" name="Phone" placeholder="(###)-###-####" required>
                    </div>
                    <div class="mb-3">
                        <label for="Address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Address City, State(Abbr.)" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox" onclick="showPass()">
                        <label class="form-check-label" for="checkbox">Show Password?</label>
                    </div>
                    <div class="mb-3">
                        <label for="DOB" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="DOB" name="DOB" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="userType" value="Customer">
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">{{ __('Register') }}</button>
                    <button type="button" class="btn btn-secondary" onclick="clearFields()">Clear</button>
                </form>
                <div class="text-center">
                    <p>Already a member? <a href="{{url('/Login')}}">Log In</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clearFields() {
            document.getElementById("register").reset();
        }

        function showPass() {
            var passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>

    @if(isset($error))
    <script>
        alert("{{ $error }}");
    </script>
    @endif
</body>
</html>
