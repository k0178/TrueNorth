@extends('layout.admin')
@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')

<div class="bg-white mx-5" style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold text-center w-100">Blocked Users</span>
    </a>
    <div>
      <table class="table" id="blocked">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>Funds</th>
            <th>Account Created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody >
         
          @foreach ($data as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->fname. " " .$user->lname}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->funds}}</td>
              <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat('MMM D, YYYY')}}</td>
              <td>
                
                <div class="d-flex">
                  
                    {!! Form::open(['action'=>['App\Http\Controllers\BlockedUsersController@update',$user->id],
                  'method'=>'PUT'])!!}
                  {{ Form::hidden('id',$user->id) }}
                  <i class="bi bi-person-lock"></i>
                  {{ Form::submit('Unblock Account',['class' => 'btn userloggedbtn text-success'])}}
                  {!! Form::close() !!}

                  {!! Form::open(['action'=>['App\Http\Controllers\BlockedUsersController@destroy',$user->id],
                  'method'=>'DELETE'])!!}
                  {{ Form::hidden('id',$user->id) }}
                  {{ Form::submit('Delete Account',['class' => 'btn userloggedbtn text-danger mx-4'])}}
                  {!! Form::close() !!}
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
      $('#blocked').DataTable();
    });

  </script>
  @endsection