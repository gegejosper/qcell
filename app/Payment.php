<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function bill()
    {
        return $this->belongsTo('App\Bill','bill_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function account()
    {
        return $this->belongsTo('App\Account','account_id','id');
    }
}
