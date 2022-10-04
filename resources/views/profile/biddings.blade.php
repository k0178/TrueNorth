@extends('layout.app')

    @section('content')
    <div class="container border my-5 w-75">
      <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none" style="border-bottom:1px #dddddd solid;">
      <span class="fs-5 fw-bold text-center w-100">Biddings</span>
    </a>
     <div class="container my-5 w-100 ">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active fw-bold  " style="color:#EDC948;" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="me-1 bi bi-hourglass-split" style="color:#EDC948;"></i>Pending Bids</button>
            <button class="nav-link fw-bold " style="color:#59A14F;" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="me-1 bi bi-trophy " style="color:#59A14F;"></i>Bids Won</button>
            <button class="nav-link fw-bold" style="color:#E15759;" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="me-1 bi bi-x-square " style="color:#E15759;"></i>Bids Lost</button>
          </div>
        </nav>
        <div class="tab-content " id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            @if(count($pending) > 0)
            @foreach($pending as $info)
            <div class="list-group list-group-flush scrollarea align-items-center" style="border-bottom:1px #dddddd solid;">
              <div class="d-flex align-items-center">
                <div class="d-flex">
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="130px" height="130px" 
                    style="object-fit: cover; 
                            border:3px #EDC948 solid; 
                            
                            margin-top :20px;
                            margin-bottom :20px;" 
                    class="rounded-circle "></a>
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
                <div class="">
                  <ul  style="list-style: none;">
                   
                      <li><h5>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h5></li>
                      <li class="mb-1"> <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y h:i:s A')}} </b></li>
                      <li>Reference #: <b>{{$info->refnum}}</b> </li>
                      {{-- <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li> --}}
                    
                  </ul>
                </div>
                <div class="ms-5">
                  @if(\Carbon\Carbon::parse($info->endDate)->subDays(1) < (\Carbon\Carbon::today()) )
                        <button type="button" class="btn btn-secondary  mt-3 w-100  mb-2" style="border-radius:0%; background:none;"
                          data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-custom-class="custom-tooltip"
                          data-bs-title="You are not allowed to retract if there are 24 hours or less left on the timer.">
                          <i class="bi bi-x-circle me-1 text-secondary"></i>
                          <b class="text-secondary">RETRACT</b> 
                      </button>
                      </div>
                    @else
                    <div class=" text-center mx-3">

                      <button type="button" class="btn btn-danger  mt-3 w-100  mb-2" style="border-radius:0%; border:#E15759 2px solid; background:none;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-x-circle me-1 text-danger"></i>
                        <b class="text-danger">RETRACT</b> 
                      </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Retract your Bid.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Retracting means withrawing the bid you placed. You can retract if you accidentally bid the wrong amount. 
                                    If you retracted too many times, the system can prevent you from retracting. So always check the amount you entered before placing a bid.
                                    You can also retract if the product description have been changed.
                                    <br>
                                    <br>
                                    <b><a href="/termsandcondition" class="">View our Terms & Condition</a></b>
                                </div>
                                
                                
                                <div class="modal-footer justify-content-center  align-items-center">
                                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                                    {{-- {{Form::submit('CANCEL', ['class'=>' btn btn-secondary mt-3 w-25 mb-2','style'=>'border-radius:0%;','data-bs-dismiss'=>'modal']) }} --}}
                                    {!! Form::open(['action'=>['App\Http\Controllers\BiddingController@retractbid',$info->id],
                                    'method'=>'POST'])!!}
                                      {{Form::submit('Confirm Retract', ['class'=>' btn btn-danger  mb-2','style'=>'border-radius:0%;']) }}
                                      {{Form::hidden('id',$info->id)}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                      
                        {{-- {{ Form::hidden('id',$info->id) }}
                        <div class="d-flex align-items-center justify-content-center mb-2">
                          <button class="btn btn-danger "  style="border-radius:0%;">
                            <i class="bi bi-x-circle me-1" style="color: white;"></i> Retract
                          </button>
                        </div>
                        
                        {!! Form::close() !!} --}}
                    </div>
                </div>
                @endif
              </div>
            </div>
            @endforeach
            
            @else
              No Pending Bids

            @endif
            <div class="justify-content-center mt-3 w-100 d-flex ">{{$pending->links()}}</div>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            @if(count($won) > 0)
            @foreach($won as $info)
            <div class="list-group list-group-flush scrollarea align-items-center" style="border-bottom:1px #dddddd solid;">
              <div class="d-flex align-items-center">
                <div class="d-flex">
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="130px" height="130px" 
                    style="object-fit: cover; 
                            border:3px #EDC948 solid; 
                            
                            margin-top :20px;
                            margin-bottom :20px;" 
                    class="rounded-circle "></a>
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
                <div class="">
                  <ul  style="list-style: none;">
                   
                      <li><h5>Bid Placed: <b>{{number_format($info->bidamt,2)}} PHP</b></h5></li>
                      <li class="mb-1"> <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y h:i:s A')}} </b></li>
                      <li>Reference #: <b>{{$info->refnum}}</b> </li>
                      {{-- <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li> --}}
                    
                  </ul>
                </div>
                <div class="ms-5">
                  
                  @if(\Carbon\Carbon::parse($info->endDate)->subDays(1) <= (\Carbon\Carbon::today()) )
                        <button type="button" class="btn btn-secondary" style="border-radius: 0%; "
                          data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-custom-class="custom-tooltip"
                          data-bs-title="You are not allowed to retract if there is 24 hours or less left on the timer.">
                          <i class="bi bi-x-circle me-1 " style="color: white;"></i>
                          Retract Bid
                      </button>
                      </div>
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
              </div>
            </div>
            @endforeach
            
            @else
              No Pending Bids

            @endif
            <div class="justify-content-center mt-3 w-100 d-flex ">{{$won->links()}}</div>
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
           <?php
                use App\Models\Biddings;
            ?>
            @if(count($lost) > 0)
       
            @foreach($lost as $info)
        
            {{-- {{ Form::text('id',$info->prod_id) }} --}}
            <div class="list-group list-group-flush scrollarea align-items-center" style="border-bottom:1px #dddddd solid;">
              <div class="d-flex align-items-center">
                <div class="d-flex">
                  <a href="/item/{{$info->prod_id}}"><img src="/itemImages/{{$info->itemImg}} " width="130px" height="130px" 
                    style="object-fit: cover; 
                            border:3px #E15759 solid; 
                            
                            margin-top :20px;
                            margin-bottom :20px;" 
                    class="rounded-circle "></a>
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
                <div class="">
                  <ul  style="list-style: none;">
                      @php
                      
                        $winner = Biddings::where('bidtransactions.prod_id', '=', $info->prod_id)
                                          ->where('bidtransactions.winstatus', '=','Won')
                                          ->first();
                                        
                      @endphp
                                            
                      <li><h5>Winner: <b>{{$winner}}</b></h5></li>
                      {{-- <li>Winning Bid: <b>{{number_format($winner,2)}} PHP</b></li> --}}
                      {{-- <li class="mb-1"> <b>{{\Carbon\Carbon::parse($info->created_at)->format('l, jS \of F Y h:i:s A')}} </b></li>
                      <li>Reference #: <b>{{$info->refnum}}</b> </li> --}}
                      <li>Starting Price: <b>{{number_format($info->initialPrice,2)}} PHP</b></li>
                    
                  </ul>
                </div>
              
              </div>
            </div>
            @endforeach
            
            @else
              No Pending Bids

            @endif
            <div class="justify-content-center mt-3 w-100 d-flex ">{{$lost->links()}}</div>
          </div>
          
        </div>
    </div>
  </div>
@endsection
  