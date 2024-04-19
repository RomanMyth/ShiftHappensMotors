<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent/Lease</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .navbar {
            justify-content: space-around;
        }

        .container {
            margin-top: 20px; /* Add margin-top for better spacing */
        }
    </style>
</head>
<body>


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
