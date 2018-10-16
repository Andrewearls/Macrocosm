<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function inventory()
    {
        return $this->hasMany('App\Inventory', 'owner_id');
    }

    public function classes()
    {
        return $this->hasMany('App\Classes', 'owner_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Positions');
    }

    public function badges()
    {
        return $this->hasMany('App\Badges', 'owner_id');
    }

    public function expeditions()
    {
        return $this->hasMany('App\Expeditions', 'owner_id');
    }
}
