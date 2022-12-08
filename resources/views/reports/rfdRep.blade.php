@extends('layout.admin')
@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content') 
@php
    $total = 0;
@endphp

@foreach ($data as $rep)
  @php
      $total = $total + $rep->amount
  @endphp
@endforeach

<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Withdraw Reports</span>
  </a>

  <table class="table" id="refunds">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Gcash Number</th>
          <th scope="col">Amount</th>
          <th scope="col">Time of Request</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $rep)
          <tr>
              <td>{{$rep->uname}}</td>
              <td>{{$rep->gcashnum}}</td>
              <td>{{number_format($rep->amount,2)}} PHP</td>
              <td>{{\Carbon\Carbon::parse($rep->created_at)->toDayDateTimeString()}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>

<div class="d-flex justify-content-center pt-3 pb-3 ">
    <h5>Total: <b> {{number_format($total,2)}} PHP</b></h5>
</div>
</div>
@endsection

@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#refunds').DataTable();
    });

  </script>
  @endsection