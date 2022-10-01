@extends('layout.admin')
@section('content') 
@php
    $total = 0;
@endphp

@foreach ($data as $rep)
  @php
      $total = $total + $rep->amount
  @endphp
@endforeach
<div class="mx-3 pt-5">
  <h5>Total: <b> {{$total}} PHP</b></h5>
</div>
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Fund Reports</span>
  </a>
<div class="d-flex justify-content-center">

  <table class="table table-striped">
      <thead>
        <tr class="text-center">
          <th scope="col">Name</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Amount</th>
          <th scope="col">Type</th>
          <th scope="col">Time of Request</th>
        </tr>
      </thead>
      <?php
        $total = 0;
      ?>
      <tbody>
        @if (count($data)>0)
        @foreach ($data as $rep)
          <tr class="text-center">
              <th scope="row">{{$rep->uname}}</th>
              <td>{{$rep->refnum}}</td>
              <td>{{$rep->amount}}</td>
              <td>{{$rep->type}}</td>
              <td>{{\Carbon\Carbon::parse($rep->created_at)->toDayDateTimeString()}}</td>
          </tr>
          @endforeach
        @else
        <tr class="text-center">
          <td colspan="100">      
              <p class="h3">
                No Records Found.
              </p>
          </td>
        </tr>  
        @endif
          
      </tbody>
    </table>
</div>
</div>
@endsection