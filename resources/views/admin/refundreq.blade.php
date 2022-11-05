@extends('layout.admin')

@section('content')
<div class="bg-white  mx-5 " style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-semibold text-center w-100">Refund Requests</span>
    </a>
    <div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">Amount</th>
            <th scope="col">Gcash Number</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $rf)
            <tr>
            <th>{{$rf->id}}</th>
            <td>{{$rf->uname}}</td>
            <td>{{$rf->amount}}</td>
            <td>{{$rf->gcashnum}}</td>

            @if ($rf->status!="pending")

                @if ($rf->status=="Refunded")
                    <td class="text-info">{{$rf->status}}</td>
                @endif      
                @if ($rf->status=="Denied")
                <td class="text-danger">{{$rf->status}}</td>
                @endif          
            @else

            {!! Form::open(['action'=>['App\Http\Controllers\RefundController@update',$rf->id],
            'method'=>'PUT'])!!}

            

            <td>{{Form::radio('apr','Refunded',[
                ])}} <small class="text-info">Mark as Refunded</small></td>
                <td> {{Form::radio('apr','Denied',[
                ])}} <small class="text-danger">Deny</small></td>
                 <td>
                    {{Form::textArea('refundmsg','We have Refunded PHP '.$rf->amount.'.00 to your Gcash Account:'.$rf->gcashnum.'. Ref No:',
                    ['class'=>'form-control',
                    'style'=>'height:50px;'
                    ])}}
    
                </td>
                <td>
                {{ Form::hidden('uname',$rf->uname) }}
                {{ Form::hidden('amt',$rf->amount) }}
                {{ Form::hidden('uid',$rf->uid) }}
                {{ Form::hidden('email',$rf->email) }}

                {{ Form::submit('SUBMIT',['class' => 'btn '])}}
                </td>
                {!! Form::close() !!}
            @endif

           
          
            </tr>
        @endforeach
            
        </tbody>
    </table>       
    </div>
</div>
@endsection