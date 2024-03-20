<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Balance;
//Comments are here to review my code if needed later when working on other pages
class PartControllerAPI extends Controller
{
    public function create(){

        return view("addParts");
     }
    public function index()
    {
        $newPart = Part::all();

        return view("Home", ["parts"=>$newPart]);
    }



    public function sellParts()
    {
        $parts = Part::all();
        $cart = session()->get('cart', []); 
    
     
        return view('sellParts', ['parts' => $parts, 'cart' => $cart]);
    }




public function sellPart(Request $request, $partNumber)
{
   
    $part = Part::where('PartNumber', $partNumber)->firstOrFail();
    $request->validate([
        'quantity' => ['required', 'integer', 'min:1', 'max:' . $part->Quantity],
    ]);
    $part->Quantity -= $request->input('quantity');
    $part->save();
    return redirect()->route('sell.parts')->with('success', 'Part sold successfully.');
}


    public function store(Request $request)
    {
        $newPart = $request->all();
        Part::create($newPart);
        echo"Success";

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    //Update the specified resource in storage.
   
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addToCart(Request $request)
    {
        $partNumber = $request->input('partNumber');
        $quantity = $request->input('quantity');

        // Retrieve the part from the database
        $part = Part::where('PartNumber', $partNumber)->firstOrFail();

        // Get the current cart items from session or initialize an empty array
        $cart = session()->get('cart', []);

        // Check if the part is already in the cart
        if (array_key_exists($partNumber, $cart)) {
            // Increment the quantity if the part is already in the cart
            $cart[$partNumber]['quantity'] += $quantity;
        } else {
            // Add the part to the cart with the given quantity
            $cart[$partNumber] = [
                'quantity' => $quantity,
                'price' => $part->Price,
                'name' => $part->PartName
            ];
        }

        // Store the updated cart in session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Part added to cart successfully.');
    }

    public function checkout(Request $request)
{
    // Get the cart from the session
    $cart = session()->get('cart', []);

    // Calculate total cost of parts in the cart
    $totalCost = 0;
    foreach ($cart as $partNumber => $quantity) {
        $part = Part::where('PartNumber', $partNumber)->firstOrFail();
        // Ensure $quantity is cast to integer and is positive

        $quantity = max(0, (int)$quantity); // Ensure quantity is not negative
        // Calculate total price for this part based on its price and quantity
        $totalCost += $part->Price * $quantity;
    }

   // Update user's balance
$userId = auth()->id();
$balanceRecord = Balance::where('user_id', $userId)->first();

if ($balanceRecord) {
    // If balance record exists, update balance
    foreach ($cart as $partNumber => $quantity) {
        $part = Part::where('PartNumber', $partNumber)->firstOrFail();
        // Ensure $quantity is cast to integer
        $quantity = (int)$quantity;
        // Calculate total price for this part based on its price and quantity
        $totalCost += $part->Price * $quantity;
    }
    $balanceRecord->balance += $totalCost;
    $balanceRecord->save();
} else {
    // If balance record does not exist, create new balance record
    Balance::create([
        'user_id' => $userId,
        'balance' => $totalCost,
    ]);
}

    // Clear the cart after successful checkout
    session()->forget('cart');

    // Redirect the user back with a success message
    return redirect()->route('payment')->with('success', 'Checkout successful. Balance updated.');
}

    

    

public function removeFromCart($partNumber)
{
    $cart = session()->get('cart', []);

    // Remove the specified part from the cart
    unset($cart[$partNumber]);

    // Update the cart in session
    session()->put('cart', $cart);

    // Redirect back to the sell parts page with a success message
    return redirect()->route('sell.parts')->with('success', 'Item removed from cart.');
}



}
