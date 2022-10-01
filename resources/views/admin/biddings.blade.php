@extends('layout.admin')
@section('content')
    <div class="bg-white  mx-5 " style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
        <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold text-center w-100">Violated Bids</span>
        </a>
        <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Product Name</th>
                <th scope="col">Bid Placed</th>
                <th scope="col">Reference Num.</th>
                <th scope="col">Date Won</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bids as $info)
                <tr>
                <th scope="row">{{$info->uname}}</th>
                <td>{{$info->prodname}}</td>
                <td>{{number_format($info->bidamt,2)}} PHP</td>
                <td>{{$info->refnum}}</td>
                <td>{{ Carbon\Carbon::parse($info->updated_at)->toDayDateTimeString()}}</td>
            @endforeach
            </tbody>
        </table>       
        </div>
    </div>
@endsection