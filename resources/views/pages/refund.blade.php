@extends('layout.app')
@section('content')
@php
    
@endphp
<div class="m-5 py-5 justify-content-center" style="background: #f0eeee;">
    <div class="d-flex ps-5 align-items-center ">
        <h3 class="w-100"><b>REFUND REQUEST</b> </h3>
    </div>
    <div class="justify-content-center align-items-center w-75">
        <div class="px-5 my-5">
            <h4><i class="bi bi-exclamation-octagon me-2 text-danger"></i>YOU ARE ABOUT TO REQUEST A REFUND</h4>
            <p class="mt-2">Before you can request for a GCash fund refund, you must be eligible.</p>
            <p>To be eligible:
                <li class="text-danger">
                   Your Account must have atleast PHP 500.00 in funds.
                </li>
                <li class="text-danger">
                    You are not currently participating in any bidding at the moment.
                </li>
                <li class="text-danger">
                    You currently have no items in your bag.
                </li>
          </p>

          <div class="mt-3 mb-3">
            {!! Form::open(['action'=>'App\Http\Controllers\RefundController@store',
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

            {{Form::number('gcashnum','',
            ['class'=>'form-control w-50',
            'placeholder'=>'Enter your Gcash Number'])}}
            @if (Auth::user()->user_status==3)
            {{Form::submit('Your Account is Frozen',['class'=>'btn btn-dark mt-3 disabled','style'=>'border-radius:0%;'])}}
            @else
            {{Form::submit('REQUEST REFUND',['class'=>'btn btn-dark mt-3','style'=>'border-radius:0%;'])}}
            @endif
       

            {!! Form::close() !!}
          </div>
          
          <small class="font-italic secondary">
            ** Note: Please make sure the number provided is a Verified User of Gcash. While we are processing your refund request, your account will be frozen; meaning that features will be unaccesible for you whilst undergoing the refund process. 
          </small>
        </div>
    </div>
</div>
@endsection