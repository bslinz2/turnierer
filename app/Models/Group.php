<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $dates = [
        'deleted_at',
        'start_date'
    ];

    protected $fillable = ['name', 'start_date', 'schema'];
    
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
            [1, 4],
            [2, 3],
            [1, 3],
            [2, 4],
        ],
        5 => [
            [1, 2],
            [3, 4],
            [5, 1],
            [2, 3],
            [4, 5],
            [1, 3],
            [2, 4],
            [5, 3],
            [1, 4],
            [2, 5],
        ],
        6 => [
            [1, 2],
            [3, 4],
            [5, 6],
            [1, 3],
            [2, 4],
            [3, 6],
            [1, 5],
            [4, 6],
            [2, 5],
            [1, 6],
            [4, 5],
            [2, 3],
            [1, 4],
            [3, 5],
            [2, 6],
        ]
    ];

    public function getSchemaAttribute($value) {
        if($value) {
            return json_decode($value);
        }
        $teamCount = count($this->teams);

        if(array_key_exists($teamCount, self::$schemas)) {
            return self::$schemas[$teamCount];
        }

        return [];
    }

    public function setSchemaAttribute($value) {
        $teamCount = $this->teams;

        foreach($value as $row) {
        }
        $this->attributes['schema'] = json_encode($value);
    }

    public function tournament()
    {
        return $this->hasOne('App\Models\Tournament', 'id', 'tournament_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }

    public function games() {
        return $this->hasMany('App\Models\Game');
    }

    public static function teamSizes() {
        return array_keys(self::$schemas);
    }
}
