<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer_id',
        'evaluator_id',
        'text',
        'grade',
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

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }

    public function evaluator()
    {
        return $this->belongsTo('App\Evaluator');
    }

    /**
     * Get all of the feedback's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
