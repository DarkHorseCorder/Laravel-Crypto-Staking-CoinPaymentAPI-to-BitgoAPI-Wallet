<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$gs->title.'-'}}@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{getPhoto($gs->favicon)}}">
    
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/font-awsome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/components.css')}}">
    @stack('style')
    <!-- Favicon -->
</head>
<body>
     <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </section>     
    </div>
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/proper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/scripts.js')}}"></script>
    @include('notify.alert')
    
</body>
</html>