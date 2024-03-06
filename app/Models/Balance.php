<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

   
    protected $table = 'balance';
    protected $primaryKey = 'balance_ID';
    
    public $timestamps = false;

    protected $fillable = [
        'user_ID',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID', 'id');
    }
}
