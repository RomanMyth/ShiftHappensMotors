<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    function getTestData()
    {
        $data = Test::all();
        echo $data;
    }

  
}