@extends('layout.admin')
@section('content')
  
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Inventory Reports</span>
  </a>
<div class="d-flex ">
  <table class="table table-striped">
      <thead>
        <tr class="text-center">
          <th scope="col">Name</th>
          <th scope="col">Condition</th>
          <th scope="col">Category</th>
          <th scope="col">Type</th>
          <th scope="col">Starting Price</th>
          <th scope="col">Buy Price</th>
          <th scope="col">Stock Left</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $rep)
          <tr class="text-center">
              <th scope = "row">{{$rep->prodName}}</th>
              <td>{{$rep->cond}}</td>
              <td>{{$rep->category}}</td>
              <td>{{$rep->type}}</td>
              <td>{{$rep->initialPrice}}</td>
              <td>{{$rep->buyPrice}}</td>
              <td>{{$rep->qty}}</td>
            </tr>
          @endforeach
      </tbody>
    </table>
</div>
</div>
@endsection