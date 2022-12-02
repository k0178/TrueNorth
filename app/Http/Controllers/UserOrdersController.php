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
                    ->get();
    
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
        
   
        
        return view('profile.myorders', compact('title','data'));
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

    public function search(Request $request){
    
        if($request->ajax()){

            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data = Order::where('refnum','like','%'.$query.'%')
                            ->orwhere('tracknum','like','%'.$query.'%')
                            ->where('user_id', Auth::user()->id)
                            ->get();
            }
            else{
                $data = Order::where('user_id', Auth::user()->id)
                        ->orderBy('created_at','DESC')
                        ->get();
            }
            
        
       

            $total_row = $data->count();
            $items = '';

         
          
         

            if($total_row > 0){
                foreach ($data as $row) {
                
                    $orders = Auction::join('order_items','auctions.id','=','order_items.prod_id')
                            ->select('auctions.*')
                            ->where('order_items.user_id','=',Auth::user()->id)
                            ->where('order_items.order_id',$row->id)
                            ->get();
                            
                    foreach($orders as $item){
                        $items .=  '<div>'.$item->prodName.'</div>';
                    }      
                
                    $delstat = '';
                    if($row->del_stat == "Pending"){
                        $delstat = '<td class="fw-bold text-warning">'.$row->del_stat.'</td>';
                    }
                    elseif($row->del_stat == "Shipped"){
                        $delstat = '<td class="fw-bold text-info">'.$row->del_stat.'</td>';
                    }
                    elseif($row->del_stat == "Delivered"){
                        $delstat = '<td class="fw-bold text-success">'.$row->del_stat.'</td>';
                    }
                    
                    
                    $output .= '
                        <tr>
                            <th scope="row">'.$row->id.'</th>
                            <td> 
                            <button type="button" class="info-btn mb-3" data-bs-toggle="modal" data-bs-target="#items'.$row->id.'">
                                VIEW ITEMS
                            </button>
                           
                            </td>
                            <td>'.$row->del_address.'</td>
                            <td>'.number_format($row->total,2) .' PHP</td>
                            <td>'.$row->refnum.'</td>
                            <td>'.$row->del_date.'</td>
                            '.$delstat.'
                            <td>'.$row->tracknum.'</td>

                            <td>
                                <form action = "/mailrec" method="GET">
                                    <input type = "hidden" name="id" value="'.$row->id.'">
                                    <input type = "hidden" name="refnum" value="'.$row->refnum.'">
                                    <input type = "hidden" name="total" value="'.number_format($row->total,2).'">
                                    <input type = "hidden" name="tracknum" value="'.$row->tracknum.'">

                                    <input type = "hidden" name="items" value="'.$items.'">


                                    <button type="submit" class="info-btn w-100" ><i class="bi bi-envelope me-1"></i>SEND</button>
                                </form>
                            </td>
                        </tr>
                        ';
                        
                }
                $html = ' <div class="modal fade" id="items'.$row->id.'"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">ORDER ID#: <b>'.$row->id.'</b></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            '.$items.'
                                Thank you for auctioning with us! Kindly wait for the delivery of your item/s. If you want more details about the delivery status of your parcel, you can track the parcel using the tracking number provided or you can also <b><a href="/contactus" class="">Contact Us</a></b>.
                                <br>
                                <br>
                                <b><a href="https://www.jtexpress.ph/index/query/gzquery.html" class="">Track your order.</a></b>
                        </div>
                    
                    <div class="modal-footer justify-content-center  align-items-center">
                        <button type="button" class="info-btn" data-bs-dismiss="modal">Got It</button>
                    </div>
                </div>
            </div>
        </div>';
        {{$html;}}
            }
            else{
                $output = '
                    <tr>
                        <td colspan=6 class=text-center> NO DATA FOUND</td>
                    </tr>
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
