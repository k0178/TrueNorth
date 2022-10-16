<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Funds;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class fundController extends Controller
{
    public function fundReq(Request $request){
        $this->validate($request,[
            'reqAmt'=>'required'
        ]);

        $fndget = User::select('funds')
        ->where('username', Auth::user()->username)
        ->get();
        //add existing value with the requested value
        $newsum =$fndget['0']->funds + $request->reqAmt;
        //update new value
        $fundup = User::select('funds')
        ->where('username', Auth::user()->username)
        ->update(['funds'=>$newsum]);

        $data = new Funds;
        $data->uname=$request->accname;
        $data->status='Approved';
        $data->refnum=$request->refnum;
        $data->type='Fund';
        $data->amount=$request->reqAmt;
        $data->save();

        return back();
    }

    public function memberPay(Request $request){

        $data = new Funds;
        $data->uname=$request->accname;
        $data->refnum=$request->refnum;
        $data->type='Membership';
        $data->amount=1000;
        $data->save();

        User::where('id', Auth::user()->id)
            ->update(['memberpmt'=>'Pending']);

        return back();
    }
}
