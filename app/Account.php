<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    public function credit()
    {
        return $this->belongsTo('App\Credit','id','account_id');
    }

    public function bill()
    {
        return $this->hasMany('App\Bill','account_id','id');
    }
}
