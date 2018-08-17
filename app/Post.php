<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'note', 'author',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    // 關聯方法: 關聯的model是App\User，外來鍵是id，主鍵是author
    public function author() {
        return $this->hasOne('App\User', 'id', 'author');
    }
}
