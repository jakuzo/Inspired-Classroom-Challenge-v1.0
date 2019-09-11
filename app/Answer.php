<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'step_id',
        'classroom_id',
        'team_id',
        'text',
        'ready'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function step()
    {
        return $this->belongsTo('App\Step');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback');
    }

    /**
     * Get all of the answer's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
