@php
    use App\Models\Biddings;  
@endphp
<a href="/admin/auctionlist" style="margin-top: 150px;" class=" border d-flex flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-bold text-center w-100">Auction List</span>
</a>
<div class="bg-white mb-5" style="margin:0%; width: 500px; border-right:1px #f0eeee solid; border-left:1px #f0eeee solid;">
  <div class="list-group list-group-flush border-bottom scrollarea " style="overflow:auto;">
    
    @if(count($auctions)>0)
    @foreach ($auctions as $info)
    @php
        $highest_bid = Biddings::select('bidamt')
        ->where('prod_id', $info->id)
        ->max('bidamt');
    @endphp
      <a href="/admin/auction/{{$info->id}}" class="list-group-item list-group-item-action  py-3" aria-current="true">
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
      </a>
    @endforeach
      @else
        <p class="m-auto"> No Records Found! </p>
    @endif
  </div>
</div>