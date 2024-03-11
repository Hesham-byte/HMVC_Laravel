<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function getLangAttribute()
    {
        if(app()->isLocale('ar'))
            return $this->name_ar;
        return $this->name_en;
    }

}
