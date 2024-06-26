<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

        h2 {
            text-align: center;
            margin-bottom: 30px;
            }

        .col-lg-6 {
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 500px;
            margin: auto;
            padding: 50px 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
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
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

        button[type="submit"] {
            width: 80px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            margin-left: 11px;
        }

button[type="submit"]:hover {
    background-color: white;
    color: black;
    border: solid black 1px;
    }
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>

    <h2>Add Parts to Inventory</h2>
    <div class="container p-5">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
