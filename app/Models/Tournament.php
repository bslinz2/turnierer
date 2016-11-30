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
        'start'
    ];

    protected $fillable = ['name', 'start'];

    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
