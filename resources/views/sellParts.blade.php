<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Parts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }
        .table {
            margin-bottom: 20px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>
    <div class="container">
        <h1>Sell Parts</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Price</th>
                    <th>Available Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parts as $part)
                    <tr>
                        <td>{{ $part->PartName }}</td>
                        <td>{{ $part->Price }}</td>
                        <td>{{ $part->Quantity }}</td>
                        <td>
                            <form action="{{ route('add.to.cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="partNumber" value="{{ $part->PartNumber }}">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" min="1" max="{{ $part->Quantity }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Display Shopping Cart -->
        <h2>Shopping Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalCost = 0;
                @endphp
                @foreach ($cart as $partNumber => $item)
                    @php
                        $part = App\Models\Part::where('PartNumber', $partNumber)->first();
                        $totalPrice = $part->Price * $item['quantity'];
                        $totalCost += $totalPrice;
                    @endphp
                    <tr>
                        <td>{{ $part->PartName }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $part->Price }}</td>
                        <td>{{ $totalPrice }}</td>
                        <td>
                            <form action="{{ route('sell.parts.removeFromCart', ['partNumber' => $partNumber]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>

        <h3>Total Cost: {{ $totalCost }}</h3>
        <form action="{{ route('sell.parts.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
</body>
</html>
