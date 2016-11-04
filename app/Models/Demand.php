<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "demands";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description','token','file_id', 'status',
        'type', 'state', 'click',
    ];
}
