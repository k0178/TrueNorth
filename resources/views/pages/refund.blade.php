@extends('layout.app')
@section('content')
@php
    
@endphp
<div class="w-100 justify-content-center d-flex">
    <div class="m-5 w-75 py-5 justify-content-center" style="background: #f0eeee;">
        <div class="d-flex ps-5 align-items-center ">
            <h3 class="w-100"><b>REFUND REQUEST</b> </h3>
            
        </div>
        
        <div>
            <div class="px-5 my-5">
                <hr>
                <h4 class="pt-3"><b><i class="bi bi-exclamation-octagon me-2 fw-bold text-danger"></i>YOU ARE ABOUT TO REQUEST A REFUND</b></h4>
                <p class="mt-2">Before you can request for a GCash fund refund, you must be eligible.</p>
                To be eligible:
                <ul>
                    <li class="text-danger">Your Account must have atleast PHP 500.00 in funds.</li>
                    <li class="text-danger"> You are not currently participating in any bidding at the moment.</li>
                    <li class="text-danger">You currently have no items in your bag.</li>
                </ul>
                <div align="center" class="w-100">
                    <div class="mt-3 mb-3">
                        <div class="col-lg-6 col-md-8"> 
                            {!! Form::open(['action'=>'App\Http\Controllers\RefundController@store',
                            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            {{Form::number('gcashnum','',
                            ['class'=>'form-control  w-100 ',
                            'placeholder'=>'Enter your Gcash Number','required'])}}
                            @if (Auth::user()->user_status==3)
                                {{Form::submit('Your Account is Frozen',['class'=>'form-btn mt-3 disabled'])}}
                            @else
                                {{Form::submit('REQUEST REFUND',['class'=>'form-btn mt-3 w-100'])}}
                            @endif
                            {!! Form::close() !!}
                        </div>
                
                    </div>
                    <p style="font-size: 14px;"><i class="bi bi-info-circle-fill"></i> Please make sure the number provided is preferably a <b class="text-success">Verified User</b> of Gcash. While we are processing your refund request, your account will be <b class="text-danger">frozen</b> ; meaning that features will be unaccesible for you whilst undergoing the refund process. </p> 
                <a href="/termsandcondition" class="" style="font-size: 12px;">View Terms & Condition</a>
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection