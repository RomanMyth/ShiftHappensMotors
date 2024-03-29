<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lease</title>
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

        <!-- Form for buying the car -->
        <form action="" method="POST">
            @csrf
            <!-- Add hidden input fields for car details -->
            <input type="hidden" name="vin" value="{{ $car->Vin }}">
            <input type="hidden" name="price" value="{{ $car->Price/10 }}">

        
            <!-- Add form fields for customer information -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <!-- Add more form fields for other customer information -->
        
            <!-- Add a submit button -->
            <button type="submit" class="btn btn-primary">Lease Now</button>
        </form>
        
    </div>
</body>
</html>