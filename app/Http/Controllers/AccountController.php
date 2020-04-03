<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Response;
use DB;
use App\Payment;
use Illuminate\Support\Facades\Input;

class AccountController extends Controller
{
    //
    public function add_account(Request $req){
        
        $rules = array(
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag());
        }
        else {
            $data_user = new User();
            $data_user->name = strtoupper($req['lname'].' '.$req['fname'].' '.$req['mname']) ;
            $data_user->username = $req['username'];
            $data_user->email = $req['email'];
            $data_user->password = Hash::make($req['password']);
            $data_user->usertype = 'member';
            $data_user->status = 'active';
            $data_user->save();

            $data_member = new Member();
            $data_member->user_id = $data_user->id;
            $data_member->fname = $req['fname'];
            $data_member->lname = $req['lname'];
            $data_member->mname = $req['mname'];
            $data_member->dob = $req['dob'];
            $data_member->address = $req['address'];
            $data_member->gender = $req['gender'];
            $data_member->civil_status = $req['civil_status'];
            $data_member->profilepic = 'profile.jpg';
            $data_member->status = 'active';
            $data_member->save();
        }
        return redirect()->back()->with('success','Member successfully added!');
    }
    public function view_account($account_id){
        $data_account = Account::with('credit.product', 'bill.credit')->where('id', '=', $account_id)->first();
        //dd($data_account->bill);
        $data_payment = Payment::where('account_id', '=', $account_id)->with('bill.credit.product', 'user')->take(10)->get();
        //dd($data_payment);
        return view('admin.account', compact('data_account', 'data_payment'));

    }
    public function view_account_bill_history($account_id){
        $data_account = Account::with('credit.product', 'bill.credit')->where('id', '=', $account_id)->first();
        //dd($data_account->bill);
        
        return view('admin.account-bill', compact('data_account'));

    }
    public function view_account_payment_history($account_id){
        $data_account = Account::with('credit.product', 'bill.credit')->where('id', '=', $account_id)->first();
        //dd($data_account->bill);
        $data_payment = Payment::where('account_id', '=', $account_id)->with('bill.credit.product', 'user')->get();
        //dd($data_payment);
        return view('admin.account-payment', compact('data_account', 'data_payment'));

    }

    public function account_search(Request $request){
        if($request->ajax())
        {
            $search = $request->search;
            $output="";
            $data_account = DB::table('accounts')
                ->where(function($query) use ($search){
                    $query->where('accounts.fname', 'LIKE', '%'.$search.'%');
                    $query->orWhere('accounts.lname', 'LIKE', '%'.$search.'%');
                    $query->orWhere('accounts.mname', 'LIKE', '%'.$search.'%');
                    $query->orWhere('accounts.contact_number', 'LIKE', '%'.$search.'%');
                })
                ->latest()
                ->get();
            if($data_account)
            {
                $count=1;
                foreach ($data_account as $Account) {
                    $output.='<tr class="item'.$Account->id.'">
                        <td><a href="/admin/account/'.$Account->id.'">'.$Account->id.'</a></td>
                        <td><a href="/admin/account/'.$Account->id.'">'.strtoupper($Account->lname).', '.strtoupper($Account->fname).' '.strtoupper($Account->mname).'</td>
                        <td>'.$Account->address.'</td>
                        <td>'.$Account->contact_number.'</td>
                        <td><a href="/admin/account/'.$Account->id.'" class="btn btn-info btn-small"><i class="fa fa-search"></i></a></td>';
                    $output .='</tr>';
                    $count++;
                }
                return Response($output);
            }
        }
    }
}
