@extends('layout.admin')
@section('content') 


<a href="/admin/auctionlist" class="d-flex flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold text-center w-100">Auction List</span>
</a>

<div class="d-flex">
      <div class="bg-white" style="margin:0%; width: 500px; ">
          <div class="list-group list-group-flush border-bottom scrollarea " style="border-right:1px #f0eeee solid;">
          @if(count($auctions)>0)
          @foreach ($auctions as $info)

@php

$date = date($auction->endDate);
$time = date(' 23:59:59');
$date_today = $date.''.$time;
@endphp
    
<script type="text/javascript">
var count_id = "<?php echo $date_today ?>";
var countDownDate = new Date(count_id).getTime();
var x = setInterval(function(){
  var now  = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance/(1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24 ))/(1000 * 60 * 60));
  var minutes = Math.floor((distance%(1000 * 60 * 60))/(1000 * 60));
  var seconds = Math.floor((distance%(1000 * 60))/1000);

document.getElementById("end_date").innerHTML = "<b>Remaining Time: </b>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

if(distance < 0){
  clearInterval(x);
  document.getElementById("end_date").innerHTML = "Remaining Time: Bidding ENDED";
}

},1000);
</script>
            <a href="/admin/auction/{{$info->id}}" class="list-group-item list-group-item-action  py-3" aria-current="true">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <img src="/itemImages/{{$info->itemImg}}" width="100px" height="100px" 
                    style="object-fit: cover; border:1px #121212 solid;" 
                    class="rounded-circle" >
                </div>
                <div>
                  <div class="d-flex w-100 align-items-center justify-content-between">
                    <strong class="mb-1">{{$info->prodName}}</strong><br>
                    <small></small>
                  </div>
                  <div class="col-10 mb-1 ">
                    {{$info->cond}}
                  </div>
                  <div class="" style="">
                    <div>
                      Highest Bid: <b>{{$highest_bid}}</b>
                    </div>
                    <div>
                      Buyout Price: <b>{{$info->buyPrice}}</b>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            @endforeach
            @else
            <p class="m-auto"> No Records Found! </p>
          @endif
          </div>
        </div>

<div class="w-100 d-flex"> 
    <div class="item-container" 
        style="display: flex;
                width:100%;
                height:1000px;">
        <div class="my-5"
                style="
                justify-content:center;
                align-items:center;
                margin:auto;
                ">
                <div class="text-center">
                    <img
                    src="/itemImages/{{$auction->itemImg}}"
                    class="card-img-top  mx-auto mb-3" 
                    style="border-radius: 0%;
                            width: 300px;
                            height:300px;
                            border:1px #f0eeee solid;" />
                            
                </div>
                    <h3 class="d-flex justify-content-center pb-2"><b>{{$auction->prodName}}</b></h3> 
                    <h6 class="text-center"><b><p id = "end_date"></p></b></h6>
                    <p class="text-center mx-5">{{$auction->prodDeets}}</p>
                <div class="d-flex pt-3 w-100 justify-content-center                          ">
                    <div class="details mx-3">
                    
                        <div class="item-det ">
                          
                            <h6>Category:<b> {{$auction->category}}</h6>
                            <h6>Initial Price: <b>{{$auction->initialPrice}}</b> PHP</h6>
                            <h6>Buy Price: <b>{{$auction->buyPrice}}</b> PHP</h6>
                            <h6>Auction Ends Date: <b>{{$auction->endDate}}</b></h6>
                        </div>
                    </div>
                    <div>
                        <div class="details mx-3">
                            <div class="item-det">
                                <h6>Type: <b>{{$auction->type}}</b></h6>
                                <h6>Status: <b>ACTIVE</b> </h6>
                                @if($highest_bid === null)
                                  <h6>Highest Bid: </h6>
                                  @else
                                  <h6>Highest Bid: <b>{{$highest_bid}}</b> PHP</h6>
                                @endif
                                
                                @if($max_bidder === null)
                                  <h6>Highest Bidder: 
                                @else
                                  <h6>Highest Bidder: <b>{{$max_bidder->uname}}</b><br>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
              
                  
                
            </div>
        </div>
    </div>                              
</div>

  


{{--     <div class="searchbox  pt-5">
        {!! Form::open(['action'=>'App\Http\Controllers\SearchController@search',
        'method'=>'GET']) !!} 
       
       {{Form::text('search','',['class'=>'form-control','style'=>'border:none; border-radius:0%;  border-bottom:1px #000000 solid;','placeholder'=>'Search'])}}
       {{Form::submit('Search',['class'=>'btn w-50 textalign-center','style'=>'border-radius:0%; color:#ffffff; background:#121212'])}} 
        {!! Form::close() !!} 
     </div> --}}


    @endsection