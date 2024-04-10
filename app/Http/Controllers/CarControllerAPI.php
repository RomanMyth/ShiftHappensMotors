<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Balance;
use App\Models\RentLease;

//Deals with Data dealing with Dates
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::all();
        $makes = DB::select("SELECT DISTINCT CONVERT(varchar(max), Make) as Make FROM cars;");

        $favorites = [];
        if(Auth::user()){
            $id = Auth::user()->id;
            $favorites = DB::select("SELECT Vin FROM favorites WHERE User_ID = $id;");
        }
        
        //return $favorites;
        return view("Home", ["cars"=>$data, 'makes'=>$makes, 'favorites'=>$favorites]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Car::create($data);
        echo "Success";

          

    }

    public function storeLease(Request $request)
{
    // Retrieve necessary data from the request
    $userId = auth()->id();
    $vin = $request->input('vin');
    $startDate = Carbon::parse($request->input('start_date'));
    $endDate = Carbon::parse($request->input('end_date'));
    $pricePerDay = $request->input('price_per_day');

    // Calculate total price based on the number of days leased
    $totalPrice = $startDate->diffInDays($endDate) * $pricePerDay;

    // Create a new lease record
    $lease = new RentLease();
    $lease->UserID = $userId;
    $lease->VIN = $vin;
    $lease->Start_Date = $startDate;
    $lease->End_Date = $endDate;
    $lease->PricePerDay = $pricePerDay;
    $lease->Total_Price = $totalPrice;
    $lease->save();

    // Update the current user's balance
    $balance = Balance::where('user_id', $userId)->first();
    if ($balance) {
        $balance->balance += $totalPrice;
        $balance->save();
    } else {
        // If the user doesn't have a balance record, create one
        $balance = new Balance();
        $balance->user_id = $userId;
        $balance->balance = $totalPrice;
        $balance->save();
    }

    // Redirect or return a response as needed
    return redirect()->back()->with('success', 'Lease created successfully.');
}


    public function updateBalance(Request $request)
    {
        // Retrieve the authenticated user's ID
        $userId = auth()->id();
    
        // Retrieve the car price from the request
        $carPrice = $request->input('price');
    
        // Retrieve the user's balance
        $balance = Balance::where('user_ID', $userId)->first();
    
        // Check if the user has a balance record
        if (!$balance) {
            // If balance record does not exist, create a new one
            $balance = new Balance();
            $balance->user_id = $userId;
            $balance->balance = $carPrice; // Initial balance is the car price
        } else {
            // If balance record exists, add the car price to the existing balance
            $balance->balance += $carPrice;
        }
    
        // Retrieve the Total_Price from the request
        $totalPrice = $request->input('Total_Price');
    
        // Add the Total_Price to the user's balance
        $balance->balance += $totalPrice;
    
        $balance->save();
    
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Balance updated successfully.');
    }
    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    public function favorite(Request $request){
        if(!Auth::user()){
            return auth()->check();
        }
        
        $Vin = $request->Vin;
        $User_ID = auth()->id();

        Favorite::create(['User_ID' => $User_ID, 'Vin' => $Vin]);
    }

    public function deleteFavorite(Request $request){
        $Vin = $request->Vin;
        $User_ID = auth()->id();

        Favorite::where(['User_ID' => $User_ID, 'Vin' => $Vin])->delete();
    }

    public function addVehicleForm(){
        return view("addVehicle");
    }

    public function showBuyVehicleDetails(Request $request)
    {
        $car = Car::where('Vin', $request["car_details"])->first();
        if (!$car) {
            // Handle the case where the car is not found
            abort(404);
        }
    
        // Pass the car data to the view, including the picture URL
        return view('BuyVehicleDetails', compact('car'));
    }

    public function showLeaseVehicleDetails(Request $request)
    {
        $car = Car::where('Vin', $request["car_details"])->first();
        if (!$car) {
            // Handle the case where the car is not found
            abort(404);
        }
    
        // Pass the car data to the view, including the picture URL
        return view('LeaseVehicleDetails', compact('car'));
    }
    

}
