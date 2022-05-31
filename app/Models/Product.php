<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id', 'id')->where('pictures.status', '=', 1);
    }
}
