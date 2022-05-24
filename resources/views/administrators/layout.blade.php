<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        body{
            background: #797878;
        }
    </style>
</head>
<body>
    @include('administrators.navigation')
    <div class="container">
        <div class="content-page border bg-white">
            @if(session()->has('notify'))
              <div class="col-lg-12">
                <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
                    <strong class="text-uppercase">[{{ session()->get('notify')['status'] }}]</strong> {{ session()->get('notify')['message'] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              </div>
              <script>
                    setTimeout(()=>{
                        $('.alert').hide();
                    },3000);
              </script>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <footer class="footer-mn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center p-2">
                        Administrator &copy; {{ date('Y') }} All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
