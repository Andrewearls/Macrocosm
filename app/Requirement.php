<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
	protected $table = "requirement";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public static function notActive ($collection)
    {
        return Requirement::all()->whereNotIn(
            'id',
            $collection->map(
                function ($item){
                    return $item->id;
                }
            )
        );

    }

    public function specific()
    {
        return $this->morphTo();
    }

    public function badges()
    {
    	return $this->belongsToMany('App\Badges', 'badge_requirement', 'requirement_id', 'badge_id')->withTimestamps();
    }

    public function classes()
    {
    	return $this->belongsToMany('App\Classes', 'class_requirement', 'requirement_id', 'class_id')->withTimestamps();
    }
}
