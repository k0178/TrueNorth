
@extends('layout.app')
@section('content')

<div class="mx-3 mt-5 justify-content-center ">
<table class="table">
    <thead>
        <div align="right" class="my-5 d-flex align-items-center">
            <i class="bi bi-search me-3"></i>
            <input type="search" class="form-control me-3 w-50"  name="search" id="form-search" placeholder="Search for Item Name, Reference Number or Date (yyyy-mm-dd)">
            <div class="d-flex align-items-center">
                Showing
                <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
                </div>
        </div>
        <tr>
            <th scope="col" colspan="3" class=" border-top text-center" style="font-size: 22px;">Bid History</th>
        </tr>
    </thead>
    <tbody id="bidhistory">
        {{-- @if(count($data) > 0)
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
        @endif --}}
   
    </tbody>
  </table>

</div>
<script>
    $(document).ready(function(){
            fetch_bidhistory_data();
    
            function fetch_bidhistory_data(query = ''){
                
                $.ajax({
                    url:"{{ route('bhsearch')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('#bidhistory').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }
    
            $(document).on('keyup','#form-search',function(){
                var query  = $(this).val();
                fetch_bidhistory_data(query);
            })
        })
      </script>
@endsection

