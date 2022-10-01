<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class itemListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Inventory::all();
        $title = "Admin | Item List";
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.itemList', compact('title'))->with('data',$data);
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Item';
        $data= Inventory::find($id);
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.editItem',compact('title'))->with('data',$data);
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Inventory::find($id);

        $input->prodName=$request->prodName;
        $input->prodDeets=$request->prodDeets;
        $input->category=$request->category;
        $input->type=$request->type;
        $input->initialPrice=$request->initialPrice;
        $input->buyPrice=$request->buyPrice;
        $input->cond=$request->cond;
        $input->qty=$request->qty;

        $input->save();


        return redirect('/admin/list')->with('success','Item Updated. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drop=Inventory::find($id);
        $drop->delete();
        return redirect('/admin/list')->with('error','Item Deleted');
    }


}
