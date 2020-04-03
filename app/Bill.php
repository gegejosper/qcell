<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    public function credit()
    {
        return $this->belongsTo('App\Credit','credit_id','id');
    }

    public function account()
    {
        return $this->belongsTo('App\Account','account_id','id');
    }
}
