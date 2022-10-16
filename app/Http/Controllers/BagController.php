<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bag;
use App\Models\Biddings;
use Illuminate\Support\Facades\Auth;
use Session;
class BagController extends Controller
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
    public function show(Request $request, $id)
    {
        // $title = "Bag";

        // $products = Auction::join('bag','auctions.id','=','bag.product_id')
        // ->where('bag.user_id','=',Auth::user()->id)
        // ->get();
    
        // $bid_deet = Biddings::join('bag','bag.product_id','=','bidtransactions.prod_id')
        //         ->where('bag.user_id','=',Auth::user()->id)
        //         ->first();

        // $price = Biddings::select('bidtransactions.bidamt')
        //                 ->join('bag','bag.product_id','=','bidtransactions.prod_id')
        //                 ->where('bidtransactions.bagstatus',1)
        //                 ->where('bidtransactions.prod_id','=',$request->product_id)
        //                 ->where('bidtransactions.user_id', Auth::user()->id)
        //                 ->first();
                        

        // $bid_deet = Bag::leftjoin('bidtransactions','bidtransactions.prod_id','=','bag.product_id')
                    
        //             ->where('bag.user_id', Auth::user()->id)
        //             ->where('bag.product_id','bidtransactions.prod_id')
        //             ->get();
    

        // $total = Bag::join('bidtransactions','bag.product_id','=','bidtransactions.prod_id')
        // ->where('bag.user_id', Auth::user()->id)
        // ->where('bidtransactions.bagstatus', 1)
        // ->sum('bidtransactions.bidamt');

        // $total_sgl =  Bag::join('auctions','bag.product_id','=','auctions.id')
        // ->where('bag.user_id', Auth::user()->id)
        // ->sum('auctions.buyPrice');
        
        // $status = Bag::where('user_id', Auth::user()->id)->get();

        // return view('inc.userloggedbar')
        //         ->with(compact('title',
        //                     'products'
        //                     ));
    
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
        Biddings::where('prod_id',$id)
                    ->where('user_id', Auth::user()->id)
                    ->update(['bagstatus' => 0]);

        $del = Bag::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();
        
        $del->delete();
        
        return redirect()->back();
    }
    function addToBag(Request $request){

            Biddings::where('prod_id',$request->product_id)
                    ->where('user_id', Auth::user()->id)
                    ->update(['bagstatus' => 1]);
            $user = Auth::user()->username;
            $bag = new Bag;
            $bag->product_id = $request->product_id;
            $bag->user_id = Auth::user()->id;
            $bag->status = 0;
            
            $bag->save();
            Session::flash('success', "Item successfully added to Bag.");
            return redirect()->back();
    }

    static function bag_qty(){
        $user_id = Auth::user()->id;
        return Bag::where('user_id',$user_id)->where('status','0')->count();
    }
}
