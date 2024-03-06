<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class MaintenanceControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'vin' => 'required',
            'date' => 'required|date',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'apptTime' => 'required',
            'maintenanceInstruction' => 'required',
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Check if the selected date is not in the past and is at least 5 days out
        $selectedDate = Carbon::parse($request->input('date'))->startOfDay();
        $currentDate = Carbon::now()->startOfDay();
        $minDate = $currentDate->copy()->addDays(5);

        if ($selectedDate <= $currentDate || $selectedDate < $minDate) {
            return response()->json(['message' => 'Invalid date selected'], 400);
        }

        // Check if there are already 5 appointments for the selected date
        $countAppointments = Maintenance::whereDate('date', $selectedDate)->count();

        if ($countAppointments >= 5) {
            return response()->json(['message' => 'Maximum appointments reached for this day'], 400);
        }

        // Check if the selected time slot is available
        $existingAppointment = Maintenance::where('date', $selectedDate)
            ->where('apptTime', $request->input('apptTime'))
            ->first();

        if ($existingAppointment) {
            return response()->json(['message' => 'Appointment time slot not available'], 400);
        }

        // Create a new appointment using the provided data
        $appointment = Maintenance::create([
            'email' => $request->input('email'),
            'phoneNumber' => $request->input('phoneNumber'),
            'vin' => $request->input('vin'),
            'date' => $selectedDate,
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'apptTime' => $request->input('apptTime'),
            'maintenanceInstruction' => $request->input('maintenanceInstruction'),
        ]);

        // Return a success response
        return response()->json(['message' => 'Appointment scheduled successfully', 'data' => $appointment], 200);
        return redirect(route('/'));
    }

    // Other methods...



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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

    public function schMaintenanceForm(){
        return view('scheduleMaintenance');
    }


    public function getAppointmentCount(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'date' => 'required|date',
        ]);

        // Parse the date from the request
        $date = Carbon::parse($request->input('date'))->startOfDay();

        // Count the appointments for the given date
        $countAppointments = Maintenance::whereDate('date', $date)->count();

        // Return the count of appointments
        return response()->json(['count' => $countAppointments]);
    }



//     public function checkAppointments(Request $request){
//     $date = Carbon::parse($request->input('date'))->toDateString();
//     $countAppointments = Maintenance::whereDate('date', $date)->count();

//     return response()->json($countAppointments);
//     }




//     public function getUnavailableDates(){
//         $unavailableDates = Maintenance::select('date')
//             ->groupBy('date')
//             ->havingRaw('COUNT(*) >= 5') // Assuming 5 is the max appointments per day
//             ->get()
//             ->pluck('date')
//             ->map(function ($date) {
//                 // Format dates as 'YYYY-MM-DD'
//                 return Carbon::parse($date)->format('Y-m-d');
//             });

//         return response()->json($unavailableDates);
//     }





//     public function getAvailableTimes(Request $request){
//     $date = $request->input('date');

//     // Get all time slots for the specified date
//     $allTimes = [
//         ['value' => '09:00:00', 'label' => '9:00 AM', 'available' => true],
//         ['value' => '11:00:00', 'label' => '11:00 AM', 'available' => true],
//         ['value' => '13:00:00', 'label' => '1:00 PM', 'available' => true],
//         ['value' => '15:00:00', 'label' => '3:00 PM', 'available' => true],
//         ['value' => '17:00:00', 'label' => '5:00 PM', 'available' => true]
//         // Add other available time slots
//     ];

//     // Check if any appointments exist for the specified date
//     $existingAppointments = Maintenance::whereDate('date', $date)->count();

//     // If there are already appointments for the date, mark the corresponding time slots as unavailable
//     if ($existingAppointments >= 5) {
//         foreach ($allTimes as &$time) {
//             $time['available'] = false;
//         }
//     }

//     return response()->json($allTimes);
// }





// public function markAppointmentUnavailable(Request $request)
// {
//     // Validate the request data
//     $validator = Validator::make($request->all(), [
//         'date' => 'required|date',
//         'apptTime' => 'required',
//     ]);

//     // If validation fails, return the validation errors
//     if ($validator->fails()) {
//         return response()->json(['errors' => $validator->errors()], 400);
//     }

//     // Find the appointment by date and apptTime
//     $appointment = Maintenance::where('date', $request->input('date'))
//                                 ->where('apptTime', $request->input('apptTime'))
//                                 ->first();

//     // If the appointment exists, mark it as unavailable
//     if ($appointment) {
//         $appointment->update(['is_available' => false]);
//         return response()->json(['message' => 'Appointment marked as unavailable'], 200);
//     } else {
//         return response()->json(['message' => 'Appointment not found'], 404);
//     }
// }


}
