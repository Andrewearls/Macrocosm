<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalInventory extends Model
{
    protected $table = "external_inventory";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'link', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
