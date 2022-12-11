@extends('layout.app')
@section('content')
<div class="m-5 py-5 justify-content-center" style="background: #f0eeee;">
    <div class="d-flex ps-5 align-items-center ">
        <h3 class="w-100"><b>Policies</b> </h3>
        <div align='right' class="w-100 me-5">
            <a class="navbar-brand" href="/home">   <img src="/img/tnglogo.png" alt="" class="" width="213px" height= "73px" ></a>
        </div>
    </div>
    <div class="justify-content-center align-items-center">
        <div class="px-5 my-5">
            <p>
                Welcome to True North Auction! Below are the policies that you agreed upon your regsitration on our website. Make sure to read them and follow it accordingly. Thank you!
            </p>
        </div>
        <div  class="accordion mx-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <i class="bi bi-fingerprint me-2"></i> Privacy Policy
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="justify-content-center align-items-center w-75">
                            <div class="px-5 my-5">
                                <p> This privacy policy describes our policies about the data collection that may happen while using our system. By using our system, you have agreed to the collection and use of information in accordance with this policy. These Personal Information are then used to create accounts that is able to give access to the users.
                                </p>
                            </div>
                            <div class="px-5 my-5">
                                <h5 class="mb-3"><b>Information Collection and Use</b></h5>
                                <p> While using our system, we may ask you to register first so that we can use it to create an account for you. This registration would only ask you for your specific personal information like your Name, Address, Email Address and your Phone  Number. This is also a way to contact you if there is a problem that have occurred involving your account.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="bi bi-emoji-sunglasses-fill me-2"></i>Cookie Policy
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="justify-content-center align-items-center w-75">
                            <div class="px-5 my-5">
                                <p>The Cookie Policy explains how our system uses cookies as a means to recognize you whenever you use our system. Cookies are also a way to collect certain personal information from you and can be combined to other cookies to form as a personal information.
                    
                                </p>
                            </div>
                            <div class="px-5 my-5">
                                <h5 class="mb-3"><b>What is a Cookie?</b></h5>
                                <p>Cookies are small data files that are stored in your computer when you visit certain websites. They are mostly used to make websites work or in order to make them work efficiently and to provide report information.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="bi bi-cash-coin me-2"></i>Bidding Policy
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="px-5 my-5">
                            
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>  Upon registering, each user must pay a 1000 Philippine Peso membership fee through our system to be able to bid.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>   Each user can only bid once on a specific auction. 
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    To checkout a won auction, the checkout and delivery price must be paid through the funds of the user.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    Each user will receive a notification detailing whether they have won or lost once the auction has ended.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>     Upon bidding, if there is more than 24 hours left on the bidded item, a user may retract their bid.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    Upon retracting on an item, a user may bid once more on it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="bi bi-person-x-fill me-2"></i>Blocking Policy
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="px-5 my-5">
                            
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>  If the user has won two (2) separate auctions but has not checked out either of them, said user will receive a warning stating that they are in risk for a ban.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>   Upon three (3) non-checked out auctions won by the user, said user will be banned by the system.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    Retracting ten (10) or more times on a single item within a day will put the user at risk of a ban.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    To reappeal for an unban, kindly contact the company through their contact information located on the website.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="bi bi-piggy-bank-fill me-2"></i>Withdraw Policy
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="px-5 my-5">
                            
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>  Users are able to request for a withdrawal of funds from their account.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>  To request for a withdrawal, users must not be currently participating in any auction, must have more than 500 Philippine Pesos in their account and must not have any items in their bag.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>    Take note that users cannot specify an amount for the withdrawal. All funds will be withdrawn from their account.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>     A GCash account is required in order to process the withdrawal.
                            </p>
                            <p>
                                <i class="bi bi-x-diamond-fill me-2"></i>     After inputting the GCash number of the user, their account will be frozen and funds cannot be moved until the withdrawal is completed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection