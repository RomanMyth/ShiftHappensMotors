<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    function getTestData()
    {
    //     $serverName = "tcp:shift-happens-motors.database.windows.net,1433";
    //     $connectionOptions = array("Database"=>"ShiftHappensMotorsDB", "Uid"=>"mftadmin", "PWD"=>"SHMdb123!");
    //     $conn = sqlsrv_connect($serverName, $connectionOptions);

    //     // $connectionInfo = array("UID" => "mftadmin", "pwd" => "SHMdb123!", "Database" => "ShiftHappensMotorsDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    //     // $serverName = "tcp:shift-happens-motors.database.windows.net,1433";
    //     // $conn = sqlsrv_connect($serverName, $connectionInfo);

    //     if($conn == false){
    //         echo "Bad connection";
    //         return $conn;
    //     }

    //    $tsql = "SELECT * FROM tests";
    //     //print_r($conn);
    //     //return $conn;

    //     $getProducts = sqlsrv_query($conn, $tsql);
           
    //     while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)){
    //         print_r($row["test"]);
    //     }

        $data = Test::all();
        echo $data;
       // return $getProducts;
        // return $conn;
    }

  
}