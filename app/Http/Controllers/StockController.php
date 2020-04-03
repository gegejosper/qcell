<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{
    //
    public function stocks(){
        $data_stock = Stock::paginate(50);
        return view('admin.stocks', compact('data_stock'));
    }
}
