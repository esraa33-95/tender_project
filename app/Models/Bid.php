<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public const WAITING = 0;
    public const ACCEPTED = 1;
    public const REJECTED = 2;
    

    protected $fillable = [
            'project_id',
            'contractor_id',
            'price',
            'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contractor()
    {
        return $this->belongsTo(User::class,'contractor_id');
    }
}
