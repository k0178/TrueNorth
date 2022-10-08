@extends('layout.app')
@section('title', 'Home | True North Garments')
@section('content')

<div class="container">
  <div class="show text-center pt-4"><h2><b>TRUE NORTH GARMENTS</b></h2>
    <p><a href ="/store" style="font-size: small;">VIEW STORE</a></p>
</div>
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="5000" >
        <img src="\img\sample.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="5000" >
        <img src="\img\sample2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="500" >
        <img src="\img\sample3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  {{-- <div id="carouselExampleIndicators" class="carousel slide pb-5" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="\img\sample.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="\img\sample2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="\img\sample3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </a>
    </div> --}}
</div>
<div class="whats-new container pt-4">
  <div class="row justify-content-center align-items-center m-auto pb-4 pt-5 px-3">
    <div class ="col" style="text-align:left;">
      <a href="/store">SEE MORE</a>
    </div>`
    <div class = "col" style=" text-align:right;">
      <h3>What's New! </h3>
    </div>
  </div>
    <div
        id="carouselMultiItemExample"
        class="carousel slide carousel-dark text-center"
    >
    <div class="carousel-inner pb-3">
      <div class="carousel-item active">
        <div class="container">
          <div class="row">

@if(count($products)>0)
<section id="portfolio" class="portfolio">
  <div class="container  ">
    <div class="row portfolio-container">
  @foreach($products as $prod)

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app" >
                      
                      <div class="portfolio-wrap">
                        <img src="/itemImages/{{$prod->itemImg}}" class="img-fluid " alt="" style="width: 490px;
                        height: 400px; ">
                        
                        <div class="portfolio-info ">
                          
                          <h4>{{$prod->prodName}}</h4>
                          <p>Auction until: {{ Carbon\Carbon::parse($prod->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</p>
                          <small style="color:white;">{{$prod->prodDeets}}</small>
                          <div class="portfolio-links pt-5">
                            <a href="/item/{{$prod->id}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{$prod->prodName}}">VIEW AUCTION</a>
                          </div>
                        </div>
                      </div>
                      <h4 class="mt-3"><b>{{$prod->prodName}}</b></h4>
                      <small class="text-secondary">NEW</small>
                    </div>
                    
            {{-- </div> --}}
              @endforeach
                  </div>
                </div>
              </section>
                @else
                <p> Auctions will arrive soon. </p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


      <hr style="color: #1C1C1E; margin-left: 10%; margin-right: 10%;">
<div class="carousel slide carousel-dark text-center pb-5">
  <div class="carousel-inner pb-5">
    <div class="row">
      <div class="col">
        <div class="carousel-item active">
          <div class="container">
            <div class="row">
              <div class="row justify-content-center align-items-center m-auto pb-4 pt-5 px-3">
                <div class ="col" style="text-align:left;">
                  <h3>Hot Auctions!</h3>
                </div>
                <div class = "col" style=" text-align:right;">
                  <a href="/store">SEE MORE</a>
                </div>
              </div>

              @if(count($products)>0)
              <section id="portfolio" class="portfolio">
                <div class="container ">
                  <div class="row portfolio-container">
              @foreach($products as $prod)
              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                  <img src="/itemImages/{{$prod->itemImg}}" class="img-fluid " alt="" style="width: 490px;
                  height: 400px; ">
                  <div class="portfolio-info ">
                    <h4>{{$prod->prodName}}</h4>
                    <p>Auction until: {{ Carbon\Carbon::parse($prod->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</p>
                    <small style="color:white;">{{$prod->prodDeets}}</small>
                    <div class="portfolio-links pt-5">
                      <a href="/item/{{$prod->id}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{$prod->prodName}}">VIEW AUCTION</a>
                    </div>
                  </div>
                </div>
                <h4 class="mt-3"><b>{{$prod->prodName}}</b></h4>
                <small class="text-secondary">NEW</small>
              </div>
                    
                          @endforeach
                        </div>
                      </div>
                    </section>
                            @else
                            <p> Auctions will arrive soon. </p>
                        @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection
