<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','price','class','introduction', 'detail', 'category','series','rank','brand','middleSection','topSection'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    public function image()
    {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }    
}
