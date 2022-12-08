
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
  <a href="" style="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom" >
    <span class="fs-5 fw-bold text-center w-100">Shipped</span>
  </a>
    <table class="table" id="shipped">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">User ID</th>
          <th scope="col">Items</th>
          <th scope="col">Delivery Address </th>
          <th scope="col">Total</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Status</th>
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
            <td>{{$info->id}}</td> 
            <td>{{$info->user_id}}</td> 
            <td>
              @foreach($orders as $item)
                {{$item->prod_id}}
              @endforeach
            </td>
            <td>{{$info->del_address}}</td>
            <td>{{number_format($info->total,2)}} PHP</td>
            <td>{{$info->refnum}}</td>
            <td class="text-success">{{$info->del_stat}}</td>
            <td>{{$info->tracknum}}</td>
            {{-- <td>
              <a href="/feedback/" class="btn userloggedbtn text-success ">Add Feedback</a>
            </td> --}}
            {!! Form::open(['action'=>['App\Http\Controllers\ShippedController@update',$info->id],
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            {{-- <td>
              <a href="/feedback/" class="btn userloggedbtn text-success ">Add Feedback</a>
            </td> --}}
            {{-- <td>
              {{Form::hidden('id',$info->id)}}
              {{Form::hidden('_method','PUT')}}
              {{Form::submit('Mark as Delivered',['class'=>'btn userloggedbtn text-success ','style'=>'border-radius:0%;'])}}
              {!! Form::close() !!} --}}
              {{-- <a href="https://www.jtexpress.ph/index/query/gzquery.html" class="btn userloggedbtn text-success " > Track Order</a> --}}
            {{-- </td> --}}
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
      $('#shipped').DataTable();
    });

  </script>
  @endsection
