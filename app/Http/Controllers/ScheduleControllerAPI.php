<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ScheduleControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        $today = DB::select("SELECT m.firstName as Manager, s1.firstName as Sales1, s2.firstName as Sales2, t.firstName as Technician FROM ((((schedules s JOIN users m ON s.Manager = m.id) JOIN users s1 ON s.Salesperson1 = s1.id) JOIN users s2 ON s.Salesperson2 = s2.id) JOIN users t ON s.Technician = t.id) WHERE s.Date = CAST( GETDATE() AS Date );");
        if($today == null){
            $today = "None";
        }
        return view("/viewSchedules", ['today'=>$today, 'schedules'=>$schedules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Schedule::create($data);
        return redirect($to = "/viewSchedule");
    }

    /**
     * Display the specified resource.
     */
    // Assuming you have a method in your controller to fetch schedules
    public function showSchedule(Request $request)
    {
        $today = date('Y-m-d');
        $selectedDate = $request->input('date') ?? $today;
    
        $schedule = Schedule::where('Date', $selectedDate)->first();
    
        if ($schedule) {
            $manager = User::find($schedule->Manager)->firstName;
            $sales1 = User::find($schedule->Salesperson1)->firstName;
            $sales2 = User::find($schedule->Salesperson2)->firstName;
            $technician = User::find($schedule->Technician)->firstName;
    
            return response()->json([
                'Manager' => $manager,
                'Sales1' => $sales1,
                'Sales2' => $sales2,
                'Technician' => $technician,
            ]);
        } else {
            return response()->json('None');
        }
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

    public function newSchedule(){
        $managers = DB::select("SELECT firstName, id FROM users WHERE userType = 'Manager'");
        $salesperson = DB::select("SELECT firstName, id FROM users WHERE userType = 'Salesperson'");
        $technicians = DB::select("SELECT firstName, id FROM users WHERE userType = 'Technician'");
        return view('/createSchedule', ['managers'=>$managers, 'salesperson'=>$salesperson, 'technicians'=>$technicians]);
    }
}
