@extends('layout.app')
@section('content')
@php
use App\Models\Bag;
use App\Models\Biddings;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
@endphp
<div class="bg-white my-5 mx-5 " style=" border-right:1px #dddddd solid; border-top:1px #dddddd solid; border-bottom:1px #dddddd solid;border-left:1px #dddddd solid;">
<a class=" d-flex flex-shrink-0 p-3 link-dark text-decoration-none ">
    <span class="fs-5 fw-bold " style="margin:auto;">Your Bag</span>
  </a>
<div class="d-flex">
    <div class="bg-white mb-5 w-75 " style=" border-top:1px #dddddd solid;">
      @if(count($products)>0)
        @foreach ($products as $item)
      <div class="list-group list-group-flush border-bottom scrollarea ps-3 py-3">
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
            <div class="d-flex w-100">
              <div class="d-flex w-75 align-items-center">
                <ul class="pe-3" style="list-style: none;   margin-bottom:auto;">
                    <li><h5><b>{{$item->prodName}} </b></h5></li>
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
        </div>
      @endforeach
      @else
        <div class="d-flex w-100 h-100 justify-content-center align-items-center">
          <h5><b>Your Bag is Empty.</b> </h5>
        </div>
      @endif
      
    </div>
  <div class="w-50" style="border-left: 1px #dddddd solid; border-top: 1px #dddddd solid;">
    <div class="">
      <h5 class="pt-3 text-center">BAG TOTAL</h5>
      <div class="ms-3 me-3">
        <hr>
        <div class="d-flex w-100 px-1" >
          <div class="w-100" >
            @foreach($products as $item)
              <ul class="" style=" list-style: none; margin-bottom:auto;">
                  <li><h6>{{$item->prodName}}</b></h6></li>
              </ul>
            @endforeach
          </div>
          <div align="right" class="w-50 me-4">
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
        <div align="right" class="w-100 px-3">
          @php
          @endphp
          <label><h5>Sub-Total: <b>{{number_format($sub_total,2)}}</b></h5> </label><br>
          <label>Shipping Fee: <b>{{$del_fee}}</b></label><br>
          <label class="mb-2 " style="font-size: small;"> (J&T Express Delivery)</label> <br>
          <hr>
          <label class= "px-3 pt-2 mb-3" style="border:1px #3eb952 solid; "><h5>Total: <b style="color: #3eb952;">{{number_format($total_amt, 2)}} PHP</b></h5>  </label>
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
</div>
</div>
@endsection