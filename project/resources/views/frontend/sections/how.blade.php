<section class="how-to-get-started-section pt-100 pb-100">
    <div class="container">
        <div class="section-header text-center">
            <h6 class="section-header__subtitle">@lang(@$section->content->title)</h6>
            <h3 class="section-header__title">@lang(@$section->content->heading)</h3>
            <p>
                @lang(@$section->content->sub_heading)
            </p>
        </div>
        @if (!empty($section->sub_content))
            <div class="how--wrapper">
                @foreach (@$section->sub_content as $item)
                    <div class="how__item">
                        <div class="how__item-icon">
                            <i class="{{@$item->icon}}"></i>
                        </div>
                        <div class="how__item-cont">
                            <h5 class="title">@lang(@$item->title)</h5>
                            <p>
                                @lang(@$item->details)
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>