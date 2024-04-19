<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .navbar{
        justify-content: space-around;
    }
</style>
<body>

    <x-navbar>
    </x-navbar>

    <div class="container">
        <!-- Car details display area -->
       <!-- Car details display area -->
<div class="card">
    <div class="card-header">
        <h5>{{ $car->Make }} {{ $car->Model }} {{ $car->Year }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Price:</strong> ${{ $car->Price }}</p>
        <p><strong>Color:</strong> {{ $car->Color }}</p>
        <!-- Add more details here -->

        <!-- Display the car's picture -->
        <img src="{{ $car->Image }}" alt="Car Image" class="img-fluid">
    </div>
</div>


        <!-- Form for buying the car -->
        <form action="{{ route('update.balance') }}" method="POST">
            @csrf
            <!-- Add hidden input fields for necessary data -->
            <input type="hidden" name="price" value="{{ $car->Price }}">
            <!-- Add additional hidden fields if needed -->
        
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
            <!-- Add more form fields for other customer information -->
        
            <!-- Add a submit button -->
            <button type="submit" class="btn btn-primary">Buy Now</button>
        </form>
        
        
    </div>
</body>
</html>