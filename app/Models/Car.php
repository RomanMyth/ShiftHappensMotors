<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Car extends Model
{
    use HasFactory; use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;protected $fillable = ["Vin", "Make", "Model", "Year", "Price", "Available", "Image", "gasType", "Color", "vehicleType", "Mileage", "Transmission", "driveTrain", "Engine", "interiorColor", "newOrUsed"];
}
