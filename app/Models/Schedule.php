<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'Date',
        'Manager',
        'Salesperson1',
        'Salesperson2',
        'Technician'
    ];
}
