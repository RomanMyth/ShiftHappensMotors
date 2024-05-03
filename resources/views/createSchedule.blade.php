<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Schedule</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin-top: 50px; /* Adjusted to accommodate the navbar */
        }

        /* Container styling */
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f9f9f9;
            position: relative;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        select {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16"><path d="M0 6l8 8 8-8H0z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
            padding-right: 30px; /* Adjusted to accommodate the arrow icon */
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: white;
            color: #000;
            border: 1px solid black;
        }

        /* Navbar styling */
        x-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>

    <h1 style="text-align: center;">Create a Schedule</h1>

    <div class='container'>
        <form action="{{ route('schedule.create') }}" method="POST">
            @csrf
            <label for="Date">Date</label>
            <input type="date"  name='Date' required>

            <select name="Manager" required>
                <option value="" disabled selected>Select Manager</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->firstName }}</option>
                @endforeach
            </select>

            <div style="display: flex; width: 100%; justify-content: space-between;">
                <select name="Salesperson1" id="sales1" style="flex: 1;" required>
                    <option value="" disabled selected>Select Salesperson 1</option>
                    @foreach ($salesperson as $sales)
                        <option value="{{ $sales->id }}">{{ $sales->firstName }}</option>
                    @endforeach
                </select>
                <select name="Salesperson2" id="sales2" style="flex: 1;" required>
                    <option value="" disabled selected>Select Salesperson 2</option>
                    @foreach ($salesperson as $sales)
                        <option value="{{ $sales->id }}">{{ $sales->firstName }}</option>
                    @endforeach
                </select>
            </div>

            <select name="Technician" required>
                <option value="" disabled selected>Select Technician</option>
                @foreach ($technicians as $technician)
                    <option value="{{ $technician->id }}">{{ $technician->firstName }}</option>
                @endforeach
            </select>
            <button type='submit'>Create Schedule</button>
        </form>
    </div>
</body>
</html>
