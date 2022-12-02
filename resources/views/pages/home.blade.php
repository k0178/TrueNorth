@extends('layout.app')
@section('title', 'Home | True North Garments')
@section('content')


  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    
    <div class="carousel-indicators">
      <button type="" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active " aria-current="true" aria-label="Slide 1"></button>
      <button type="" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="5000" >
        <img src="\img\Default.png" class="d-block w-100" alt="..." style=" filter:blur(3px);">
        <span style=" position: absolute; top: 200px; left: 200px;">
          @if(Auth::check())
            <h1 class="text-white fw-bold me-5 pe-3" style="font-size: 45px !important;">Welcome to <br> True North Auction,<br> <label for="" style="color: #E7BB41;">{{Auth::user()->username}}</label> .</h1> <br>
            <button class="form-btn  fw-bold" onclick="location.href='/store'" style="font-size: 16px;">
              VIEW OUR AUCTIONS
            </button>
          @else
          <h1 class="text-white fw-bold me-5 pe-3" style="font-size: 60px !important;">Welcome to <br><label for="" style="color: #E7BB41;">True North Auction.</label> </h1> <br>
            <button class="form-btn text-dark fw-bold ms-2" onclick="location.href='/store'" style="font-size: 16px;   ">
              VIEW OUR AUCTIONS
            </button>
          @endif
        </span>
        {{-- <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div> --}}
      </div>

      <div class="carousel-item" data-bs-interval="5000" >
        <img src="\img\PreLoved.png" class="d-block w-100" alt="..." >
        <span style=" position: absolute; top: 200px; left: 200px;">
            <h1 style="font-weight: bold; color:#fff; font-size:60px;">True North Auction</h1>
        </span>
        <div class="carousel-caption d-none d-md-block">
          <h5>TRUE NORTH AUCTIONS</h5>
          <p>Bid on Brand-New or Pre-Loved Apparel Products.</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="500" >
        <img src="\img\Bulk.png" class="d-block w-100" alt="..." >
        <span style=" position: absolute; top: 200px; left: 200px;">
          <h1 style="font-weight: bold; color:#fff; font-size:60px;">True North Auction</h1>
      </span>
        <div class="carousel-caption d-none d-md-block">
          <h5>TRUE NORTH AUCTIONS</h5>
          <p>Bid on Bulk Apparel Products.</p>
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
<div class="container mt-5">
<div class="whats-new container pt-4">
  <div class="row justify-content-center align-items-center m-auto pb-4 pt-5 px-3">
    <div class = "col" style=" text-align:left;">
      <h3><b>What's New!</b>  </h3>
    </div>
    <div class ="col" style="text-align:right;">
      <a href="/store">SEE MORE</a>
    </div>`
    
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
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app" style="text-align: left !important;">
                      <div class="portfolio-wrap">
                        <img src="/itemImages/{{$prod->itemImg}}" class="img-fluid " alt="" style="width: 490px;
                        height: 400px; ">
                        <div class="portfolio-info ">
                          <h4>{{$prod->prodName}}</h4>
                          <p>Auction until: {{ Carbon\Carbon::parse($prod->endDate)->isoFormat('MMM D, YYYY')}} (11:59 PM)</p>
                          {{-- <small style="color:white;">{{$prod->prodDeets}}</small> --}}
                          <div class="portfolio-links pt-5">
                            <a href="/item/{{$prod->id}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{$prod->prodName}}">VIEW AUCTION</a>
                          </div>
                        </div>
                      </div>
                      <div class="px-2 py-3 ">
                        <h5 class="text-dark fw-bold my-2">{{$prod->prodName}}<span class="badge " style="background: #E7BB41; font-size:12px;">{{$prod->cond}}</span></h6>
                        <label style="font-size: 12px;">BID STARTS AT: <label for="" class="fw-bold">{{number_format($prod->initialPrice,2)}} PHP</label> </label> 
                      </div>
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
                  <h3><b>Hot Auctions!</b></h3>
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
