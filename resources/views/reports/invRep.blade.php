@extends('layout.admin')
@section('content')
  
<div class="bg-white my-5 mx-5 " style=" border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-bottom:1px #f0eeee solid;border-left:1px #f0eeee solid;">
  <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      <span class="fs-5 fw-bold text-center w-100">Inventory Reports</span>
  </a>
  <div align="right" class="my-3 mx-3 d-flex align-items-center">
    <i class="bi bi-search me-3"></i>
    <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Item Name">
    <div class="d-flex align-items-center">
        Showing
        <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
        </div>
  </div>
<div class="d-flex ">
 
  <table class="table table-striped">
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
      
      </tbody>
    </table>
</div>
</div>
<script>
  $(document).ready(function(){
          fetch_inv_data();
  
          function fetch_inv_data(query = ''){
              // console.log('load data = ' + query);
              
              $.ajax({
                  url:"{{ route('invsearch')}}",
                  method:'GET',
                  data:{query:query},
                  dataType:'json',
                  success:function(data){
                      $('tbody').html(data.table_data);
                      $('#total_records').text(data.total_data);
                      
                  }
              })
          }
  
          $(document).on('keyup','#form-search',function(){
              var query  = $(this).val();
              fetch_inv_data(query);
          })
      })
    </script>
@endsection