<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','phone','level'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 设置用户密码
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /*
     * 关联详细信息
     */
    public function content()
    {
        return $this->hasOne(UserContent::class,"user_id");
    }

    /*
     * 关联关注列表
     */
    public function follow()
    {
        return $this->hasMany(Follow::class,"user_id",'id');
    }
    /*
     * 关联粉丝
     */
    public function fans()
    {
        return $this->hasMany(Follow::class,"cover_user_id",'id');
    }
    /*
     * 关联浏览记录
     */
    public function browse()
    {
        return $this->hasMany(Browse::class,"user_id",'id');
    }
}
