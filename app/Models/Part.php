<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'PartNumber';
    protected $fillable = [
        'PartName',
        'Price',
        'Quantity'
    ];
    use HasFactory;
}
