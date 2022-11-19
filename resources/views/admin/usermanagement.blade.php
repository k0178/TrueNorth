@extends('layout.admin')
@section('content')


<div class="bg-white  mx-5 mt-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <div class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold text-center w-100">Manage Users</span>
  </div>
  <div align="right" class="my-3 mx-3 d-flex align-items-center">
    <i class="bi bi-search me-3"></i>
    <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Name or Username ">
    <div class="d-flex align-items-center">
        Showing
        <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
        </div>
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
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          {{-- @foreach ($data as $user)
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
          @endforeach --}}
        </tbody>
      </table>       
    </div>
  </div>

  <script>
    $(document).ready(function(){
            fetch_userlist_data();
    
            function fetch_userlist_data(query = ''){
                
                $.ajax({
                    url:"{{ route('usersearch')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }
    
            $(document).on('keyup','#form-search',function(){
                var query  = $(this).val();
                fetch_userlist_data(query);
            })
        })
      </script>
@endsection