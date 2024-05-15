<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'PartNumber';

    protected $fillable = [
        'PartNumber',
        'PartName',
        'Price',
        'Quantity'
    ];
}

