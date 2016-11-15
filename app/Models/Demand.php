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
     * 封面
     * Eloquent cover
     */
    public function cover()
    {
        return $this->hasOne(File::class,"id",'file_id');
    }

    /*
     * Eloquent Users
     */
    public function user()
    {
        return $this->hasOne(User::class,"id",'user_id');
    }

    /*
     * Eloquent Tags
     */
    public function tag()
    {
        return $this->belongsToMany(Tag::class,"tag_demands","demand_id","tag_id");
    }

    /*
     * Eloquent file
     */
    public function file()
    {
        return $this->belongsToMany(File::class,"file_demands","demand_id","file_id");
    }
    /*
     * Eloquent Discus
     */
    public function discus()
    {
        return $this->hasMany(Discus::class,"demand_id",'id');
    }

    /*
     * Eloquent follows
     */
    public function follow()
    {
        return $this->hasMany(Follow::class,"demand_id",'id');
    }

}
