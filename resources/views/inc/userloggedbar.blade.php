
<?php
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BagController;
use App\Models\Bag;
use App\Models\Biddings;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

$username = Auth::user()->username;
$bag_qty = BagController::bag_qty();

$data = User::where('username',$username)->first();
?>

{{--<div class="userloggedbar d-flex  align-items-center  justify-content-end py-2 px-4" style="background: #f0eeee;">
    <div class="userloggedbar-content d-flex align-items-center">
        <a href="/messages/{{$username}}" class="userloggedbtn btn " style="font-size: medium;">
            <label style="font-size: 12px; " class="text-danger"></label>
            <i class="bi bi-envelope-exclamation pe-3 "></i>
        </a>
        <a href="/fundings" class="userloggedbtn btn align-items-center" style="font-size: medium;">
            <label style="font-size: 12px;">( {{number_format(Auth::user()->funds,2)}} PHP )</label>
            <i class="bi bi-wallet2 pe-3"></i>
        </a>
        <a href="/bag/{{$username}}" class="userloggedbtn btn" style="font-size: medium;">
            <label style="font-size: 12px;">( {{$bag_qty}} )</label>
            <i class="bi bi-bag pe-3"></i>
        </a>
        <div class="dropdown" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
            <img src="/userPFP/{{$data->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-1" >
            <a href="/profile" class="userloggedbtn"><b>{{$username}}</b></a> 
        </div>
        <div class="dropdown-menu dropdown-menu-right my-1" style="border-radius: 0%; border:1px #f0eeee solid;  background-color:#ffffff;">
            <div class="dropdown-item">
                <a class="userloggedbtn" href="/profile">Profile</a>
            </div>
            <div class="dropdown-item">
                <a class="btn userloggedbtn" id="open">Logout</a>
            </div>
        </div>
            
            <div class="mdl_container" id="mdl_container">
                <div class="mdl">
                <h5>ARE YOU SURE YOU WANT TO LOGOUT?</h5>
                <a class="btn userloggedbtn text-danger" href="/logout" id="logout">OK</a>
                <br>
                <a class="btn userloggedbtn" id="close">CANCEL</a>
                </div>
            </div> 
        </div>
    </div>


 --}}

