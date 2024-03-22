<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    #banner{
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                height: 100px;
                font-size: 50px;
                font-family: Copperplate, "Copperplate Gothic Light", fantasy;
                background-image: linear-gradient(to right, rgba(59, 210, 230, 0.5), white); 
                padding: 20px;
            }
            .navbar{
                justify-content: space-around;
            }
</style>
<body>

    <div id='banner'>
        ShiftHappensMotors
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

        <!-- Form for buying the car -->
        <form action="{{ route('car.buy', $car->id) }}" method="POST">
            @csrf
            <!-- Add form fields for customer information -->
            <!-- Add a submit button -->
            <button type="submit" class="btn btn-primary">Buy Now</button>
        </form>
    </div>
</body>
</html>