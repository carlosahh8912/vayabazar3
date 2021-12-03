<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'shipping_id',
        'store_id',
        'shipping_address',
        'total_cost',
        'total',
        'payment_status',
        'shipping_status',
        'status',
    ];

    public function SaleDetails(){
        return $this->hasMany(SaleDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function shippig(){
        return $this->belongsTo(Shipping::class);
    }
}
