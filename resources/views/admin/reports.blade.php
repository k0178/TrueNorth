@extends('layout.admin')

@section('content')

<div class="bg-white  mx-5 mb-5 " style=" margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold text-center w-100">Reports</span>
    </a>

    <div class="d-flex justify-content-center">
        {{-- <div class="card w-50">
            <div class="card-body">
              @foreach ($hotItem as $item)
                  <img src="/itemImages/{{$item->itemImg}}" style="Size:50%">
              @endforeach
            </div>
        </div> --}}
        

        <div class="card mb-3 mt-3 me-3 w-25" style="max-width: 540px; height:150px;">
            <div class="row g-0">
              <div class="col-md-4">
                @foreach ($hotItem as $item)
                <img src="/itemImages/{{$item->itemImg}}" class="img-fluid rounded-start" >
                </div>
                <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">Most Popular Item</h5>
                <p class="card-text">{{$item->prodName}}</p>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="card mb-3 mt-3 me-3 w-25" style="max-width: 540px; height:150px;">
            <div class="card-body">
              <h5 class="card-title">Requested Funds</h5>
                @php
                    $total=0;
                    $rfnd=0;
                @endphp
              @foreach ($data as $rep)
                 @php
                    $total = $total + $rep->amount
                 @endphp
            @endforeach
            @foreach ($refund as $data)
                @php
                    $rfnd = $rfnd + $data->amount
                @endphp
            @endforeach

              <h6 class="card-subtitle mb-2 text-muted">total: {{$total,2}} PHP </h6>
              <h5 class="card-title mt-3">Refunded</h5>
              <h6 class="card-subtitle mb-2 text-muted">total: {{$rfnd,2}} PHP</h6>
            </div>
          </div>

    </div><hr>
<div class=" text-center pt-5">
    <i class="bi bi-box-seam pe-2" style="font-size: 20px;"></i>
    <b>INVENTORY REPORT</b>  
    {!! Form::open(['action'=>['App\Http\Controllers\reportsController@invreport'],
    'method'=>'GET', 'enctype'=>'multipart/form-data']) !!}
        {{Form::submit('Generate Report',['class'=>'btn btn-dark  mt-3 mb-5','style'=>'border-radius:0%;'])}}
    {!! Form::close() !!}
</div>
<hr>
<div class=" text-center pt-5">
    <i class="bi bi-cash-coin pe-2" style="font-size: 20px;"></i>
    <b>FUND REPORT</b> 
    {!! Form::open(['action'=>['App\Http\Controllers\reportsController@fndreport'],
    'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    
    <div id="datepicker-container">
        <div id="datepicker-center">
            <div id="datepicker" class="my-3 d-flex justify-content-center align-items-center">
                <b>From:</b> {{ Form::date('from', \Carbon\Carbon::now(), ['class' => 'ms-2 w-25 form-control ']) }}
            </div>
        </div>
    </div>
    <div id="datepicker-container">
        <div id="datepicker-center">
            <div id="datepicker" class="mb-4 d-flex justify-content-center align-items-center">
                <b>To:</b> {{ Form::date('to', \Carbon\Carbon::now(), ['class' => 'ms-2 w-25 form-control ']) }}
            </div>
        </div>
    </div>
        {{Form::submit('Generate Report',['class'=>'btn btn-dark  mb-5','style'=>'border-radius:0%;'])}}
    {!! Form::close() !!}
    </div>
    <hr>
    <div class=" text-center pt-5">
        <i class="bi bi-piggy-bank me-2 style="font-size: 20px;"></i>
        <b>REFUND REPORT</b> 
        {!! Form::open(['action'=>['App\Http\Controllers\reportsController@rfdreport'],
        'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        
        <div id="datepicker-container">
            <div id="datepicker-center">
                <div id="datepicker" class="my-3 d-flex justify-content-center align-items-center">
                    <b>From:</b> {{ Form::date('from', \Carbon\Carbon::now(), ['class' => 'ms-2 w-25 form-control ']) }}
                </div>
            </div>
        </div>
        <div id="datepicker-container">
            <div id="datepicker-center">
                <div id="datepicker" class="mb-4 d-flex justify-content-center align-items-center">
                    <b>To:</b> {{ Form::date('to', \Carbon\Carbon::now(), ['class' => 'ms-2 w-25 form-control ']) }}
                </div>
            </div>
        </div>
            {{Form::submit('Generate Report',['class'=>'btn btn-dark  mb-5','style'=>'border-radius:0%;'])}}
        {!! Form::close() !!}
        </div>
</div>

@endsection