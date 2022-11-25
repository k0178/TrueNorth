@extends('layout.app')
@section('content')
    @foreach ($win as $won)
        {{$won->bidamt}}
        {{$won->uname}}
        {{$won->prod_id}}
  
        <br>
    @endforeach
@endsection