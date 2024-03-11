<?php

namespace Modules\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

Trait UploadTrait
{

    //Main Upload File Method
    public function upload_file($request, $fileInputName, $moveTo)
    {
        $file = $request->file($fileInputName);
        $file_name = md5($moveTo).Str::random(10).'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($moveTo, $file, $file_name);
        return $moveTo."/".$file_name;

        // $file = $request->file($fileInputName);
        // $fileUploaded='Upload_'.rand(1,99999999999).'.'.$file->getClientOriginalExtension();
        // $file->move($moveTo, $fileUploaded);
        // return $fileUploaded;
    }

}

