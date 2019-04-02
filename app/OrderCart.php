<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    protected $table = 'order_carts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','product_id','qty'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    /**
     * 定義關聯
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
