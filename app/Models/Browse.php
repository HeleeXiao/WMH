<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Browse extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "browses";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'demand_id', 'state','tag_id',
    ];

    /*
     * demand
     */
    public function demand()
    {
        return $this->hasOne(Demand::class,'id','demand_id');
    }
    /*
     * Tag
     */
    public function tag()
    {
        return $this->hasOne(Tag::class,'id','tag_id');
    }
}
