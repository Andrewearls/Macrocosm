<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
	protected $table = "badges";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'owner_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function owner()
    {
    	return $this->belongsToMany('App\User', 'badges_user', 'badge_id', 'user_id')->withTimestamps();
    }

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement', 'badge_requirement', 'badge_id', 'requirement_id')->withTimestamps();
    }
}
