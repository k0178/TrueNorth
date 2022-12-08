
@extends('layout.admin')
@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')

@php 
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItems;
@endphp

<div class="bg-white mx-3 ">
  <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom " >
    <span class="fs-5 fw-bold text-center w-100">Completed Orders</span>
  </div>
    <table class="table" id="completed">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">User ID</th>
          <th scope="col">Items</th>
          <th scope="col">Delivery Address </th>
          <th scope="col">Total</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Tracking Number</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $info)
            @php
              $orders = Orderitems::select('prod_id')
              ->where('user_id','=',$info->user_id)
              ->where('order_id',$info->id)
              ->get();
            @endphp
          <tr>
            <th scope="row">{{$info->id}}</th> 
            <td>{{$info->user_id}}</td> 
            <td>
              @foreach($orders as $item)
                {{$item->prod_id}}
              @endforeach
            </td>
            <td>{{$info->del_address}}</td>
            <td>{{number_format($info->total,2)}}</td>
            <td>{{$info->refnum}}</td>
            <td>{{$info->tracknum}}</td>
            <td>
              <a href="" class="btn userloggedbtn text-success ">View Feedback/s</a>
            </td>
        @endforeach
        </tr>
      </tbody>
    </table>   
</div>

@endsection
@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#completed').DataTable();
    });

  </script>
  @endsection
