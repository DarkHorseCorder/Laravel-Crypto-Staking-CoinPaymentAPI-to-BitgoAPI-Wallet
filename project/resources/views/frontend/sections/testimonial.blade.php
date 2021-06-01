<section class="testimonial-section bg--section pt-100 pb-100">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle">@lang(@$section->content->title)</h6>
            <h3 class="section-header__title">@lang(@$section->content->heading)</h3>
        </div>
        @if (!empty(@$section->sub_content))
        <div class="testimonial-slider owl-carousel owl-theme">
            @foreach ($section->sub_content as $item)
                <div class="testimonial-item">
                    <div class="testimonial-header">
                        <div class="thumb">
                            <img src="{{getPhoto(@$item->image)}}">
                        </div>
                        <div class="icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                    </div>
                   
                    <div class="testimonial-content">
                        <p>
                            @lang(@$item->quote)
                        </p>
                        <h5 class="name text--base mt-3">@lang(@$item->name)</h5>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
</section>