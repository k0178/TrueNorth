
@extends('layout.admin')
@section('content')

@php 
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItems;
@endphp

<div class="bg-white mx-3 " style="margin-top:15%;  border-top:1px #dddddd solid; ">
  <a href="" style="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none " style="border-bottom:1px #dddddd solid;">
    <span class="fs-5 fw-bold text-center w-100">To Ship</span>
  </a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">User ID</th>
          <th scope="col">Items</th>
          <th scope="col">Delivery Address </th>
          <th scope="col">Zip Code </th>
          <th scope="col">Total</th>
          <th scope="col">Reference Number</th>
          <th scope="col">Delivery Date</th>
          <th scope="col">Order Date</th>
          <th scope="col">Status</th>
          <th scope="col">Tracking Number</th>
        </tr>
      </thead>
      <tbody>
        @if(count($data) > 0)
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
            <td>{{$info->zipcode}}</td>
            <td>{{number_format($info->total,2)}}</td>
            <td>{{$info->refnum}}</td>
            <td>{{\Carbon\Carbon::parse($info->del_date)->isoFormat('MMM D, YYYY')}}</td>
            <td>{{\Carbon\Carbon::parse($info->created_at)->isoFormat('MMM D, YYYY')}}</td>
            @if($info->del_stat == "Pending")
              <td class="text-warning">{{$info->del_stat}}</td>
            @endif
            
            <td>{{$info->tracknum}}</td>
            {{-- <td>
              <a href="/feedback/" class="btn userloggedbtn text-success ">Add Feedback</a>
            </td> --}}
            <td>
              <a href="https://www.jtexpress.ph/index/query/gzquery.html" class="btn userloggedbtn text-success " > Track Order</a>
            </td>
        @endforeach
        @else
          <td colspan="8" class="text-center"> 
            <h5><b>You have no orders yet.</b> </h5>
          </td>
        @endif
        </tr>
      </tbody>
    </table>   
</div>
@endsection
