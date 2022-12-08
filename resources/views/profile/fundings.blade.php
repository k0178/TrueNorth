@extends('layout.app')

@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

@section('content')

<div class="bg-white my-5 mx-5 " style="border: 1px #dddddd solid;">
    <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none "
    style=" border-bottom:1px #dddddd solid;">
      <span class="fs-5 fw-bold text-center w-100">My Funds</span>
    </div>
<?php
    $refnum=Auth::user()->id.date('ymdHis');
?>
        
<div class="d-flex">
  <div class=" px-3 pt-3 pt-5 pb-5  w-50 list-group list-group-flush scrollarea"
        style=" border-right:1px #dddddd solid;">
    {!! Form::open(['action'=>['App\Http\Controllers\PaymentController@fndPay'],
    'method'=>'POST']) !!} 
    <div class="text-center mb-3">
      @if(Auth::user()->user_status == 0)
        {{Form::number('reqAmt','',['class'=>'form-control','step'=>'0.01', 'placeholder'=>'Enter Amount','disabled'])}}  
        {{Form::submit('ADD FUNDS',['class'=>'form-btn mt-3 mb-5 w-100 ','disabled'])}}
        {{Form::hidden('refnum',$refnum)}}
        {{Form::hidden('accname',Auth::user()->username)}}
        {!! Form::close() !!}  

        @elseif(Auth::user()->user_status == 1)
          @if(Auth::user()->memberpmt == 'Unpaid' )
          <b>Fund Request is only available to paid members.</b>
          <br>
          <b><a href="/membershippay">Click here to pay membership.</a></b>
       
          @elseif(Auth::user()->memberpmt == 'Pending')
            <b>Membership Payment approval is pending.</b>
          @else
              {{Form::number('reqAmt','',['class'=>'form-control','step'=>'0.01', 'placeholder'=>'Enter Amount','required'])}}  
              {{Form::submit('ADD FUNDS',['class'=>'form-btn mt-3 mb-5 w-100 '])}}
              {{Form::hidden('refnum',$refnum)}}
              {{Form::hidden('accname',Auth::user()->username)}}
              {!! Form::close() !!}  
          @endif
        
      @endif
    </div>
  
    <div class="mt-3 text-center"> 
      <h3>Your current funds: <b>{{number_format(Auth::user()->funds,2)}} PHP</b></h3>
      Your Reference number is <b>{{$refnum}}</b>   
      <p class="mt-5"><small >Want to add funds? Pay thru: </small></p>  
      <i class="bi bi-paypal" style="font-size: 45px;"></i><b>PAYPAL</b> 
      <p  class="mx-5" style="font-size: 11px; color:#989795;"><i class="bi bi-info-circle-fill me-1" style="color: #989795;"></i>PayPal is an online payment system that makes paying for things online and sending and receiving money safe and secure. </p>
      
  </div>
</div>


  <div class="w-100 mx-3">
    <h4 class="mt-3 text-center">Fund Request History</h4>
<hr>
      <table class="display" id="funds">
        <thead>
          <tr>
            <th>Amount</th>
            <th>Type</th>
            <th>Status</th>
            <th>Payment ID</th>
            <th>Date Requested</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
              <tr>
                <td>{{number_format($item->amount,2)}} PHP</td>
                <td>{{$item->type}}</td>
                <td class="text-success d-flex"><i class="bi bi-check-circle-fill me-1 text-success"></i>{{$item->status}}</td>
                <td>{{$item->refnum}}</td>
                <td>{{$item->created_at}}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#funds').DataTable();
    });

  </script>
  @endsection