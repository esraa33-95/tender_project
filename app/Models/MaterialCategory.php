<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MaterialCategory extends Model implements TranslatableContract,HasMedia
{
    use Translatable;
    use InteractsWithMedia;

    public const ROOM_CEIL = 1;
    public const ROOM_WALL = 2;
    public const ROOM_FLOOR = 3;

    public $translatedAttributes = [ 'name'];

 

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
    return $this->hasMany(RoomMaterial::class);
}



}
