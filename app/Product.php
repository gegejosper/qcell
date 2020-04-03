<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = array('brand', 'product_name', 'model', 'quantity', 'unit_price', 'cash_price');
    public function pic()
    {
        return $this->hasMany('App\Productpic','product_id','id');
    }

    public function branddetails()
    {
        return $this->belongsTo('App\Brand','brand','id');
    }
}
