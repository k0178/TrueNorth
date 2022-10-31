@extends('layout.admin')
@section('content') 
<a href="/admin/list" class=" d-flex w-100 flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold text-center w-100">Item List</span>
</a>

      
          <div class="list-group list-group-flush border-bottom scrollarea " style="border-right:1px #f0eeee solid;">
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
          @endif
{{--     <div class="searchbox  pt-5">
        {!! Form::open(['action'=>'App\Http\Controllers\SearchController@search',
        'method'=>'GET']) !!} 
        {{Form::text('search','',['class'=>'form-control','style'=>'border:none; border-radius:0%;  border-bottom:1px #000000 solid;','placeholder'=>'Search'])}}
        {{Form::submit('Search',['class'=>'btn w-50 textalign-center','style'=>'border-radius:0%; color:#ffffff; background:#121212'])}} 
          {!! Form::close() !!} 
      </div> --}}
    @endsection
{{-- @extends('layout.admin')
@section('content')
<div class="">
  <a href="/admin/list" class=" text-decoration-none border-bottom">
    <span class="fs-5 fw-semibold text-center w-100">Item List</span>
  </a>
  @foreach ($data as $info)
      <div class="w-100">
        <div class="d-flex">
          <img src="/itemImages/{{$info->itemImg}}" width="100px" height="100px" 
            style="object-fit: cover; border:2px #f0eeee solid; margin:20px;" 
            class="rounded-circle ">
            <ul style="list-style: none; margin-top: auto; margin-bottom:auto;">
              <small>
                <li><b>ID:</b> {{$info->id}}</li>
                <li><b>Name:</b> {{$info->prodName}}</li>
                <li><b>Details:</b> {{$info->prodDeets}}</li>
                <li><b>Category:</b> {{$info->category}}</li>
              </small>
            </ul>
            <ul class="pe-3" style="list-style: none;  margin-top: auto; margin-bottom:auto;">
              <small >
                <li><b>Type:</b> {{$info->type}}</li>
                <li><b>Quantity:</b> {{$info->qty}}</li>
                <li><b>Starting Price:</b> {{$info->initialPrice}} PHP</li>
                <li><b>Buyout Price:</b> {{$info->buyPrice}} PHP</li> 
              </small>
            </ul>

            <div class="d-flex w-100 align-items-center">
              <div class="d-flex w-100 m-auto">
                <div>
                  <a href="list/{{$info->id}}/edit" class="userloggedbtn ms-5 px-5">Edit</a>
                </div>
                 <div>
                    {!! Form::open(['action'=>['App\Http\Controllers\itemListController@destroy',$info->id],
                   'method'=>'POST'])!!}
                    {{ Form::hidden('_method','DELETE') }}
                    {{ Form::submit('Delete',
                    ['class' => 'text-danger userloggedbtn px-5 w-100',
                     'style'=>' background:none;
                                border-right: 1px #b6b5b5 solid;
                                border-left: 1px #b6b5b5 solid;'])}}
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
                      {{ Form::submit('Post',['class' => 'btn userloggedbtn text-success ms-5'])}}
                  {!! Form::close() !!} 
                </div>
                @endif
            </div>
         </div>  
      </div>
  @endforeach
</div>
@endsection
 --}}