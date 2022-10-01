@extends('layout.app')
    @section('content')

    <div class="bg-white my-5 mx-5" style="  border-right:1px #dddddd solid; border-top:1px #dddddd solid; border-left:1px #dddddd solid; border-bottom:1px #dddddd solid;">
      <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none" style="border-bottom:1px #dddddd solid;">
        <span class="fs-5 fw-bold text-center w-100">Biddings</span>
      </a>

  @if(count($data) > 0)
    @foreach ($data as $info) 
   
      <div class="list-group list-group-flush scrollarea " style="border-bottom:1px #dddddd solid;">
          <div class="d-flex">
            <div class="d-flex">
            
             

            @if($info->orderstatus = 0)
              <figure>
              <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                style="object-fit: cover; 
                        border:3px #DC3545 solid; 
                        margin:20px;" 
                class="rounded-circle "></a>
                <figcaption class="text-danger fw-bold text-center">Item Sold</figcaption>
              </figure>

            @else
              @if($info->winstatus == "Won")
              <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                style="object-fit: cover; 
                        border:3px #267952 solid; 
                        margin:20px;" 
                class="rounded-circle "></a>
                @elseif($info->winstatus == "Lost")
                <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                  style="object-fit: cover; 
                          border:3px #DC3545 solid; 
                          margin:20px;" 
                  class="rounded-circle "></a>
                  @elseif($info->winstatus == "Pending")
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                    style="object-fit: cover; 
                            border:3px #FFC106 solid; 
                            margin:20px;" 
                    class="rounded-circle "></a>
                  @elseif($info->winstatus == "Declined")
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                    style="object-fit: cover; 
                            border:3px #DC3545 solid; 
                            margin:20px;" 
                    class="rounded-circle "></a>
                  @elseif($info->orderstatus = 1)
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                    style="object-fit: cover; 
                            border:3px #DC3545 solid; 
                            margin:20px;" 
                    class="rounded-circle "></a>
                @endif
            @endif 

            </div>  
              <div class="d-flex w-100">
                <div class="w-100 d-flex">
                  <ul style="list-style: none; margin-top: auto; margin-bottom:auto;">
                    <small>
                      <li class="d-flex"><h5><b>{{$info->prodName}}</b> </h5>
                      @if($info->orderstatus == 1)
                      <i class="bi bi-exclamation-circle-fill text-danger ms-2" style="font-size:18px; "> ITEM SOLD</i>
                      @else
                          @if($info->winstatus == "Pending")
                            <i class="bi bi-clock-fill text-warning ms-2" style="font-size:18px; "><label class="ms-1 text-warning" style="font-size: small;">Pending</label></i>
                            @elseif($info->winstatus == "Lost")
                              <i class="bi bi-x-circle-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">Lost</label></i>
                            @elseif($info->winstatus == "Won")
                              <i class="bi bi-check-circle-fill text-success ms-2" style="font-size:18px; "><label class="ms-1 text-success" style="font-size: small;">Won</label></i>
                              @elseif($info->winstatus == "Declined")
                              <i class="bi bi-x-circle-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">Did not Order</label></i>
                            @endif
                      @endif
                      </li>
                      <li>Type: <b>{{$info->type}}</b></li>
                      <li>Category: <b>{{$info->category}}</b></li>
                      <li>Condition: <b>{{$info->cond}}</b></li>
                      <li>End Date: <b>{{Carbon\Carbon::parse($info->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                    </small>
                  </ul>
                </div>
                <div class="w-75 d-flex" style="border-right: 1px #dddddd solid; ">
                  <ul class="pe-3" style="list-style: none;  margin-top: auto; margin-bottom:auto;">
                    <small>
                      <li><h6>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h6></li>
                      <li><h6>Date: <b>{{\Carbon\Carbon::parse($info->created_at)->toDayDateTimeString()}} </b></h6></li>
                      <li>Reference Num: <b>{{$info->refnum}}</b> </li>
                      <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li>
                    </small>
                  </ul>
                </div>
                <div class="d-flex w-50  align-items-center justify-content-center">
                
                  @if($info->winstatus == "Won")
                  <div class="text-center">
                    <form action="/addtobag" method="GET">
                        <button class="btn userloggedbtn mb-3" style="border-radius: 0%;">
                            <i class="bi bi-bag-plus" style="font-size: 18px;"></i>
                            Add to Bag
                        </button>
                      <input type="hidden" name="product_id" value={{$info->prod_id}}>
                    </form>
                    <button class="btn userloggedbtn text-success" style="border-radius: 0%;">
                      <i class="bi bi-bag-check text-success" style="font-size: 18px;"></i>
                      <a href="/checkout/{{$info->prod_id}}" class="userloggedbtn w-50" style="border-radius: 0%;">Checkout</a>
                    </button>
                    <br>
                      <small class="px-3 mt-2">You must place an order for this item before {{\Carbon\Carbon::parse($info->orderDate)->toDayDateTimeString()}} </small>
                    
                  </div>
                  
                  @elseif($info->winstatus == "Lost")
                    <a href="/store" class="me-5 btn userloggedbtn " style="font-size: 14px;">View other Auctions</a>
                      {!! Form::open(['action'=>['App\Http\Controllers\BiddingController@destroy',$info->id],
                      'method'=>'DELETE'])!!}
                      {{ Form::hidden('id',$info->id) }} 
                      {{ Form::submit('Remove',['class' => 'btn userloggedbtn text-danger '])}}
                      {!! Form::close() !!}

                  @elseif($info->winstatus == "Pending")
                    @if(\Carbon\Carbon::parse($info->endDate)->subDays(1)->isoFormat('Y-MM-DD') == \Carbon\Carbon::now()->isoFormat('Y-MM-DD'))
                      <div class="text-center">
                        <b><small class="text-danger">You are not allowed to retract anymore.</small> </b>
                      </div>
                      
                    @else
                        {!! Form::open(['action'=>['App\Http\Controllers\BiddingController@retractbid',$info->id],
                        'method'=>'POST'])!!}
                        {{ Form::hidden('id',$info->id) }}
                        <i class="bi bi-x-circle text-danger"></i>
                        {{ Form::submit('Retract Bid',['class' => 'btn userloggedbtn text-danger '])}}
                        {!! Form::close() !!}
                    @endif
                  
                  @elseif($info->winstatus == "Declined")
                  
                  @else
                  {{-- <div>
                    @if($info->orderstatus = 1)
                    <button class="btn userloggedbtn text-success" style="border-radius: 0%;">
                      <a href="/store" class="userloggedbtn w-50" style="border-radius: 0%;">View other Auctions</a>
                    </button>
                    @else
                      {!! Form::open(['action'=>['App\Http\Controllers\BiddingController@retractbid',$info->id],
                      'method'=>'POST'])!!}
                      {{ Form::hidden('id',$info->id) }}
                      <i class="bi bi-x-circle text-danger"></i>
                      {{ Form::submit('Retract Bid',['class' => 'btn userloggedbtn text-danger '])}}
                      {!! Form::close() !!}
                    @endif
                  </div>  --}}
                @endif                  
                </div>
              </div>
            </div>
          </div>
      @endforeach
      @else
      <div class="  my-5 text-center">
        <h5><b>You have no bids yet.</b> </h5>
        <a href="/store" class=" btn userloggedbtn " style="font-size: 14px;">View other Auctions</a>
      </div> 
  @endif
    
    </div>
  <div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div>
@endsection
  