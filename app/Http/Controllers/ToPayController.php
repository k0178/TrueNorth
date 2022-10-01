<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funds;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ToPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Admin | To Pay";
        $data = Funds::select('*')->orderBy('created_at','desc')->paginate(10);
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.topay', compact('title'))->with('data',$data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {   //username of the client
    $uname = $request->uname;

    $reqtype = Funds::select('type')
                    ->where('uname', $uname)
                    ->get();
        if($reqtype == 'Fund'){
            $fndget = User::select('funds')
                    ->where('username', $uname)
                    ->get();
                    //add existing value with the requested value
            $newsum =$fndget['0']->funds + $request->amt;
            //update new value
            $fundup = User::select('funds')
            ->where('username', $uname)
            ->update(['funds'=>$newsum]);

            //approve fund request
            $statup = Funds::find($request->id);
            $statup->status="Approved";
            $statup->save();
            return back();

        }
        else{
            $fndget = User::select('funds')
                    ->where('username', $uname)
                    ->get();
                    //add existing value with the requested value
            $newsum =$fndget['0']->funds + $request->amt;
            //update new value
            $fundup = User::select('funds')
            ->where('username', $uname)
            ->update(['funds'=>$newsum]);

            //approve fund request
            $statup = Funds::find($request->id);
            $statup->status="Approved";
            $statup->save();

            User::where('username', $uname)
                ->update(['memberpmt'=>'Paid']);
            return back();
        }
    }


    public function deny(Request $request)
    {
        $id = $request->id;
        $statup = Funds::find($id);
        $statup->status="Denied";
        $statup->save();
        return back();
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
