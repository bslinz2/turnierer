<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use SoftDeletes;
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_date'
    ];

    protected $fillable = [
        'name',
        'start_date',
        'point_win',
        'point_draw',
        'point_lose',
        'game_duration',
        'break_duration',
    ];

    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
