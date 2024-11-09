<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ImageUpload;
    public $folderPath = "posts/";

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getPaginatedCommentsAttribute()
    {
        $a = $this->comments()->where('parent_id', null)->orderBy('id', 'desc')->paginate(2);
        $a->setPath(route('comments',$this->id));
        return $a;

    }
}
