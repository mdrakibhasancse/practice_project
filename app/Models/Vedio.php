<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Model;

class Vedio extends Model
{
    use ImageUpload;
    public $folderPath = "vedios/";

    public function post(){
       return $this->belongsTo(Post::class);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
