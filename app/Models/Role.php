<?php

namespace App\Models;

use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    function getLangAttribute()
    {
        if(app()->isLocale('ar'))
            return $this->name_ar;
        return $this->name_en;
    }


    public function Pages()
    {
        return $this->belongsToMany(Page::class, 'roles_pages', 'role_id', 'page_id');
    }
}
