<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'color_id',
        'size_id',
        'user_id',
        'quantity',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')
        ->with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC');
    }
    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
}
