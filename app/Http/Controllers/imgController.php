<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class imgController extends Controller
{
    public function upload(Request $request){
        $this->validate($request,[
            'pfpImg'=>'required'
        ]);

        $data = User::where('username', Auth::user()->username)->first();
        $imgName = Auth::user()->username;
        
        $filename= $imgName.".".$request->file('pfpImg')->getClientOriginalExtension();
        $request->file('pfpImg')->storeAs('userPFP',$filename,'public_uploads');

        $data->profileImage=$filename;
        $data->save();
        $link = "/profile/$data->username/edit";
     
        return redirect($link)->with('success','Picture Changed.');
    }
}
