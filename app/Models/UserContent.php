<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "user_contents";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sex', 'age','country','address', 'state',
        'province', 'city', 'education','major',
    ];
}
