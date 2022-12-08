
@extends('layout.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

@section('content')

@php 
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItems;
use App\Models\Auction;
@endphp

    <div class="bg-white my-5 " style=" border-right:1px #dddddd solid; border-top:1px #dddddd solid; border-left:1px #dddddd solid;">
      <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none " style="border-bottom:1px #dddddd solid;">
        <span class="fs-5 fw-bold text-center w-100">My Orders</span>
      </div>
      <div class="m-5">
        <table class="display" id="orders">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Item/s</th>
              <th >Delivery Address </th>
              <th>Total</th>
              <th>Reference Number</th>
              <th>Delivery Date</th>
              <th>Status</th>
              <th>Tracking Number</th>
              <th>Tracking Number</th>
              <th>Send Receipt to Email</th>
            </tr>
          </thead>
          <tbody>
            @if(count($data) > 0)
              @foreach ($data as $info)
                @php
                  $orders = Auction::join('order_items','auctions.id','=','order_items.prod_id')
                  ->select('auctions.*')
                  ->where('order_items.user_id','=',Auth::user()->id)
                  ->where('order_items.order_id',$info->id)
                  ->get();
                @endphp
              <tr>
                <td>{{$info->id}}</td> 
                <td>
                  @foreach($orders as $item)
                  <div class="mb-2 d-flex">
                    <img src="/itemImages/{{$item->itemImg}}" 
                    width="40px" height="40px" 
                    style="object-fit: cover; border: 3px #393E41 solid;" 
                    class="rounded-circle me-1">
                    {{$item->prodName}}
                  </div>
                    @if( !$loop->last)
                        ,
                    @endif
                  @endforeach
                </td>
                <td>{{Auth::user()->address}}</td>
              
                <td>{{number_format($info->total,2)}}</td>
                <td>{{$info->refnum}}</td>
                <td>{{\Carbon\Carbon::parse($info->del_date)->isoFormat('MMM D, YYYY')}}</td>
                @if($info->del_stat == "Pending")
                  <td><span class="badge text-bg-warning"><i class="bi bi-hourglass-split me-1"></i>{{$info->del_stat}}</span></td>
                @elseif($info->del_stat == "Shipped")
                  <td><span class="badge text-bg-success"><i class="bi bi-truck me-1"></i>{{$info->del_stat}}</span></td>
                @elseif($info->del_stat == "Delivered")
                <td><span class="badge text-bg-warning"><i class="bi bi-bookmark-check-fill me-1"></i>{{$info->del_stat}}</span></td>
                @endif
                
                <td>{{$info->tracknum}}</td>
                <td>
                  <a href="https://www.jtexpress.ph/index/query/gzquery.html" class="btn userloggedbtn text-success " > <i class="bi bi-truck text-success">Track Order</i></a>
                </td>
                <td>{{$info->tracknum}}</td>
            @endforeach
            @else
              <td> 
                <h5><b>You have no orders yet.</b> </h5>
              </td>
            @endif
            </tr>
          </tbody>
        </table>   
      </div>
        
    </div>
    {{-- <div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div> --}}
    @endsection
  @section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#orders').DataTable();
    });
    
  </script>
  @endsection