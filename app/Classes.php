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
        'name', 'description', 'short_description', 'image', 'owner_id',
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

    public function owner()
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
}
