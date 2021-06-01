<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('other.seo')
    <title>{{__($gs->title)}}-@yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/animate.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/lightbox.min.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/odometer.css"/>
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/owl.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/main.css">
    <link href="{{asset('assets/frontend/css/main.php')}}?color={{$gs->theme_color}}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{getPhoto($gs->favicon)}}">
    @stack('style')
</head>
<body>
    @php
       $bg = @json_decode(DB::table('site_contents')->where('slug','banner')->first()->content)->image;
    @endphp
    <div class="overlayer"></div>

     @include('frontend.partials.header')

     @if (!request()->routeIs('front.index'))
        <!-- Hero -->
        <section class="banner-section bg_img" data-img="{{getPhoto($bg)}}">
            <div class="banner-overlay bg--gradient">&nbsp;</div>
            <div class="container">
                <div class="hero-text">
                    <h2 class="hero-text-title">@yield('title')</h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{url('/')}}">@langg('Home')</a>
                        </li>
                        <li>
                            @yield('title')
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    <!-- Hero -->
     @endif

     @yield('content')

     @include('frontend.partials.footer')

     @if (@$gs->is_tawk)
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        'use strict';
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="https://embed.tawk.to/{{ @$gs->tawk_id }}";
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    @endif


    <script src="{{asset('assets/frontend')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/viewport.jquery.js"></script>
    <script src="{{asset('assets/frontend')}}/js/odometer.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js//owl.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
    @include('notify.alert')
    @stack('script')
   
    
</body>

</html>
