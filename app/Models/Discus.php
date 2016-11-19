<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discus extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "discuss";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'demand_id', 'parent_id','content','status', 'state',
        'type', 'file_id',
    ];

    /*
     * Eloquent hasOne User Models
     */
    public function user()
    {
        return $this->hasOne(User::class,'id',"user_id");
    }
}
