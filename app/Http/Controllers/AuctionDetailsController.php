<?php

namespace App\Http\Controllers;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biddings;                                                                                                                
class AuctionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::where('aucStatus','=',1)->get();
        $title = "Admin | Auction List";
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.auctionList', compact('title','auctions'));
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

        $title = "Admin | Auction List";

        $highest_bid = Biddings::select('bidamt')
                                ->where('prod_id','=',$id)
                                ->max('bidamt');
        $max_bidder = Biddings::select('*')
        ->where('prod_id','=',$id)
        ->where('bidamt','=',$highest_bid)
        ->first();                       
        $auction = Auction::find($id);
        $auctions = Auction::where('aucStatus','=',1)->get();
        return view('admin.auctions')
        ->with(compact('title','auction', 'auctions','highest_bid','max_bidder'))
        ;
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
