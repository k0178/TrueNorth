@extends('layout.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="bg-white  mx-5 " style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-semibold text-center w-100">Withdraw Requests</span>
    </a>
    <div>
    <table class="display " id="wdraw">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Amount</th>
                <th>Gcash Number</th>
                <th>Status</th>
                <th>Date Requested</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $rf)
            <tr>
                <td>{{$rf->id}}</td>
                <td>{{$rf->uname}}</td>
                <td>{{number_format($rf->amount,2)}} PHP</td>
                <td>{{$rf->gcashnum}}</td>
                <td>
                    @if($rf->status != "pending")
                        @if ($rf->status=="Refunded")
                            <label for="" class="text-success">{{$rf->status}}</label>
                        @elseif ($rf->status=="Denied")
                            <label for="" class="text-danger">{{$rf->status}}</label>
                        @endif   
                    @else
                        <div class=" justify-content-center">
                            <div align="center">
                                {{Form::radio('apr','Refunded',[
                                    ])}} <small class="text-success fw-bold me-3">Mark as Refunded</small>
                                {{Form::radio('apr','Denied',[
                                        ])}} <small class="text-danger fw-bold">Deny</small><br>
                            </div>
                            {!! Form::open(['action'=>['App\Http\Controllers\RefundController@update',$rf->id],
                            'method'=>'PUT','enctype'=>'multipart/form-data'])!!}
                                
                                <label for="" style="font-size: 11px;">Enter Message:</label>
                                {{Form::textArea('refundmsg','We have Refunded PHP '.number_format($rf->amount,2).'PHP to your Gcash Account:'.$rf->gcashnum.'. Ref No:',
                                                ['class'=>'form-control mb-3',
                                                'style'=>'height:50px;'
                                                ])}}
                                @method('put')
                                <label for="" style="font-size: 11px;">Add Attachment(jpg, png, jpeg, etc.):</label>
                                    {{Form::file('img',['class'=>'form-control mb-3','required'])}} 
                        
                                    {{ Form::hidden('uname',$rf->uname) }}
                                    {{ Form::hidden('amt',$rf->amount) }}
                                    {{ Form::hidden('uid',$rf->uid) }}
                                    {{ Form::hidden('email',$rf->email) }}
                                    {{ Form::submit('SUBMIT',['class' => 'form-btn mt-2 w-100'])}}   
                        </div>
                        {!! Form::close() !!}
                    @endif

                
                </td>
                <td>{{$rf->created_at}}</td>
                
            </tr>
            {{-- <tr>
                <td>{{$rf->id}}</td>
                <td>{{$rf->uname}}</td>
                <td>{{number_format($rf->amount,2)}} PHP</td>
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
            'method'=>'PUT','enctype'=>'multipart/form-data'])!!}

            <td>
                {{Form::radio('apr','Refunded',[
                ])}} <small class="text-info">Mark as Refunded</small>
                {{Form::radio('apr','Denied',[
                    ])}} <small class="text-danger">Deny</small> 
                
                {{Form::textArea('refundmsg','We have Refunded PHP '.number_format($rf->amount,2).'PHP to your Gcash Account:'.$rf->gcashnum.'. Ref No:',
                ['class'=>'form-control',
                'style'=>'height:50px;'
                ])}}
                @method('put')
                            {{Form::file('img',['class'=>'form-control w-75'])}} 
                
                            {{ Form::hidden('uname',$rf->uname) }}
                    {{ Form::hidden('amt',$rf->amount) }}
                    {{ Form::hidden('uid',$rf->uid) }}
                    {{ Form::hidden('email',$rf->email) }}

                    {{ Form::submit('SUBMIT',['class' => 'btn '])}} 
                {!! Form::close() !!}
            </td>
            @endif
            </tr> --}}
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
            $('#wdraw').DataTable();
        });

    </script>
@endsection