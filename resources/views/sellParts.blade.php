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
        });
    </script>
    <style>

        #banner{
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                height: 100px;
                font-size: 50px;
                font-family: Copperplate, "Copperplate Gothic Light", fantasy;
                background-image: linear-gradient(to right, rgba(59, 210, 230, 0.5), white); 
                padding: 20px;
            }
            
            .navbar{
                justify-content: space-around;
            }

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
    <div id='banner'>
        ShiftHappensMotors
    </div>

    <x-navbar>
    </x-navbar>
    <div class="container">
        Maximum Price
        <div>
            <input type="number" class="Max-Price filter">
        </div>
        Minimum Price 
        <div>
            <input type="number" class="Min-Price filter">
        </div>
        <h1>Buy the Parts</h1>
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
                    <tr class="part" data-Price="{{ $part->Price }}">
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
        <form id="checkoutForm" action="{{ route('sell.parts.checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="userId" value="{{ auth()->id() }}">
            <input type="hidden" name="totalCost" value="{{ $totalCost }}">
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
        
        
        

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get the form element
                var checkoutForm = document.getElementById('checkoutForm');
    
                // Add event listener for form submission
                checkoutForm.addEventListener('submit', function(event) {
                    // Prevent the default form submission
                    event.preventDefault();
    
                    // Submit the form
                    this.submit();
    
                    // Redirect to the payments page
                    window.location.href = "{{ route('payment.form') }}";
                });
            });
        </script> --}}

    </div>
</body>
</html>
