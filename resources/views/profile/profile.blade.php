
@extends('layout.app')

@section('content')

<div class="reg my-5">
    <div class="d-flex   py-3">
        <h3 class="px-5"><b> Your Profile</b></h3>
    </div>
    {!! Form::open(['action'=>'App\Http\Controllers\ProfileController@store',
    'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="profpic text-center mb-3">
        <img src="/userPFP/{{$data->profileImage}}" width="200px" height="200px" style="object-fit: cover; " class="rounded-circle mb-3" >
        <div class="profpic text-center mb-3">
            <h5 class="" style="text-transform: uppercase; font-weight:bold;">{{Auth::user()->username}}</h5>
            <label style="font-size: medium;">
                @if($data->user_type == 1)
                    User Type: <b>Registered User</b><br>
                    @if($data->memberpmt == 'Unpaid')
                        Membership: <b class="text-danger">{{$data->memberpmt}} Membership</b><br>
                        <button class="btn userloggedbtn mb-2">
                            <a href="/membershippay">Pay Membership</a>
                        </button>
                        @else
                        Membership: <b class="text-success">{{$data->memberpmt}} Membership</b><br>
                    @endif
                    <br>
                @endif
                @if($data->user_status == 0)
                    User Status: <b class="text-danger">Account Blocked</b> 
                    @else
                    User Status: <b class="text-success">Active</b> 
                @endif
            </label>
        </div>
    </div> 
    <div class="d-flex w-100 justify-content-center align-items-center mb-3">
        <button type="button" class= "info-btn w-25 " onclick="location.href='/profile/{{$data->username}}/edit'">Edit Profile</button> 
    </div> 

    {{-- /profile/{{$data->username}}/edit --}}
        {!! Form::close() !!}
        <fieldset disabled>
            <div class="container  my-5 ">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card ">
                            <div class="card-header">{{ __('PROFILE') }}</div>
            
                        <div class="card-body">
                                
                                    @csrf
                                    
                            <div class="row mb-3">
                                <div class="col">
                                        <label for="fname" class="col-form-label text-md-end">{{ __('First Name') }}</label>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $data->fname }}">
                                        
                                    </div>
                                </div>
    
                                <div class="col">
                                    <label for="lname" class="col-form-label text-md-end">{{ __('Last Name') }}</label>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $data->lname }}">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class=" col-form-label text-md-end">{{ __('Email Address') }}</label>
                                    <input type="text" class="form-control" value="{{ $data->email }}">
                                </div>
                                <div class="col">
                                    <label for="bday" class="col-form-label text-md-end">{{ __('Birth Date') }}</label>
                                    <input type="date" class="form-control" value="{{ $data->bday}}">

                                </div>
                                
                                <div class="col">
                                    <label for="pnum" class="col-form-label text-md-end">{{ __('Phone Number') }}</label>
                                    <div class="col">
                                        <input type="number" class="form-control" value="{{ $data->pnum }}">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="username" class="col-form-label text-md-end">{{ __('Username') }}</label>
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{ $data->username }}">
                                    </div>
                                </div>
                                        
                                    
                                <div class="w-100">
                                    <div class="row mb-4">
                                        <div class="w-75">
                                            <div class="col">
                                                <label for="address" class="  col-form-label text-md-end">{{ __('Address') }}</label>
                                                <input type="text" class="form-control" value="{{ $data->address }}">
                                            </div>
                                        </div>
                                        <div class="w-25">
                                            <div class="col">
                                                <label for="zipcode" class="col-form-label text-md-end">{{ __('Zip Code') }}</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" value="{{ $data->zipcode }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset> 
    </div>
</div>
@endsection