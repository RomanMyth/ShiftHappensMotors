<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::all();
        $makes = DB::select("SELECT DISTINCT CONVERT(varchar(max), Make) as Make FROM cars;");
        return view("Home", ["cars"=>$data, 'makes'=>$makes]);
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
