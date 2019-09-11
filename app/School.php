<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address_line',
        'zipcode_id',
        'frlp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function zipcode()
    {
        return $this->belongsTo('App\Zipcode');
    }

    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }

    public function states()
    {
        return $this->hasManyThrough('App\State', 'App\Zipcode');
    }
}
