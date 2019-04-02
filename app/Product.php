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
    /**
     * 與 ProductImage 做關聯，外來鍵為 product_id，主鍵為 id
     */
    public function image()
    {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }    
}
