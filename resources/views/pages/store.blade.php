@extends('layout.app')
@section('content')
    <div class="store-container" style="text-align: center">
        <div class="carousel-inner py-4">
            <div class="row">
              <div class="col">
                <div class="carousel-item active">
                  <div class="container">
                    <div class="row">
                      @if (count($products)>0)
                      <section id="portfolio" class="portfolio">
                        <div class="container ">
                          <div class="row portfolio-container">
                      @foreach ($products as $item)
                      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                          <img src="/itemImages/{{$item->itemImg}}" class="img-fluid border" alt="" style="width: 490px;
                          height: 400px; ">
                          <div class="portfolio-info ">
                            <h4>{{$item->prodName}}</h4>
                            <p>Ends on: {{ Carbon\Carbon::parse($item->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</p>
                            <small style="color:white;">{{$item->prodDeets}}</small>
                            <div class="portfolio-links pt-5">
                              
                              <a href="/item/{{$item->id}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{$item->prodName}}">VIEW AUCTION</a>
                            </div>
                          </div>
                        </div>
                        <h4 class="mt-3"><b>{{$item->prodName}}</b></h4>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </section>
                      @else
                          <p>No items yet..</p>
                      @endif
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
@endsection





