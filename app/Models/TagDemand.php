<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagDemand extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "tag_demands";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'demand_id', 'tag_id','state',
    ];
}
