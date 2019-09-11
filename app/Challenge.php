<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'active',
        'scenario',
        'research',
        'background'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
        'deleted_at'
    ];

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }

    public function steps()
    {
        return $this->hasMany('App\Step');
    }

    public function answers()
    {
        return $this->hasManyThrough('App\Answer','App\Step');
    }

    public function evaluators()
    {
        return $this->belongsToMany('App\Evaluator');
    }

    /**
     * Get all of the challenge's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }

}
