<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;
use App\Bill;
use App\Account;
use App\Product;

class CreditController extends Controller
{
    //
    public function add_credit(Request $req){
        $data_account = new Account();
        $data_account->fname = $req->fname;
        $data_account->lname = $req->lname;
        $data_account->address = $req->address;
        $data_account->contact_number = $req->contact_num;
        $data_account->status = 'active';
        $data_account->save();
        $remaining_balance = $req->amount - $req->downpayment;
        $term_bill_amount = $remaining_balance / $req->term;

        $data_credit = new Credit();
        $data_credit->product_id = $req->product_id;
        $data_credit->account_id = $data_account->id;
        $data_credit->quantity = $req->quantity;
        $data_credit->amount = $req->amount;
        $data_credit->downpayment = $req->downpayment;
        $data_credit->balance = $remaining_balance;
        $data_credit->term = $req->term;
        $data_credit->term_payment = round($term_bill_amount, 2);
        $data_credit->date_credit = $req->date_credit;
        $data_credit->status = 'not paid';
        $data_credit->save();
        
        $data_product = Product::where('id', '=', $req->product_id)->first();
        $new_product_quantity = $data_product->quantity - $req->quantity;

        Product::find($req->product_id)->update(['quantity' => $new_product_quantity]);
        //echo $req->date_credit;
        for($i = 1; $i<=$req->term; $i++){
            $due_date = date("Y-m-d",strtotime(+$i.' month',strtotime($req->date_credit)));
            $data_bill = new Bill();
            $data_bill->account_id = $data_account->id;
            $data_bill->amount_paid = 0;
            $data_bill->bill = round($term_bill_amount, 2);
            $data_bill->credit_id = $data_credit->id;
            $data_bill->balance = round($term_bill_amount, 2);
            $data_bill->due_date = $due_date;
            $data_bill->status = 'not paid';
            $data_bill->save();
            //echo $due_date."<br>";
        }
        return redirect('/admin/credit/view/'.$data_credit->id)->with('success','Credit successfully process!');     
    }

    public function view_credit($credit_id){
        $data_credit = Credit::with('product')->where('id', '=', $credit_id)->first();
        $data_account = Account::where('id', '=', $data_credit->account_id)->first();
        $data_bill = Bill::where('credit_id', '=', $credit_id)->get();

        return view('admin.credit-view', compact('data_credit', 'data_account', 'data_bill'));
    }
}
