
<?php
    use App\Models\User;

    $username = Auth::user()->username;
    $data = User::where('username',$username)->first();
?>

{{-- <div class="userloggedbar d-flex  align-items-center border-bottom justify-content-end bg-white py-2 px-4">
        <div class="userloggedbar-content d-flex">
            <a href="/admin/messages" class="userloggedbtn btn mt-1 " style="font-size: medium;">
                <label style="font-size: 12px; " class="text-danger">( 1 )</label>
                <i class="bi bi-envelope-exclamation pe-3 "></i>
            </a>
            <div class="dropdown" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                <img src="/userPFP/{{$data->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-1" >
                <a href="/profile" class="userloggedbtn"><b>{{$username}}</b></a> 
            </div>
            <div class="dropdown-menu dropdown-menu-right my-1" style="border-radius: 0%; border:1px #f0eeee solid;  background-color:#ffffff;">
                <div class="dropdown-item">
                    <a class="userloggedbtn" href="/adminprofile">Profile</a>
                </div>
                <div class="dropdown-item">
                    <a class="btn userloggedbtn" id="open">Logout</a>
                </div>
            </div>
                
                <div class="mdl_container" id="mdl_container">
                    <div class="mdl">
                    <h5>ARE YOU SURE YOU WANT TO LOGOUT?</h5>
                    <a class="btn userloggedbtn text-danger" href="/logout" id="logout">OK</a>
                    <br>
                    <a class="btn userloggedbtn" id="close">CANCEL</a>
                    </div>
                </div> 
            </div>
        </div> --}}

<nav class="navbar " style="background: #f0eeee;" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <div class="d-flex align-items-center">
            <button class="" style="text-decoration: none;"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight">
                {{-- <span class="bi bi-three-dots-vertical"></span> --}}
                
                <img src="/userPFP/{{Auth::user()->profileImage}}" width="35px" height="35px" style="object-fit: cover;" class="rounded-circle me-1" >
                <label for="" class="fw-bold" style="font-size: 14px;">{{strtoupper(Auth::user()->username)}}</label>
            </button> 
            
            {{-- <a href="" class="mx-3" style="color: black; font-size:16px;"><i class="bi bi-bag"></i></a>       --}}
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">
                    TRUE NORTH GARMENTS | 
                    <img src="/userPFP/{{Auth::user()->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle ms-1" >
                    <label for="" style="font-size: 18px;">{{Auth::user()->username}}</label>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                
            </div>
        <div class="offcanvas-body">
            <hr>
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                @if(Auth::user()->user_type == 5)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/index">
                            <i class="bi bi-plus-square me-2"></i>ADD ITEM
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/list"><i class="bi bi-card-list me-2"></i>ITEM LIST
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/auctionlist">
                            <i class="bi bi-card-checklist me-2"></i>AUCTION LIST</a>
                    </li>
                @elseif(Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/feedback"><i class="bi bi-chat-left-heart me-2"></i>FEEDBACKS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/reports"><i class="bi bi-flag me-2"></i>REPORTS</a>
                    </li>
                @elseif(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/shippings"><i class="bi bi-truck"></i>TO SHIP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/shipped"><i class="bi bi-bookmark-check me-2"></i>SHIPPED</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/completed"><i class="bi bi-check-circle me-2"></i>COMPLETED</a>
                    </li>
                
                @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/biddings"><i class="bi bi-exclamation-circle me-2"></i>UNORDERED AUCTIONS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/refundreq"><i class="bi bi-piggy-bank me-2"></i>REFUND REQUESTS</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/usermanagement"><i class="bi bi-people me-2"></i>MANAGE USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/blockedusers"><i class="bi bi-person-x me-2"></i>BLOCKED USERS</a>
                    </li>
                @else

                @endif
                <hr>
                <li class="nav-item">
                    {{-- <a class="btn btn-dark w-100" href="/logout"><i class="bi bi-box-arrow-left me-2"></i>LOGOUT</a> --}}
                <button type="button" class="btn btn-dark w-100" style="border-radius: 0%;" onclick="location.href='/logout'"><i class="bi bi-box-arrow-left me-2 text-white"></i>LOGOUT</button>
                </li>
                
            </ul>
        </div>
        </div>
    </div>
    </div>
</nav>    



