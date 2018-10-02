<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footwear extends Model
{
    protected $table = 'footwears';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'price', 'description', 'series', 'categories', 'rank', 'brands'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
