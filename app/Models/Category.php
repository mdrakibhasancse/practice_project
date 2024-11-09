<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ImageUpload;
    public $folderPath = "categories/";
}
