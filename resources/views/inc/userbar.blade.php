

 


{{--     <div class="userloggedbar d-flex align-items-center justify-content-end bg-white py-2 px-4">
    <div>
        <a href="/bag/{{$username}}" class="userloggedbtn btn" style="font-size: medium;">
            <label style="font-size: 11px;">( 0 )</label>
            <i class="bi bi-bag pe-2"></i> 
        </a>
    </div>
        <div class="userloggedbar-content ">
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
        </div>
    </div>
 --}}

<div class="userloggedbar  d-flex  align-items-center justify-content-end " style="background: #f0eeee;">
 @guest
        <div class="userbar d-flex  justify-content-end  py-2">
            <div class="userbar-content">
                    @if (Route::has('login'))
                        <div class="">
                            <a class="me-2 px-2" href="/login" style="font-size:12px;"><i class="bi bi-arrow-right-short pe-1"></i></i>LOGIN</a>
                    @endif

                    @if (Route::has('register'))
                    <a class="pe-4" href="/register" style="font-size:12px;"><i class="bi bi-plus pe-1"></i>REGISTER</a> 
                    @endif 
                </div>       
            </div>
        </div> 
            @else
           
                <a class="nav-link" href="/cart/{{Auth::user()->username}}">Cart.
                    <label style="font-size: 11px;">( 0 )</label>
                    <i class="bi bi-bag pe-2"></i> 
                </a>
               
                <div class="userloggedbar bg-white d-flex align-items-center justify-content-end bg-white">
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                                @csrf
                            
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
 </div>





