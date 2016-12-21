<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $points = 0;
    public $goalsShot = 0;
    public $goalsGot = 0;

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

    protected $fillable = [
        'start_offset',
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
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }

    public function team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id');
    }

    public function vsTeam()
    {
        return $this->hasOne('App\Models\Team', 'id', 'vs_team_id');
    }
    
    public function points() {
        if($this->team_result == $this->vs_team_result) {
            $this->vsTeam->points = $this->group->tournament->point_draw;
            $this->team->points = $this->group->tournament->point_draw;
        } elseif($this->team_result > $this->vs_team_result) {
            $this->team->points = $this->group->tournament->point_win;
            $this->vsTeam->points = $this->group->tournament->point_lose;
        } elseif($this->team_result < $this->vs_team_result) {
            $this->team->points = $this->group->tournament->point_lose;
            $this->vsTeam->points = $this->group->tournament->point_win;
        }
        $this->team->goalsGot = $this->vs_team_result;
        $this->vsTeam->goalsGot = $this->team_result;

        $this->team->goalsShot = $this->team_result;
        $this->vsTeam->goalsShot = $this->vs_team_result;
    }
}
