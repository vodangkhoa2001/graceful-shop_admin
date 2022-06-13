<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'num_like', 
    ];
    
    use HasFactory;
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id', 'id')->where('pictures.status', '=', 1);
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id', 'id');
    }
}