<nav class="navbar " style="background: #D3D0CB;" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <div class="d-flex align-items-center">
            <div class="position-relative mx-3">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                        {{$bag_qty}}
                    </span>
                    <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#bag" aria-controls="bag">
                        {{-- <span class="bi bi-three-dots-vertical"></span> --}}
                        
                        <i class="bi bi-bag " style="font-size: 16px; font-weight:bold;"></i>
                    </button> 
            </div> 
            <button class="btn" style="text-decoration: none;"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight">
                {{-- <span class="bi bi-three-dots-vertical"></span> --}}
                
                <img src="/userPFP/{{Auth::user()->profileImage}}" width="35px" height="35px" style="object-fit: cover;" class="rounded-circle me-1" >
                <label for="" class="fw-bold" style="font-size: 14px;">{{strtoupper(Auth::user()->username)}}</label>
            </button> 
            
            {{-- <a href="" class="mx-3" style="color: black; font-size:16px;"><i class="bi bi-bag"></i></a>       --}}
        </div>

        @if($bag_qty == 0)
            <div class="offcanvas offcanvas-end w-25" tabindex="-1" id="bag" aria-labelledby="offcanvasNavbarLightLabel">
        @else
            <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="bag" aria-labelledby="offcanvasNavbarLightLabel">
        @endif
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="bag">
                    <i class="bi bi-bag" style="font-size: 18px;"></i>
                    <b> BAG |
                    <img src="/userPFP/{{Auth::user()->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle ms-1" >
                    <label for="" style="font-size: 18px;">{{Auth::user()->username}}</label>
                </h5></b>  
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                
            </div>
            <div class="offcanvas-body">
                <hr>
                    <div class="d-flex border-bottom justify-content-center ">
                        
                            @php
                                $products = Auction::join('bag','auctions.id','=','bag.product_id')
                                            ->where('bag.user_id','=',Auth::user()->id)
                                            ->get();
    
                            @endphp
                            @if(count($products)>0)
                            <div class="">
                            @foreach ($products as $item)
                            
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <a href="/item/{{$item->product_id}}">
                                            <img src="/itemImages/{{$item->itemImg}}" width="100px" height="100px" 
                                            style="object-fit: cover; border:1px #121212 solid;" 
                                            class="rounded-circle" >
                                    </a>
                                    </div>
                            {{-- @php
                                $price = Biddings::select('bidtransactions.bidamt')
                                            ->join('bag','bag.product_id','=','bidtransactions.prod_id')
                                            ->where('bidtransactions.bagstatus',1)
                                            ->where('bidtransactions.prod_id','=',$item->product_id)
                                            ->where('bidtransactions.user_id', Auth::user()->id)
                                            ->first();
                                // $total = Bag::join('bidtransactions','bag.product_id','=','bidtransactions.prod_id')
                                // ->where('bag.user_id', Auth::user()->id)
                                // ->where('bidtransactions.bagstatus', 1)
                                // ->sum('bidtransactions.bidamt');
                    
                                // $total_sgl =  Bag::join('auctions','bag.product_id','=','auctions.id')
                                // ->where('bag.user_id', Auth::user()->id)
                                // ->sum('auctions.buyPrice');
                    
                            @endphp --}}
                                <input type="hidden" name="product_id" value={{$item->product_id}}>
                                <div class="d-flex ">
                                    <div class="d-flex  align-items-center">
                                    <ul class="pe-3" style="list-style: none;   margin-bottom:auto;">
                                        <li><h6><b>{{$item->prodName}} </b></h6></li>
                                        @php
                                        $price = Biddings::select('bidtransactions.bidamt')
                                                    ->join('bag','bag.product_id','=','bidtransactions.prod_id')
                                                    ->where('bidtransactions.bagstatus',1)
                                                    ->where('bidtransactions.prod_id','=',$item->product_id)
                                                    ->where('bidtransactions.user_id', Auth::user()->id)
                                                    ->first();
                                        @endphp
                                        @if($price === null)
                                        <li><h6>Buy Price: <b>{{number_format($item->buyPrice,2)}} </b></h6></li>
                                        @else
                                        <li><h6>Bid Placed: <b>{{number_format($price->bidamt,2)}} </b></h6></li>
                                        @endif
                                        <li>Condition: <b>{{$item->cond}}</b></li>
                                        </small>
                                    </ul>
                                    </div>
                                    <div class="w-50 justify-content-center align-items-center d-flex">
                                    {!! Form::open(['action'=>['App\Http\Controllers\BagController@destroy',$item->product_id],
                                    'method'=>'DELETE'])!!}
                                        <button class='btn userloggedbtn ms-3' style="font-size: 20px;">
                                            <i class="bi bi-bag-x text-danger"></i>
                                        </button>
                                    {!! Form::close() !!}
                                    </div>
                                </div>
                                <br>
                                </div>
                                <hr class="me-3">
                            @endforeach
                        </div>
                            <div class="w-50" style="border-left: 1px #dddddd solid;">
                                <div class="">
                                <h5 class="pt-3 text-center">BAG TOTAL</h5>
                                <div class="ms-3 me-3">
                                    <hr>
                                    <div class="d-flex " >
                                    <div class="" >
                                        @foreach($products as $item)
                                        <ul class="" style=" list-style: none; margin-bottom:auto;">
                                            <li><h6>{{$item->prodName}}</b></h6></li>
                                        </ul>
                                        @endforeach
                                    </div>
                                    <div align="right" class="">
                                        @php
                                        // $total_bids = Bag::join('bidtransactions','bag.product_id','=','bidtransactions.prod_id')
                                        // ->where('bidtransactions.user_id', Auth::user()->id)
                                        // ->where('bidtransactions.bagstatus', 1)
                                        // ->where('bidtransactions.winstatus', 'Won')
                                        // ->where('bidtransactions.prod_id','=',$item->product_id)
                                        // ->sum('bidtransactions.bidamt');
                            
                                        // $total_bids = Biddings::where('user_id', Auth::user()->id)
                                        //                       ->where('bagstatus',1)
                                                            
                                        //                       ->sum('bidamt');
                            
                                        $total_bids = 0;
                                        $total_buy =  0;
                                        $del_fee =  number_format(45, 2);
                                        @endphp
                                        @foreach($products as $item)
                                        @php
                                        $price = Biddings::select('bidtransactions.bidamt')
                                                    ->join('bag','bag.product_id','=','bidtransactions.prod_id')
                                                    ->where('bidtransactions.bagstatus',1)
                                                    ->where('bidtransactions.prod_id','=',$item->product_id)
                                                    ->where('bidtransactions.user_id', Auth::user()->id)
                                                    ->first();
                                        @endphp
                                        <ul class="" style="list-style: none;   margin-bottom:auto;">
                                            <small>
                                            @if($price === null)
                                            <li><h6><b>{{number_format($item->buyPrice,2)}} </b></h6></li>
                                            @php
                                                $total_buy += $item->buyPrice;
                                            @endphp
                                            @else
                                            @php
                                                $total_bids += $price->bidamt;
                                            @endphp
                                            <li><h6><b>{{number_format($price->bidamt,2)}} </b></h6></li>
                                            @endif
                                            </small>
                                        </ul>
                                        @endforeach
                                        @php
                                            $sub_total = $total_bids + $total_buy;
                                            $total_amt = $sub_total + $del_fee ;
                                        @endphp
                                    </div>
                                    </div>
                                    <hr>
                                    <div align="right" class="">
                                    @php
                                    @endphp
                                    <label><h5>Sub-Total: <b>{{number_format($sub_total,2)}}</b></h5> </label><br>
                                    <label>Shipping Fee: <b>{{$del_fee}}</b></label><br>
                                    <label class="mb-2 " style="font-size: small;"> (J&T Express Delivery)</label> <br>
                                    <hr>
                                    <label class= "p-2" style="border:1px #3eb952 solid; "><h5>Total: <b style="color: #3eb952;">{{number_format($total_amt, 2)}} PHP</b></h5>  </label>
                                    </div>
                                    
                                </div>
                                </div>
                            @if(count($products)>0)
                                <div class="d-flex mt-5 justify-content-center">
                                {!! Form::open(['action'=>'App\Http\Controllers\CheckoutController@index','method'=>'GET']) !!}
                                    {{Form::submit('CHECKOUT', ['class'=>' btn btn-dark  mb-3  ','style'=>'border-radius:0%;']) }}
                                {!! Form::close() !!}
                                </div>
                                @else
                        
                            @endif
                            
                            </div>
                            
                            @else
                            <div class=" w-100 mb-3  justify-content-center align-items-center">
                                <h5><b>Your Bag is empty.</b> </h5>
                                <a href="/biddings"> View Biddings</a>
                            </div>
                            @endif
                        
                        
                    </div>
                    
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">
                    TRUE NORTH GARMENTS | 
                    <img src="/userPFP/{{Auth::user()->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle ms-1" >
                    <label for="" style="font-size: 18px;">{{Auth::user()->username}}</label>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                
            </div>

            <div class="offcanvas-body">
                <hr>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">
                            <i class="bi bi-person me-2"></i>PROFILE
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/biddings"><i class="bi bi-cash-coin me-2"></i>BIDDINGS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bidhistory">
                            <i class="bi bi-clock-history me-2"></i>BID HISTORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fundings"><i class="bi bi-wallet2 me-2"></i>FUNDINGS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/orders"><i class="bi bi-basket3 me-2"></i>MY ORDERS</a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        {{-- <a class="btn btn-dark w-100" href="/logout"><i class="bi bi-box-arrow-left me-2"></i>LOGOUT</a> --}}
                    <button type="button" class="btn btn-dark w-100" style="border-radius: 0%;" onclick="location.href='/logout'"><i class="bi bi-box-arrow-left me-2 text-white"></i>LOGOUT</button>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</nav>