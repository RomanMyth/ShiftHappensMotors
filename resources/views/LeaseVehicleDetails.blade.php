<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lease</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Body styling */
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }


        button[type="submit"]:hover {
            border: solid 1px black;
            color: black;
            background-color: white;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }

        #header {
            background-color: #000;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 10px 20px;
            margin-bottom: 20px;
            border: none;
            font-weight: bold;
        }

        /* Form styling */
        .form-label {
            color: #555;
            font-weight: bold;
        }

        .form-control {
            border-color: #ccc;
            border-radius: 5px;
            box-shadow: none;
        }

        /* Button styling */
        .btn-primary {
            background-color: #000;
            border-color: #000;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #111;
            border-color: #111;
        }

        /* Navbar styling */
        .navbar {
            justify-content: space-around;
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            margin-bottom: 20px;
        }

        /* Car image styling */
        .car-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .car-image:hover {
            transform: scale(1.05);
        }

        /* Modal styling */
        .modal-content {
            background-color: transparent;
            border: none;
        }

        .modal-dialog {
            max-width: 90%;
            margin: 30px auto;
        }

        .modal-body img {
            width: 100%;
            height: auto;
        }

        input {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input:hover {
            border-color: black;
        }

        form input:focus {
            border-color: black; /* Change border color on focus */
            box-shadow: 0 0 5px black; /
        }
    </style>
</head>
<body>

<x-navbar>
</x-navbar>

<div class="container">
    <!-- Car details display area -->
    <div class="card">
        <div id="header" class="card-header">
            <h5><strong>{{ $car->Make }} {{ $car->Model }} {{ $car->Year }}</strong></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Car details -->
                <div class="col-md-6 car-details">
                    <p><strong>Price Per Day:</strong> ${{ (int)$car->Price/100 }}</p>
                    <p><strong>Color:</strong> {{ $car->Color }}</p>
                    <p><strong>Brand:</strong> {{ $car->Make}}</p>
                    <p><strong>Mileage:</strong> {{ $car->Mileage}}</p>
                    <p><strong>Gas Type:</strong> {{ $car->gasType}}</p>
                    <p><strong>Interior Color:</strong> {{ $car->interiorColor}}</p>
                    <p><strong>Drive Train:</strong> {{ $car->driveTrain}}</p>
                    <!-- Add more details as needed -->
                </div>
                <!-- Car image -->
                <div class="col-md-6 text-center">
                    <img src="{{ $car->Image }}" alt="Car Image" class="car-image" data-bs-toggle="modal" data-bs-target="#carModal">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for larger car image -->
    <div class="modal fade" id="carModal" tabindex="-1" aria-labelledby="carModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ $car->Image }}" alt="Car Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Form for leasing the car -->
    <form action="{{ route('lease.vehicle') }}" method="POST">
        @csrf
        <!-- Add hidden input fields for car details -->
        <input type="hidden" name="vin" value="{{ $car->Vin }}">
        <input type="hidden" name="price_per_day" value="{{ (int)$car->Price/100 }}">

        <!-- Add form fields for customer information -->

        <div class="mt-4">
            <label for="cardNumber" class="form-label">Credit Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
        </div>
        <div class="mb-3">
            <label for="expiryDate" class="form-label">Expiry Date</label>
            <input type="text" class="form-control" id="expiryDate" name="expiryDate" required>
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required>
        </div>
        <div class="row mt-4">
            <div class="col">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="col">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
        </div>
        <!-- Add more form fields for other customer information -->

        <!-- Add a submit button -->
        <button type="submit" class="btn btn-primary mt-4">Lease Now</button>
    </form>
</div>
<br>
<br>
<br>
<br>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
