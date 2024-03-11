<?php

namespace Modules\Banners\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Banners\Database\factories\BannerFactory;
use Modules\Products\app\Models\Product;

class Banner extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'banner_products','banner_id','product_id')->distinct();
    }

}
