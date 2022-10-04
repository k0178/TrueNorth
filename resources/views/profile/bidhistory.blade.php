
@extends('layout.app')
@section('content')
<div class="bg-white my-5 mx-5" style="  border-right:1px #dddddd solid; border-top:1px #dddddd solid; border-left:1px #dddddd solid; border-bottom:1px #dddddd solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none" style="border-bottom:1px #dddddd solid;">
    <span class="fs-5 fw-bold text-center w-100">Bidding History</span>
  </a>
@if(count($data) > 0)
    @foreach ($data as $info) 
    <div class="list-group list-group-flush scrollarea " style="border-bottom:1px #dddddd solid;">
        <div class="d-flex">
            <div class="d-flex">
        
            
            <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
            style="object-fit: cover; 
                    border:1px #000000 solid; 
                    margin:20px;" 
            class="rounded-circle "></a>
            
            
        
            
            </div>  
            <div class="d-flex w-100">
                <div class="w-100 d-flex">
                <ul style="list-style: none; margin-top: auto; margin-bottom:auto;">
                    <small>
                    <li class="d-flex"><h5><b>{{$info->prodName}}</b> </h5>
                    @if($info->orderstatus == 1)
                    <i class="bi bi-exclamation-circle-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">ITEM SOLD</label></i>
                    @else
                        @if($info->winstatus == "Pending")
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-fill text-warning ms-2" style="font-size:18px; "><label class="ms-1 text-warning" style="font-size: small;">PENDING</label></i>
                            </div>
                            @elseif($info->winstatus == "Lost")
                                <i class="bi bi-x-circle-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">LOST</label></i>
                            @elseif($info->winstatus == "Won")
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success ms-2" style="font-size:18px; "><label class="ms-1 text-success" style="font-size: small;">WON</label></i>
                                </div>
                            @elseif($info->winstatus == "")
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-x-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">RETRACTED</label></i>
                                </div>
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
                        <li><h5>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h5></li>
                        <li class="mb-1"> <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y h:i:s A')}} </b></li>
                        <li>Reference #: <b>{{$info->refnum}}</b> </li>
                        {{-- <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li> --}}
                    </small>
                </ul>
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

