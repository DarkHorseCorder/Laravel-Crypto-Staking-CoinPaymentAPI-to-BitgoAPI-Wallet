@extends('layouts.frontend')

@section('title')
    @lang('Frequently Asked Questions')
@endsection

@section('content')
    <section class="faqs-section pt-50 pb-100">
        <div class="container">
            
            <div class="row flex-wrap-reverse gy-5 justify-content-center">
                <div class="col-lg-10">
                    @if(!empty($faq->sub_content))
                    <div class="accordion-wrapper">
                        @foreach($faq->sub_content as $key => $item)
                            
                                <div class="accordion-item {{$loop->first ? 'open active':''}}">
                                    <div class="accordion-title">
                                        <h6 class="title">
                                            {{translate(@$item->question)}}
                                        </h6>
                                        <span class="icon"></span>
                                    </div>
                                    <div class="accordion-content">
                                        <p>
                                            {{translate(@$item->answer)}}
                                        </p>
                                    </div>
                                </div>
                                
                                @endforeach
                            </div>
                    @endif
                </div>
                
            </div>
        </div>
        <span class="banner-elem elem1">&nbsp;</span>
        <span class="banner-elem elem3">&nbsp;</span>
        <span class="banner-elem elem5">&nbsp;</span>
        <span class="banner-elem elem6">&nbsp;</span>
    </section>
 
@endsection