<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel= "stylesheet" href= "\css\style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <title>{{$title}}</title> 
</head>
<body>
    <div class="fixed-top">
        @include('inc.adminbar')
        @include('inc.adminNav')
    </div>  

    <div class="sidenav">
        @guest
            @if (Route::has('login'))
            @endif
                @else
                @include('inc.adminSidebar') 
            @endguest
    </div>

    <div class="main " style="margin-top: 100px;">
        @if(Session::has('error'))
            <div class="d-flex w-100 mt-3 justify-content-center" style="background: none; margin:0%;">
                <div class="alert alert-danger w-50 text-center">
                    {{Session::get('error')}}
                </div>
            </div>
        @endif

        @if(Session::has('success'))
            <div class="d-flex w-100 mt-3 justify-content-center" style="background: none; margin:0%;">
                <div class="alert alert-success w-50 text-center">
                    {{Session::get('success')}}
                </div>
            </div>
        @endif
        @yield('content')
        @include('inc.footer')
    </div>


  

    <script src="\js\modals.js"></script>

    <script>
        
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    
</body>
</html>
