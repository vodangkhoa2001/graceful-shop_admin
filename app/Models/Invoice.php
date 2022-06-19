<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invoice_code',
        'voucher_id',
        'quantity',
        'ship_price',
        'until_price',
        'name',
        'phone',
        'address',
        'status',
    ];
    public function invoice_detail()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id')->with(['product']);
    }
}
