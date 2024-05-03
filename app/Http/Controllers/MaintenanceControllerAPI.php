<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;


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
        //return redirect(route('/'));
    }

    // Other methods...



    /**
     * Display the specified resource.
     */
    public function show()
    {


        // Retrieve all appointments from the database
        $appointments = Maintenance::all();

        // Pass the appointments data to the view
        return view('viewMaintenanceSchedule', ['appointments' => $appointments]);

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

    /**
     * Delete an appointment.
     *
     *
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

    Maintenance::where('Appointment_ID', $request->Appointment_ID)->delete();

    }




    public function search(Request $request)
    {
        // Retrieve the search query from the request
        $query = $request->input('query');
        $selectedMonth = $request->input('month');

        // Initialize a collection to hold the matching appointments
        $matchingAppointments = collect([]);

        // Check if the query contains a month name
        if ($selectedMonth) {
            // Perform the search query for appointments matching the month
            $monthAppointments = Maintenance::whereMonth('date', Carbon::parse($selectedMonth)->month)->get();
            // Merge the matching appointments into the collection
            $matchingAppointments = $matchingAppointments->merge($monthAppointments);
        }

        // Perform additional search for other fields if applicable
        if ($query) {
            $otherAppointments = Maintenance::where('email', 'like', "%$query%")
                ->orWhere('phoneNumber', 'like', "%$query%")
                ->orWhere('maintenanceInstruction', 'like', "%$query%")
                ->orWhere('apptTime', 'like', "%$query%")
                ->get();

            // Merge the matching appointments into the collection
            $matchingAppointments = $matchingAppointments->merge($otherAppointments);
        }

        // Pass the matched appointments data to the view
        return view('viewMaintenanceSchedule', ['appointments' => $matchingAppointments]);
    }

    public function filterByMonth(Request $request)
{
    $selectedMonth = $request->input('month');
    // Log selected month
    Log::info("Selected Month: " . $selectedMonth);

    if ($selectedMonth) {
        $monthAppointments = Maintenance::whereMonth('date', Carbon::parse($selectedMonth)->month)->get();
        // Log retrieved appointments
        Log::info("Appointments: " . $monthAppointments);
        return response()->json(['appointments' => $monthAppointments]);
    } else {
        // Handle invalid input or return all appointments if no month is selected
        $appointments = Maintenance::all();
        return response()->json(['appointments' => $appointments]);
    }
}





    // // Retrieve the search query from the request
    // $query = $request->input('query');

    // // Perform the search query
    // $appointments = Maintenance::where('email', 'like', "%$query%")
    //     ->orWhere('phoneNumber', 'like', "%$query%")
    //     ->orWhere('maintenanceInstruction', 'like', "%$query%")
    //     ->orWhere('date', 'like', "%$query%")
    //     ->orWhere('apptTime', 'like', "%$query%")
    //     ->get();

    // // Pass the matched appointments data to the view
    // return view('viewMaintenanceSchedule', ['appointments' => $appointments]);




    public function getAppointments()
    {
    $appointments = Maintenance::all();
    return response()->json(['appointments' => $appointments]);
    }


    public function schMaintenanceForm(){
        $appointments = $this->getNextMonth();

        return view('scheduleMaintenance', ['appointments'=>$appointments]);
    }

    public function viewMaintenanceScheduleForm(){
        return view('viewMaintenanceSchedule');
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

    public function getNextMonth(){
        $appointments = DB::select("SELECT date, apptTime FROM maintenances WHERE date BETWEEN Getdate()+4 AND GETDATE()+30 GROUP BY date, apptTime;");

        return $appointments;
    }

}
