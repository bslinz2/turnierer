<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group');
    }
}
