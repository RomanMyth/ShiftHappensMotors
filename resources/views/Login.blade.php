<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>

.loginForm {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}



input[type="text"],
input[type="password"], {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="text"],
input[type="password"],
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

input[type="text"]:hover,
input[type="password"]:hover,
textarea:hover {
    border-color: black /* Change border color on hover */
}

input[type="text"]:focus,
input[type="password"]:focus,
textarea:focus {
    border-color: black; /* Change border color on focus */
    box-shadow: 0 0 5px black; /* Add box shadow on focus */
}

::placeholder {
    color: #999; /* Placeholder text color */
    font-style: italic; /* Italicize placeholder text */
}

#loginBtn {
    width: 596px;
    font-weight: bold;
    margin-bottom: 20px;
    background-color: #000;
    border: solid 1px black;
}

#regHere{
    /* background-color: #f9f9f9; */
    color: black;
    border: none;
    background-color: white;
    margin-bottom: 20px;
}

#regHere:hover {
    font-weight: bold;
}

#loginBtn:hover {
    background-color: white;
    color: #000;
    border: #000 solid 1px;
}

#clearBtn {

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

a:hover {
    text-decoration: underline; /* Add underline on hover */
}

.registerNow {
    color: #007bff; /* Link color */
    text-decoration: none; /* Remove underline */
}

.copyright {
    color: #999;
    font-size: small ;
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
    </style>


</head>
<body>
    <x-navbar></x-navbar>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="loginForm" method="POST" action="{{ route('login') }}" lass="p-5">
                    @csrf
                    <h3>Login</h3>
                    <br>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <br>
                        <button id="loginBtn" type="submit" class="btn btn-primary">Login</button>
                    <br>
                </form>
                <div class="text-center">
                    <form class="regHereForm" action="{{url('/register')}}" method="GET" class="p-5">
                        <p class="notReg">Or</p>
                        <button id="regHere" class="btn btn-secondary">Register Here</button>
                    </form>
                    </div>
                <div class="text-center">
                    <p class="copyright">Shift Happens Motors © 2024</p>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
