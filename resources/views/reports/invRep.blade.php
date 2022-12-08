@extends('layout.admin')
@section('styles')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endsection
@section('content')
  
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Item Reports</span>
  </a>

  
    <table class="table " id="inventory">
        <thead>
          <tr class="text-center">
            <th scope="col">Name</th>
            <th scope="col">Condition</th>
            <th scope="col">Category</th>
            <th scope="col">Type</th>
            <th scope="col">Starting Price</th>
            <th scope="col">Stock Left</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr>
              <td>{{$item->prodName}}</td>
              <td>{{$item->cond}}</td>
              <td>{{$item->category}}</td>
              <td>{{$item->type}}</td>
              <td>{{number_format($item->initialPrice,2)}} PHP</td>
              <td>{{$item->qty}}</td>
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
      $('#inventory').DataTable();
    });

  </script>
  @endsection