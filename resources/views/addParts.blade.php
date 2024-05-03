<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: auto;
            padding: 50px 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #000;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        input {
            width: calc(50% - 10px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #000;
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
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>
    
    <div class="container p-5">
        <h1>Add Parts</h1>
        <form action="{{ route('Part.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label for="PartNumber">Serial Number</label>
                    <input type="text" name="PartNumber" required>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="PartName">Part Name</label>
                    <input type="text" name="PartName" required>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="Price">Price ($)</label>
                    <input type="number" name="Price" step="0.01" min="0" required>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="Quantity">Quantity</label>
                    <input type="number" name="Quantity" min="0" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
