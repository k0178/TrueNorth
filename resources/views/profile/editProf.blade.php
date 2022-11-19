@extends('layout.app')
@section('content')
<div class="reg my-5">  
    <div class="d-flex ms-2  pt-3">
        <h2 class="px-5"><b> Edit Your Profile</b></h2>
    </div>
        <div class="py-1 text-center">
            {!! Form::open(['action'=>['App\Http\Controllers\imgController@upload'],
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!} 
            <div class="profpic text-center mb-3">
                <img src="/userPFP/{{$data->profileImage}}" width="200px" height="200px" style="object-fit: cover; " class="rounded-circle mb-3" >
                <h5 class="" style="text-transform: uppercase; font-weight:bold;">{{Auth::user()->username}}</h5>
                <label style="font-size: small;">
                    @if($data->user_type == 1)
                        User Type: <b>Registered User</b><br>
                    @endif
                    @if($data->user_status == 0)
                        User Status: <b class="text-danger">Account Blocked</b> 
                        @else
                        User Status: <b class="text-success">Active</b> 
                    @endif
                </label>
            </div>
            <small>Upload Profile Picture</small> 
            <div class="text-center pb-4 d-flex align-items-center justify-content-center">
                    {{Form::file('pfpImg',['class'=>'form-control w-25 me-3','id'=>'pfpImg'])}}
               
                    {{-- {{Form::submit('SAVE',['class'=>'userloggedbtn px-3 py-1'])}}  --}}
                    <button type="submit" class="form-btn">SAVE PICTURE</button>
                    {!! Form::close() !!}
               
            </div>
        </div>

        <div class="container  pb-5 ">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">{{ __('PROFILE') }}</div>
                        <div class="card-body">
                                @csrf
                                <fieldset disabled>
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
                                        <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($data->bday)->isoFormat('Y-m-d') }}">
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
                                </fieldset>
                                {!! Form::open(['action'=>['App\Http\Controllers\ProfileController@update',$data->id],
                                    'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
                                
                                <div class="w-100">
                                    <div class="row mb-4">
                                        <div class="w-75">
                                            <div class="col">
                                                <label for="address" class="  col-form-label text-md-end">{{ __('Address') }}</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ $data->address }}">
                                            </div>
                                        </div>
                                        <div class="w-25">
                                            <div class="col">
                                                <label for="zipcode" class="col-form-label text-md-end">{{ __('Zip Code') }}</label>
                                                <div class="col">
                                                    <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ $data->zipcode }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
{{--                                     
                                    {{ Form::submit('SAVE PROFILE',['class'=>'btn btn-dark my-3 w-50 ',
                                    'style' => 'border-radius:0%;'
                                    ]) }} --}}
                                    <button type="submit" class="form-btn mb-3 w-50">SAVE PROFILE</button>
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        
    @endsection