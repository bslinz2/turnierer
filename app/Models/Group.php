<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $dates = [
        'deleted_at',
        'start_date'
    ];

    protected $fillable = ['name', 'start_date'];

    public function tournament()
    {
        return $this->hasOne('App\Models\Tournament', 'id', 'tournament_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
