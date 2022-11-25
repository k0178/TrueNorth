@extends('layout.app')
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
    {!! Form::open(['action'=>['App\Http\Controllers\fundController@fundReq'],
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
    <div align="right" class="my-3 d-flex align-items-center">
      <i class="bi bi-search me-3"></i>
      <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Reference Number or Date (yyyy-mm-dd)">
      <div class="d-flex align-items-center">
          Showing
          <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
          </div>
    </div>
<hr>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Amount</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Reference #</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
        fetch_fund_data();

        function fetch_fund_data(query = ''){
            // console.log('load data = ' + query);
            
            $.ajax({
                url:"{{ route('frmsearch')}}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                    $('tbody').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            })
        }

        $(document).on('keyup','#form-search',function(){
            var query  = $(this).val();
            fetch_fund_data(query);
        })
    })
  </script>
@endsection