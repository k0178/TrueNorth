<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use Hash;
use Session;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('logged') == 1) {
            return redirect('/index')->with('error','error.');
         }
         else{
            $title = "Login";
            return view('pages.login',compact('title'));
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoginRequest $request)
    {
        $this->validate($request,
        [
        'uname'=>'required',
        'password'=>'required'
        ]);
        
        $user = Users::where('username','=',$request->uname)->first();

        if($user){
           if (Hash::check($request->password, $user->password)) {
               // $request->session()->put('loginID',$user->id);
                return back()->with('success','Login Success.');
            }
            else{
                 return back()->withInput()->with('error','Incorrect Password.');
            }  
        }
        else{
            return back()->withInput()->with('error','User not found.');
        }
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginRequest  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoginRequest $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
