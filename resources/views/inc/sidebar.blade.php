@extends('layout.sidebar')

<div class="flex-shrink-0 p-3" style="width: 200px;">
  <a class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 px-3 fw-semibold">Menu</span>
  </a>
  <ul class="list-unstyled ps-0">
    <li class="mb-1">
      <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
        Men 
      </button>
     
      <div class="collapse" id="home-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="link-dark rounded">Tees</a></li>
          <li><a href="#" class="link-dark rounded">Pants</a></li>
          <li><a href="#" class="link-dark rounded">Shorts</a></li>
          <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
            Shoes 
          </button>
          <div class="collapse" id="orders-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="#" class="link-dark rounded">Sneakers</a></li>
            </ul>
          </div>
        </ul>
       
      </div>
    </li>

       <li class="mb-1">
      <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
        Women 
      </button>
     
      <div class="collapse" id="home-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="link-dark rounded">Tees</a></li>
          <li><a href="#" class="link-dark rounded">Pants</a></li>
          <li><a href="#" class="link-dark rounded">Shorts</a></li>
        </ul>
      </div>
    </li>
    <li class="mb-1">
      <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
        Accessories
      </button>
      <div class="collapse" id="orders-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="link-dark rounded">New</a></li>
          <li><a href="#" class="link-dark rounded">Processed</a></li>
          <li><a href="#" class="link-dark rounded">Shipped</a></li>
          <li><a href="#" class="link-dark rounded">Returned</a></li>
        </ul>
      </div>
    </li>
    <li class="border-top my-3"></li>
    <li class="mb-1">
      <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
        Account
      </button>
      <div class="collapse" id="account-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="link-dark rounded">Profile</a></li>
        </ul>
      </div>
    </li>
  </ul>
</div>


