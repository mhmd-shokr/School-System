<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_section'];
    protected $fillable=['Name_section','Grade_id','Class_id','status'];
    
    public function grade() {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }
        public function class (){
        return $this->belongsTo(Classroom::class,'Class_id');
    }

}
