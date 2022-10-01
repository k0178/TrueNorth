@if (count($errors)>0)
    @foreach ($errors->all() as $error)
    <div class="alert mt-4 w-25" style="color:#9e464e; text-align:center; border-radius:0%; border-style:solid; border-color:#9e464e; border-width:2px; margin:auto;">
        {{$error}}
    </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert mt-4 w-25" style="color:#798a6d; text-align:center; border-radius:0%; border-style:solid; border-color:#a9ba9d; border-width:2px; margin:auto;">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert mt-4 w-25" style="color:#9e464e; text-align:center; border-radius:0%; border-style:solid; border-color:#9e464e; border-width:2px; margin:auto;">
        {{session('error')}}
    </div>   
@endif