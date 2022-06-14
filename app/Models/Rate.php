<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'user_id',
        'num_rate',
        'description',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function pictures_rate()
    {
        return $this->hasMany(PictureRate::class, 'rate_id', 'rates.id');
    }
}