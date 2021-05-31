<section class="shield-section bg--section pt-100 pb-100">
    <div class="container">
        <div class="row gy-5 justify-content-evenly align-items-center">
            <div class="col-lg-6">
                <div class="shield-content">
                    <h2 class="title">
                       @lang(@$section->content->heading)
                    </h2>
                    @if (!empty($section->sub_content))
                        <ul class="security-feature-list">
                            @foreach ($section->sub_content as $item)
                                <li>
                                    @lang($item->feature)
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mt-4 pt-3">
                        <a href="{{url(@$section->content->btn_url ?? '/')}}" class="cmn--btn">@lang(@$section->content->btn_name) <span class="round-effect">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="shield-area">
                    <h4 class="title text--white">
                        @lang(@$section->content->feature_text)
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>