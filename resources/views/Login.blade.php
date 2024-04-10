<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
                     #banner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 250px; /* You can adjust the height as needed */
    background-image: linear-gradient(to right, rgba(19, 19, 19, 0.922), white);
    padding: 10px;
}
    </style>
</head>
<body>

    <div id='banner'>
        <img src="https://github.com/RomanMyth/ShiftHappensMotors/blob/Frank/Logo.png?raw=true" alt="ShiftHappensMotors Logo" style="max-width: 280%; max-height: 130%;">
    </div>

    <x-navbar></x-navbar>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="POST" action="{{ route('login') }}" lass="p-5">
                    @csrf
                    <h3>Login</h3>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <form action="{{url('/Register')}}" method="GET" class="p-5">
                    <p>Not Registered?</p>
                    <button type="submit" class="btn btn-secondary">Register Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
