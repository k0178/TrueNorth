@extends('layout.app')
<?php

use App\Http\Controllers\BiddingController;
use App\Models\Biddings;                           

$won_qty = BiddingController::won_qty();
$pend_qty = BiddingController::pend_qty();
$lost_qty = BiddingController::lost_qty();

?>
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

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
          <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <table class="display " id="pending">
              <thead>
                <tr>
                  <th>ITEMS (Alphabetical Order)</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pending as $item)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="/itemImages/{{$item->itemImg}} " width="130px" height="130px" 
                            style="object-fit: cover; 
                                  border:3px #E7BB41 solid; 
                                  margin-top :20px;
                                  margin-bottom :20px;" 
                            class="rounded-circle ">
                          <div class="pt-3 d-flex">
                            <ul style="list-style: none;">
                              <li><h5><b>{{$item->prodName}}</b></h5></li>
                              <li>Type: <b>{{$item->type}}</b></li>
                              <li>Category: <b>{{$item->category}}</b></li>
                              <li>Condition: <b>{{$item->cond}}</b></li>
                              <li>Ends on: <b>{{Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                            </ul>
                            <ul style="list-style: none;">
                              
                              <li>Bid Placed: <b>{{number_format($item->bidamt,2)}} PHP</b></li>
                              <li>Reference #: <b>{{$item->refnum}}</b></li>
                              <li>Placed at: <b>{{Carbon\Carbon::parse($item->created_at)->format('l, jS \of F Y (h:i:s A)')}}</b></li>
                            </ul>
                          </div>
                        </div>
                        @if(\Carbon\Carbon::parse($item->endDate)->subDays(1)< (\Carbon\Carbon::today()))
                        <label align="center" class="text-danger my-3 w-100" style="font-size:11px;">
                          <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                          You are not allowed to retract anymore if there are <b class="text-danger">
                            24 hours or less
                          </b>left on the timer.
                        </label>
                      @else
                      <div align="center" class="w-100">
                        <button type="button" class="form-btn mt-3 mb-2" style="background:#C76D6D;" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->id}}">
                            <i class="bi bi-x-circle me-1 text-white"></i>
                            <b class="text-white">RETRACT</b> 
                        </button>
                      </div>
                        

                        <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Retract your Bid. ({{$item->prodName}})</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                            <h4>ARE YOU SURE YOU WANT TO RETRACT YOUR BID FOR THIS ITEM?</h4>
                                            <br>
                                            <small class = "mb-3">
                                                Retracting means withrawing the bid you placed. You can retract if you accidentally bid the wrong amount. 
                                                If you retracted too many times, the system can prevent you from retracting. So always check the amount you entered before placing a bid.
                                                You can also retract if the product description have been changed.
                                            </small>
                                            <br>
                                            <br>
                                        <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                                    </div>
                                    <div class="modal-footer justify-content-center  align-items-center">
                                        <form action="/retractbid" method="get">
                                            <input type="hidden" name="product_id" value="{{$item->id}}">
                                            <button type="submit" class="form-btn" data-bs-dismiss="modal">Retract Bid</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endif
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-content " id="nav-tabContent">
          <div class="tab-pane fade show mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <table class="display " id="won">
              <thead>
                <tr>
                  <th>ITEMS (Alphabetical Order)</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($won as $item)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="/itemImages/{{$item->itemImg}} " width="130px" height="130px" 
                            style="object-fit: cover; 
                                  border:3px #59A14F solid; 
                                  margin-top :20px;
                                  margin-bottom :20px;" 
                            class="rounded-circle ">
                          <div class="pt-3 d-flex">
                            <ul style="list-style: none;">
                              <li><h5><b>{{$item->prodName}}</b></h5></li>
                              <li>Type: <b>{{$item->type}}</b></li>
                              <li>Category: <b>{{$item->category}}</b></li>
                              <li>Condition: <b>{{$item->cond}}</b></li>
                              <li>Ends on: <b>{{Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                            </ul>
                            <ul style="list-style: none;">
                              
                              <li>Bid Placed: <b>{{number_format($item->bidamt,2)}} PHP</b></li>
                              <li>Reference #: <b>{{$item->refnum}}</b></li>
                              <li>Placed at: <b>{{Carbon\Carbon::parse($item->created_at)->format('l, jS \of F Y (h:i:s A)')}}</b></li>
                            </ul>
                          </div>
                        </div>
                      <div align="center" class="w-100">
                        <button type="button" class="form-btn text-white mb-3 d-flex" style="border-radius: 0%; background:#56A06E;"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Checkout"
                            onclick="location.href='/checkout/{{$item->prod_id}}'" >
                            <i class="bi bi-bag-check me-2" style="color:white;"></i>
                            CHECKOUT
                        </button>
                        <button type="button" class="info-btn mb-3" data-bs-toggle="modal" data-bs-target="#bidresults{{$item->prod_id}}">
                            View Bidding Results
                        </button>
                      </div>
                      <div class="modal fade" id="bidresults{{$item->prod_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidding Results: <b>{{$item->prodname}}</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                @php
                                  $bids = Biddings::where('prod_id',$item->prod_id)
                                                  ->orderBy('bidamt','DESC')
                                                  ->get();
                                @endphp
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
                                          @foreach ($bids as $item)
                                              <tr>
                                                <td>{{$item->uname}}</td>
                                                <td>{{number_format($item->bidamt,2)}} PHP</td>
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
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-content " id="nav-tabContent">
          <div class="tab-pane fade show mt-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
            <table class="display " id="lost">
              <thead>
                <tr>
                  <th>ITEMS (Alphabetical Order)</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lost as $item)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="/itemImages/{{$item->itemImg}} " width="130px" height="130px" 
                            style="object-fit: cover; 
                                  border:3px #C76D6D solid; 
                                  margin-top :20px;
                                  margin-bottom :20px;" 
                            class="rounded-circle ">
                          <div class="pt-3 d-flex">
                            <ul style="list-style: none;">
                              <li><h5><b>{{$item->prodName}}</b></h5></li>
                              <li>Type: <b>{{$item->type}}</b></li>
                              <li>Category: <b>{{$item->category}}</b></li>
                              <li>Condition: <b>{{$item->cond}}</b></li>
                              <li>Ends on: <b>{{Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                            </ul>
                            <ul style="list-style: none;">
                              
                              <li>Bid Placed: <b>{{number_format($item->bidamt,2)}} PHP</b></li>
                              <li>Reference #: <b>{{$item->refnum}}</b></li>
                              <li>Placed at: <b>{{Carbon\Carbon::parse($item->created_at)->format('l, jS \of F Y (h:i:s A)')}}</b></li>
                            </ul>
                          </div>
                        </div>
                      <div align="center" class="w-100">
                        <button type="button" class="info-btn mb-3" data-bs-toggle="modal" data-bs-target="#bidresults{{$item->prod_id}}">
                            View Bidding Results
                        </button>
                      </div>
                      <div class="modal fade" id="bidresults{{$item->prod_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidding Results: <b>{{$item->prodname}}</b></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                @php
                                  $bids = Biddings::where('prod_id',$item->prod_id)
                                                  ->orderBy('bidamt','DESC')
                                                  ->get();
                                @endphp
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
                                          @foreach ($bids as $item)
                                              <tr>
                                                <td>{{$item->uname}}</td>
                                                <td>{{number_format($item->bidamt,2)}} PHP</td>
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
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
   

@endsection

@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#pending').DataTable();
    });
    $(document).ready( function () {
      $('#won').DataTable();
    });
    $(document).ready( function () {
      $('#lost').DataTable();
    });
    
    
  </script>
  @endsection
  