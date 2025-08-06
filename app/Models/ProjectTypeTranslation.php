<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTypeTranslation extends Model
{
     public $timestamps = true;
     
    protected $fillable =['name'];


    public function projecttype()
    {
        return $this->belongsTo(ProjectType::class);
    }

    
}
