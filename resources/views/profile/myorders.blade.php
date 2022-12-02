
@extends('layout.app')
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
      <div align="right" class="my-3 mx-3 d-flex align-items-center">
        <i class="bi bi-search me-3"></i>
        <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Reference Number or Tracking Number">
        <div class="d-flex align-items-center">
            Showing
            <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
            </div>
      </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">Item/s</th>
              <th scope="col">Delivery Address </th>
              <th scope="col">Total</th>
              <th scope="col">Reference Number</th>
              <th scope="col">Delivery Date</th>
              <th scope="col">Status</th>
              <th scope="col">Tracking Number</th>
              <th scope="col">Send Receipt to Email</th>
            </tr>
          </thead>
          <tbody>
            {{-- @if(count($data) > 0)
              @foreach ($data as $info)
                @php
                  $orders = Auction::join('order_items','auctions.id','=','order_items.prod_id')
                  ->select('auctions.prodName')
                  ->where('order_items.user_id','=',Auth::user()->id)
                  ->where('order_items.order_id',$info->id)
                  ->get();
                @endphp
              <tr>
                <th scope="row">{{$info->id}}</th> 
                <td>
                  @foreach($orders as $item)
                    {{$item->prodName}}
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
                  <td class="text-warning">{{$info->del_stat}}</td>
                @elseif($info->del_stat == "Shipped")
                  <td class="text-success">{{$info->del_stat}}</td>
                @elseif($info->del_stat == "Delivered")
                <td class="text-success">{{$info->del_stat}}</td>
                @endif
                
                <td>{{$info->tracknum}}</td>
                <td>
                  <a href="https://www.jtexpress.ph/index/query/gzquery.html" class="btn userloggedbtn text-success " > <i class="bi bi-truck text-success">Track Order</i></a>
                </td>
            @endforeach
            @else
              <td colspan="8" class="text-center"> 
                <h5><b>You have no orders yet.</b> </h5>
              </td>
            @endif
            </tr> --}}


          </tbody>
        </table>   
    </div>
    {{-- <div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div> --}}
    
    <script>
      $(document).ready(function(){
          fetch_myorders_data();
      
              function fetch_myorders_data(query = ''){
                  
                  $.ajax({
                      url:"{{ route('mosearch')}}",
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
                  fetch_myorders_data(query);
              })
          })
        </script>
  
    @endsection
  