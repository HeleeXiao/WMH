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
        'user_id', 'file_id', 'sex', 'age','country','address',
        'state', 'province', 'city', 'education','major',
    ];

    /**
     * @name        head
     * @DateTime    ${DATE}
     * @param
     * @return      \Eloquent
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function head()
    {
        return $this->hasOne(File::class,'id','file_id');
    }
}
