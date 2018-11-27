<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function notAssigned ($collection)
    {
        return User::all()->whereNotIn(
            'id',
            $collection->map(
                function ($item){
                    return $item->id;
                }
            )
        );

    }

    public function inventory()
    {
        return $this->hasMany('App\Inventory', 'owner_id');
    }

    public function classes()
    {
        return $this->hasMany('App\Classes', 'owner_id');
    }

    public function positions()
    {
        return $this->belongsToMany('App\Positions', 'user_position', 'user_id', 'position_id');
    }

    public function badge()
    {
        return $this->hasMany('App\Badges', 'owner_id');
    }

    public function badges()
    {
        return $this->belongsToMany('App\Badges', 'badges_user', 'user_id', 'badge_id')->withTimestamps();
    }

    public function expeditions()
    {
        return $this->hasMany('App\Expeditions', 'owner_id');
    }

    public function enroll()
    {
        return $this->belongsToMany('App\Classes', 'class_enrollment', 'user_id', 'class_id')->withTimestamps();
    }

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement', 'user_requirement', 'user_id', 'requirement_id')->withTimestamps();
    }

    //recieves a collection of manditory requirements
    //returns boolian if user meets manditory requirements
    public function meetsRequirements($requirements)
    {
        return $requirements->diff($this->requirements)->isEmpty();
    }
}
