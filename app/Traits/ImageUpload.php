<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function upload($file){
        $ext = "." . $file->getClientOriginalExtension();
        $imageName = uniqid() .'_'. time() . $ext;
        Storage::disk('public')->put($this->folderPath . $imageName, File::get($file));
        return $imageName;
    }

    public function getImageUrl(){
       return asset('storage/' . $this->folderPath . $this->image);
    }
}
