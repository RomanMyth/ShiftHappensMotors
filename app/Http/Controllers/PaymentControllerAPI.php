<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\User;

class PaymentControllerAPI extends Controller
{
    public function showPaymentForm()
    {
        // Get the authenticated user's ID
        $userId = auth()->id();

        // Retrieve the user's balance
        $balance = Balance::where('user_ID', $userId)->first();

        return view('Payments', ['balance' => $balance]);
    }



  public function processPayment(Request $request)
{
    // Validate payment amount
    $request->validate([
        'amount' => 'required|numeric|min:0',
    ]);

    // Get the authenticated user's ID
    $userId = auth()->id();

    // Retrieve the user's balance
    $balance = Balance::where('user_id', $userId)->first();

    // Check if the user exists
    if (!$balance) {
        // Handle the case where the user does not exist
        return redirect()->back()->with('error', 'User balance not found.');
    }

    // Ensure the payment amount does not exceed the current balance
    if ($request->amount > $balance->balance) {
        return redirect()->back()->with('error', 'Payment amount exceeds current balance.');
    }

    // Calculate the new balance after deducting the payment amount
    $newBalance = $balance->balance - $request->amount;

    // Update the user's balance
    $balance->balance = $newBalance;
    $balance->save();

    return redirect()->back()->with('success', 'Payment processed successfully. Balance updated.');
}


    
    

}
