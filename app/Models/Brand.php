<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getImageAttribute($image){

        if($image == null){
            return 'noimg.jpg';
        }else{
            if(file_exists('storage/brands/'.$image)){
                return $image;
            }else{
                return 'noimg.jpg';
            }
        }
    }
}
