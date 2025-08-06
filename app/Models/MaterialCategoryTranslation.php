<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCategoryTranslation extends Model
{
    public $timestamps = true;
     
    protected $fillable =['name'];


    public function materialCategory()
    {
        return $this->belongsTo(MaterialCategory::class);
    }
}
