<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'deleted_at',];

    protected $fillable = ['name'];

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group');
    }
}
