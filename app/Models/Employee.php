<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $fillable = [
    //   i think is not needed because of the autoincrement  // 'Employee_ID',
        'name',
        'lastName',
        'phone',
        'address',
        'department',
        'email'
    ];
}

