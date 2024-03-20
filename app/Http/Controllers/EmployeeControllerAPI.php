<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;


class EmployeeControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     public function create(){

        return view("addEmployee");
     }
    public function index()
    {
        $newEmp = Employee::all();

        return view("Home", ["employees"=>$newEmp]);
    }

    public function store(Request $request)
    {
        $newEmp = $request->all();
        User::create($newEmp);
        echo"Success";

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
}
