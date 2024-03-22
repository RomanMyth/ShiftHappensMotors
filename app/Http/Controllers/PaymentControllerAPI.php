<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;

class PaymentControllerAPI extends Controller
{
    /**
     * Display the payment form.
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentForm()
    {
        // Get the authenticated user's ID
        $userId = auth()->id();

        // Retrieve the user's balance
        $balance = Balance::where('user_id', $userId)->first();

        return view('payments', ['balance' => $balance]);
    }

    /**
     * Process a payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        // Validate the payment request
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Retrieve the user's balance
        $balance = Balance::where('user_id', $userId)->first();

        if (!$balance) {
            return redirect()->back()->with('error', 'User balance not found');
        }

        // Calculate the new balance after payment
        $newBalance = $balance->balance - $request->amount;

        if ($newBalance < 0) {
            return redirect()->back()->with('error', 'Insufficient balance');
        }

        // Update the user's balance
        $balance->balance = $newBalance;
        $balance->save();

        return redirect()->back()->with('success', 'Payment processed successfully');
    }
}
