 
@guest
     <!-- CTAs Section -->
<section class="ctas-section">
    <div class="container">
        <div class="ctas__wrapper">
            <div class="ctas-button">
                <a href="{{route('user.login')}}" class="link">&nbsp;</a>
                <h2 class="title">@langg('Login')</h2>
                <div class="text">
                    @langg('Already have account ? Login to trade.')
                </div>
            </div>
            <div class="ctas-button">
                <a href="{{route('user.register')}}" class="link">&nbsp;</a>
                <h2 class="title">@langg('Join Xnet')</h2>
                <div class="text">
                   @langg('Don\'t have an account ? Create One Now.')
                    </spandiv>
                </div>
            </div>
        </div>
</section>
<!-- CTAs Section -->
@endguest
 
 <!-- Footer Section -->
 <footer class="bg_img" data-img="{{getPhoto($bg)}}">
    <div class="banner-overlay bg--gradient">&nbsp;</div>
    <div class="footer-top position-relative">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-logo">
                    <a href="{{url('/')}}">
                        <img src="{{getPhoto($gs->header_logo)}}" alt="logo">
                    </a>
                </div>
                <div class="footer-links">
                    <h5 class="title">@langg('Menu')</h5>
                    <ul>
                        @foreach (json_decode($gs->menu) as $item)
                        @if ($item->dropdown == 'no')
                            <li>
                            <a target="{{$item->target == 'self' ? '':'_blank'}}" href="{{url($item->href)}}">{{__($item->title)}}</a>
                            </li>
                        @endif
                      @endforeach
                    </ul>
                </div>
                <div class="footer-links mobile-second-item">
                    <h5 class="title">@lang('Get Started')</h5>
                    <ul>
                        <li>
                            <a href="{{route('faq')}}">@lang('Buy Crypto')</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}">@lang('Sell Crypto')</a>
                        </li>
                        <li>
                            <a href="{{route('user.register')}}">@lang('Sign Up')</a>
                        </li>
                        <li>
                            <a href="{{route('user.login')}}">@lang('Sign In')</a>
                        </li>
                    </ul>
                </div>

                <div class="footer-links mobile-second-item">
                    <h5 class="title">@lang('Pages')</h5>
                    <ul>
                       
                        <li>
                            <a href="{{route('faq')}}">@lang('Frequently Asked Questions')</a>
                        </li>
                        @foreach (DB::table('pages')->where('lang',app()->currentLocale())->get() as $item)
                            @if ($item->slug != 'about')
                                <li>
                                    <a href="{{route('pages',[$item->id,$item->slug])}}">@lang($item->title)</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                
                
                <div class="footer-comunity">
                    @php
                      $socials = App\Models\SiteContent::where('slug','social')->first();
                    @endphp
                    <h5 class="title">@langg('Social Links')</h5>
                    <ul class="social-icons justify-content-start mt-0 mb-4">
                        @foreach ($socials->sub_content as $item)
                            <li>
                                <a target="_blank" href="{{@$item->url}}"><i class="{{@$item->icon}}"></i></a>
                            </li>
                         @endforeach
                    </ul>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom position-relative py-4 border-top">
        <div class="container text-center d-flex flex-wrap justify-content-evenly justify-content-md-between">
            <p class="m-0">
                &copy; @langg('All Right Reserved by') <a href="{{url('/')}}" class="text--base">{{$gs->title}}</a>
            </p>
          
            <ul class="bottom-menu d-flex flex-wrap justify-content-center">
                @php
                $policies = App\Models\SiteContent::where('slug','policies')->first();
                @endphp
                @foreach ($policies->sub_content as $key=> $item)
                    @if (app()->currentLocale() == $item->lang)
                        <li>
                            <a class="text--base {{$loop->first ? '':'ms-3'}}" href="{{route('terms.details',[$key,Str::slug($item->title)])}}">{{__($item->title)}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</footer>
<!-- Footer Section -->