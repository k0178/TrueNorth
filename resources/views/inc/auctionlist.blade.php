@php
    use App\Models\Biddings;  
@endphp
<div style="" class=" d-flex flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-bold text-center w-100">Auction List</span>
</div>
<div align="right" class="my-3 mx-3 d-flex align-items-center">
  <i class="bi bi-search me-3"></i>
  <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Item Name or Item ID ">
  <div class="d-flex align-items-center">
      Showing
      <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
      </div>
</div>
<div class="bg-white mb-5" style="margin:0%; width: 500px; border-right:1px #f0eeee solid; border-left:1px #f0eeee solid;">
  <div class="list-group list-group-flush border-bottom scrollarea " style="overflow:auto;">
    
    @if(count($auctions)>0)
    @foreach ($auctions as $info)
    @php
        $highest_bid = Biddings::select('bidamt')
        ->where('prod_id', $info->id)
        ->max('bidamt');
    @endphp
      <button type="button" class="btn list-group-item list-group-item-action  py-3" onclick="location.href='/admin/auction/{{$info->id}}'" aria-current="true">
        <div class="d-flex align-items-center">
          <div class="me-3">
            <img src="/itemImages/{{$info->itemImg}}" width="100px" height="100px" 
              style="object-fit: cover; border:1px #121212 solid;" 
              class="rounded-circle" >
          </div>
          <div>
            <div class="d-flex w-100 align-items-center justify-content-between">
              <strong class="mb-1">{{$info->prodName}}</strong><br>
            </div>
            <div class="col-10 mb-1 w-100 ">
              {{$info->cond}}
            </div>
            <div class="" style="">
              <div>
                  Highest Bid: <b>{{$highest_bid}}</b>
              </div>
              <div>
                Buyout Price: <b>{{$info->buyPrice}}</b>
              </div>
            </div>
          </div>
        </div>
      </button>
    @endforeach
      @else
        <p class=" text-center"> No Records Found! </p>
    @endif
  </div>
</div>