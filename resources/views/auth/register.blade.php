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



form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="date"],
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

input[type="text"]:hover,
input[type="email"]:hover,
input[type="tel"]:hover,
input[type="password"]:hover,
input[type="date"]:hover,
textarea:hover {
    border-color: #007bff; /* Change border color on hover */
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="password"]:focus,
input[type="date"]:focus,
textarea:focus {
    border-color: #007bff; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add box shadow on focus */
}

::placeholder {
    color: #999; /* Placeholder text color */
    font-style: italic; /* Italicize placeholder text */
}

#registerBtn {
    width: 540px;
    font-weight: bold;
}

#clearBtn {

}


button:hover {
    background-color: #0056b3; /* Darker Blue Color on Hover */
    color: #fff; /* Change text color on hover */
}


.container {
    margin-top: 50px; /* Adjust this value as needed */
}

h3 {
    font-size: 28px; /* Increase the font size */
    /* color: #007bff; Blue color */
    margin-bottom: 15px; /* Reduce the margin */
    text-align: center; /* Center-align the header */
    text-transform: uppercase; /* Convert text to uppercase */
    /* letter-spacing: 2px; Increase letter spacing for emphasis */
    font-weight: bold; /* Make the text bold */
}

form label {
    font-size: 16px; /* Adjust the font size as needed */
    color: #555; /* Adjust the color as needed */
    margin-bottom: 5px; /* Adjust the margin as needed */
    font-weight: bold; /* Make the text bold */
}

/* Custom styling for checkboxes */
input[type="checkbox"] {
    appearance: none; /* Remove default appearance */
    -webkit-appearance: none; /* Remove default appearance for webkit browsers */
    -moz-appearance: none; /* Remove default appearance for Firefox */
    width: 20px; /* Set width of checkbox */
    height: 20px; /* Set height of checkbox */
    border-radius: 3px; /* Optional: Add border radius for a rounded look */
    border: 2px solid #007bff; /* Add border */
    background-color: #fff; /* Background color */
    cursor: pointer; /* Show pointer cursor on hover */
    margin-right: 5px; /* Add spacing between checkbox and label */
}

/* Custom styling for checkbox labels */
input[type="checkbox"] + label {
    font-size: 16px; /* Set font size for label */
    color: #333; /* Set color for label */
    cursor: pointer; /* Show pointer cursor on hover */
}

/* Custom styling for checked checkboxes */
input[type="checkbox"]:checked {
    background-color: #007bff; /* Change background color when checked */
}

/* Custom styling for checked checkbox labels */
input[type="checkbox"]:checked + label {
    color: #f9f9f9; /* Change color of label when checked */
}

a {
    color: #007bff; /* Link color */
    text-decoration: none; /* Remove underline */
}
a:hover {
    text-decoration: underline; /* Add underline on hover */
}

.notReg {
    overflow: hidden;
    text-align: center;
}

.notReg::before, .notReg::after {
  background-color: #000;
  content: "";
  display: inline-block;
  height: 1px;
  position: relative;
  vertical-align: middle;
  width: 50%;
}

.notReg::before {
  right: 0.5em;
  margin-left: -50%;
}

.notReg::after {
  left: 0.5em;
  margin-right: -50%;
}

.copyright {
    color: #999;
    font-size: small ;
}

#terms {
    font-size: small;
    margin-bottom: 20px;
}

    </style>


</head>
<body>
    {{-- <x-navbar></x-navbar> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <form id="register" method="POST" action="{{ route('register') }}" class="p-5">
                    @csrf
                    <h3 class="mb-4">Register (Logo will go here)</h3>
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
                    <div id="dobInput" class="mb-3">
                        <label for="DOB" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="DOB" name="DOB" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="userType" value="Customer">
                    </div>
                    <div id="terms" class="text-center">By clicking <strong>"Register"</strong>,  you <strong>agree</strong> to our <strong>terms and conditions</strong>.</div>
                    <button id="registerBtn" type="submit" class="btn btn-primary" name="register">{{ __('Register') }}</button>
                    <br><br>
                    <div class="text-center">
                    {{-- <button id="clearBtn" type="button" class="btn btn-secondary" onclick="clearFields()">Clear Fields</button> --}}
                    </div>
                    <div class="text-center">
                        <form action="{{url('/login')}}" method="GET" class="p-5">
                            <p class="notReg">Or</p>
                            <button class="btn btn-secondary">Login Here</button>
                        </form>
                    </div>
                </form>
                <div class="text-center">
                    <p class="copyright">Shift Happens Motors © 2024</p>
            </div>

            </div>
        </div>
    </div>

    <x-footer></x-footer>

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
