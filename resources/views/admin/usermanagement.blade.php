@php
  use App\Models\Biddings;   
@endphp
@extends('layout.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')


<div class="bg-white  mx-5 mt-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold text-center w-100">Manage Users</span>
  </div>

    <div>
      <table class="display " id="users">
        <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Funds</th>
            <th scope="col">Account Created at</th>
            <th scope="col">Total Retractions</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->username}}</td>
              <td>{{$user->fname. " " .$user->lname}}</td>
              <td>{{$user->address}}</td>
              <td>{{number_format($user->funds,2)}} PHP</td>
              <td>{{$user->created_at}}</td>
              @php
              $retract_count = Biddings::where('retractstat', 1)
                                        ->where('user_id', $user->id)
                                        ->count();
              @endphp
              <td>{{$retract_count}}</td>
              @if($retract_count >= 10)
                <td>
                  {!! Form::open(['action'=>['App\Http\Controllers\UserManagementController@update',$user->id],
                  'method'=>'PUT'])!!}
                  {{ Form::hidden('id',$user->id) }}
                  {{ Form::submit('Block User',['class' => 'btn userloggedbtn text-danger'])}}
                  {!! Form::close() !!}
                </td>
              @else
                <td> </td>
              @endif
            
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
      $('#users').DataTable();
    });

  </script>
  @endsection