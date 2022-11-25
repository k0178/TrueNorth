@extends('layout.app')
@section('content')
@php
use App\Models\Bag;
use App\Models\Biddings;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


$ref_num = Auth::user()->id.date('ymdHis');
$del_fee = 45;
$total_amt = $total->bidamt + $del_fee ;
@endphp
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
    <div class=" d-flex flex-shrink-0 p-3 link-dark text-decoration-none  ">
        <span class="fs-5 fw-bold " style="margin:auto;">Checkout</span>
    </div>
    <div class="d-flex">
        <div class="bg-white mb-5 w-75" style=" border-top:1px #f0eeee solid;">
            <div class="list-group list-group-flush border-bottom scrollarea ps-3 py-3">
                <div class="d-flex align-items-center">
                    <div class="">
                    <img src="/itemImages/{{$item->itemImg}}" width="100px" height="100px" 
                        style="object-fit: cover; border:1px #121212 solid;" 
                        class="rounded-circle" >
                    </div>
                <input type="hidden" name="product_id" value={{$item->product_id}}>
                <div class="d-flex w-100">
                    <div class="d-flex w-75 align-items-center">
                        <ul class="pe-3" style="list-style: none;   margin-bottom:auto;">
                            <li><h5><b>{{$item->prodName}} </b></h5></li>
                            {{-- @if($price === null) --}}
                            <li><h6>Price:<b> {{number_format($total->bidamt,2)}} PHP </b></h6></li>
                            {{-- @else
                            <li><h6>Buy Price:<b>{{number_format($price->bidamt,2)}} PHP</b></h6></li>
                            @endif --}}
                            
                            <li>Condition: <b>{{$item->cond}}</b></li>
                        </small>
                        </ul>
                    </div>
                </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="w-75" style="border-left: 1px #f0eeee solid; border-top: 1px #f0eeee solid;">
            <div class="">
                <h5 class="pt-3 text-center">ORDER SUMMARY</h5>
                <div class="ms-3 me-3">
                <hr>
                    <ul class="" style=" list-style: none; margin-bottom:auto;">
                        <li><h6>Name: <b>{{Auth::user()->fname.' '. Auth::user()->lname}}</b></h6></li>
                        <li><h6>Delivery Address: <b>{{Auth::user()->address}}</b></h6></li>
                        <li><h6>Estimated Delivery Date: <b>{{ Carbon\Carbon::now()->isoFormat('MMM D, YYYY')}}</b></h6></li>
                        <li><h6>Reference #: <b>{{$ref_num}}</b></h6></li>
                        
                    </ul>
                <hr>
                <div class="d-flex w-100 px-1" >
                    <div class="w-100" >
                        <ul class="" style=" list-style: none; margin-bottom:auto;">
                            <li><h6>{{$item->prodName}}</b></h6></li>
                        </ul>
                    </div>
                    <div align="right" class="w-50 me-4">
                        {{-- @php
                        $price = Biddings::select('bidamt')
                                    ->where('prod_id','=',$item->id)
                                    ->where('user_id', Auth::user()->id)
                                    ->first();
                        @endphp --}}
                        <ul class="" style="list-style: none;   margin-bottom:auto;">
                        <small>
                            {{-- @if($price === null) --}}
                            <li><h6><b>{{number_format($total->bidamt,2)}} PHP </b></h6></li>
                            {{-- @else
                            <li><h6><b>{{number_format($price->bidamt,2)}} PHP</b></h6></li>
                            @endif --}}
                        </small>
                        </ul>
                    </div>
                </div>
                <hr>
                <div align="right" class="w-100 px-3">
                    <label><h5>Sub-Total: <b>{{number_format($total->bidamt,2)}} PHP</b></h5> </label><br>
                    @php
                    @endphp
                    <label>Shipping Fee: <b>{{number_format($del_fee,2)}} PHP</b></label><br>
                    <label class="mb-2 " style="font-size: small;"> (J&T Express Delivery)</label> <br>
                    {{-- {!! Form::text('total_amt', $total_amt, ['id'=>'total_amt']) !!}
                    {!! Form::text('prod_id', $item->id, ['id'=>'prod_id']) !!} --}}
                    <label class= "px-3 py-2" style="border:1px #3eb952 solid; "><h5>Total: <b style="color: #3eb952;">{{number_format($total_amt, 2)}} PHP</b></h5>  </label>
                </div>
                
                </div>
            </div>
            <div class=" mt-5 text-center mb-3 ">
                @if(Auth::user()->funds < $total_amt)  
                    {!! Form::open(['action'=>'App\Http\Controllers\CheckoutController@index','method'=>'GET']) !!}
                        {{Form::submit('PLACE ORDER', ['class'=>'form-btn  mb-1  ','disabled']) }}
                        {!! Form::close() !!}
                    <small class="userloggedbtn ">By Placing Order, you agree to pay the Total amount using your Funds.</small>
                    <br>
                        <label for="">Funds: <b class="text-danger"> {{number_format(Auth::user()->funds,2)}} PHP</b></label>
                    <div class="d-flex  justify-content-center">
                        {{Form::submit('CANCEL', ['class'=>' info-btn  mb-3  ']) }} 
                    </div>
                @elseif(Auth::user()->funds > $total_amt || Auth::user()->funds = $total_amt )
                    {!! Form::open(['action'=>'App\Http\Controllers\CheckoutController@placeSingleOrder','method'=>'POST']) !!}
                    {{Form::hidden('refnum',$ref_num)}}
                    {{Form::hidden('total_amt',$total_amt)}}
                    {{Form::hidden('prod_id',$item->id)}}
                    <div class="">
                        {{Form::submit('PLACE ORDER', ['class'=>' form-btn mb-1 w-25 ']) }}
                        {!! Form::close() !!}
                        <br>
                        <small class="userloggedbtn">By Placing Order, you agree to pay the <b>Total amount</b>  using your <b>Funds</b> .</small>
                        <label for="" class="mt-3">Your Funds after placing this order will be: <br> <b class="text-success"> {{number_format(Auth::user()->funds - $total_amt,2) }} PHP</b></label>
                    </div>
                </div>
            <div class="d-flex  justify-content-center">
                <button class="info-btn mt-3 mb-5 w-25" onclick="location.href='/biddings' " style="border-radius: 0%;">
                    CANCEL
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection