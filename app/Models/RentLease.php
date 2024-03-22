<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLease extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'LeaseID';
    protected $fillable = [
        'UserID',
        'VIN',
        'Start_Date',
        'End_Date',
        'PricePerDay',
        'Total_Price'
    ];
    use HasFactory;

    public function PersonRenting()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
}
