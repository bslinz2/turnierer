<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // schemas for groups with 3 and 4 teams, http://neu.hessen-volley.de/filerepository/CxNu63XgYercbu6kUvub.pdf
    protected static $schemas = [
        3 => [
            [1, 2],
            [2, 3],
            [3, 1],
        ],
        4 => [
            [1, 2],
            [3, 4],
            [1, 3],
            [2, 4],
            [1, 4],
            [2, 3],
        ]
    ];

    protected $dates = [
        'deleted_at'
    ];

    public static function teamSizes() {
        return array_keys(self::$schemas);
    }

    public static function teamSchema($size) {
        if(!array_key_exists($size, self::$schemas)) {
            return [];
        }
        return self::$schemas[$size];
    }

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
