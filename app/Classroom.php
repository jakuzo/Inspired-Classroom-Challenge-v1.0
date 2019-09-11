<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'join_code',
        'name',
        'challenge_id',
        'teacher_id',
        'start_date',
        'end_date',
        'num_students',
        'num_teams',
        'grade',
        //TODO: change to challenge_id
        //'challenge',
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

    public function challenge()
    {
        return $this->belongsTo('App\Challenge');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    public function answers()
    {
        return $this->hasMany('App\Answers');
    }

    /**
     * Get all of the answer's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
