<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expeditions extends Model
{
    protected $table = "expeditions";
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
    	return $this->belongsTo('App\User', 'owner_id');
    }
}
