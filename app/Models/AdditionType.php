<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AdditionType extends Model implements TranslatableContract
{
    use Translatable;
    
     public $translatedAttributes = ['name'];

    protected $fillable = ['price','contractor_percentage','added_date'];

    public function translates()
    {
        return $this->hasMany(AdditionTypeTranslation::class);
    }

    public function additions()
    {
      return $this->hasMany(Addition::class);
    }
    
}
