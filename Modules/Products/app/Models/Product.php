<?php

namespace Modules\Products\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Products\Database\factories\ProductFactory;
use Modules\Tags\app\Models\Tag;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function famous()
    {
        return $this->belongsToMany('App\Models\User', 'product_famouses','product_id','famous_id')->distinct();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags','product_id','tag_id')->distinct();
    }

}
