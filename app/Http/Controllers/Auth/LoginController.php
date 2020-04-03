<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/member/home';
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->username = $this->findUsername();
    }
    // public function findUsername()
    // {
    //     $login = request()->input('username');
    //     //dd($login);
    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
    //     request()->merge([$fieldType => $login]);
 
    //     return $fieldType;
    // }
    // public function username(){
    //     return $this->username;
    // }

    public function username(){
        return 'username';
    }

    protected function authenticated() {
        if (Auth::check()) {
            if(Auth::user()->usertype == "admin") {
                return redirect('/admin/dashboard');    
            }
            else if(Auth::user()->usertype == "collector"){
                return redirect('/collector/home'); 
            }
            else {
                return redirect('/'); 
            }
        }
    }
}
