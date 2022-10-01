@extends('layout.app')
@section('content')
      
<div class="border mx-5 mb-5 mt-4 ">
    <div class="d-flex  flex-shrink-0 p-3 align-items-center  link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold  w-100">Messages</span>
    </div>
    <div>
        {!! Form::open(['action'=>['App\Http\Controllers\MessagesController@store'],
        'method'=>'POST']) !!} 
        {!! Form::text('message', '', ['class' => 'form-control', 'style' => 'background:none; ; border-radius:0%; border:none;','placeholder' => 'Enter your message here.', 'required '] )!!}
      
        {!! Form::close() !!}
    </div>

    <div class=" mb-5" style="overflow-y:scroll; height:40vh; margin:0%;  border-right:1px #f0eeee solid; border-left:1px #f0eeee solid;">
        @foreach($messages as $message)
            <div class="list-group p-3 list-group-flush border-bottom d-flex " style="border-right:1px#dddddd solid;">
                <div class="ms-1 mb-2">
                    <img src="/userPFP/{{Auth::user()->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-1" >
                    
                    <b><label for="" style="font-size: 16px;">You</label></b>
                    <small class="userloggedbtn ps-2 text-success"><i class="bi bi-send-check text-success"></i> {{$message->created_at}}
                    </small> 
                    {{-- {!! Form::open(['action'=>['App\Http\Controllers\MessagesController@destroy',$message->id],
                    'method'=>'DELETE']) !!} 
                        <button type = "button" class="btn" >
                            <i class="bi bi-envelope-dash ms-1 text-danger"></i>
                        </button>
                    {!! Form::close() !!} --}}
                </div>
                
                {!! Form::textarea('message', $message->message, ['rows' => '3', 'cols' => '25','class' => ' form-control ', 'style' => ' background:none; border; font-size: 16px;', 'disabled']) !!}
                
            </div>
        @endforeach
    </div>
   
</div>


@endsection