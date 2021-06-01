<span class="toTopBtn">
  <i class="fas fa-angle-up"></i>
</span>
<div class="overlayer"></div>
<div class="loader"></div>
<!-- Overlayer -->
@php
    $socials   = App\Models\SiteContent::where('slug','social')->first();
    $languages = DB::table('languages')->get();
@endphp
<!-- Header -->
<header>
  <div class="navbar-top">
      <div class="container">
          <div class="d-flex flex-wrap justify-content-evenly justify-content-md-between">
              <div class="d-flex flex-wrap align-items-center">
                  <ul class="social-icons py-1 py-md-0 me-md-auto">
                    @foreach ($socials->sub_content as $item)
                    <li>
                        <a target="_blank" href="{{@$item->url}}"><i class="{{@$item->icon}}"></i></a>
                    </li>
                     @endforeach
                  </ul>
                  <div class="change-language d-md-none">
                    <select class="language-bar" onChange="window.location.href=this.value">
                        @foreach ($languages as $item)
                         <option value="{{route('lang.change',$item->code)}}" {{session('lang') == $item->code ? 'selected':''}}>@lang($item->language)</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <ul class="contact-bar py-1 py-md-0">
                <li>
                    <a href="Tel:{{@$contact->content->phone}}">{{@$contact->content->phone}}</a>
                </li>
                <li>
                    <a href="Mailto:{{@$contact->content->email}}">{{@$contact->content->email}}</a>
                </li>
                  <li>
                      <div class="change-language d-none d-md-block">
                        <select class="language-bar" onChange="window.location.href=this.value">
                            @foreach ($languages as $item)
                             <option value="{{route('lang.change',$item->code)}}" {{session('lang') == $item->code ? 'selected':''}}>@lang($item->language)</option>
                            @endforeach
                        </select>
                      </div>
                  </li>
                  <li>
                      <div class="mode--toggle d-none d-sm-block">
                          <i class="fas fa-moon"></i>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <div class="navbar-bottom">
      <div class="container">
          <div class="navbar-wrapper">
              <div class="logo me-auto">
                  <a href="{{url('/')}}">
                      <img src="{{getPhoto($gs->header_logo)}}"/>
                  </a>
              </div>
              <div class="nav-toggle d-lg-none">
                  <span></span>
                  <span></span>
                  <span></span>
              </div>
              <div class="nav-menu-area">
                  <div class="menu-close text--danger d-lg-none">
                      <i class="fas fa-times"></i>
                  </div>
                  <ul class="nav-menu">
                    @foreach (json_decode($gs->menu) as $item)
                  
                    @if ($item->dropdown =='no')
                    <li>
                        <a target="{{$item->target == 'self' ? '':'_blank'}}" href="{{url($item->href)}}">{{__($item->title)}}</a>
                    </li>
                        
                    @else
                    <li>
                        <a href="javascript:void(0)">{{__($item->title)}}</a>
                        <ul class="sub-nav">
                            <li>
                                <a href="{{route('offer.list',['type' => 'buy'])}}">@langg('Buy')</a>
                            </li>
                            <li>
                                <a href="{{route('offer.list',['type' => 'sell'])}}">@langg('Sell')</a>
                            </li>
                        </ul>
                    </li>
                        
                    @endif      

                    @endforeach
                    <li>
                        @auth
                        <div class="btn__grp ms-lg-3">
                            <a href="{{route('user.dashboard')}}" class="cmn--btn">@lang('User Dashboard')</a>
                            <a href="{{route('user.logout')}}" class="cmn--btn btn-outline">@lang('Logout')</a>
                        </div>
                        @else
                        <div class="btn__grp ms-lg-3">
                            <a href="{{route('user.login')}}" class="cmn--btn">@lang('Sign in')</a>
                            <a href="{{route('user.register')}}" class="cmn--btn btn-outline">@lang('Register')</a>
                        </div>
                        @endauth
                    </li>
                  </ul>
              </div>
              <div class="mode--toggle d-sm-none">
                  <i class="fas fa-moon"></i>
              </div>
          </div>
      </div>
  </div>
</header>