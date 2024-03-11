<?php

namespace Modules\ProductsCategory\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductsCategory\Database\factories\ProductsCategoryFactory;

class ProductsCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


    //Full file path
    // public function getImageAttribute($value)
    // {
    //     if(!$value)
    //         return null;
    //     else
    //         return asset('/uploads/'. $value);
    // }

}
