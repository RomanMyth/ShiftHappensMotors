<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .col-lg-4 {
            display: flex;
            flex-direction: column;
        }
        .col-lg-6 {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>
    <div class="container p-5">
        <h1>Add Employee</h1>
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
                    <select name="userType">
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
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
