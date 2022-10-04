<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Inventory;
use App\Http\Requests\StoreAuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use Illuminate\Support\Facades\Auth;
use Session;
Use \Carbon\Carbon;
class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
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
     * @param  \App\Http\Requests\StoreAuctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuctionRequest $request)
    {    $this->validate($request,[
        'endDate'=>'required',
    ]);
    if($request->endDate < Carbon::today()->toDateString()){
        Session::flash('error', "Invalid Date.");
        return redirect()->back()->withInput();
    }
    else{
        $input = new Auction;
        $input->itemImg=$request->itemImg;
        $input->prodName=$request->prodName;
        $input->prodDeets=$request->prodDeets;
        $input->cond=$request->cond;
        $input->category=$request->category;
        $input->type=$request->type;
        $input->initialPrice=$request->initialPrice;
        $input->buyPrice=$request->buyPrice;
        $input->aucStatus=1;
    
        $newQty = $request->qty - 1;

        $input->endDate=$request->endDate;

        $find = Inventory::where('id', $request->id)->first();
        $find->qty = $newQty;

        $find->save();
        $input->save();

        Session::flash('success', "Auction Posted.");
        return redirect('/admin/auctionlist'); 
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction, $id)
    {
        $data = Inventory::find($id);
        $title = 'Post Auction';
        return view('admin.itemPost', compact('title'))->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuctionRequest  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuctionRequest $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
