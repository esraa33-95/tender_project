<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ProjectType extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name'];

    protected $fillable = ['added_date'];
   

    public function translates()
    {
        return $this->hasMany(ProjectTypeTranslation::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
