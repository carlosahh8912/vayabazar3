<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'cost',
        'price',
        'purchased',
        'image',
        'brand_id',
        'status',
        'stock',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function SaleDetails(){
        return $this->hasMany(SaleDetail::class);
    }

    public function getImageAttribute($image){

        if($image == null){
            return 'noimg.jpg';
        }else{
            if(file_exists('storage/products/'.$image)){
                return $image;
            }else{
                return 'noimg.jpg';
            }
        }
    }
}
