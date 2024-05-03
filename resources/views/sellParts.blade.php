<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Parts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            filters = {
                MaxPrice : 0,
                MinPrice : 0
            };

            $(".Max-Price").change(function(){
                filters.MaxPrice= this.value;
            })


            $(".Min-Price").change(function(){
                filters.MinPrice= this.value;
            });

            

            $(".filter").change(function(){
                $(".part").each(function(){
                    console.log($(this).attr("data-Price"))
                    if((filters.MinPrice < parseFloat($(this).attr("data-Price")) || filters.MinPrice==0) && (filters.MaxPrice > parseFloat($(this).attr("data-Price"))|| filters.MaxPrice==0) ){
                        $(this).show();
                    }
                    else{
                        $(this).hide();
                    }
                })
            });

            // Function to handle search by serial number
            $(".search-input").keyup(function(){
                var searchText = $(this).val();


                $(".part").each(function(){

                    if( $(this).attr("data-serial").indexOf(searchText) != -1 || $(this).attr("data-name").indexOf(searchText) != -1 ){
                        $(this).show();
                    }
                    else{
                        $(this).hide();
                    }

                });
                
            });
        });
    </script>
    <style>
        *{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
                    
        .navbar{
            justify-content: space-around;
        }


        
        button[type="submit"] {
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

        .container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            text-align: center;
            color: #343a40;
        }

        #filters {
            margin-bottom: 20px;
        }

        #filters input[type="number"] {
            width: 100px;
        }
        
        .partsBtn{
            width: 30%;
            margin-top: 10px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>
   
    <br>
    <br>
    <div class="container">
        Maximum Price
        <div>
            <input type="number" class="Max-Price filter">
        </div>
        <br>
        Minimum Price 
        <div>
            <input type="number" class="Min-Price filter">
        </div>
        <br>
        Search By Name or Serial Number
        <div>
        <input type="text" class="search-input">
        </div>   
        <h1>Buy the Parts</h1>
      
        <table class="table part-table">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Part Name</th>
                    <th>Price</th>
                    <th>Available Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parts as $part)
                    <tr class="part" data-Price="{{ $part->Price }}" data-serial="{{$part->PartNumber}} " data-name="{{$part->PartName}}">
                        <td>{{ $part->PartNumber }}</td>
                        <td>{{ $part->PartName }}</td>
                        <td>{{ $part->Price }}</td>
                        <td>{{ $part->Quantity }}</td>
                        <td>
                            <form action="{{ route('add.to.cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="partNumber" value="{{ $part->PartNumber }}">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" min="1" max="{{ $part->Quantity }}">
                                <button type="submit" class="btn btn-primary partsBtn" style="margin-left: 35px; margin-top:0;">Add to Cart</button>
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
                    <th>Serial Number</th>
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
                        <td>{{ $part->PartNumber }}</td>
                        <td>{{ $part->PartName }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $part->Price }}</td>
                        <td>{{ $totalPrice }}</td>
                        <td>
                            <form action="{{ route('sell.parts.removeFromCart', ['partNumber' => $partNumber]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit1" class="btn btn-danger partsBtn">-</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Cost: {{ $totalCost }}</h3>
        <form id="checkoutForm" action="{{ route('sell.parts.checkout') }}" method="POST" style="text-align: center;">
            @csrf
            <input type="hidden" name="userId" value="{{ auth()->id() }}">
            <input type="hidden" name="totalCost" value="{{ $totalCost }}">
            <button type="submit" class="btn btn-primary partsBtn">Checkout</button>
        </form>
    </div>
</body>
</html>
