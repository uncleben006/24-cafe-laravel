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
        return $this->hasOne('App\Rackets', 'product_id', 'id');
    }
}
