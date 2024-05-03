<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .col-lg-3 {
            display: flex;
            flex-direction: column;
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

                <div class="col-lg-3">
                    <label for="PartNumber">Serial Number:</label>
                    <input type="text" name="PartNumber">
                </div>
                
                <div class="col-lg-3">
                    <label for="PartName">Part Name:</label>
                    <input type="text" name="PartName">
                </div>
                <div class="col-lg-3">
                    <label for="Price">Price:</label>
                    <input type="decimal" name="Price">
                </div>
                <div class="col-lg-3">
                    <label for="Quantity">Quantity:</label>
                    <input type="number" name="Quantity" min="0">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
            
        </form>
    </div>
</body>
</html>
