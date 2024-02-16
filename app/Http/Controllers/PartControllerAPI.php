<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;

class PartControllerAPI extends Controller
{
    public function create(){

        return view("addParts");
     }
    public function index()
    {
        $newPart = Part::all();

        return view("Home", ["parts"=>$newPart]);
    }

    public function store(Request $request)
    {
        $newPart = $request->all();
        Part::create($newPart);
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
