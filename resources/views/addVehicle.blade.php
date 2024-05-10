<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .col-lg-3{
                display: flex;
                flex-direction: column;
            }

            .container {
                max-width: 800px; /* Limit the width of the container */
            margin: 0 auto; /* Center the container horizontally */
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); Add shadow effect */
            }

            h2 {
            text-align: center;
            margin-bottom: 30px;
            }



            input[type="text"],
input[type="number"], {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="text"],
input[type="number"],
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    /* box-shadow: 0 0 5px black; */
    margin-bottom: 20px;
}

input[type="text"]:hover,
input[type="number"]:hover,
textarea:hover {
    border-color: black; /* Change border color on hover */
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus {
    border-color: black; /* Change border color on focus */
    box-shadow: 0 0 5px black; /* Add box shadow on focus */
    outline: black;
}

select.form-select {
    width: 282px;
    /* padding: 10px; */
    /* margin-bottom: 15px; */
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #fff;
    color: #495057;
    line-height: 1;
    /* appearance: none; */
    height: 28px; /* Adjust height to match input fields */
    /* position: relative; */
}


select.form-select option {
    padding: 10px;
}


select.form-select:hover {
    border-color: black;
}

select.form-select:focus {
    border-color: black;
    box-shadow: 0 0 5px black;
}


::placeholder {
    color: #999; /* Placeholder text color */
    font-style: italic; /* Italicize placeholder text */
}

form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
    margin-top: 50px;
}

label {
    font-weight: bold;
    color: #555;
}

#submitBtn {
    font-weight: bold;
    background-color: black;
    color: white;
    cursor: pointer;
    border: none;
    width: 88px;
    height: 44px;
}

#submitBtn:hover {
    border: solid 1px black;
    background-color: white;
    color: black;
}


        </style>
    </head>
    <body>
        <x-navbar></x-navbar>
        <div class="container">
            <h2>Add Vehicle to Inventory</h2>
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
                        <select name="Available" class="form-select">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="Image">Image url: </label>
                        <input type="text" name="Image">
                    </div>
                    <div class="col-lg-3">
                        <label for="gasType">Gas Type: </label>
                        <div class="col-lg-3">
                            <select name="gasType" class="form-select">
                                <option value="petrol">Gas</option>
                                <option value="diesel">Diesel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-3">
                    <label for="Color">Color: </label>
                    <select name="Color" class="form-select">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="silver">Silver</option>
                        <option value="gray">Gray</option>
                        <option value="blue">Blue</option>
                        <option value="red">Red</option>
                        <option value="green">Green</option>
                        {{-- <option value="brown">Brown</option> --}}
                        {{-- <option value="orange">Orange</option> --}}
                        <option value="yellow">Yellow</option>
                        {{-- <option value="purple">Purple</option>
                        <option value="gold">Gold</option>
                        <option value="bronze">Bronze</option>
                        <option value="beige">Beige</option>
                        <option value="burgundy">Burgundy</option>
                        <option value="navy">Navy</option>
                        <option value="maroon">Maroon</option>
                        <option value="charcoal">Charcoal</option> --}}
                    </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="vehicleType">Vehicle Type (sedan, suv, etc.): </label>
                        <select name="vehicleType" class="form-select">
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="truck">Truck</option>
                            <option value="van">Van</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="convertible">Convertible</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="Mileage">Mileage: </label>
                        <input type="number" name="Mileage">
                    </div>
                    <div class="col-lg-3">
                        <label for="Transmission">Transmission: </label>
                        <select name="Transmission" class="form-select">
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                            <option value="cvT">CVT</option>
                        </select>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-3">
                        <label for="driveTrain">Drive Train (4WD, 2WD, etc.): </label>
                        <select name="driveTrain" class="form-select">
                            <option value="4WD">4WD</option>
                            <option value="2WD">2WD</option>
                            <option value="AWD">AWD</option>
                            <option value="RWD">RWD</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="Engine">Engine: </label>
                        <input type="text" name="Engine">
                    </div>
                    <div class="col-lg-3">
                        <label for="interiorColor">Interior Color: </label>
                        <select name="interiorColor" class="form-select">
                            <option value="black">Black</option>
                            <option value="gray">Gray</option>
                            <option value="beige">Beige</option>
                            <option value="brown">Brown</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="newOrUsed">New/Used: </label>
                        <select name="newOrUsed" class="form-select">
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                        </select>
                    </div>
                </div>
                <button id="submitBtn" class="btn btn-primary" type="Submit">Submit</button>
            </form>
        </div>
    </body>
</html>
