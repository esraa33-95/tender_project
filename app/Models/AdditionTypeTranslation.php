<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionTypeTranslation extends Model
{
     public $timestamps = true;
     
    protected $fillable =['name'];


    public function additiontype()
    {
        return $this->belongsTo(AdditionType::class);
    }
    
}
