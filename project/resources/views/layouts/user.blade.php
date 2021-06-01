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
    <link rel="stylesheet" href="{{asset('assets/admin/css/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/lightbox.min.css" />
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/odometer.css"/>
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/owl.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/main.css">
    <link rel="stylesheet" href="{{asset('assets/user')}}/css/custom.css">
    <link href="{{asset('assets/frontend/css/main.php')}}?color={{$gs->theme_color}}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{getPhoto($gs->favicon)}}">
    @stack('style')
</head>
<body>
     <!-- Overlayer -->
  <span class="toTopBtn">
    <i class="fas fa-angle-up"></i>
  </span>
  <div class="overlayer"></div>
  <div class="loader"></div>
  <!-- Overlayer -->
    <main class="dashboard-section">
       @include('user.partials.sidebar')
       <article class="main--content">
          @include('user.partials.header')
          <div class="dashborad--content">
            <div class="breadcrumb-area pt-0">
              <h5 class="title mt-3">@yield('title')</h5>
              <ul class="breadcrumb">
                  <li>
                      <a href="{{route('user.dashboard')}}">@langg('User Dashboard')</a>
                  </li>
                  <li>
                    @yield('title')
                  </li>
              </ul>

            </div>
            <div class="row">
              @if ($gs->kyc)
                @include('user.partials.kyc_info')
              @endif
            </div>
            @yield('content')
            <div class="footer-copyright text-center mt-auto">
              &copy; @langg('All Right Reserved by') <a href="{{url('/')}}" class="text--base">{{$gs->title}}</a>
          </div>
          </div>
       </article>
    </main>

    <script src="{{asset('assets/frontend')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/bootstrap.bundle.js"></script>
    <script src="{{asset('assets/frontend')}}/js/viewport.jquery.js"></script>
    <script src="{{asset('assets/frontend')}}/js/odometer.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/owl.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/lightbox.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
    <script src="{{asset('assets/admin/js/summernote.js')}}"></script>
    @include('notify.alert')
    @stack('script')

    <script>
       'use strict';
        $('.reason').on('click',function(){
          $('#modal-reason').find('.reason-text').val($(this).data('reason'))
          $('#modal-reason').modal('show')
        })
    </script>
</body>

