<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $table = "positions";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function users()
    {
    	return $this->hasMany('App\User', 'position_id');
    }

    public function requirement()
    {
        return $this->morphOne('App\Requirement', 'specific');
    }
}
