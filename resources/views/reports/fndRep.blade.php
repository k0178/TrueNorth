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
<div class="d-flex py-3 mt-5 ms-5 ">
  <h5>Total: <b> {{number_format($total,2)}} PHP</b></h5>
</div>
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Fund Reports</span>
  </a>
  {{-- <div align="right" class="my-3 mx-3 d-flex align-items-center">
    <i class="bi bi-search me-3"></i>
    <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Username, Reference Number, or Time of Request">
    <div class="d-flex align-items-center">
        Showing
        <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
        </div>
  </div> --}}


  <table class="table" id="fundrep">
      <thead>
        <tr class="text-center">
          <th scope="col">Name</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Amount</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col">Time of Request</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $rep)
          <tr>
              <td>{{$rep->uname}}</td>
              <td>{{$rep->refnum}}</td>
              <td>{{number_format($rep->amount,2)}} PHP</td>
              <td>{{$rep->type}}</td>
              <td class="text-success">{{$rep->status}}</td>
              <td>{{\Carbon\Carbon::parse($rep->created_at)->toDayDateTimeString()}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
   

{{-- <div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div> --}}
</div>

@endsection
@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#fundrep').DataTable();
    });

  </script>
  @endsection