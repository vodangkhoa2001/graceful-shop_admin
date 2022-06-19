<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id', 
        'name',
        'address',
        'phone_number',
        'is_default',
    ];

}
