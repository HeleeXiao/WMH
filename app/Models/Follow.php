<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "follows";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cover_user_id', 'demand_id','state',
    ];
}
