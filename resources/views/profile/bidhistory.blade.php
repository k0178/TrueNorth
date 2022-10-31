
@extends('layout.app')
@section('content')

<div class="mx-3 mt-5">
<table class="table">
    <thead>
      <tr>
        <th scope="col" colspan="3" class="text-center" style="font-size: 22px;">Bid History</th>
      </tr>
    </thead>
    <tbody>
        @if(count($data) > 0)
            @foreach($data as $info)
                <tr class="">
                    <th scope="row">
                        <img src="/itemImages/{{$info->itemImg}} " width="125px" height="125px" 
                            style="object-fit: cover; 
                                    border:1px #000000 solid; 
                                    margin:20px;" 
                            class="rounded-circle">
                    </th>
                    <td class="" style="padding-top:40px; padding-bottom:30px;">
                        <ul class="" style="list-style: none;">
                            <small>
                            <li class="d-flex align-items-center"><h5><b>{{$info->prodName}}</b> </h5>
                            @if($info->orderstatus == 1)
                            <i class="bi bi-exclamation-circle-fill text-danger ms-2" style="font-size:18px; "><label class="ms-1 text-danger" style="font-size: small;">ITEM SOLD</label></i>
                            @else
                                @if($info->winstatus == "Pending")
                                        <span class="badge text-bg-warning ms-2">PENDING</span>
                                    @elseif($info->winstatus == "Lost")
                                        <span class="badge text-bg-danger ms-2">LOST</span>
                                    @elseif($info->winstatus == "Won")
                                        <span class="badge text-bg-success ms-2">WON</span>
                                    @elseif($info->winstatus == "")
                                        <span class="badge text-bg-danger ms-2">RETRACTED</span>
                                        
                                @endif
                            @endif
                            </li>
                            <li>Type: <b>{{$info->type}}</b></li>
                            <li>Category: <b>{{$info->category}}</b></li>
                            <li>Condition: <b>{{$info->cond}}</b></li>
                            <li>End Date: <b>{{Carbon\Carbon::parse($info->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                            </small>
                        </ul>
                    </td>
                    <td class="pt-5">
                        <ul ul class="" style="list-style: none;">
                            <small>
                                <li><h5>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h5></li>
                                <li class="mb-1"> <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y h:i:s A')}} </b></li>
                                <li>Reference #: <b>{{$info->refnum}}</b> </li>
                                {{-- <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li> --}}
                            </small>
                        </ul>
                    </td>
                </tr> 
            @endforeach
        @else
            <div class="  my-5 text-center">
                <h5><b>You have no bids yet.</b> </h5>
                <a href="/store" class=" btn userloggedbtn " style="font-size: 14px;">View other Auctions</a>
            </div> 
        @endif
   
    </tbody>
  </table>

</div>

@endsection

