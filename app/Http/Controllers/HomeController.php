<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Biddings;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $title = "Home";
        $products= Auction::where('aucStatus','=',1)->take(6)->orderBy('endDate', 'DESC')->get();
        // $hot_auc = Biddings::join('auctions', 'bidtransactions.prod_id','=','auctions.id')
        //                     ->select('auctions.prodName')
        //                     ->where('bidtransactions.bidamt',max('bidtransactions.bidamt'));
                            
        return view('pages.home',compact('title'))->with('products',$products);
    }
}
