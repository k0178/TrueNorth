@extends('layout.admin')
@section('content')
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-semibold text-center w-100">To Pay</span>
  </a>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Amount</th>
          <th scope="col">Type</th>
          <th scope="col">Reference Num.</th>
          <th scope="col">Date</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $info)
          <tr>
            <th scope="row">{{$info->uname}}</th>
            <td>{{number_format($info->amount,2)}} PHP</td>
            <td>{{$info->type}}</td>
            <td>{{$info->refnum}}</td>
            <td>{{ Carbon\Carbon::parse($info->created_at)->toDayDateTimeString()}}</td>
            @if($info->status == "Pending")
              <td class="text-warning">{{$info->status}}</td>
            @elseif($info->status =="Approved")
              <td class="text-success">{{$info->status}}</td>
            @elseif($info->status =="Denied")
              <td class="text-danger">{{$info->status}}</td>
            @endif
            <td>
              @if ($info->status == "Pending")
              {!! Form::open(['action'=>['App\Http\Controllers\ToPayController@update',$info->id],
              'method'=>'POST'])!!}

                  {{ Form::hidden('uname',$info->uname) }}
                  {{ Form::hidden('amt',$info->amount) }}
                  {{ Form::hidden('id',$info->id) }}

                  
                  {{ Form::submit('Approve',['class' => 'btn userloggedbtn text-success'])}}
              {!! Form::close() !!}
              @else
                ----
              @endif
              </td>
            <td>
              @if ($info->status == "Pending")
              {!! Form::open(['action'=>['App\Http\Controllers\ToPayController@deny',$info->id],
              'method'=>'POST'])!!}

                  {{ Form::hidden('uname',$info->uname) }}
                  {{ Form::hidden('amt',$info->amount) }}
                  {{ Form::hidden('id',$info->id) }}
                  
                  {{ Form::submit('Deny',['class' => 'btn userloggedbtn text-danger'])}}
                  {!! Form::close() !!}
              @else
                ----
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>       
  </div>
</div>
<div class="justify-content-center  w-100 d-flex ">{{$data->links()}}</div>
@endsection