@extends('layout.app')
@section('content')
<div class="m-5 py-5 justify-content-center" style="background: #f0eeee;">
    <div class="d-flex ps-5 align-items-center ">
        <h3 class="w-100"><b>Terms and Conditions</b> </h3>
        <div align='right' class="w-100 me-5">
            <a class="navbar-brand" href="/home">   <img src="/img/tnglogo.png" alt="" class="" width="213px" height= "73px" ></a>
        </div>
    </div>
    <div class="justify-content-center align-items-center w-75">
        <div class="px-5 my-5">
            <p>Welcome to True North Auctions! If you are going to use our website continuously, you are agreeing to the terms and conditions that is stated below and are also bound to follow them by any means necessary. If you disagree, please stop using our website

            </p>
        </div>
        <div class="px-5 my-5">
            <h5 class="mb-3"><b>The use of the website is subject to the following terms of use:</b></h5>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>  Users can browse through the system in order to bid for a product but they do not have access to product posting.
            </p>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>    Users must register their accounts via confirmation in their respective emails to avoid fraud accounts.
            </p>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>    Admin Users are the only one who can post products and edit certain user details in the system.
            </p>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>   Users must have atleast 1000.00 PHP worth of funds in their account to participate in biddings.
            </p>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>     As of now, the mode of payment for adding funds to your account is only PayPal. <br><a  class="fw-bold" style="font-size: 12px;" href="https://www.paypal.com/ms/webapps/mpp/what-is-paypal">Learn how to use PayPal.</a> 
            </p>
            <p>
                <i class="bi bi-x-diamond-fill me-2"></i>    Users that have won a product in an auction will have a limited time and must be paid  before the specific time given. The user will be given 2 Weeks / 14 Days to place an order for the said item.
            </p>
        </div>
    </div>
</div>
@endsection