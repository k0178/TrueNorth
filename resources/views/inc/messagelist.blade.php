@php
    use App\Models\Messages;
@endphp
<div class="border mx-5 mb-5  " style="margin-top: 150px;">
    <div class="d-flex  flex-shrink-0 p-3 r  link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold  w-100">Messages</span>
    </div>
    {{-- @foreach($users as $user)
    <div class="">
     {{$user->username}}

    </div>
   
    <br>
    @endforeach --}}


<div class="bg-white mb-5" style="margin:0%; width: 400px; border-right:1px #f0eeee solid; border-left:1px #f0eeee solid;">
  <div class="list-grouplist-group-flush border-bottom scrollarea " style="overflow:auto;">
    
    @if(count($users)>0)
    @foreach ($users as $user)

        <a href="/admin/messages/{{$user->id}}" class="px-3 list-group-item list-group-item-action  py-3" aria-current="true">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="/userPFP/{{$user->profileImage}}" width="30px" height="30px" style="object-fit: cover;" class="rounded-circle me-1" >
                </div>
                <label for="" class="fw-bold me-2" style="font-size: 16px;">{{$user->username}}</label>
                <label for="" class="">{{$user->fname. ' '. $user->lname}}</label>
                @php
                      $latest_msg = Messages::select('*')
                                            ->where('user_id',$user->id)
                                            ->orderBy('created_at','DESC')
                                            ->first();
                @endphp
            </div>
            <div class="d-flex mt-2 align-items-center">
                <label for="" class="me-2" style="font-size: 16px;">{{$latest_msg->message}} </label>
                <label for="" class="text-secondary">- {{$latest_msg->created_at}} </label>
            </div>
            
            
        </a>
        @endforeach
        @else
            <p class="m-auto"> No Messages </p>
        @endif
    </div>
    </div>
</div>