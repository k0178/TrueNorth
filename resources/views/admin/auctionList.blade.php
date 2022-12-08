@extends('layout.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')
@include('inc.auctionlist')

 

@endsection
@section('javascripts')
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
  $(document).ready( function () {
    $('#auctionlist').DataTable();
  });

  
  
</script>
@endsection
