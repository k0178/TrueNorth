
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel= "stylesheet" href= "\css\app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>{{$title}}</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/273827b7bf.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/img/favicon.ico">
  </head>
  <body class="">
    <div class="sticky-top">
      @guest
          @if (Route::has('login')) 
          <div class="sticky-top">
              @include('inc.userbar')
              @include('inc.navbar')
          </div>
              
          @endif
          @else
          <div class="sticky-top">
              @include('inc.userloggedbar')  
              @include('inc.navbar') 
          </div>
  </div>  
      @endguest
              
{{--       
  @guest
      @if (Route::has('login')) 
          @endif
          @else
          @include('inc.usermenu')
  @endguest --}}
  
  
<div class="justify-content-center">
  @if(Session::has('error'))
      {{-- <div class="d-flex w-100 mt-5 justify-content-center" style="background: none; margin:0%;">
          <div class="alert alert-danger alert-dismissible w-50  align-items-center d-flex">
              <div class="w-100 text-center text-danger">
                  {{Session::get('error')}}
              </div>
              <div align="right" class="">
                  <button class="close btn userloggedbtn"  data-dismiss="alert"><b class="text-danger" style="font-size: 20px;">&times;</b></button>
              </div>
          </div>
      </div> --}}
  <div class="justify-content-center w-100 d-flex mt-5">
      <div class="alert alert-danger alert-dismissible fade text-center show w-50" role="alert">
          <i class="bi bi-exclamation-circle-fill text-danger"></i>
          <strong class="text-danger">Oops.</strong> {{Session::get('error')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  </div>
  @endif

  @if(Session::has('success'))
      <div class="d-flex w-100 mt-5 justify-content-center" style="background: none; margin:0%;">
          <div class="alert alert-success alert-dismissible w-50  align-items-center d-flex" style="border-radius: 0%;">
              <div class="w-100 text-center text-success">
                  {{Session::get('success')}}
              </div>
              <div align="right" class="">
                  <button class="close btn userloggedbtn"  data-dismiss="alert"><b class="text-success" style="font-size: 20px;">&times;</b></button>
              </div>
          </div>
      </div>
  @endif
  
  @yield('content')
  
</div>

@include('inc.footer')
<script type="text/javascript">

  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  
  const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
myInput.focus()
})
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
toastTrigger.addEventListener('click', () => {
const toast = new bootstrap.Toast(toastLiveExample)

toast.show()
})
}
    
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

const alert = (message, type) => {
const wrapper = document.createElement('div')
wrapper.innerHTML = [
`<div class="alert alert-${type} alert-dismissible" role="alert">`,
`   <div>${message}</div>`,
'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
'</div>'
].join('')

alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
alertTrigger.addEventListener('click', () => {
alert('Nice, you triggered this alert message!', 'success')
})

}
/**
* Template Name: Sailor - v4.9.0
* Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
"use strict";

/**
* Easy selector helper function
*/
const select = (el, all = false) => {
el = el.trim()
if (all) {
return [...document.querySelectorAll(el)]
} else {
return document.querySelector(el)
}
}

/**
* Easy event listener function
*/
const on = (type, el, listener, all = false) => {
let selectEl = select(el, all)
if (selectEl) {
if (all) {
  selectEl.forEach(e => e.addEventListener(type, listener))
} else {
  selectEl.addEventListener(type, listener)
}
}
}

/**
* Easy on scroll event listener 
*/
const onscroll = (el, listener) => {
el.addEventListener('scroll', listener)
}

/**
* Toggle .header-scrolled class to #header when page is scrolled
*/
let selectHeader = select('#header')
if (selectHeader) {
const headerScrolled = () => {
if (window.scrollY > 100) {
  selectHeader.classList.add('header-scrolled')
} else {
  selectHeader.classList.remove('header-scrolled')
}
}
window.addEventListener('load', headerScrolled)
onscroll(document, headerScrolled)
}

/**
* Back to top button
*/
let backtotop = select('.back-to-top')
if (backtotop) {
const toggleBacktotop = () => {
if (window.scrollY > 100) {
  backtotop.classList.add('active')
} else {
  backtotop.classList.remove('active')
}
}
window.addEventListener('load', toggleBacktotop)
onscroll(document, toggleBacktotop)
}

/**
* Mobile nav toggle
*/
on('click', '.mobile-nav-toggle', function(e) {
select('#navbar').classList.toggle('navbar-mobile')
this.classList.toggle('bi-list')
this.classList.toggle('bi-x')
})

/**
* Mobile nav dropdowns activate
*/
on('click', '.navbar .dropdown > a', function(e) {
if (select('#navbar').classList.contains('navbar-mobile')) {
e.preventDefault()
this.nextElementSibling.classList.toggle('dropdown-active')
}
}, true)

/**
* Hero carousel indicators
*/
let heroCarouselIndicators = select("#hero-carousel-indicators")
let heroCarouselItems = select('#heroCarousel .carousel-item', true)

heroCarouselItems.forEach((item, index) => {
(index === 0) ?
heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>":
heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
});

/**
* Porfolio isotope and filter
*/
window.addEventListener('load', () => {
let portfolioContainer = select('.portfolio-container');
if (portfolioContainer) {
let portfolioIsotope = new Isotope(portfolioContainer, {
  itemSelector: '.portfolio-item'
});

let portfolioFilters = select('#portfolio-flters li', true);

on('click', '#portfolio-flters li', function(e) {
  e.preventDefault();
  portfolioFilters.forEach(function(el) {
    el.classList.remove('filter-active');
  });
  this.classList.add('filter-active');

  portfolioIsotope.arrange({
    filter: this.getAttribute('data-filter')
  });
}, true);
}

});

/**
* Initiate portfolio lightbox 
*/
const portfolioLightbox = GLightbox({
selector: '.portfolio-lightbox'
});

/**
* Portfolio details slider
*/
new Swiper('.portfolio-details-slider', {
speed: 400,
loop: true,
autoplay: {
delay: 5000,
disableOnInteraction: false
},
pagination: {
el: '.swiper-pagination',
type: 'bullets',
clickable: true
}
});

/**
* Initiate portfolio details lightbox 
*/
const portfolioDetailsLightbox = GLightbox({
selector: '.portfolio-details-lightbox',
width: '90%',
height: '90vh'
});

/**
* Skills animation
*/
let skilsContent = select('.skills-content');
if (skilsContent) {
new Waypoint({
element: skilsContent,
offset: '80%',
handler: function(direction) {
  let progress = select('.progress .progress-bar', true);
  progress.forEach((el) => {
    el.style.width = el.getAttribute('aria-valuenow') + '%'
  });
}
})
}

})()
const triggerTabList = document.querySelectorAll('#myTab button')
triggerTabList.forEach(triggerEl => {
const tabTrigger = new bootstrap.Tab(triggerEl)

triggerEl.addEventListener('click', event => {
event.preventDefault()
tabTrigger.show()
})
})

</script>
  </body>
</html>