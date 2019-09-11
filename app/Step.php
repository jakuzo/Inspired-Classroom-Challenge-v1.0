<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'challenge_id',
        'name',
        'step_number',
        'text',
        'resources_name',
        'resources_text',
        'resources_reminders',
        'min_num_of_answers'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function challenge()
    {
        return $this->belongsTo('App\Challenge');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function feedback()
    {
        return $this->hasManyThrough('App\Feedback','App\Answer');
    }

    /**
     * Get all of the step's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
