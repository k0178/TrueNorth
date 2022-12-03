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
<div class="d-flex justify-content-center">

  <table class="table table-striped">
      <thead>
        <tr class="text-center">
          <th scope="col">Name</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Amount</th>
          <th scope="col">Time of Request</th>
        </tr>
      </thead>
      <tbody>
        @if (count($data)>0)
        @foreach ($data as $rep)
          <tr class="text-center">
              <th scope="row">{{$rep->uname}}</th>
              <td>{{$rep->refnum}}</td>
              <td>{{$rep->amount}}</td>
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
{{-- <div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div> --}}
</div>

@endsection