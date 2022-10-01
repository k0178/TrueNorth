<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   
        $title = "Profile";
        $username =  Auth::user()->username;
        $data = User::where('username',$username)->first();
        return view('profile.profile',compact('title'))->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //temporarily here for debugging purposes only; once session is working move to edit function!
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {   
        $username = Auth::user()->username;
        $data = User::where('username',$username)->first();
        $title = "Profile Edit";
        
        return view('profile.editProf',compact('title'))->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request,[
            'address'=>'required',
            'zipcode'=>'required'
        ]);
        $data = User::find($id);
        $type = Auth::user()->user_type;

        $data->address=$request->input('address');
        $data->zipcode=$request->input('zipcode');
        
        $data->save();

        if($type = 0){
            Session::flash('success', "Profile succesfully Updated. ");
            return redirect('/admin/index');
        }
        else{
            Session::flash('success', "Profile succesfully Updated. ");
            return redirect('/profile');
        }
        // if($type == 'Administrator'){
        //     return redirect('/admin/index')->with('success','Profile Updated.');
        // }

        // return redirect('/profile')->with('success','Profile Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users)
    {
        //
    }
}
