<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classroom_id',
        'name'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
