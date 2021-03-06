<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = "classes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'short_description', 'image', 'owner_id', 'time', 'date', 'location', 'frequency',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function type()
    {
        return get_class($this);
    }

    public function instructor()
    {
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function requirement()
    {
        return $this->morphOne('App\Requirement', 'specific');
    }

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement', 'class_requirement', 'class_id', 'requirement_id')->withTimestamps();
    }

    public function enroll()
    {
        return $this->belongsToMany('App\User', 'class_enrollment', 'class_id', 'user_id')->withTimestamps();
    }

    public function descriptionRoute()
    {
        return route('classDescription', ['id' => $this->id]);
    }
}
