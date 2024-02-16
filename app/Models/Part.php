<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public $timestamps = false;
    protected $fillable = [
    //   i think is not needed because of the autoincrement  // 'PartNumber',
        'PartName',
        'Price',
        'Available'
    ];
    use HasFactory;
}
