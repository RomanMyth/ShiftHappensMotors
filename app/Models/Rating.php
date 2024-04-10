<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'Rating_ID';
    protected $fillable = [
        'Employee_ID',
        'Employee_Name',
        'rating',
        'comment'
    ];
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'Employee_ID', 'id');
    }

}
