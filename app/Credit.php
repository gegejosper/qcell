<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    public function bill()
    {
        return $this->hasMany('App\Bill','credit_id','id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function account()
    {
        return $this->belongsTo('App\Account','account_id','id');
    }

}
