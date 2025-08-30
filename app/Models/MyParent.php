<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;
    public $translatable=['Name_father','Job_father','Name_mother','Job_mother'];
    protected $guarded = [];
}
