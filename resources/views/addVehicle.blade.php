<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .col-lg-3{
                display: flex;
                flex-direction: column;
            }
        </style>
    </head>
    <body>
        <div class=".container">
            <form action="/storeVehicle" method="POST" class="p-5">
                @csrf
                <div class='row'>
                    <div class="col-lg-3">
                        <label for="Vin">Vin: </label>
                        <input type="text" name="Vin">
                    </div>
                    <div class="col-lg-3">
                        <label for="Make">Make: </label>
                        <input type="text" name="Make">
                    </div>
                    <div class="col-lg-3">
                        <label for="Model">Model: </label>
                        <input type="text" name="Model">
                    </div>
                    <div class="col-lg-3">
                        <label for="Year">Year: </label>
                        <input type="number" name="Year">
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-3">
                        <label for="Price">Price: </label>
                        <input type="number" step="0.01" name="Price">
                    </div>
                    <div class="col-lg-3">
                        <label for="Available">Available: </label>
                        <input type="number" name="Available">
                    </div>
                    <div class="col-lg-3">
                        <label for="Image">Image url: </label>
                        <input type="text" name="Image">
                    </div>
                    <div class="col-lg-3">
                        <label for="gasType">Gas Type: </label>
                        <input type="text" name="gasType">
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-3">
                        <label for="Color">Color: </label>
                        <input type="text" name="Color">
                    </div>
                    <div class="col-lg-3">
                        <label for="vehicleType">Vehicle Type (sedan, suv, etc.): </label>
                        <input type="text" name="vehicleType">
                    </div>
                    <div class="col-lg-3">
                        <label for="Mileage">Mileage: </label>
                        <input type="number" name="Mileage">
                    </div>
                    <div class="col-lg-3">
                        <label for="Transmission">Transmission: </label>
                        <input type="text" name="Transmission">
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-3">
                        <label for="driveTrain">Drive Train (4WD, 2WD, etc.): </label>
                        <input type="text" name="driveTrain">
                    </div>
                    <div class="col-lg-3">
                        <label for="Engine">Engine: </label>
                        <input type="text" name="Engine">
                    </div>
                    <div class="col-lg-3">
                        <label for="interiorColor">Interior Color: </label>
                        <input type="text" name="interiorColor">
                    </div>
                    <div class="col-lg-3">
                        <label for="newOrUsed">New/Used: </label>
                        <input type="text" name="newOrUsed">
                    </div>
                </div>
                <button type="Submit">Submit</button>
            </form>
        </div>
    </body>
</html>