<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css" type="text/css">
    <style>
        .col-lg-4 {
            display: flex;
            flex-direction: column;
        }
        .col-lg-6 {
            display: flex;
            flex-direction: column;
        }
        .empSelect {
    width: 416px;
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


.empSelect option {
    padding: 10px;
}


.empSelect:hover {
    border-color: #007bff;
}

.empSelect:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.container {
                max-width: 800px; /* Limit the width of the container */
            margin: 0 auto; /* Center the container horizontally */
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            }

            h2 {
                text-align: center;
            margin-bottom: 30px;
            }



            input[type="text"],
input[type="email"],
input[type="date"], {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="text"],
input[type="email"],
input[type="date"],
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

input[type="text"]:hover,
input[type="email"]:hover,
input[type="date"]:hover,
textarea:hover {
    border-color: #007bff; /* Change border color on hover */
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
textarea:focus {
    border-color: #007bff; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add box shadow on focus */
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
}

#submitBtn {
    font-weight: bold;
}

h2 {
                text-align: center;
            margin-bottom: 30px;
            }


    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>

    <div id="empBack" class="emp-container p-5">
        <h2>Add Employee</h2>
        <form action="{{ route('employees.store') }}" method="POST" class="container">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName">
                </div>
                <div class="col-lg-4">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName">
                </div>
                <div class="col-lg-4">
                    <label for="Phone">Phone:</label>
                    <input type="text" name="Phone">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <label for="Address">Address:</label>
                    <input type="text" name="Address">
                </div>
                <div class="col-lg-4">
                    <label for="userType">Department:</label>
                    <select class="empSelect" name="userType">
                        <option value="Manager">Manager</option>
                        <option value="Salesperson">Salesperson</option>
                        <option value="Technician">Technician</option>
                    </select>
                    {{-- <input type="text" name="userType"> --}}
                </div>
                <div class="col-lg-4">
                    <label for="email">Email:</label>
                    <input type="email" name="email">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="password">Enter Password (Chosen by employee):</label>
                    <input type="text" name="password">
                </div>
                <div class="col-lg-6">
                    <label for="DOB">Date of Birth:</label>
                    <input type="date" name="DOB">
                </div>
            </div>
            <button id="submitBtn" type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
