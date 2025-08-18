<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Project extends Model implements  HasMedia
{
  use InteractsWithMedia;

  
  public  const NEW = 1;
  public  const RUNNING = 2;
  public  const COMPLETED = 3;
  public  const CANCELLED = 4;

   
    protected $fillable =[
        'user_id',
        'contractor_id',
        'project_type_id',
        'area',
        'name',
        'budget_from',
        'budget_to',
        'open_budget',
        'location',
        'duration',
        'image',
        'start_date',
        'status',
        'cancel_reason'
    ];

public function users()
{
  return $this->belongsTo(User::class, 'user_id');
}

public function contractor()
{
  return $this->belongsTo(User::class, 'contractror_id');
}

public function projecttype()
{
  return $this->belongsTo(ProjectType::class,'project_type_id');
}

public function projectrooms()
{
  return $this->hasMany(ProjectRoom::class);
}

public function stageCosts()
{
    return $this->hasMany(ProjectStageCost::class);
}


public function bids()
    {
        return $this->hasMany(Bid::class);
    }

public function ratings()
{
    return $this->hasMany(Rating::class);
}

    
}