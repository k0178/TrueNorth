<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Session;

class BidHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =  Auth::user()->username ." | Bid History";
        $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
        ->where('bidtransactions.user_id','=',Auth::user()->id)
        ->orderBy('bidtransactions.created_at','DESC')
        ->get();

        
        return view('profile.bidhistory', compact('title'))
                ->with('data',$data);
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
                $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                            ->where('bidtransactions.refnum','like','%'.$query.'%')
                            ->orwhere('bidtransactions.created_at','like','%'.$query.'%')
                            ->orwhere('bidtransactions.prodname','like','%'.$query.'%')
                            ->where('bidtransactions.uname', Auth::user()->username)
                            ->get();
            }
            else{
                $data = Auction::join('bidtransactions','bidtransactions.prod_id','=','auctions.id')
                ->where('bidtransactions.user_id','=',Auth::user()->id)
                ->orderBy('bidtransactions.created_at','DESC')
                ->get();
            }
            
            

            $total_row = $data->count();
            if($total_row > 0){
                foreach ($data as $row) {

                    $status = '';
                    if($row->winstatus == 'Won'){
                        $status = '<li class= "text-success">'.$row->winstatus.'</li>';
                    }
                    elseif($row->winstatus == 'Pending'){
                        $status = '<li class= "text-warning">'.$row->winstatus.'</li>';
                    }
                    elseif($row->winstatus == 'Lost'){
                        $status = '<li class= "text-danger">'.$row->winstatus.'</li>';
                    }
                    $output .=' 
                        <tr">
                            <th scope = row>
                                <img src = "/itemImages/'.$row->itemImg.'" width=125px height="125px" 
                                    style = object-fit: cover; 
                                    border:1px #000000 solid; 
                                    class = rounded-circle>
                            </th>
                        <td style=>
                            <ul style= list-style: none;>
                                <small>
                                    <li class=d-flex align-items-center><h5><b>'.$row->prodName.'</b> </h5></li>
                                    <li>Type: <b>'.$row->type.'</b></li>
                                    <b>'.$status.'</b>
                                    <li>Category: <b>'.$row->category.'</b></li>
                                    <li>Condition: <b>'.$row->cond.'</b></li>
                                    <li>End Date: <b>'.\Carbon\Carbon::parse($row->endDate)->isoFormat('MMM D, YYYY').' (11:59 PM)</b></li>
                                </small>
                            </ul>
                        </td>
                        <td class=>
                            <ul>
                                <small>
                                    <li><h5>Bid Placed: <b>'.number_format($row->bidamt,2) .'PHP</b></h5></li>
                                    <li class=mb-1> <b>'.\Carbon\Carbon::parse($row->created_at)->format('l, jS \of F Y h:i:s A').'</b></li>
                                    <li>Reference #: <b>'.$row->refnum.'</b> </li>
                                </small>
                            </ul>
                        </td>
                    </tr> 
                    ';
                }
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
