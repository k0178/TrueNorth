@extends('layout.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content') 
<div class=" d-flex w-100 flex-shrink-0 py-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold text-center w-100">Item List</span>
</div>
<div class="m-3">
<table class="display" id="itemlist">
  <thead>
    <tr>
      <th>ITEMS (Alphabetical Order)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
      <tr>
        <td>
          <div class="list-group list-group-flush scrollarea mx-3 ">
            <div class="d-flex align-items-center">
                <img src="/itemImages/{{$item->itemImg}}"width="160px" height="160px" 
                style="object-fit: cover; 
                        border:3px #393E41 solid; 
                        " 
                class="rounded-circle ">
                <div class="pt-3">
                    <ul style="list-style: none;">
                        <li>#<b>{{$item->id}}</b></li>
                        <li class="d-flex align-items-center " style="text-overflow: ellipsis;">
                          <h3><b>{{$item->prodName}}</b></h3>
                          @if($item->qty == 0)
                            <span class="badge rounded-pill text-bg-danger">Out of Stock</span>
                          @else
                            <form action = "/postItem/{{$item->id}}" method="GET">
                              <button type="sumbit" class="btn text-success d-flex">
                                      <i class="bi bi-plus-circle-fill me-2 text-success" style=""></i>
                                      POST ITEM
                              </button>
                            </form>
                          @endif
                            <form action = "/deleteitem" method="GET">
                                <input type = "hidden" name="product_id" value={{$item->id}}>
                                <button type="submit" class="btn mb-2 ms-2 d-flex" style="font-size:18px;" >
                                    <i class="bi bi-trash-fill " style="color:#C76D6D;"></i>
                                </button>
                            </form>
                    
                            <button type="button" class="btn mb-2 ms-2 text-dark d-flex" 
                                onclick="location.href='list/{{$item->id}}/edit'" style="font-size:18px;" >
                                <i class="bi bi-pencil-square" style="color:#393E41;"></i>
                            </button>
                        </li>
                        <li>Type: <b>{{$item->type}}</b></li>
                        <li>Category: <b>{{$item->category}}</b></li>
                        <li>Condition: <b>{{$item->cond}}</b></li>
                        <li>Stock: <b>{{$item->qty}}</b></li>
                        <li>Starting Price: <b>{{number_format($item->initialPrice,2)}} PHP</b></li>
                        
                        <button class="form-btn my-3 " style="background: #D3D0CB;" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->id}}">
                            SHOW DETAILS
                        </button>
                        
                        <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$item->prodName}} Details </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$item->prodDeets}}
                                    </div>
                                    
                                    <div class="modal-footer justify-content-center  align-items-center">
                                        <button type="button" class="info-btn" data-bs-dismiss="modal">GOT IT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        </td>
      </tr> 
    @endforeach
   
  </tbody>
</table>

</div>

      
          {{-- <div class="list-group list-group-flush border-bottom scrollarea " style="border-right:1px #f0eeee solid;">
            @if(count($data)>0)
            @foreach ($data as $info)
            <div class="list-group-item list-group-item-action  py-3" aria-current="true">
              <div class="d-flex align-items-center">
              
                <div class="me-3">
                  <img src="/itemImages/{{$info->itemImg}}" width="120px" height="120px" 
                    style="object-fit: cover; border:1px #121212 solid;" 
                    class="rounded-circle" >
                </div>
                <div class="d-flex align-items-center">
                  <small>
                    <ul style="list-style: none; margin-top: auto; margin-bottom:auto;">
                        <li><b>ID:</b> {{$info->id}}</li>
                        <li><b>Name:</b> {{$info->prodName}}</li>
                        <li><b>Details:</b> <textarea class="form-control" style="background: none; resize:none;" name="" id="" cols="10" rows="5" disabled>{{$info->prodDeets}}</textarea> </li>
                    </ul>
                  </small>
                  <small>
                    <ul class="pe-3" style="list-style: none;  margin-top: auto; margin-bottom:auto;">
                        <li><b>Condition:</b> {{$info->cond}}</li>
                        <li><b>Category:</b> {{$info->category}}</li>
                        <li><b>Type:</b> {{$info->type}}</li>
                        <li><b>Quantity:</b> {{$info->qty}}</li>
                        <li><b>Starting Price:</b> {{$info->initialPrice}} PHP</li>
                        <li><b>Buyout Price:</b> {{$info->buyPrice}} PHP</li> 
                    </ul>
                  </small>
                </div>
                <div>
                  <a href="list/{{$info->id}}/edit" class="userloggedbtn ms-5 px-5" style="font-size:15px;">Edit</a>
                </div>
                <div>
                    {!! Form::open(['action'=>['App\Http\Controllers\itemListController@destroy',$info->id],
                    'method'=>'POST'])!!}
                    {{ Form::hidden('_method','DELETE') }}
                    {{ Form::submit('Delete',
                    ['class' => 'text-danger userloggedbtn px-5 w-100',
                    'style'=>' background:none;
                                border-right: 1px #b6b5b5 solid;
                                border-left: 1px #b6b5b5 solid;
                                font-size:15px;'])}}
                    {!! Form::close() !!} 
                </div>
                @if ($info->qty<1)
                <div>
                  <small class="text-danger ms-5 ">Out Of Stock!</small>  
                </div>                    
                @else
                <div>
                  {!! Form::open(['action'=>['App\Http\Controllers\AuctionController@show',$info->id],
                  'method'=>'POST'])!!}
                      {{ Form::hidden('_method','GET') }}
                      {{ Form::submit('Post',['class' => 'btn userloggedbtn text-success ms-5', 'style' => 'font-size:15px;'])}}
                  {!! Form::close() !!} 
                </div>
                @endif
              </div>
            </div>
            @endforeach
            @else
            <p class="m-auto"> No Records Found! </p>
          @endif --}}
        
  
    @endsection

    @section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#itemlist').DataTable();
    });
  
    
    
  </script>
  @endsection
