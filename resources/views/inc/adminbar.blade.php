
<?php
    use App\Models\User;

    $username = Auth::user()->username;
    $data = User::where('username',$username)->first();
?>

<div class="userloggedbar d-flex  align-items-center border-bottom justify-content-end bg-white py-2 px-4">
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
        </div>



