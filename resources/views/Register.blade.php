<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/app.css" type="text/css">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form id="register" method="POST" class="p-5">
                    <h3 class="mb-4">Register</h3>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="firstName" placeholder="First" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="lastName" placeholder="Last" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="emailID" name="emailID" placeholder="example@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phoneNumber" placeholder="(###)-###-####" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="userPass" placeholder="Password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox" onclick="showPass()">
                        <label class="form-check-label" for="checkbox">Show Password?</label>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="DOB" placeholder="YYYY-MM-DD" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Submit</button>
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
