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

    /*
     * Eloquent Files
     */
    public function file()
    {
        return $this->hasMany(File::class,"id",'file_id');
    }

    /*
     * Eloquent Users
     */
    public function user()
    {
        return $this->hasOne(User::class,"id",'user_id');
    }

    public function tag()
    {
//        return $this->hasMany(Tag::class,'id','id');
    }

}
