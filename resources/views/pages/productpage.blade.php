@extends('layout.app')
    @section('content')

@php
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
$date = date($item->endDate);
$time = date(' 23:59:59');
$date_today = $date.''.$time;
@endphp
    
<script type="text/javascript">
var count_id = "<?php echo $date_today ?>";
var countDownDate = new Date(count_id).getTime();

var x = setInterval(function(){

    var now  = new Date().getTime();
    var distance = countDownDate - now;
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24 ))/(1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60))/(1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60))/1000);

document.getElementById("end_date").innerHTML = "<h5 class='mt-3 px-4 py-2' style ='border: 2px #000000 solid; '>Remaining Time: <br> <b style='font-size: 22px;'>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s </b></h5>";

if(distance < 0){
    clearInterval(x);
    document.getElementById("end_date").innerHTML = "Remaining Time: Bidding ENDED";
}
},1000);
</script>


    <div class="bidding my-5">
        <div class="bidding-container p-5 justify-content-center ">
            <div class="row">
                <div class="col">
                    <div class="title">
                        <h3><b>BIDDING</b></h3>
                    </div>
                </div>
            </div>
            <section id="portfolio" class="portfolio">
                <div class="container mt-5">
                    <div class="row portfolio-container align-items-center justify-content-center">
                        <div class="col-lg-5 col-md-6 portfolio-item filter-app me-3">
                            <div class="portfolio-wrap">
                                <img src="/itemImages/{{$item->itemImg}}" class="img-fluid" alt="" style="width:500px;
                                height: 450px; ">
                                <div class="portfolio-info ">
                                    <h4>{{$item->prodName}}</h4>
                                    <p>Ends on: {{ \Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <h4 class="mb-3">Starting Bid: <b>{{number_format($item->initialPrice,2)}} PHP</b></h4>
                            <h5>Category: <b>{{$item->category}}</b></h5>
                            <h5>Condition: <b>{{$item->cond}}</b> </h5>
                            <small class=""><p  style="width:500px; max-width:100%;">{{$item->prodDeets}}</p></small>
                            @if(empty($orderstat))
                                <h5>Auction Ends on:<b> {{ Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></h5>
                                <p id="end_date"></p>
                            @elseif(!empty($orderstat) && $orderstat = 1)
                                <h4><b class="text-danger">ITEM SOLD</b></h4>
                            @else
                                <h5>Auction Ends on:<b> {{ Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></h5>
                                <p id="end_date" class=""></p>
                            @endif
                           
                            <div class="">
                                {{-- @if(Auth::user()->funds > $item->initialPrice)
                                    Funds: <b class="text-success">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                                @else
                                    Funds: <b class="text-danger">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                                    <a href="/fundings" class="userloggedbtn ms-1"> <i class="bi bi-plus-circle" style="font-size: 18px;"></i></a>
                                @endif  --}}
                    @if(Auth::check())
                    <div class="">
                        <h5 class="mb-2">Your Max Bid: <b>{{number_format($my_max_bid,2)}} PHP</b> </h5>
                        
                        @if(empty($pfp))
                            <h5><b>No Bidders yet.</b></h5>
                        @else
                            <h5>Highest Bidder: <img src="/userPFP/{{$pfp->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-2" ><b>{{$max_bidder->uname}}</b></h5>
                        @endif
                    </div>
                                @if(Auth::user()->user_status == 0)
                                    <h6 class="">Enter your Bidding Amount</h6>
                                    {!! Form::number('bid_amt', '', ['class'=>'form-control','disabled']) !!}
                                    {{Form::submit('PLACE BID', ['class'=>'btn btn-dark mt-5 w-50 mb-2','style'=>'border-radius:0%; ','disabled']) }}
                                @else
                                    @if($bid_data === null || $bid_status = 0)
                                        {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'POST',$item->id]) !!}
                                            {{Form::hidden('id',$item->id)}}
                                            {!! Form::number('bid_amt', '', ['class'=>'form-control me-5','step'=>'0.01','style'=>'border-radius:0%;','placeholder'=>'Enter your Bidding Amount','required']) !!}
                                            {{--  --}}
                
                
                                        <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark btn btn-dark mt-3 w-100  mb-2" style="border-radius:0%;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    PLACE BID
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bid Agreement</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                If you won an auction, you must place an order for the item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                                You can also be <b class="text-danger">BLOCKED</b> by the Administrator from bidding on other auctions.
                                                <br>
                                                <br>
                                                <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                                            </div>
                                            
                                            
                                            <div class="modal-footer justify-content-center  align-items-center">
                                                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                                                {{-- {{Form::submit('CANCEL', ['class'=>' btn btn-secondary mt-3 w-25 mb-2','style'=>'border-radius:0%;','data-bs-dismiss'=>'modal']) }} --}}
                                                {{Form::submit('CONFIRM BID', ['class'=>' btn btn-dark  w-50 mb-2','style'=>'border-radius:0%;']) }}
                                                {{Form::hidden('id',$item->id)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                    @else
                                        <div class="">
                                            <h5><b>Bid Placed: {{number_format($bid_data->bidamt,2)}} PHP</b></h5>
                                            <a href="/biddings" class="userloggedbtn" style="font-size: 15px;">View your Biddings</a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="mt-5">
                            <b >You need to Login first.</b> 
                            <br>
                            <button class="btn btn-dark mt-3 w-100" onclick="location.href='/login' " style="border-radius: 0%;">
                                LOGIN TO BID
                            </button>
                        </div>
                            
                
                    @endif
                    </div>

                </section>

        {!! Form::open(['action'=>'App\Http\Controllers\storePagesController@store_index','method'=>'GET']) !!}
            {{Form::submit('VIEW OTHER AUCTIONS', ['class'=>'userloggedbtn mt-5  ','style'=>'border-radius:0%; font-size:14px; font-weight:bold; border: 1px #000000 solid; padding: 0.3rem 0.5rem;'])}}<br>
        {!! Form::close() !!}

    </div>
</div>
@endsection
