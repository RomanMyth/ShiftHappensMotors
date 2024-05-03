<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
            .navbar{
                justify-content: space-around;
            }
</style>
<body>

    <x-navbar>
    </x-navbar>

    <div class="container">
        <h1 class="mt-5">Make a Payment</h1>
        @if ($balance)
            <p>Your current balance: ${{ $balance->balance }}</p>
        @endif
        <form id="paymentForm" action="{{ route('payment.process') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="paymentAmount" class="form-label">Payment Amount:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</body>
</html>
