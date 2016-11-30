<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $dates = [
        'deleted_at'
    ];

    public function group()
    {
        return $this->hasOne('App\Models\Group');
    }

    public function team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id');
    }

    public function vsTeam()
    {
        return $this->hasOne('App\Models\Team', 'id', 'vs_team_id');
    }
}
