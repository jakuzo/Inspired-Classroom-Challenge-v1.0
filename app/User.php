<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function administrator()
    {
        return $this->hasOne('App\Administrator');
    }

    public function evaluator()
    {
        return $this->hasOne('App\Evaluator');
    }

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }

    /**
     * Get all of the user's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }

    public function userType()
    {
        if ($this->administrator) {
            return 'administrator';
        } elseif ($this->evaluator) {
            return 'evaluator';
        } elseif ($this->student) {
            return 'student';
        } elseif ($this->teacher) {
            return 'teacher';
        } else {
            return null;
        }
    }

    public function userTypeModel()
    {
        if ($this->administrator) {
            return $this->administrator;
        } elseif ($this->evaluator) {
            return $this->evaluator;
        } elseif ($this->student) {
            return $this->student;
        } elseif ($this->teacher) {
            return $this->teacher;
        } else {
            return null;
        }
    }
}
