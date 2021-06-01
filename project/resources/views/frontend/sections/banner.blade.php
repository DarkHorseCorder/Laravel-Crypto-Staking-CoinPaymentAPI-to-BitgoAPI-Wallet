<section class="banner-section bg_img" data-img="{{getPhoto(@$section->content->image)}}">
    <div class="banner-overlay bg--gradient">&nbsp;</div>
    <div class="container">
        <div class="banner-wrapper">
            <div class="banner-exchange-area">
                <div class="exchange-area">
                    <h5 class="title">{{__(@$section->content->title)}}</h5>
                    <form method="GET" action="{{route('offer.list')}}">
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <select name="type" class="form-control text--dark">
                                        <option value="buy" {{request('type') == 'buy' ? 'selected':''}}>@langg('Buy')</option>
                                        <option value="sell" {{request('type') == 'sell' ? 'selected':''}}>@langg('Sell')</option>
                                    </select>
                                   
                                    <select name="crypto" class="form-control text--dark">
                                        @foreach ($currencies as $item)
                                         <option value="{{$item->code}}" {{request('crypto') == $item->code ? 'selected':''}}>{{$item->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <select name="gateway" class="form-control gateway_id text--dark">
                                        <option value="">@langg('Select One')</option>
                                        @foreach ($paymentMethods as $item)
                                        <option value="{{$item->slug}}" data-currency="{{json_encode($item->fiats())}}" {{request('gateway') == $item->slug ? 'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <select name="currency" class="form-control fiats text--dark" disabled>
                                            
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="number" name="amount"  class="form-control text--dark" placeholder="@langg('Amount')"
                                    name="amount">
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="cmn--btn w-100 rounded">Find Offer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="banner-cont text--light">
                <h1 class="title text--base">@lang(@$section->content->heading)</h1>
                <p>
                    @lang(@$section->content->sub_heading)
                </p>
                <h5 class="subtitle text--white"> @lang(@$section->content->payment_text)</h5>
                @if (!empty($section->sub_content))
                    <div class="btn__grp">
                        @foreach ($section->sub_content as $item)
                        <a href="javascript:void(0)" class="cmn--btn">
                            <img src="{{getPhoto(@$item->image)}}" alt="banner">
                            {{@$item->title}}</a>
                        @endforeach
                       
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        'use strict';
        $('.gateway_id').on('change',function () { 
           const currency = $(this).find('option:selected').data('currency')
           var option = '<option value="">@langg('Select')</option>';
           $.each(currency, function (i, val) { 
              option += `<option value="${val.code}">${val.code}</option>`
           });
           $('.fiats').attr('disabled',false)
           $('.fiats').html(option)
        })
    </script>
@endpush