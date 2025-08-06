<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MaterialCategory extends Model implements TranslatableContract
{
    use Translatable;

public const CEIL = 1;
public const FLOOR = 2;
public const WALL = 3;


    public $translatedAttributes = ['name'];

    protected $fillable = [
        'room_property',
        'image',
        'price',
        'contractor_percentage',
        'added_date'
];
   

    public function translates()
    {
        return $this->hasMany(MaterialCategoryTranslation::class);
    }

     public function materials()
    {
        return $this->hasMany(ProjectRoomMaterial::class);
    }

}
