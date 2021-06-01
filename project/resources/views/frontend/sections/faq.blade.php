<section class="faq-section pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-header mb-lg-0">
                    <h6 class="section-header__subtitle">@lang(@$section->content->title)</h6>
                    <h3 class="section-header__title">@lang(@$section->content->heading)</h3>
                    <p>
                        @lang(@$section->content->sub_heading)
                    </p>
                    <a href="{{url(@$section->content->btn_url)}}" class="cmn--btn">
                        @lang(@$section->content->btn_name) 
                        <span class="round-effect">
                           <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                @if(!empty($section->sub_content))
                <div class="accordion-wrapper">
                    @foreach($section->sub_content as $key => $item)
                      @if ($key < 5)
                        <div class="accordion-item {{$loop->first ? 'open active':''}}">
                            <div class="accordion-title">
                                <h5 class="title">
                                    {{__(@$item->question)}}
                                </h5>
                                <span class="right-icon"></span>
                            </div>
                            <div class="accordion-content">
                                {{__(@$item->answer)}}
                            </div>
                        </div>
                     @endif
                    @endforeach
                   
                </div>
                @endif
            </div>
        </div>
    </div>
</section>