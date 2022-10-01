<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bag;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Biddings;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Checkout";
        $products = Auction::join('bag','auctions.id','=','bag.product_id')
        ->where('bag.user_id','=',Auth::user()->id)
        ->get();
        $prod_id = Bag::where('user_id', Auth::user()->id)
                        ->get();
       
        return view('pages.checkout')
                ->with(compact('title',
                            'products',
                            'prod_id'
                            ));
                
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
        $title = "Checkout";
        $total = Bag::join('bidtransactions','bag.product_id','=','bidtransactions.prod_id')
        ->where('bag.user_id', Auth::user()->id)
        ->where('bidtransactions.bagstatus', 1)
        ->sum('bidtransactions.bidamt');

        $item = Auction::where('id',$id)->first();
        return view('pages.checkoutsingle')
        ->with(compact('item','total','title'));
                    
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

    public function placeSingleOrder(Request $request){
        
        
        $data = new Order;
        $data->user_id = Auth::user()->id;
        $data->del_address =  Auth::user()->address;
        $data->zipcode = Auth::user()->zipcode;
        $data->total = $request->input('total_amt');
        $data->del_date = Carbon::now()->addDays(7);
        $data->del_stat = 'Pending';
        $data->refnum = $request->refnum;
        $data->save(); 

      
        OrderItems::create([
            'order_id' => $data->id,
            'prod_id' => $request->input('prod_id'),
            'user_id' => Auth::user()->id,
            'price' => $request->total_amt
        ]);
                        
        Biddings::where('prod_id', $request->prod_id)
        ->where('user_id', '<>',Auth::user()->id)
        ->update(['orderstatus' => 1
                ]);
        
        Biddings::where('prod_id', $request->prod_id)
        ->where('user_id', Auth::user()->id)
        ->delete();
        
        Auction::where('id',$request->prod_id)
        ->update(['aucStatus' => 0,
                'orderstatus' => 1
    ]);

        $bag = Bag::where('user_id', Auth::user()->id)
                    ->get();

        Bag::destroy($bag);
        
        $fund_upd = Auth::user()->funds - $request->total_amt;
        User::where('id', Auth::user()->id)
            ->update(['funds' => $fund_upd]);
        
        Session::flash('success', "Order Successfully Placed!");
        return redirect('/orders');

        

    }
    public function placeOrder(Request $request){

        
            $data = new Order;
            $data->user_id = Auth::user()->id;
            $data->del_address =  Auth::user()->address;
            $data->zipcode = Auth::user()->zipcode;
            $data->total = $request->total_amt;
            
            $data->del_date = Carbon::now()->addDays(7);
            $data->del_stat = 'Pending';
            $data->refnum = $request->refnum;
            $data->save(); 


            $bag_items = Bag::join('auctions','bag.product_id','=','auctions.id')
                            ->where('bag.user_id','=',Auth::user()->id)
                            ->get();

                            
                            $lnt = count($bag_items)-1;
                            
                                for ($i=0; $i <= $lnt ; $i++) { 
                                    OrderItems::create([
                                        'order_id' => $data->id,
                                        'prod_id' => $bag_items[$i]->product_id,
                                        'user_id' => Auth::user()->id,
                                        'price' => $request->total_amt,
                                    ]);
                                }

                            $lnt2 =  count($bag_items);

                            for ($i=0; $i < $lnt2 ; $i++) { 
                                Biddings::where('prod_id', $bag_items[$i]->product_id)
                                ->where('user_id', '<>',Auth::user()->id)
                                ->update(['orderstatus' => 1]);

                                Auction::where('id', $bag_items[$i]->product_id)
                                ->update(['aucStatus' => 0,
                                        'orderstatus' => 1
                                ]);    
                            }

            $bag = Bag::where('user_id', Auth::user()->id)
                        ->get();
            Bag::destroy($bag);
            
            $fund_upd = Auth::user()->funds - $request->total_amt;
            User::where('id', Auth::user()->id)
                ->update(['funds' => $fund_upd]);
            
            Session::flash('success', "Order Successfully Placed!");
            return redirect('/orders');
        
    }
}
