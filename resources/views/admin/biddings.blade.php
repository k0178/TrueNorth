@extends('layout.admin')
@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="bg-white  mx-5 " style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
        <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold text-center w-100">Violated Bids</span>
        </a>
        <div>
        <table class="table" id="violated">
            <thead>
            <tr>
                <th >Username</th>
                <th>Product Name</th>
                <th>Bid Placed</th>
                <th>Reference Num.</th>
                <th>Date Won</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bids as $info)
                <tr>
                <th>{{$info->uname}}</th>
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

@section('javascripts')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#violated').DataTable();
    });

  </script>
  @endsection