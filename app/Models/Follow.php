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
    /*
     * 记录所有者
     */
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    /*
     *被关注人（偶像）
     */
    public function idol()
    {
        return $this->hasOne(User::class,'id','cover_user_id');
    }
    /*
     *被关注商品
     */
    public function demand()
    {
        return $this->hasOne(Demand::class,'id','demand_id');
    }

}
