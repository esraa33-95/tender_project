<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable =[
        'project_id',
        'contractor_id',
        'user_id',
        'rate'

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }
}
