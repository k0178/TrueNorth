@extends('layout.admin')
@section('content')


<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold text-center w-100">Manage Users</span>
        {{-- <form type="get" action="{{url ('/admin/usermanagement/search')}}" class="d-flex  justify-content-center align-items-center" style="float: left; position:relative;">
          <input type="search" name="search" class="search form-control mr-sm-1" step="width:200px;" placeholder="Search for Users">
          <button type = "submit" class="btn"><i class="bi bi-search"></i></button>
        </form>  --}}
  </div>
  
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
        <tbody>
          @foreach ($data as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->username}}</td>
              <td>{{$user->fname. " " .$user->lname}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->funds}}</td>
              <td>{{ Carbon\Carbon::parse($user->created_at)->isoFormat('MMM D, YYYY')}}</td>
              <td>
                {!! Form::open(['action'=>['App\Http\Controllers\UserManagementController@update',$user->id],
                'method'=>'PUT'])!!}
                {{ Form::hidden('id',$user->id) }}
                {{ Form::submit('Block User',['class' => 'btn userloggedbtn text-danger ms-5'])}}
                {!! Form::close() !!}
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>       
    </div>
  </div>
@endsection