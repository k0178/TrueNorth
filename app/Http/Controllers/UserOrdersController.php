<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
use App\Models\OrderItems;
use App\Models\Order;
use App\Models\Bag;
use Illuminate\Support\Facades\Auth;
class UserOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "My Orders";
        $data = Order::where('user_id', Auth::user()->id)
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
    
        // $user_deet = User::join('order')
        // $total = Bag::join('bidtransactions','bag.product_id','=','bidtransactions.prod_id')
        // ->where('bag.user_id', Auth::user()->id)
        // ->where('bidtransactions.bagstatus', 1)
        // ->sum('bidtransactions.bidamt');

        // $del_fee = 45;
        // $total += $del_fee;

        // $orders = Orderitems::select('prod_id')
        // ->where('user_id','=',Auth::user()->id)
        // ->where('order_id',$d)
        // ->get();
        
        
        
        return view('profile.myorders', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
