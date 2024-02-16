<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .col-lg-3 {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container p-5">
        <h1>Add Employee</h1>
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="row">
                {{-- <div class="col-lg-3">
                    <label for="Employee_ID">Employee ID:</label>
                    <input type="text" name="Employee_ID">
                </div> --}}
                <div class="col-lg-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name">
                </div>
                <div class="col-lg-3">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName">
                </div>
                <div class="col-lg-3">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="address">Address:</label>
                    <input type="text" name="address">
                </div>
                <div class="col-lg-3">
                    <label for="department">Department:</label>
                    <input type="text" name="department">
                </div>
                <div class="col-lg-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
