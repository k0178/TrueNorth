@extends('layout.admin')
@section('content')

<div class="bg-white mx-5" style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold text-center w-100">Blocked Users</span>
    </a>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Funds</th>
            <th scope="col">Account Created at</th>
          </tr>
        </thead>
        <tbody >
          @if(count($data)>0)
          @foreach ($data as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->username}}</td>
              <td>{{$user->fname. " " .$user->lname}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->funds}}</td>
              <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat('MMM D, YYYY')}}</td>
              <td>
                {!! Form::open(['action'=>['App\Http\Controllers\BlockedUsersController@update',$user->id],
                'method'=>'PUT'])!!}
                {{ Form::hidden('id',$user->id) }}
                {{ Form::submit('Unblock Account',['class' => 'btn userloggedbtn text-success ms-3'])}}
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(['action'=>['App\Http\Controllers\BlockedUsersController@destroy',$user->id],
                'method'=>'DELETE'])!!}
                {{ Form::hidden('id',$user->id) }}
                {{ Form::submit('Delete Account',['class' => 'btn userloggedbtn text-danger mx-4'])}}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          @else
            <tr>
              <td class="text-center" colspan="7">No Records Found</td>
            </tr>
          @endif
        </tbody>
      </table>       
    </div>
  </div>
@endsection