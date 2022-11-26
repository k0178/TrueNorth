@extends('layout.app')
@section('content')
<div class="m-5 py-5 justify-content-center" style="background: #f0eeee;">
    <div class="d-flex ps-5 align-items-center ">
        <h3 class="w-100"><b> Frequently Asked Questions (FAQs)</b> </h3>
        <div align='right' class="w-100 me-5">
            <a class="navbar-brand" href="/home">   <img src="/img/tnglogo.png" alt="" class="" width="213px" height= "73px" ></a>
        </div>
    </div>
    <div class="justify-content-center align-items-center w-75">
        <div class="px-5 my-5">
            <h5 class="mb-3"><i class="bi bi-x-diamond-fill me-2"></i><b>How can I participate in Bidding?</b></h5>
            <p>To participate, you must register first. Your account will be activated if you have received the confirmation in your email. Once you have accepted the confirmation, your account can now be used. You must also have a certain balance in your account in order to participate. Login with your account and then start looking for the products you want to bid. If you have chosen an auction to participate, you can click it and it will direct you to the product page. You can now enter the amount you want to bid and submit it.
            </p>
        </div>

        <div class="ps-5 my-5">
            <h5 class="mb-3"><i class="bi bi-x-diamond-fill me-2"></i><b>How will I know if I have won the bid?</b></h5>
            <p>All the Won bids will appear on your Biddings Page once you have won the product in the auction. A limited time will be put on your winning and it means that you need to place an order for the product before the given date. Once you placed an order, it will be delivered to your address that you have filled up in the registration step.
            </p>
        </div>

        <div class="ps-5 my-5" >
            <h5 class="mb-3"><i class="bi bi-x-diamond-fill me-2"></i><b>How to add funds on my account?</b></h5>
            <p> A user must pay a minimum 1000.00 php as a membership fee through Gcash or Paypal. Once paid, the admin must approve whether they paid correctly. Once approved, the user can now request for a fund in there account via Gcash or Paypal. Afterwards, the membership fee is now added to their funds. Users who did not paid the membership fee can only view the auction but cannot participate.
            </p>
        </div>
    </div>
</div>
@endsection