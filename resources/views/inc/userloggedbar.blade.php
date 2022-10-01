
<?php
use App\Models\User;
use App\Http\Controllers\BagController;

$username = Auth::user()->username;
$bag_qty = BagController::bag_qty();

$data = User::where('username',$username)->first();
?>

<div class="userloggedbar d-flex  align-items-center border-bottom justify-content-end bg-white py-2 px-4">
    <div class="userloggedbar-content d-flex align-items-center">
        <a href="/messages/{{$username}}" class="userloggedbtn btn " style="font-size: medium;">
            <label style="font-size: 12px; " class="text-danger"></label>
            <i class="bi bi-envelope-exclamation pe-3 "></i>
        </a>
        <a href="/fundings" class="userloggedbtn btn align-items-center" style="font-size: medium;">
            <label style="font-size: 12px;">( {{number_format(Auth::user()->funds,2)}} PHP )</label>
            <i class="bi bi-wallet2 pe-3"></i>
        </a>
        <a href="/bag/{{$username}}" class="userloggedbtn btn" style="font-size: medium;">
            <label style="font-size: 12px;">( {{$bag_qty}} )</label>
            <i class="bi bi-bag pe-3"></i>
        </a>
        <div class="dropdown" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
            <img src="/userPFP/{{$data->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-1" >
            <a href="/profile" class="userloggedbtn"><b>{{$username}}</b></a> 
        </div>
        <div class="dropdown-menu dropdown-menu-right my-1" style="border-radius: 0%; border:1px #f0eeee solid;  background-color:#ffffff;">
            <div class="dropdown-item">
                <a class="userloggedbtn" href="/profile">Profile</a>
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
    </div>



