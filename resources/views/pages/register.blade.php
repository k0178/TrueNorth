@extends('layout.app')
    @section('content')
    
   
    {!! Form::open(['action'=>'App\Http\Controllers\UsersController@store',
    'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="reg mt-5">
        <div class="d-flex ms-2 mt-5 ">
            <h2 class="px-5"><b> CREATE YOUR ACCOUNT </b></h2>
        </div>

        <div class="my-3 px-3" style="width: 500px; margin-left:70px" >
            <div class="py-1">
                <img src="" width="150px" height="150px" >
            </div>
            <br>
                <div class="up-photo" style="padding-top: 5px; ">
                   <h4> <label for="uploadpic">Upload Profile Photo</label></h4>
                    {{Form::file('pfpImg',['class'=>'form-control'])}}
                </div>
          </div>


        <div class="reg-content">
            <div class="col-5">
                <div class="row ms-2">
                    {{Form::label('first name','First Name',['class'=>'lead text-dark'])}}
                    {{Form::text('fname','',['class'=>'form-control','placeholder'=>'First Name'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('last name','Last Name',['class'=>'lead text-dark'])}}
                    {{Form::text('lname','',['class'=>'form-control','placeholder'=>'Last Name'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('email address','Email Address',['class'=>'lead text-dark'])}}
                    {{Form::email('email','',['class'=>'form-control','placeholder'=>'Email Address'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('phone num','Phone Number',['class'=>'lead text-dark'])}}
                    {{Form::text('pnum','',['class'=>'form-control','placeholder'=>'Phone Number'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('address','Address',['class'=>'lead text-dark'])}}
                    {{Form::text('add','',['class'=>'form-control','placeholder'=>'Address'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('zipcode','Zip Code',['class'=>'lead text-dark'])}}
                    {{Form::number('zipcode','',['class'=>'form-control','placeholder'=>'Zip Code'])}}
                </div>
            </div>

            <div class="col-5 ms-5 pe-5">
                <div class="row ms-2">
                    {{Form::label('uname','User Name',['class'=>'lead text-dark'])}}
                    {{Form::text('uname','',['class'=>'form-control','placeholder'=>'User Name'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('pword','Password',['class'=>'lead text-dark'])}}
                    {{Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}
                </div>
                <div class="row ms-2">
                    {{Form::label('cpword','Confirm Password',['class'=>'lead text-dark'])}}
                    {{Form::password('confPassword',['class'=>'form-control','placeholder'=>'Confirm Password'])}}
                </div>
                <div class="row ms-2 justify-content-around">
                    <label class="lead text-dark"> Birthday </label>
                        <div class="col">
                            {{Form::number('month','',['class'=>'form-control','placeholder'=>'MM'])}}
                        </div>
                        <div class="col">
                            {{Form::number('day','',['class'=>'form-control','placeholder'=>'DD'])}}
                        </div>
                        <div class="col">
                            {{Form::number('year','',['class'=>'form-control','placeholder'=>'YYYY'])}}
                        </div>
                    <div class="reg-button">
                        <div class="row mt-5 pt-5 justify-content-end">
                            {{Form::submit('REGISTER',['class'=>'btn btn-dark w-75 textalign-center'])}}
                        </div>
                    </div>
                </div>
             {!! Form::close() !!}
            </div>
        </div>
    </div>

        
    @endsection