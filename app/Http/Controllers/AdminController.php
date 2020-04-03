<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Brand;
use App\Product;
use Carbon\Carbon;
use App\Credit;
use App\Bill;
use App\Payment;
use App\User;
class AdminController extends Controller
{
    //
    public function index(){
        $today = date('Y-m-d'); 
        $data_account = Account::latest()->get();
        $data_bill_due = Bill::where('due_date', '<=', $today)->get(); 
        $data_bill_collectibles = Bill::where('status', '=', 'not paid')->get(); 
        //dd($data_bill_due);
        //$startDate = Carbon::parse($req->fromdate.' 00:00:00');
        $collectibles = 0;
        foreach($data_bill_collectibles as $collectible){
            $collectibles = $collectibles +$collectible->balance;
        }
        return view('admin.dashboard', compact('data_bill_due', 'collectibles', 'data_account'));
    }

    public function credit(){

        $data_brand = Brand::get();
        $brands = [];
        foreach($data_brand as $brand){
            $array_brand = ['value' => $brand->id, 'text' => $brand->brand_name];
            array_push($brands, $array_brand);
        }
        $data_credit = Credit::with('account', 'product')->paginate(50);
        $data_item = Product::with('pic', 'branddetails')->get();
        //dd($brands);
        return view('admin.credit', compact('data_brand', 'data_item', 'brands', 'data_credit'));
    }

    public function accounts(){
        $data_account = Account::latest()->paginate(50);
        return view('admin.accounts', compact('data_account'));
    }
    public function payments(){
        $data_payment = Payment::with('bill.credit.product', 'user', 'account')->latest()->paginate(50);
        return view('admin.payments', compact('data_payment'));
    }

    public function reports(){
        
        return view('admin.reports');
    }

    public function settings(){
        
        return view('admin.settings');
    }

    public function items(){
        
        $data_brand = Brand::get();
        $brands = [];
        foreach($data_brand as $brand){
            $array_brand = ['value' => $brand->id, 'text' => $brand->brand_name];
            array_push($brands, $array_brand);
        }
        $data_item = Product::with('pic', 'branddetails')->paginate(50);
        //dd($data_item);
        return view('admin.items', compact('data_brand', 'data_item', 'brands'));
    }

    public function users(){
        $data_user = User::get();
        return view('admin.users', compact('data_user'));
    }


    
}
