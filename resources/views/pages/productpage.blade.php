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

document.getElementById("end_date").innerHTML = "<h5>Remaining Time: <b>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s </b></h5>";

if(distance < 0){
    clearInterval(x);
    document.getElementById("end_date").innerHTML = "Remaining Time: Bidding ENDED";
}
},1000);
</script>


    <div class="bidding">
        <div class="bidding-container py-5 my-5">
            <div class="row">
                <div class="col">
                    <div class="title">
                        <h3><b>BIDDING</b></h3>
                    </div>
                </div>
                <div class="col">
                    <div class="icon">
                    
                    </div>
                </div>
            </div>
            <div class="item ">
                <div class="item-container ">
                    <div class="row justify-content-center align-items-center">
                        <div class="col">
                            <img
                            src="/itemImages/{{$item->itemImg}}"
                            class="card-img-top" 
                            style="border-radius: 0%;
                            width: 300px;
                            height:300px;"
                            />
                        </div>
                    
                        <div class="col">
                            <div class="details">
                                <div class="d-flex align-items-center">
                                    <h3 class="me-3"><b>{{$item->prodName}}</b></h3>
                                 
                                    @if(Auth::check())
                                    
                                        @if(empty($bid_data) && empty($bagwoutbid))
                                            <form action="/addtobag" method="GET">
                                                <button class="btn userloggedbtn mb-2" style="border-radius: 0%;">
                                                    <i class="bi bi-bag-plus" style="font-size: 18px;"></i>
                                                </button>
                                                <input type="hidden" name="product_id" value={{$item->id}}>
                                            </form>
                                        @elseif(empty($bid_data) && !empty($bagwoutbid))
                                            <button class="btn userloggedbtn mb-2" onclick="location.href='/bag/{{Auth::user()->username}}'" border-radius: 0%;">
                                                <i class="bi bi-bag-check text-success" style="font-size: 18px;"></i>
                                            </button>
                                            <input type="hidden" name="product_id" value={{$item->id}}>
                                        @else

                                        
                                        @endif
                                    @else
                                        
                                    @endif
                                </div>
                                <div class="item-det">
                                    <h4 class="mb-3">Starting Bid: <b>{{number_format($item->initialPrice,2)}} PHP</b></h4>
                                    <h5>Category: <b>{{$item->category}}</b></h5>
                                    <h5>Condition: <b>{{$item->cond}}</b> </h5>
                                    <small><p class="pe-5" style="width: 500px; max-width:100%;">{{$item->prodDeets}}</p></small>
                                    @if(empty($orderstat))
                                        <h5>Auction Ends on:<b> {{ Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></h5>
                                        <p id="end_date"></p>
                                    @elseif(!empty($orderstat) && $orderstat = 1)
                                        <h4><b class="text-danger">ITEM SOLD</b></h4>
                                    @else
                                        <h5>Auction Ends on:<b> {{ Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></h5>
                                        <p id="end_date"></p>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div> 
@if(Auth::check())

            <div class="d-flex w-100 justify-content-center align-items-center mt-3 mx-5">
                <div class="">
                    <h5 class="mb-3">Your Max Bid: <b>{{number_format($my_max_bid,2)}} PHP</b> </h5>
                    
                    <h5>Highest Bid: <b>{{number_format($highest_bid,2)}} PHP </b></h5>
                </div>
                <div align="right" class="text-center w-50 px-5 ms-5">
                    {{-- @if(Auth::user()->funds > $item->initialPrice)
                        Funds: <b class="text-success">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                    @else
                        Funds: <b class="text-danger">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                        <a href="/fundings" class="userloggedbtn ms-1"> <i class="bi bi-plus-circle" style="font-size: 18px;"></i></a>
                    @endif  --}}
                    @if(Auth::user()->user_status == 0)
                        <h6 class="">Enter your Bidding Amount</h6>
                        {!! Form::number('bid_amt', '', ['class'=>'form-control','disabled']) !!}
                        {{Form::submit('PLACE BID', ['class'=>'btn btn-dark mt-5 w-50 mb-2','style'=>'border-radius:0%; ','disabled']) }}
                    @else
                        @if($bid_data === null || $bid_status = 0)
                            <h6 class="mt-3"> <b>Enter your Bidding Amount</b> </h6>
                            {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'POST',$item->id]) !!}
                                {{Form::hidden('id',$item->id)}}
                                {!! Form::number('bid_amt', '', ['class'=>'form-control','step'=>'0.01','required']) !!}
                                {{Form::submit('PLACE BID', ['class'=>' btn btn-dark mt-3 w-50 mb-2','style'=>'border-radius:0%;']) }}
                            {!! Form::close() !!}
                            <div>
                                <i class="bi bi-info-circle userloggedbtn" style="font-size:14px;">
                                If you won an auction, you must place an order for the item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                You can also be blocked by the Administrator from bidding on other auctions.
                                </i> 
                                <br>
        
                                <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                            </div>
                            <div class="d-flex align-items-center my-3 justify-content-center">
                                <div class="w-100 me-5">
                                    <hr>
                                </div>
                                OR
                                <div class="w-100 ms-5">
                                    <hr>
                                </div>
                            </div>
                            <h5>Buy for <b>{{$item->buyPrice}} PHP</b></h5>
                            @if(Auth::user()->user_status == 0)
                                {{Form::submit('PROCEED TO CHECKOUT', ['class'=>' btn btn-dark  w-50 ','style'=>'border-radius:0%;' ,'disabled']) }}
                            @else
                                <button class="btn btn-dark my-3" onclick="location.href='/checkout/{{$item->id}}' " style="border-radius: 0%;">
                                    PROCEED TO CHECKOUT
                                </button>
                                
                            @endif
                        @else
                            <div class="">
                                <h5><b>Bid Placed: {{number_format($bid_data->bidamt,2)}} PHP</b></h5>
                                <a href="/biddings" class="userloggedbtn" style="font-size: 15px;">View your Biddings</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col">
                <div class="bidding-det mb-3">
                    <h5 class="mb-3">Your Max Bid: {{number_format($my_max_bid,2)}}</h5>
                    <h5 class="mb-3">Starting Bid: <b>{{number_format($item->initialPrice,2)}} PHP</b></h5>
                    <h5>Highest Bid: <b>{{number_format($highest_bid,2)}} PHP </b></h5>
                </div>
            </div>
            <div class="col"> --}}
                {{-- @guest
                    @if(Route::has('login'))
                    {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'GET']) !!}
                        {{Form::submit('LOGIN TO BID', ['class'=>' btn btn-dark mt-5 w-50 ','style'=>'border-radius:0%;']) }}
                    {!! Form::close() !!}
                    @endif
                    --}}
                {{-- @else --}}
                    {{-- <div class="bid-amt">
                        @if(Auth::user()->funds > $item->initialPrice)
                            <div class="align-items-center justify-content-center">
                                Funds: <b class="text-success">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                            </div>
                        @else
                            <div class="align-items-center justify-content-center">
                                Funds: <b class="text-danger">{{number_format(Auth::user()->funds,2)}} PHP</b> 
                                <a href="/fundings" class="userloggedbtn ms-1"> <i class="bi bi-plus-circle" style="font-size: 18px;"></i></a>
                            </div>
                        @endif 
                        
                        @if(Auth::user()->user_status == 0)
                            <h6 class="mt-3">Enter your Bidding Amount</h6>
                                    {!! Form::number('bid_amt', '', ['class'=>'form-control','disabled']) !!}
                                    {{Form::submit('PLACE BID', ['class'=>'btn btn-dark mt-5 w-50 ','style'=>'border-radius:0%; ','disabled']) }}
                        @else
                                @if($bid_data === null || $bid_status = 0)
                                    <h6 class="mt-3"> Enter your Bidding Amount</h6>
                                        {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'POST',$item->id]) !!}
                                            {{Form::hidden('id',$item->id)}}
                                            {!! Form::number('bid_amt', '', ['class'=>'form-control','step'=>'0.01','required']) !!}
                                            {{Form::submit('PLACE BID', ['class'=>' btn btn-dark mt-3 w-50 mb-2','style'=>'border-radius:0%;']) }}
                                            <br>
                                            <div>
                                                <i class="bi bi-info-circle userloggedbtn" style="font-size:14px;">
                                                If you won an auction, you must place an order for the item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                                
                                                The second highest bidder will win the item automatically.
                                                </i> 
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="w-25 me-5">
                                                    <hr>
                                                </div>
                                                OR
                                                <div class="w-25 ms-5">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="container ">
                                                <div class="buy-now">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5>Buy for <b>{{$item->buyPrice}} PHP</b></h5>
                                                        </div>
                                                        <div class="col">
                                                            @if(Auth::user()->user_status == 0)
                                                                {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'GET']) !!}
                                                                    {{Form::submit('BUY NOW', ['class'=>' btn btn-dark  w-50 ','style'=>'border-radius:0%;' ,'disabled']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                            <a href="/checkout/{{$item->id}}" class="btn btn-dark w-50" style="border-radius: 0%;">BUY NOW</a>
                                                                
                                                                <form action="/addtobag" method="GET">
                                                                    <button class="btn userloggedbtn mb-3" style="border-radius: 0%;">
                                                                        <i class="bi bi-bag-plus" style="font-size: 18px;"></i>
                                                                        Add to Bag
                                                                    </button>
                                                                    <input type="hidden" name="product_id" value={{$item->id}}>
                                                                </form>
                                                            @endif
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div> 
                                        {!! Form::close() !!}
                                    @else
                                        @if($bid_status = 1)
                                            <div class="pt-5">
                                                <h5><b>Bid Placed: {{number_format($bid_data->bidamt,2)}} PHP</b></h5>
                                                <a href="/biddings" class="userloggedbtn" style="font-size: 15px;">View your Biddings</a>
                                            </div>
                                        @endif
                                    @endif
                        @endif --}}

                                            {{-- {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'POST',$item->id]) !!}
                                            {{Form::hidden('id',$item->id)}}
                                            {!! Form::number('bid_amt', '', ['class'=>'form-control','step'=>'0.01','required']) !!}
                                            {{Form::submit('PLACE BID', ['class'=>' btn btn-dark mt-3 w-50 mb-2','style'=>'border-radius:0%;']) }}
                                                <br>
                                                <div>
                                                    
                                                        <i class="bi bi-info-circle userloggedbtn" style="font-size:14px;">
                                                        If you won an auction, you must place an order for the item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                                        
                                                        The second highest bidder will win the item automatically.
                                                        </i> 
                                                        
                                                    
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="w-25 me-5">
                                                        <hr>
                                                    </div>
                                                    OR
                                                    <div class="w-25 ms-5">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="container w-75">
                                                <div class="buy-now">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5>Buy for <b>{{$item->buyPrice}} PHP</b></h5>
                                                        </div>
                                                        <div class="col">
                                                            @if(Auth::check())
                                                                @if(Auth::user()->user_status == 0)
                                                                    {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'GET']) !!}
                                                                        {{Form::submit('BUY NOW', ['class'=>' btn btn-dark  w-50 ','style'=>'border-radius:0%;' ,'disabled']) }}
                                                                    {!! Form::close() !!}
                                                                    @else
                                                                    <a href="/checkout/{{$item->id}}" class="btn btn-dark w-50" style="border-radius: 0%;">BUY NOW</a>
                                                                        
                                                                        <form action="/addtobag" method="GET">
                                                                            <button class="btn userloggedbtn mb-3" style="border-radius: 0%;">
                                                                                <i class="bi bi-bag-plus" style="font-size: 18px;"></i>
                                                                                Add to Bag
                                                                            </button>
                                                                            <input type="hidden" name="product_id" value={{$item->id}}>
                                                                        </form>
                                                                    @endif
                                                                @else
                                                                {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'GET']) !!}
                                                                            {{Form::submit('LOGIN TO BUY', ['class'=>' btn btn-dark  mb-3 w-50 ','style'=>'border-radius:0%;']) }}
                                                                {!! Form::close() !!}
                                                            @endif
                                                                
                                    
                                                        </div>  
                                                    </div>
                                                </div>
                                                </div> 
                                            {!! Form::close() !!}
                                        @endif
                        
                            @endif --}}
        @else
        <div class="mt-5">
            <b >You need to Login first.</b> 
            <br>
            <button class="btn btn-dark my-3 w-25" onclick="location.href='/login' " style="border-radius: 0%;">
                LOGIN TO BID
            </button>
        </div>
            

        @endif
                {{-- </div>
            </div>
         --}}
        


                        {!! Form::open(['action'=>'App\Http\Controllers\storePagesController@store_index','method'=>'GET']) !!}
                            {{Form::submit('VIEW OTHER AUCTIONS', ['class'=>'btn btn-dark mt-5 w-25 ','style'=>'border-radius:0%;'])}}<br>
                        {!! Form::close() !!}
                    {{-- </div>  
                </div>  --}}
          
    </div>
</div>
@endsection
