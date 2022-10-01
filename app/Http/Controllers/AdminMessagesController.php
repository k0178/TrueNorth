<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Messages;
use Illuminate\Http\Request;
use Session;

class AdminMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Admin | Messages";
        $users = Messages::join('users','messages.user_id','=','users.id')
                            ->select('users.*')
                            ->groupBy('users.username')
                            ->get();
      
        return view('admin.messageslist', compact('title','users'));
          
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
        $title = "Admin | Messages";
        $user = User::select('*')
        ->where('id', $id)
        ->first();
        $messages = Messages::select('message')
                            ->where('user_id',$id)
                            ->get();
      
        return view('admin.messages', compact('title','messages','user'));
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
    public function update(Request $request, $id)
    {
        //
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
