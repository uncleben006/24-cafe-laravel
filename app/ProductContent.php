<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductContent extends Model
{
    protected $table = 'product_contents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detail','topSection','middleSection'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
