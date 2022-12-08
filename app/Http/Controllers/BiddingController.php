<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use DB;
class BiddingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
        $title = Auth::user()->username ." | Biddings";
        $pending = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->where('bidtransactions.bagstatus',0)
        ->where('bidtransactions.retractstat',0)
        ->where('bidtransactions.winstatus','Pending')
        ->orderBy('bidtransactions.created_at','DESC')
        ->get();

        $won = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->where('bidtransactions.bagstatus',0)
        ->where('bidtransactions.retractstat',0)
        ->where('bidtransactions.winstatus','Won')
        ->orderBy('bidtransactions.created_at','DESC')
        ->get();

        $lost = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->where('bidtransactions.bagstatus',0)
        ->where('bidtransactions.retractstat',0)
        ->where('bidtransactions.winstatus','Lost')
        ->where('bidtransactions.orderstatus',0)
        ->orderBy('bidtransactions.created_at','DESC')
        ->get();

        $winner = Biddings::select('*')
                            ->where('prod_id',$request->input('id'))
                            ->where('winstatus','Won')
                            ->first();
        
        return view('profile.biddings', compact('title','pending','won','lost'));
        // $currentdate = Carbon::now()->format('Y-m-d');
        // $win = Biddings::select('bidamt', 'uname','prod_id', Biddings::raw('MAX(bidamt)'))
        //                 ->where('bidstatus', 1)
		// 				->where('endDate','<=',$currentdate)
		// 				->where('retractstat',0)
		// 				->where('orderstatus',0)
        //                 ->groupBy('prod_id')
        //                 ->get();
		
		// $win = Biddings::selectRaw('prod_id, MAX(bidamt) as bidamt, uname')
		// 				->whereRaw('bidstatus =  1')
		// 				->groupBy('prod_id')
		// 				->first();
		
        // $win = Biddings::groupBy('prod_id')->max('bidamt');
		// $win = Biddings::select('*')
		// ->whereRaw('bidamt = (select max(bidamt) from bidtransactions b
		// 		where bidtransactions.prod_id = b.prod_id)')
		// // ->whereRaw('id = (select min(id) from bidtransactions b
		// // 			where bidtransactions.prod_id = b.prod_id)' )
		// ->where('bidstatus', 1)
		// ->where('retractstat',0)
		// ->where('orderstatus',0)
		// ->get();
        // $currentdate = Carbon::now()->format('Y-m-d');
        // $win = Biddings::select('bidamt','uname','prod_id')
        // ->whereRaw('bidamt in (select max(bidamt) from bidtransactions b
        //         where bidtransactions.prod_id = b.prod_id and id in (select min(id) from bidtransactions b
        //         where bidtransactions.prod_id = b.prod_id)) ')
        // ->whereRaw('id = (select min(id) from bidtransactions b
        // 			where bidtransactions.prod_id = b.prod_id)' )
        // ->whereRaw('id in (select min(id) from bidtransactions c
        // where bidtransactions.prod_id = c.prod_id)')
        // ->where('bidstatus', 1)
        // ->where('retractstat',0)
        // ->where('orderstatus',0)
        // ->where('endDate','<',$currentdate)
        // ->get();
		

       	// dd($win);

        // return view('profile.test', compact('win','title'));
    }

    static function won_qty(){
        $user_id = Auth::user()->id;
        return Biddings::where('user_id',$user_id)
                        ->where('winstatus','Won')
                        ->where('orderstatus',0)
                        ->where('bidstatus',1)
                        ->where('bagstatus',0)
                        ->count();
    }

    static function pend_qty(){
        $user_id = Auth::user()->id;
        return Biddings::where('user_id',$user_id)
                        ->where('winstatus','Pending')
                        ->where('bidstatus',1)
                        ->count();
    }

    static function lost_qty(){
        $user_id = Auth::user()->id;
        return Biddings::where('user_id',$user_id)
                        ->where('winstatus','Lost')
                        ->where('bidstatus',1)
                        ->where('retractstat',0)
                        ->where('bagstatus',0)
                        ->where('orderstatus',0)
                        ->count();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'bid_amt'=>['required','numeric']
        ]);
        
        $highest_bid = Biddings::select('bidamt')
                                ->where('prod_id','=',$request->id)
                                ->where('retractstat','=', 0)
                                ->max('bidamt');
        $prod= Auction::where('id','=',$request->id)->first();
        
    

        if(Auth::user()->funds < 500.00){
            Session::flash('error', "You have atleast 500.00 PHP worth of funds to bid. (Funds Needed: ".( 500.00 - Auth::user()->funds ).')');
            return redirect()->back()->withInput();   
            
        }

        elseif(($request->bid_amt) < $prod->initialPrice ){
            Session::flash('error', "Insufficient Amount. (Starting Bid: ".( $prod->initialPrice).')');
            return redirect()->back()->withInput();
            } 
    
        else{
            $data = new Biddings;
            $data->user_id = Auth::user()->id;
            $data->uname = Auth::user()->username;
            $data->prod_id = $request->id;
            $data->prodname = $prod->prodName;
            $data->bidamt = $request->bid_amt;
            $data->refnum = Auth::user()->id.date('ymdHis');
            $data->bidstatus = 1; //1/1 bid done
            $data->endDate = $prod->endDate;
            $data->save(); 


            Session::flash('success', "Bid Successfuly Placed!");
            return redirect()->back();
        }
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
    public function update(Request $request, $id)
    {

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bid = Biddings::find($id);
        
        $bid->delete();

        Session::flash('success', "Bid Successfuly Retracted.");
        return redirect()->back();
        
    }

    public function retractbid(Request $request){

        Biddings::where('id', $request->product_id)
        ->update(['retractstat' => 1,
                    'bidstatus' => 0,
                    'bagstatus' => 0
                ]);
                
                

        Session::flash('success', "Bid Successfuly Retracted.");
        return redirect()->back();

        
    }

}
