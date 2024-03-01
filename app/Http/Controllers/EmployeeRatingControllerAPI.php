<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeRatingControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function create()
{
    $employees = User::where('userType', '!=', 'Customer')->get(['id', 'firstName', 'lastName']);
    $ratings = Rating::with('employee')->get(); // Include the related employee
    return view('employeeRating', compact('employees', 'ratings'));
}

     


public function index()
{
    // Fetch all ratings
    $ratings = Rating::all();
    return view('employeeRating', compact('ratings'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'employee_id' => 'required|exists:users,id', 
        'rating' => 'required|numeric|min:0|max:5',
        'comment' => 'required|string|max:255', 
    ]);

    // Retrieve the employee's name based on the provided employee ID
    $employee = User::findOrFail($validatedData['employee_id']);

    // Create a new rating instance
    $rating = new Rating();
    $rating->Employee_ID = $validatedData['employee_id'];
    $rating->Employee_Name = $employee->firstName . ' ' . $employee->lastName; // Concatenate first name and last name
    $rating->rating = $validatedData['rating'];
    $rating->comment = $validatedData['comment']; 
    $rating->save();

    // Redirect back to the form with a success message
    return redirect()->back()->with('success', 'Rating submitted successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the rating with the given ID
        $rating = Rating::findOrFail($id);
        return response()->json($rating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'description' => 'required|string',
        ]);

        // Find the rating by ID
        $rating = Rating::findOrFail($id);

        // Update the rating
        $rating->rating = $request->input('rating');
        $rating->description = $request->input('description');
        $rating->save();

        return response()->json($rating);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the rating by ID and delete it
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return response()->json(null, 204);
    }

    /**
     * Get employees for dropdown.
     */
    public function employeeDropdown()
    {
        // Retrieve employees where userType is not "Customer"
        $employees = User::where('userType', '!=', 'Customer')->get(['id', 'firstName', 'lastName']);
        
        return view('employeeRating', compact('employees'));
    }
}
