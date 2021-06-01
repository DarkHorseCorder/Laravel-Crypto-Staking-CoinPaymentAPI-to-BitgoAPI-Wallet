<section class="crypto-section pt-100 pb-50">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle">@lang(@$section->content->title)</h6>
            <h3 class="section-header__title">@lang(@$section->content->heading)</h3>
        </div>
        @if (!empty($section->sub_content))
        <div class="row g-4 justify-content-center">
            @foreach ($section->sub_content as $item)
                <div class="col-lg-4 col-sm-6">
                    <div class="crp__item">
                        <a href="#0" class="crp--link">&nbsp;</a>
                        <div class="crp__item-icon">
                            <i class="{{@$item->icon}}"></i>
                        </div>
                        <div class="crp__item-cont">
                            <h5 class="crp__item-cont-title">@lang(@$item->title)</h5>
                            <p>
                               @lang(@$item->details)
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        
    </div>
</section>