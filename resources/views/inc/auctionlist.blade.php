@php
    use App\Models\Biddings;  
@endphp

<div style="" class=" d-flex flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-bold text-center w-100">Auction List</span>
</div>

<div class="m-5">
  <table class="display" id="auctionlist">
    <thead>
      <tr>
        <th class="">ITEMS (Alphabetical Order)
          <label  class="text-success fw-bold ms-2" style="font-size:11px;">
            <i class="bi bi-info-circle-fill text-success"></i>
              Click an item to view more details.
          </label>
        </th>
        
      </tr>
      
    </thead>
    <tbody>
    
      @foreach ($auctions as $info)
      @php
          $highest_bid = Biddings::select('bidamt')
          ->where('prod_id', $info->id)
          ->max('bidamt');
      @endphp
      
      <tr>
        <td>
          <button type="button" class="btn list-group-item list-group-item-action  py-3" onclick="location.href='/admin/auction/{{$info->id}}'" aria-current="true">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <img src="/itemImages/{{$info->itemImg}}" width="100px" height="100px" 
                  style="object-fit: cover; border:1px #121212 solid;" 
                  class="rounded-circle" >
              </div>
              <div>
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <h3 class="mb-1 text-dark">{{$info->prodName}}</h3>
                  <span class="badge rounded-pill text-bg-warning">{{$info->cond}}</span>
                </div>
                
                <div class="" style="">
                  <div>
                      Highest Bid: <b>{{number_format($highest_bid,2)}} PHP</b>
                  </div>
                  <div>
                    Date Added: <b>{{$info->created_at}}</b>
                </div>
                </div>
              </div>
            </div>
          </button>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
</div>

    
  
