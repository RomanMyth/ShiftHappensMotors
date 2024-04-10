<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lease</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
    .navbar {
        justify-content: space-around;
    }
</style>
<body>

    <div id='banner'>
        <img src="https://github.com/RomanMyth/ShiftHappensMotors/blob/Frank/Logo.png?raw=true" alt="ShiftHappensMotors Logo" style="max-width: 280%; max-height: 130%;">
    </div>

    <x-navbar>
    </x-navbar>

    <div class="container">
        <!-- Car details display area -->
        <div class="card">
            <div class="card-header">
                <h5>{{ $car->Make }} {{ $car->Model }} {{ $car->Year }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Price Per Day:</strong> ${{ (int)$car->Price/100 }}</p>
                <p><strong>Color:</strong> {{ $car->Color }}</p>
                <!-- Add more details here -->

                <!-- Display the car's picture -->
                <img src="{{ $car->Image }}" alt="Car Image" class="img-fluid">
            </div>
        </div>

        <!-- Form for leasing the car -->
        <form action="{{ route('lease.vehicle') }}" method="POST">
            @csrf
            <!-- Add hidden input fields for car details -->
            <input type="hidden" name="vin" value="{{ $car->Vin }}">
            <input type="hidden" name="price_per_day" value="{{ (int)$car->Price/100 }}">

            <!-- Add form fields for customer information -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
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
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <!-- Add more form fields for other customer information -->

            <!-- Add a submit button -->
            <button type="submit" class="btn btn-primary">Lease Now</button>
        </form>
    </div>
</body>
</html>
