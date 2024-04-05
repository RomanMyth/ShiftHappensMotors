<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
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
}
