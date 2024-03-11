<?php

namespace App\Models\Traits;

trait HasLanguage
{
    public function getLangAttribute()
    {
        if(app()->isLocale('ar')){
            return $this->name_ar;
        }else {
            return $this->name_en;
        }
    }
}