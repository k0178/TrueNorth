@extends('layout.app')
<?php

use App\Http\Controllers\BiddingController;
use App\Models\Biddings;                           

$won_qty = BiddingController::won_qty();
$pend_qty = BiddingController::pend_qty();
$lost_qty = BiddingController::lost_qty();

?>

    @section('content')

    <div class="container  my-5  border">
      <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none" style="border-bottom:1px #dddddd solid;">
        <span class="fs-5 fw-bold text-center w-100">Biddings</span>
      </div>
    <div class="container my-5 ">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active fw-bold text-dark" style="font-size:16px;" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="mx-1 bi bi-hourglass-split"></i>Pending Bids
              @if($pend_qty == 0)
                
              @else
                <span class="badge ms-1"  style="background:#EDC948;">{{$pend_qty}}</span></button>
              @endif
            <button class="nav-link fw-bold align-items-center text-dark" style="font-size:16px; " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="me-1 bi bi-trophy "></i>Bids Won
              @if($won_qty == 0)
                
              @else
              <span class="badge ms-1"  style="background:#59A14F;">{{$won_qty}}</span>
              @endif
            </button>
            <button class="nav-link fw-bold text-dark " style="font-size:16px;" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="me-1 bi bi-x-square " ></i>Bids Lost
              @if($lost_qty == 0)
                
              @else
              <span class="badge ms-1"  style="background:#E15759;">{{$lost_qty}}</span>
              @endif
            </button>
          </div>
        </nav>
        <div class="tab-content " id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div align="right" class="my-3 mx-3 d-flex align-items-center">
              <i class="bi bi-search me-3"></i>
              <input type="search" class="form-control me-3"  name="search" id="pend-search" placeholder="Search for Item Name">
              <div class="d-flex align-items-center">
                  Showing
                  <p id="pend_total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
              </div>
            </div>

            <div class="" id="pend_tbl">
              
            </div>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <div align="right" class="my-3 mx-3 d-flex align-items-center">
              <i class="bi bi-search me-3"></i>
              <input type="search" class="form-control me-3"  name="search" id="won-search" placeholder="Search for Item Name">
              <div class="d-flex align-items-center">
                  Showing
                  <p id="won_total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
                  </div>
            </div>
          
            <div class="" id="won_tbl">
              
            </div>
            {{-- @if(count($won) > 0)
            @foreach($won as $info)
            <div class="list-group list-group-flush scrollarea mt-3 mx-3 align-items-center" style="border-bottom:1px #dddddd solid;">
              <div class="d-flex align-items-center">
                <div class="d-flex">
                  <img src="/itemImages/{{$info->itemImg}} " width="130px" height="130px" 
                    style="object-fit: cover; 
                            border:3px #56A06E solid; 
                            
                            margin-top :20px;
                            margin-bottom :20px;" 
                    class="rounded-circle ">
                </div>
                <div class="pt-3">
                  
                    <ul style="list-style: none;">
                      <li class="d-flex align-items-center"><h5><b>{{$info->prodName}}</b> </h5>
                        {!! Form::open(['action'=>['App\Http\Controllers\BagController@addToBag',$info->product_id],
                          'method'=>'GET'])!!}
                          {{ Form::hidden('product_id',$info->prod_id) }}
                            <button class="btn" style="border-radius: 0%;"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Add to Bag">
                        <i class="bi bi-bag-plus " style="font-size: 20px;"></i>
                      </button>
                      {!! Form::close() !!}
                      
                      </li> 
                      <li>Type: <b>{{$info->type}}</b></li>
                      <li>Category: <b>{{$info->category}}</b></li>
                      <li>Condition: <b>{{$info->cond}}</b></li>
                      <li>End Date: <b>{{Carbon\Carbon::parse($info->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                    </ul>
                </div>
                <div class="w-50">
                  <ul  style="list-style: none;">
                      <li><h5>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h5></li>
                      <li class="mb-1"> Placed at: <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y (h:i:s A)')}} </b></li>
                      <li class="mb-1 mt-3"> Must place order before: <br> <b>{{\Carbon\Carbon::parse($info->orderDate)->format('l, jS \of F Y (h:i:s A)')}} </b></li>
                      <li>Reference #: <b>{{$info->refnum}}</b> </li>
                  </ul>
                </div>
              
                  @if(\Carbon\Carbon::parse($info->endDate)->subDays(1) <= (\Carbon\Carbon::today()) )
                  
                  <button type="button" class="form-btn text-white ms-3 d-flex" style="border-radius: 0%; background:#56A06E;"
                      data-bs-toggle="tooltip" data-bs-placement="top"
                      data-bs-title="Checkout"
                      onclick="location.href='/checkout/{{$info->prod_id}}'">
                      <i class="bi bi-bag-check me-1" style="color:white;"></i>
                      CHECKOUT
                    </button>
                    @else
                    <div class=" text-center mx-3">
                      {!! Form::open(['action'=>['App\Http\Controllers\BiddingController@retractbid',$info->id],
                        'method'=>'POST'])!!}
                        {{ Form::hidden('id',$info->id) }}
                        <div class="d-flex align-items-center justify-content-center mb-2">
                          <button class="btn btn-danger "  style="border-radius:0%;">
                            <i class="bi bi-x-circle me-1" style="color: white;"></i> Retract Bid
                          </button>
                        </div>
                      
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
                <hr class="text-secondary">
              </div>
              
              <button type="button" class="info-btn my-3" data-bs-toggle="modal" data-bs-target="#bidresults">
                  View Bidding Results
              </button>
              
              
              <div class="modal fade" id="bidresults" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidding Results: <b>{{$info->prodName}}</b></h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            <table class="table">
                              <div class="d-flex  flex-shrink-0  link-dark text-decoration-none border-bottom">
                                <span class="fs-6 fw-semibold text-center w-100"><b>List of Bidders</b> </span>
                              </div>
                              <thead>
                                <tr>
                                  <th scope="col">Username</th>
                                  <th scope="col">Bid Amount</th>
                                  <th scope="col">Time Placed</th>
                                  <th scope="col">Reference #</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php

                                    $bids = Biddings::where('prod_id',$info->prod_id)
                                                    ->orderBy('bidamt','DESC')
                                                    ->get();
                                  @endphp                                  
                                  @foreach ($bids as $item)
                                <tr>
                                    <th scope = "row">{{$item->uname}}</th>
                                    <td>{{number_format($item->bidamt,2) }} PHP</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->refnum}}</td>  
                                </tr> 
                                @endforeach
                              </tbody>
                            </table>
                              Make sure to secure an order for this item within 2 weeks or else, it will be <b class="text-danger"> DELETED</b> from your biddings.
                              You can also be <b class="text-danger">BLOCKED</b> by the Administrator from bidding on other auctions.
                              <br>
                              <br>
                              <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                          </div>
                          
                          
                          <div class="modal-footer justify-content-center  align-items-center">
                              <button type="button" class="info-btn" data-bs-dismiss="modal">Got It</button>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            @endforeach
            
            @else
              <h3 class="m-5 text-center">Nothing to show.</h3>
            @endif
            <div class="justify-content-center mt-3 w-100 d-flex ">{{$won->links()}}</div> --}}
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
            <div align="right" class="my-3 mx-3 d-flex align-items-center">
              <i class="bi bi-search me-3"></i>
              <input type="search" class="form-control me-3"  name="search" id="lost-search" placeholder="Search for Item Name">
              <div class="d-flex align-items-center">
                  Showing
                  <p id="lost_total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
                  </div>
            </div>
            <div class="" id="lost_tbl">
              
            </div>   

            {{-- @if(count($lost) > 0)
            @foreach($lost as $info)
            <div class="list-group list-group-flush scrollarea align-items-center" style="border-bottom:1px #dddddd solid;">
              <div class="d-flex align-items-center">
                <div class="d-flex">
                  <img src="/itemImages/{{$info->itemImg}} " width="130px" height="130px" 
                    style="object-fit: cover; 
                            border:3px #C76D6D solid; 
                            margin-top :20px;
                            margin-bottom :20px;" 
                    class="rounded-circle ">
                </div>
                <div class="pt-3">
                    <ul style="list-style: none;">
                      <li><h5><b>{{$info->prodName}}</b> </h5></li> 
                      <li>Type: <b>{{$info->type}}</b></li>
                      <li>Category: <b>{{$info->category}}</b></li>
                      <li>Condition: <b>{{$info->cond}}</b></li>
                      <li>End Date: <b>{{Carbon\Carbon::parse($info->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                    </ul>
                </div>
                <div class="mt-3">
                  <ul  style="list-style: none;">
                      @php
                        $winner = Biddings::join('users','users.username','bidtransactions.uname')
                                          ->where('bidtransactions.prod_id', '=', $info->prod_id)
                                          ->where('bidtransactions.winstatus', '=','Won')
                                          ->first();
                        $win_bid = Biddings::where('bidtransactions.prod_id', '=', $info->prod_id)
                                    ->where('bidtransactions.winstatus', '=','Won')
                                    ->first();
                      @endphp
                        
                      <br>
                      <li>Reference #: <b>{{$info->refnum}}</b> </li>
                      <li>Your Bid: <b>{{number_format($info->bidamt,2)}} PHP</b></li>
                      <li>Placed at: <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y (h:i:s A)')}}</b></li>
                  </ul>
                </div>
              </div>
            </div>
            @endforeach
            
            @else
              <h3 class="m-5 text-center">Nothing to show.</h3>
            @endif
            <div class="justify-content-center mt-3 w-100 d-flex ">{{$lost->links()}}</div> --}}
          </div>
        </div>
    </div>

    <script>
      
      $(document).ready(function(){

        
              fetch_wonbids_data();
              fetch_lostbids_data();
              fetch_pendbids_data();

              function fetch_wonbids_data(query = ''){
                  
                  $.ajax({
                      url:"{{ route('wonsearch')}}",
                      method:'GET',
                      data:{query:query},
                      dataType:'json',
                      success:function(data){
                          $('#won_tbl').html(data.table_data);
                          $('#won_total_records').text(data.total_data);
                      }
                  })
              }

              function fetch_lostbids_data(query = ''){
                  
                  $.ajax({
                      url:"{{ route('lostsearch')}}",
                      method:'GET',
                      data:{query:query},
                      dataType:'json',
                      success:function(data){
                          $('#lost_tbl').html(data.table_data);
                          $('#lost_total_records').text(data.total_data);
                      }
                  })
              }

              
              function fetch_pendbids_data(query = ''){
                  
                  $.ajax({
                      url:"{{ route('pendsearch')}}",
                      method:'GET',
                      data:{query:query},
                      dataType:'json',
                      success:function(data){
                          $('#pend_tbl').html(data.table_data);
                          $('#pend_total_records').text(data.total_data);
                      }
                  })
              }

           
      
              $(document).on('keyup','#won-search',function(){
                  var query  = $(this).val();
                  fetch_wonbids_data(query);
              })

              $(document).on('keyup','#lost-search',function(){
                  var query  = $(this).val();
                  fetch_lostbids_data(query);
              })

              $(document).on('keyup','#pend-search',function(){
                  var query  = $(this).val();
                  fetch_pendbids_data(query);
              })

              
          })
        </script>

@endsection
  