<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
     * 
     */

    public function showLoginForm(){
        $title = "True North Auction | Login";
        return view('auth.login',compact('title'));
    }
    
    protected function redirectTo()
    {
    
        if((Auth::user()-> user_type) == 5){
            return '/admin/index';
        }
        elseif((Auth::user()-> user_type) == 2){
            return '/admin/usermanagement';
        }
        elseif((Auth::user()-> user_type) == 3){
            return '/admin/shippings';
        }
        elseif((Auth::user()-> user_type) == 4){
            return '/admin/reports';
        }
        else {
            return '/home';
        }
        
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    
    }

}
