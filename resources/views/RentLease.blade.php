<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent/Lease</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .container {
            margin-top: 20px; /* Add margin-top for better spacing */
        }
    </style>
</head>
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
            <h5>{{ $car->make }} {{ $car->model }} {{ $car->year }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Price:</strong> ${{ $car->price }}</p>
            <!-- Add more details here -->
        </div>
    </div>

    <!-- Form for renting or leasing the car -->
    <form action="{{ route('car.rent', $car->vin) }}" method="POST">
        @csrf
        <!-- Add form fields for customer information -->
        <button type="submit" class="btn btn-primary">Rent Now</button>
    </form>
</div>

<!-- Bootstrap JS (optional) -->
</body>
</html>
