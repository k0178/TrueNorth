
@extends('layout.admin')
@section('content')

@php 
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItems;
@endphp

<div class="bg-white mx-3 " style="margin-top: 150px;  border-top:1px #dddddd solid; ">
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
          <th scope="col">Total</th>
          <th scope="col">Reference Number</th>
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
         
            <td>{{number_format($info->total,2)}}</td>
            <td>{{$info->refnum}}</td>
        
            @if($info->del_stat == "Pending")
              <td class="text-warning">{{$info->del_stat}}</td>
            @endif
            
            <td>{{$info->tracknum}}</td>
            {!! Form::open(['action'=>['App\Http\Controllers\ToShipController@update',$info->id],
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            {{-- <td>
              <a href="/feedback/" class="btn userloggedbtn text-success ">Add Feedback</a>
            </td> --}}
            <td>
              {{Form::hidden('id',$info->id)}}
              {{Form::hidden('_method','PUT')}}
              {{Form::submit('Mark as Shipped',['class'=>'btn userloggedbtn text-success ','style'=>'border-radius:0%;'])}}
              {!! Form::close() !!}
              {{-- <a href="https://www.jtexpress.ph/index/query/gzquery.html" class="btn userloggedbtn text-success " > Track Order</a> --}}
            </td>
        @endforeach
        @else
          <td colspan="8" class="text-center"> 
            <h5><b>No Orders placed yet</b> </h5>
          </td>
        @endif
        </tr>
      </tbody>
    </table>   
</div>
<div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div>
@endsection
