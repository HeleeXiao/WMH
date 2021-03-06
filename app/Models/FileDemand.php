<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileDemand extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "file_demands";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'demand_id', 'file_id','state',
    ];
}
