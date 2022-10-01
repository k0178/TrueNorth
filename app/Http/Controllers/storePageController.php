<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Auction;
use Illuminate\Http\Request;

class storePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Home";
        $products= Auction::where('aucStatus','=',1)->get();
        return view('pages.home', compact('title'))->with('products',$products);
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
     * @param  \App\Models\Invetory  $invetory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       


        $item=Inventory::find($id);
        
    
        return view('pages.productpage')->with('item',$item);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invetory  $invetory
     * @return \Illuminate\Http\Response
     */
    public function edit(Invetory $invetory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invetory  $invetory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invetory $invetory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invetory  $invetory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invetory $invetory)
    {
        //
    }
}
