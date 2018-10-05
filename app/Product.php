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
        'name'
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
    public function racket()
    {
        return $this->hasOne('App\Racket', 'product_id', 'id');
    }
    public function footwear()
    {
        return $this->hasOne('App\Footwear', 'product_id', 'id');
    }
    public function bag()
    {
        return $this->hasOne('App\Bag', 'product_id', 'id');
    }
    public function apparel()
    {
        return $this->hasOne('App\Apparel', 'product_id', 'id');
    }
}
