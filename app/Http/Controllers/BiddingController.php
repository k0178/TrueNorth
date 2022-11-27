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
        ->paginate(5);

        $won = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->where('bidtransactions.bagstatus',0)
        ->where('bidtransactions.retractstat',0)
        ->where('bidtransactions.winstatus','Won')
        ->orderBy('bidtransactions.created_at','DESC')
        ->paginate(5);

        $lost = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->where('bidtransactions.bagstatus',0)
        ->where('bidtransactions.retractstat',0)
        ->where('bidtransactions.winstatus','Lost')
        ->where('bidtransactions.orderstatus',0)
        ->orderBy('bidtransactions.created_at','DESC')
        ->paginate(5);

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
        
    

        if(Auth::user()->funds < $request->bid_amt){
            Session::flash('error', "Insufficient Funds. (Funds Needed: ".( $request->bid_amt - Auth::user()->funds ).')');
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

    public function wonsearch(Request $request){

        if($request->ajax()){

            $output = ' ';
            $query = $request->get('query');
            if($query != ''){

                $data =  Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                            ->where('bidtransactions.prodname','like','%'.$query.'%')
                            ->where('bidtransactions.user_id','=',Auth::user()->id)
                            ->where('bidtransactions.bagstatus',0)
                            ->where('bidtransactions.retractstat',0)
                            ->where('bidtransactions.winstatus','Won')
                            ->get();
            }
            else{

                $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                ->where('bidtransactions.user_id','=',Auth::user()->id)
                ->where('bidtransactions.bagstatus',0)
                ->where('bidtransactions.retractstat',0)
                ->where('bidtransactions.winstatus','Won')
                ->orderBy('bidtransactions.created_at','DESC')
                ->get();
            }
            

            $total_row = $data->count();
            $bidresults = '';
            if($total_row > 0){
                foreach ($data as $row) {

                    $bids = Biddings::where('prod_id','=',$row->prod_id)
                    ->orderBy('bidamt','DESC')
                    ->get();
                    foreach ($bids as $item) {
                        $bidresults .='   <tr>
                            <th scope = "row">'.$item->uname.'</th>
                            <td>'.number_format($item->bidamt,2).' PHP</td>
                            <td>'.$item->created_at.'</td>
                            <td>'.$item->refnum.'</td>  
                    </tr> ';
                    }
                    $output .= '
                    <div class="list-group list-group-flush scrollarea mx-3 align-items-center" style="border-bottom:1px #dddddd solid;">
                        <div class="d-flex align-items-center">
                            <img src="/itemImages/'.$row->itemImg.' "width="130px" height="130px" 
                            style="object-fit: cover; 
                                    border:3px #56A06E solid; 
                                    
                                    margin-top :20px;
                                    margin-bottom :20px;" 
                            class="rounded-circle ">
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                <li class="d-flex align-items-center"><h5><b>'.$row->prodname.'</b></h5>
                                        <form action = "/addtobag" method="GET">
                                            <input type = "hidden" name="product_id" value="'.$row->prod_id.'">
                                            <button class="btn" type="submit" style="border-radius: 0%;"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Add to Bag">
                                                <i class="bi bi-bag-plus " style="font-size: 20px;"></i>
                                            </button>
                                        </form>
                                </li>
                                <li>Type: <b>'.$row->type.'</b></li>
                                <li>Category: <b>'.$row->category.'</b></li>
                                <li>Condition: <b>'.$row->cond.'</b></li>
                                <li>Ended On: <b>'.\Carbon\Carbon::parse($row->endDate)->isoFormat('MMM D, YYYY').' (11:59 PM)</b></li>
                                </ul>
                            </div>
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                <li>Bid Placed <b>'.number_format($row->bidamt,2).' PHP</b></li>
                                <li> Placed at: <b>'.\Carbon\Carbon::parse($row->created_at)->format('l, jS \of F Y (h:i:s A)').' </b></li>
                                <li> Must place order before: <br> <b>'.\Carbon\Carbon::parse($row->orderDate)->format('l, jS \of F Y (h:i:s A)').' </b></li>
                                <li>Reference #: <b>'.$row->refnum.'</b> </li>
                                
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="form-btn text-white mb-3 d-flex" style="border-radius: 0%; background:#56A06E;"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Checkout"
                            onclick=location.href="/checkout/'.$row->prod_id.'">
                            <i class="bi bi-bag-check me-2" style="color:white;"></i>
                            CHECKOUT
                        </button>
                        <button type="button" class="info-btn mb-3" data-bs-toggle="modal" data-bs-target="#bidresults'.$row->prod_id.'">
                            View Bidding Results
                        </button>
                    </div>

                    <div class="modal fade" id="bidresults'.$row->prod_id.'"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidding Results: <b>'.$row->prodname.'</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <table class="table">
                                        <div class="d-flex  flex-shrink-0  link-dark text-decoration-none border-bottom">
                                            <span class="fs-6 fw-semibold text-center w-100"><b>List of Bidders</b> </span>
                                        </div>
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Bid Amount</th>
                                            <th scope="col">Time Placed</th>
                                            <th scope="col">Reference #</th>
                                        </tr>
                                    </thead>
                                        <tbody>'.
                                            $bidresults.'
                                        </tbody>
                                    </table>
                                        Make sure to secure an order for this item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                        You can also be <b class="text-danger">BLOCKED</b> by the Administrator from bidding on other auctions.
                                        <br>
                                        <br>
                                        <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                            </div>
                            
                            <div class="modal-footer justify-content-center  align-items-center">
                                <button type="button" class="info-btn" data-bs-dismiss="modal">Got It</button>
                            </div>
                        </div>
                    </div>
                </div>

                        ';
                }
            }
            else{
                $output = '
                    <div class=text-center> <h5 class="fw-bold">NO DATA FOUND</h5></div>
                '; 
            }
            $data = array(
                'table_data'=> $output,
                'total_data'=> $total_row
            );
            echo json_encode($data);
        }
    }

    public function pendsearch(Request $request){

        if($request->ajax()){
            $output = '';
            $query = $request->get('query');
            if($query != ''){

                $data =  Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                            ->where('bidtransactions.prodname','like','%'.$query.'%')
                            ->where('bidtransactions.user_id','=',Auth::user()->id)
                            ->where('bidtransactions.winstatus','Pending')
                            ->get();
            }
            else{

                $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                ->where('bidtransactions.user_id','=',Auth::user()->id)
                ->where('bidtransactions.winstatus','Pending')
                ->orderBy('bidtransactions.created_at','DESC')
                ->get();
            }
            
            $total_row = $data->count();
            $bidresults = '';
            $retract = '';
            if($total_row > 0){
                foreach ($data as $row) {
                    
                    if(\Carbon\Carbon::parse($row->endDate)->subDays(1) < (\Carbon\Carbon::today()) ){
                        $retract ='
                            <label>
<pre class="text-danger">
    <i class="bi bi-exclamation-triangle-fill text-danger"></i>
    You are not allowed to retract anymore 
    if there are <b class="text-danger">24 hours or less</b> left on the timer.
</pre>
                            </label>

                        ';
                    }
                    else{
                        $retract = '
                            <button type="button" class="form-btn mt-3   mb-2" style="background:#C76D6D;" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$row->id.'">
                                <i class="bi bi-x-circle me-1 text-white"></i>
                                <b class="text-white">RETRACT</b> 
                            </button>

                            <div class="modal fade" id="staticBackdrop'.$row->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Retract your Bid.</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                                <h4>ARE YOU SURE YOU WANT TO RETRACT YOUR BID FOR THIS ITEM?</h4>
                                                <br>
                                                <small class = "mb-3">
                                                    Retracting means withrawing the bid you placed. You can retract if you accidentally bid the wrong amount. 
                                                    If you retracted too many times, the system can prevent you from retracting. So always check the amount you entered before placing a bid.
                                                    You can also retract if the product description have been changed.
                                                </small>
                                                <br>
                                                <br>
                                            <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                                        </div>
                                        <div class="modal-footer justify-content-center  align-items-center">
                                            <form action="/retractbid" method="get">
                                                <input type="hidden" name="product_id" value="'.$row->id.'">
                                                <button type="submit" class="form-btn" data-bs-dismiss="modal">Retract Bid</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                    $bids = Biddings::where('prod_id','=',$row->prod_id)
                    ->orderBy('bidamt','DESC')
                    ->get();
                    foreach ($bids as $item) {
                        $bidresults .='   <tr>
                            <th scope = "row">'.$item->uname.'</th>
                            <td>'.number_format($item->bidamt,2).' PHP</td>
                            <td>'.$item->created_at.'</td>
                            <td>'.$item->refnum.'</td>  
                    </tr> ';
                    }
                    $output .= '
                    <div class="list-group list-group-flush scrollarea mx-3 align-items-center" style="border-bottom:1px #dddddd solid;">
                        <div class="d-flex align-items-center">
                            <img src="/itemImages/'.$row->itemImg.' "width="130px" height="130px" 
                            style="object-fit: cover; 
                                    border:3px #E7BB41 solid; 
                                    
                                    margin-top :20px;
                                    margin-bottom :20px;" 
                            class="rounded-circle ">
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                <li class="d-flex align-items-center"><h5><b>'.$row->prodname.'</b></h5></li>
                                <li>Type: <b>'.$row->type.'</b></li>
                                <li>Category: <b>'.$row->category.'</b></li>
                                <li>Condition: <b>'.$row->cond.'</b></li>
                                <li>Ends On: <b>'.\Carbon\Carbon::parse($row->endDate)->isoFormat('MMM D, YYYY').' (11:59 PM)</b></li>
                                </ul>
                            </div>
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                    <li>Bid Placed <b>'.number_format($row->bidamt,2).' PHP</b></li>
                                    <li> Placed at: <b>'.\Carbon\Carbon::parse($row->created_at)->format('l, jS \of F Y (h:i:s A)').' </b></li>
                                    <li>Reference #: <b>'.$row->refnum.'</b> </li>
                                </ul>
                            </div>
                        </div>
                        <div class=" text-center mx-5 mb-4">
                            '.$retract.'
                        </div>
                    </div>
                
                ';
                }
            }
            else{
                $output = '
                    
                        <div class=text-center> <h5 class="fw-bold">NO DATA FOUND</h5></div>
                    
                '; 
            }
            $data = array(
                'table_data'=> $output,
                'total_data'=> $total_row
            );
            echo json_encode($data);
        }
    }

    public function lostsearch(Request $request){

        if($request->ajax()){

            $output = '';
            $query = $request->get('query');
            if($query != ''){

                $data =  Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                            ->where('bidtransactions.prodname','like','%'.$query.'%')
                            ->where('bidtransactions.user_id','=',Auth::user()->id)
                            ->where('bidtransactions.bagstatus',0)
                            ->where('bidtransactions.retractstat',0)
                            ->where('bidtransactions.winstatus','Lost')
                            ->get();
            }
            else{

                $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                ->where('bidtransactions.user_id','=',Auth::user()->id)
                ->where('bidtransactions.bagstatus',0)
                ->where('bidtransactions.retractstat',0)
                ->where('bidtransactions.winstatus','Lost')
                ->orderBy('bidtransactions.created_at','DESC')
                ->get();
            }
            

            $total_row = $data->count();
            $bidresults = '';
            if($total_row > 0){
                foreach ($data as $row) {

                    $bids = Biddings::where('prod_id','=',$row->prod_id)
                    ->orderBy('bidamt','DESC')
                    ->get();
                    foreach ($bids as $item) {
                        $bidresults .='<tr>
                                        <th scope = "row">'.$item->uname.'</th>
                                        <td>'.number_format($item->bidamt,2).' PHP</td>
                                        <td>'.$item->created_at.'</td>
                                        <td>'.$item->refnum.'</td>  
                                    </tr> ';
                    }
                    $output .= '
                    <div class="list-group list-group-flush scrollarea mx-3 align-items-center" style="border-bottom:1px #dddddd solid;">
                        <div class="d-flex align-items-center">
                            <img src="/itemImages/'.$row->itemImg.' "width="130px" height="130px" 
                            style="object-fit: cover; 
                                    border:3px #C76D6D solid; 
                                    
                                    margin-top :20px;
                                    margin-bottom :20px;" 
                            class="rounded-circle ">
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                <li><h5><b>'.$row->prodname.'</b></h5></li>
                                <li>Type: <b>'.$row->type.'</b></li>
                                <li>Category: <b>'.$row->category.'</b></li>
                                <li>Condition: <b>'.$row->cond.'</b></li>
                                <li>Ended On: <b>'.\Carbon\Carbon::parse($row->endDate)->isoFormat('MMM D, YYYY').' (11:59 PM)</b></li>
                                </ul>
                            </div>
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                <li>Bid Placed <b>'.number_format($row->bidamt,2).' PHP</b></li>
                                <li> Placed at: <b>'.\Carbon\Carbon::parse($row->created_at)->format('l, jS \of F Y (h:i:s A)').' </b></li>
                                <li>Reference #: <b>'.$row->refnum.'</b> </li>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="info-btn mb-3" data-bs-toggle="modal" data-bs-target="#bidresults'.$row->prod_id.'">
                            View Bidding Results
                        </button>
                    </div>

                    <div class="modal fade" id="bidresults'.$row->prod_id.'"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidding Results: <b>'.$row->prodname.'</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <table class="table">
                                        <div class="d-flex  flex-shrink-0  link-dark text-decoration-none border-bottom">
                                            <span class="fs-6 fw-semibold text-center w-100"><b>List of Bidders</b> </span>
                                        </div>
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Bid Amount</th>
                                            <th scope="col">Time Placed</th>
                                            <th scope="col">Reference #</th>
                                        </tr>
                                    </thead>
                                        <tbody>'.
                                            $bidresults.'
                                        </tbody>
                                    </table>
                            </div>
                            
                            <div class="modal-footer justify-content-center  align-items-center">
                                <button type="button" class="info-btn" data-bs-dismiss="modal">Got It</button>
                            </div>
                        </div>
                    </div>
                </div>

                        ';
                }
            }
            else{
                $output = '
                    <div class=text-center> <h5 class="fw-bold">NO DATA FOUND</h5></div>
                '; 
            }
            $data = array(
                'table_data'=> $output,
                'total_data'=> $total_row
            );
            echo json_encode($data);
        }
    }



}
