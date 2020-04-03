<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Payment;
use App\Credit;
use App\Account;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    //
    public function bill_pay(Request $req){

        if (Auth::check())
        {
            $user_id = Auth::user()->id;
        }
        $data_payment = new Payment();
        $data_payment->account_id = $req->account_id;
        $data_payment->credit_id = $req->credit_id;
        $data_payment->bill_id = $req->bill_id;
        $data_payment->amount = $req->amount;
        $data_payment->payment_date = date("Y-m-d");
        $data_payment->payment_status = 'payment';
        $data_payment->user_id = $user_id;
        $data_payment->save();

        $data_bill = Bill::where('id', '=', $req->bill_id)->first();
        $data_credit = Credit::where('id', '=', $req->credit_id)->first();

        $balance = $data_bill->balance;
        $credit_balance = $data_credit->balance;
        $new_credit_balance = $credit_balance - $req->amount;

        if($req->amount >= $balance){
            $update_bill = Bill::where('id', '=', $req->bill_id)
                    ->update(['balance' => 0, 'status' => 'paid']);
            if($req->amount >= $new_credit_balance){
                $update_credit = Credit::where('id', '=', $req->credit_id)
                    ->update(['balance' => 0,'status' => 'paid']);
            }
            else {
                
                $update_credit = Credit::where('id', '=', $req->credit_id)
                    ->update(['balance' => $new_credit_balance]);
            }                  
        }
        else {
            $new_balance = $balance - $req->amount;
            $update_bill = Bill::where('id', '=', $req->bill_id)
                    ->update(['balance' => round($new_balance, 2)]);

            if($req->amount >= $new_credit_balance){
                $update_credit = Credit::where('id', '=', $req->credit_id)
                    ->update(['balance' => 0,'status' => 'paid']);
            }
            else {
                
                $update_credit = Credit::where('id', '=', $req->credit_id)
                    ->update(['balance' => $new_credit_balance]);
            }
        }
        return($data_payment);
    }
    public function dues(){
        $today = date('Y-m-d'); 
        $data_account = Account::latest()->get();
        $data_bill_due = Bill::with('account', 'credit.product')->where('due_date', '<=', $today)->get(); 
        $data_bill_collectibles = Bill::where('status', '=', 'not paid')->get(); 
        //dd($data_bill_due);
        //$startDate = Carbon::parse($req->fromdate.' 00:00:00');
        $collectibles = 0;
        foreach($data_bill_collectibles as $collectible){
            $collectibles = $collectibles +$collectible->balance;
        }
        return view('admin.dues', compact('data_bill_due', 'collectibles', 'data_account'));
    }
}
