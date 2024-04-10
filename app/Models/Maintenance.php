<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Maintenance extends Model
{
    public $timestamps = false;
    protected $fillable = [
            'appointment_ID',
            'email',
            'phoneNumber',
            'vin',
            'date',
            'make',
            'model',
            'year',
            'maintenanceInstruction',
            'apptTime'
    ];
}
