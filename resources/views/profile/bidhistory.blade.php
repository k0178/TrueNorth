
@extends('layout.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')

<div class="mx-3 mt-5 justify-content-center ">

    <table class="display" id="bidhistory">
        <thead>
            <tr>
                <th>ITEMS (Alphabetical Order)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>  
                        <div class="d-flex align-items-center justify-content-center">
                        <img src="/itemImages/{{$item->itemImg}} " width="130px" height="130px" 
                            style="object-fit: cover; 
                                border:3px #000000 solid; 
                                margin-top :20px;
                                margin-bottom :20px;" 
                            class="rounded-circle ">
                        <div class="pt-3 d-flex">
                            <ul style="list-style: none;">
                                <li class="d-flex"><h5><b>{{$item->prodName}}</b></h5>
                                    @if($item->winstatus == 'Won')
                                        <span class="badge text-bg-success">{{$item->winstatus}}</span>
                                    @elseif($item->winstatus == 'Lost')
                                        <span class="badge text-bg-danger">{{$item->winstatus}}</span>
                                    @elseif($item->winstatus == 'Pending')
                                        <span class="badge text-bg-warning">{{$item->winstatus}}</span>
                                    @endif
                                    
                                </li>
                                <li></li>
                                <li>Type: <b>{{$item->type}}</b></li>
                                <li>Category: <b>{{$item->category}}</b></li>
                                <li>Condition: <b>{{$item->cond}}</b></li>
                                <li>Ends on: <b>{{Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</b></li>
                            </ul>
                            <ul style="list-style: none;">
                                
                                <li>Bid Placed: <b>{{number_format($item->bidamt,2)}} PHP</b></li>
                                <li>Reference #: <b>{{$item->refnum}}</b></li>
                                <li>Placed at: <b>{{Carbon\Carbon::parse($item->created_at)->format('l, jS \of F Y (h:i:s A)')}}</b></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@section('javascripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
        $('#bidhistory').DataTable();
        });
    </script>
  @endsection
