@extends('layout.app')
<title>True North Auction | {{$item->prodName}}</title>
    @section('content')

@php
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
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

document.getElementById("end_date").innerHTML = "<h5 class='text-center mt-3 px-4 py-2' style ='border: 2px #000000 solid; '>Remaining Time: <br> <b style='font-size: 22px; color: #E7BB41;'>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s </b></h5>";

if(distance < 0){
    clearInterval(x);
    document.getElementById("end_date").innerHTML = "Auction Status: <b class=text-danger> Bidding ENDED</b>";
}
},1000);
</script>


    <div class=" my-5">
        <div class="bidding-container p-5  justify-content-center ">
            <section id="portfolio" class="portfolio">
                <div class="container mt-5">
                    <div class="row portfolio-container align-items-center justify-content-center">
                        <div class="col-lg-5 col-md-6 portfolio-item filter-app me-3 text-center">
                            <div id="prodimg" style="height:550px; width:430px; overflow:hidden;"  class="border">
                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                        <div class="carousel-item active" data-bs-interval="5000" >
                                            <img id="prod" class="border" src="/itemImages/{{$item->itemImg}}" style="transform-origin:center; object-fit:cover; height:100%; width:100%;">
                                        </div>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="5000" >
                                        <img src="/itemImages/{{$item->itemImg2}}" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="5000" >
                                        <img src="/itemImages/{{$item->itemImg3}}" class="d-block w-100" alt="...">
                                    </div>
                                
                            <script>
                                    const container = document.getElementById("prodimg");
                                    const img = document.getElementById("prod");

                                    container.addEventListener("mousemove",(e)=>{
                                        const x = e.clientX- e.target.offsetLeft;
                                        const y = e.clientY - e.target.offsetTop;
                                        
                                        img.style.transformOrigin = `${x}px ${y}px`;
                                        img.style.transform = "scale(2)";
                                    })

                                    container.addEventListener("mouseleave",()=>{
                                        img.style.transformOrigin = "center";
                                        img.style.transform = "scale(1)";

                                    })
                                </script>
                                        
                                </div>
                            </div>
                            <div class="">
                                <button data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active  " aria-current="true" aria-label="Slide 1"></button>
                                <button  data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" ></button>
                                <button  data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" ></button>
                            </div>
                            <label for="" class="mt-2" style="font-size: 11px;"><i class="bi bi-info-circle-fill"></i> Hover to zoom the item.</label>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">  
                            <div class="d-flex align-items-center">
                                    <h2 class="me-2"><b>{{$item->prodName}}</b></h2>
                                    <span class="badge" style="background-color:#E7BB41;">{{$item->cond}}</span>
                            </div>
                            Starting Bid: <h4 class="mb-3"> <b>{{number_format($item->initialPrice,2)}} PHP</b></h4>
                            <hr>
                            Category: <h5 class="mb-3"> 
                                <b>
                                    @if($item->category == 'M')
                                        Men
                                    @elseif($item->category == 'W')
                                        Women
                                    @else
                                        Assorted
                                    @endif
                                </b>
                            </h5>
                            Type: <h5 class="mb-3">
                                    <b>
                                        @if($item->type == 'T')
                                            Tops
                                        @elseif($item->type == 'P')
                                            Pants
                                        @elseif($item->type == 'S')
                                            Shorts
                                        @else
                                            
                                        @endif
                                    </b>
                                </h5>
                                
                            @if($item->cond == 'Bulk')
                                Weight: <h5 class="mb-3"><b>{{number_format($item->weight,2)}} KG</b></h5>
                            @else
                                
                            @endif
                            
                                
                            <p>
                                <button class="form-btn w-100 mb-3" style="background: #D3D0CB;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    SHOW DETAILS
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    {{$item->prodDeets}}
                                </div>
                            </div>
                            <hr>
                            {{-- <small class=""><p  style="width:500px; max-width:100%;">{{$item->prodDeets}}</p></small> --}}
                            @if(empty($orderstat))
                                Auction Ends on: <h5><b> {{ Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></h5>
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
                                </div>
                                            @if(Auth::user()->user_status == 0)
                                                
                                            @else
                                                <div class="my-3 ">
                                                    @if(Carbon::parse($item->endDate) < Carbon::now())

                                                    @else
                                                        <div class=" mb-3">
                                                            Current Bidder/s:<h4>  <b>{{$datacount}}</b></h4>
                                                            As of {{\Carbon\Carbon::now()->toDayDateTimeString()}}
                                                        </div>
                                                    @endif
                                                    {{-- <div class=" ">
                                                            @php
                                                                $total_bid = Biddings::where('prod_id',$item->id)
                                                                                    ->where('retractstat',0)
                                                                                    ->sum('bidamt');
                                                            @endphp
                                                            @if($total_bid == 0)
                                                                
                                                            @else
                                                            <label for="">Total Current Biddings:</label><h4><b class="text-success">{{number_format($total_bid, 2)}} PHP</b></h4> 
                                                            @endif
                                                            
                                                    </div> --}}
                                                </div>
                                                @if($bid_data === null || $bid_status = 0)
                                                    @if(empty($pfp))
                                                        <h5><b>No Bidders yet.</b></h5>
                                                    @else
                                                        <h5>Highest Bidder: <img src="/userPFP/{{$pfp->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-2" ><b>{{$max_bidder->uname}}</b></h5>
                                                    @endif
                                                    {!! Form::open(['action'=>'App\Http\Controllers\BiddingController@store','method'=>'POST',$item->id]) !!}
                                                        {{Form::hidden('id',$item->id)}}
                                                        {!! Form::number('bid_amt', '', ['class'=>'form-control me-5 mt-3','step'=>'0.01','style'=>'border-radius:0%;','placeholder'=>'Enter '.number_format($item->initialPrice + 0.01,2) .' PHP or more.','required']) !!}
                                                        
                                                    <!-- Button trigger modal -->
                                                    @if (Auth::User()->user_status==3)
                                                    <button type="button" class="form-btn mt-3 w-100  mb-2" style="border-radius:0%;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" disabled>
                                                        YOUR ACCOUNT IS FROZEN
                                                    </button>
                                                    @else
                                                    <button type="button" class="form-btn mt-3 w-100  mb-2" style="border-radius:0%;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        PLACE BID
                                                    </button>
                                                    @endif
                                            
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Bid Agreement</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            If you won an auction, you must place an order for the item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                                                            You can also be <b class="text-danger">BLOCKED</b> by the Administrator from bidding on other auctions.
                                                            <br>
                                                            <br>
                                                            <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                                                        </div>
                                                        
                                                        
                                                        <div class="modal-footer justify-content-center  align-items-center">
                                                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                                                            {{-- {{Form::submit('CANCEL', ['class'=>' btn btn-secondary mt-3 w-25 mb-2','style'=>'border-radius:0%;','data-bs-dismiss'=>'modal']) }} --}}
                                                            {{Form::submit('CONFIRM BID', ['class'=>'form-btn mb-2']) }}
                                                            {{Form::hidden('id',$item->id)}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <button type="button" class="info-btn w-100 mt-2 " data-bs-toggle="modal" data-bs-target="#incTbl">
                                                            SHOW BID INCREMENT TABLE
                                                        </button> --}}
                                                        <div class="modal fade" id="incTbl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Bid Increment Table</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">Bid Price</th>
                                                                                    <th scope="col">Bid Increment</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>0.00 PHP - 500.00 PHP</td>
                                                                                    <td class="text-success">100.00 PHP</td>
                                                                                </tr> 
                                                                                <tr>
                                                                                    <td>500.01 PHP - 1500.00 PHP</td>
                                                                                    <td class="text-success">150.00 PHP</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>1500.01 PHP - 3000.00 PHP</td>
                                                                                    <td class="text-success">300.00 PHP</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>3000.01 PHP - 4500.00 PHP</td>
                                                                                    <td class="text-success">300.00 PHP</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>4500.01 PHP - 5000.00 PHP</td>
                                                                                    <td class="text-success">300.00 PHP</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>5000.01 PHP - 10000.00 PHP</td>
                                                                                    <td class="text-success">500.00 PHP</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>10000.01 PHP +</td>
                                                                                    <td class="text-success">1000.00 PHP</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center  align-items-center">
                                                                        <button type="button" class="info-btn" data-bs-dismiss="modal">GOT IT</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            {!! Form::close() !!}
                                                @else
                                                {{-- <h4 class="">Your Current Bid:<b class="text-success"> {{number_format($bid_data->bidamt,2)}} PHP</b></h4>
                                                    <div class="mt-3 ">
                                                        {{$item->endDate}}
                                                        @if($item->endDate < Carbon::now()->format('Y-m-d'))

                                                        @else
                                                            <div class=" mb-3">
                                                                Current Bidder/s:<h4>  <b>{{$datacount}}</b></h4>
                                                                As of {{\Carbon\Carbon::now()->toDayDateTimeString()}}
                                                            </div>
                                                        @endif
                                                        <div class=" ">
                                                                @php
                                                                    $total_bid = Biddings::where('prod_id',$item->id)
                                                                                        ->where('retractstat',0)
                                                                                        ->sum('bidamt');
                                                                @endphp
                                                                <label for="">Total Current Biddings:</label><h4><b class="text-success">{{number_format($total_bid, 2)}} PHP</b></h4> 
                                                        </div>
                                                    </div> --}}
                                                    <div align="center" class="mt-3">
                                                        <div class="">
                                                            <button class="form-btn mb-3" onclick="location.href='/biddings'" style="background: #D3D0CB; border-radius: 0%;"><i class="bi bi-cash-coin me-2 text-dark"></i> VIEW YOUR BIDDINGS</button>
                                                            <br>
                                                            <button class="form-btn" onclick="location.href='/store'" style="border-radius: 0%; background: #D3D0CB;"> BACK TO STORE</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div align="center" class="mt-3">
                                        <div class="">
                                            <button class="form-btn mb-3" onclick="location.href='/biddings'" style="background: #D3D0CB; border-radius: 0%;"><i class="bi bi-cash-coin me-2 text-dark"></i> VIEW YOUR BIDDINGS</button>
                                            <br>
                                            <button class="form-btn" onclick="location.href='/store'" style="border-radius: 0%; background: #D3D0CB;"> BACK TO STORE</button>
                                        </div>
                                    </div> --}}
                    @else
                        <div class="mt-3">
                            Current Bidder/s:<h4>  <b>{{$datacount}}</b></h4>
                            <h6 class="mb-3">As of {{\Carbon\Carbon::now()->toDayDateTimeString()}}</h6>
                            <button class="form-btn mt-3 w-100" onclick="location.href='/login' " style="border-radius: 0%;">
                                LOGIN TO BID
                            </button>
                        </div>
                    @endif
                    </div>
                </section>
    </div>
</div>
@endsection
