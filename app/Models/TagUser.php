<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "tag_users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tag_id','state',
    ];
}
