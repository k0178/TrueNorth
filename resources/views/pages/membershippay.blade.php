@extends('layout.app')
@section('content')
<div class="bg-white my-5 mx-5 " style="border: 1px #dddddd solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none "
    style=" border-bottom:1px #dddddd solid;">
        <span class="fs-5 fw-bold text-center w-100">Membership Payment</span>
    </a>

<?php
    $refnum=Auth::user()->id.date('ymdHis');
?>
          
    {!! Form::open(['action'=>['App\Http\Controllers\fundController@memberPay'],
    'method'=>'POST']) !!} 
    <div class="m-5 ">
      @if(Auth::user()->memberpmt == 'Paid')
        
        <h2 class="text-center"><b>You are already paid.</b> </h2>

        @else
        
        {{Form::submit('PLACE PAYMENT',['class'=>'form-btn mt-3 mb-5'])}}
        {{Form::hidden('refnum',$refnum)}}
        {{Form::hidden('accname',Auth::user()->username)}}
        {!! Form::close() !!}  
        <h3 class="mt-3">Membership Fee: <b>{{number_format(1000,2)}}</b></h3>
        Your Reference number is <b>{{$refnum}}</b> 
        <div class="mt-3  align-items-center">   
            <p><small> Pay thru: </small></p>  
            <i class="bi bi-paypal " style="font-size:40px"></i>
            <br>
            <i class="fa-brands fa-google-pay" style="font-size:70px;"></i>
        </div>
        @endif
    </div>
</div>
@endsection