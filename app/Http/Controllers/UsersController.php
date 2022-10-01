<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('logged') == 1) {
            return redirect('/index')->with('error','Error.');
         }
         else{
            $title = "Register";
            return view('auth.register',compact('title'));
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
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $this->validate($request,[
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'pnum'=>['required','regex:/^(09|\+639)\d{9}$/u'],
            'add'=>'required',
            'zipcode'=>'required',
            'uname'=>'required',
            'password'=>['required',
                Password::min(8)
                ->mixedCase() // allows both uppercase and lowercase
                ->letters() //accepts letter
                ->numbers() //accepts numbers
                ->symbols() //accepts special character
                ->uncompromised(),//check to be sure that there is no data leak
    ],

            'confPassword'=>'required',
            'pfpImg'=>'required',
            
            //bday - to be concatinated
            'month'=>'required',
            'day'=>'required',
            'year'=>'required',
        ]);


        $bdd = $request->input('day');
        $bmm = $request->input('month');
        $byy = $request->input('year');

        $birthday = ''.$bmm.'/'.$bdd.'/'.$byy.'';

        $pass1 = $request->input('password');
        $pass2 = $request->input('confPassword');

        if($pass1!=$pass2){
            return redirect('/register')->with('error', 'Password mismatch');
        }

        $encpass = md5(md5($request->input('password')));
        
        //table input
            if(count(Users::where('email', $request->email)->get())>0){
                return back()->withInput()->with('error', 'Email Already Exists!');
            }

            if(count(Users::where('pnum', $request->pnum)->get())>0){
                return back()->withInput()->with('error', 'Phone Number Already Exists!');
            }

            if(count(Users::where('username', $request->uname)->get())>0){
                return back()->withInput()->with('error', 'Username is Taken!');
            }
            
            $filename= $request->input('uname').".".$request->file('pfpImg')->getClientOriginalExtension();
            $request->file('pfpImg')->storeAs('userPFP',$filename,'public_uploads');

            $users=new Users;
            $users->fname=$request->input('fname');
            $users->lname=$request->input('lname');
            $users->email=$request->input('email');
            $users->pnum=$request->input('pnum');
            $users->address=$request->input('add');
            $users->zipcode=$request->input('zipcode');
            $users->username=$request->input('uname');
            $users->password=$encpass;
            $users->bday=$birthday;
            $users->profileImage=$filename;
            $users->save();

        return redirect('/login')->with('success','Successfuly Registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
