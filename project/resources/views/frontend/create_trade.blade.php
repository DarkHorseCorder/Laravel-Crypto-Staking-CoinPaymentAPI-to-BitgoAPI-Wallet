@extends('layouts.frontend')

@section('title')
    @langg('Create trade request')
@endsection

@section('content')
    <!-- Trade Request -->
@if (kycTradeLimit())
<section class="trade-request-section pb-100 pt-100">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="create-trade-request-wrapper  border">
                    <h3 class="title">@langg('How much do you want to') {{$offer->type == 'buy' ? translate('Sell'):translate('Buy')}}</h3>
                    <h6 class="title">1 <span class="text--base">{{$offer->crypto->code}}</span> = {{amount($offer->crypto->rate * $offer->fiat->rate)}} {{$offer->fiat->code}}</h6>
                
                    <form action="{{route('user.trade.submit')}}" method="POST" id="form">
                        @csrf
                      
                        <input type="hidden" name="offer_id" value="{{$offer->id}}">
                        <input type="hidden" name="crypto_id" value="{{$offer->cryp_id}}">
                        <input type="hidden" name="fiat_id" value="{{$offer->fiat_id}}">
                     
                        <div class="row g-3 g-md-4">
                            <div class="col-sm-6">
                                <label for="pay" class="form-label">{{$offer->type == 'buy' ? translate('I will receive'):translate('I will pay')}}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="pay" placeholder="@langg('Enter Amount')" name="fiat_amount">
                                    <span class="input-group-text">{{$offer->fiat->code}}</span>
                                </div>
                                <div class="font--sm mt-2">
                                    <i class="fas fa-info-circle"></i>
                                    @langg('Minimum : ') <span class="text--base">{{amount($offer->minimum)}} {{$offer->fiat->code}}</span> @langg('and')
                                    @langg('Maximum : ') <span class="text--base">{{amount($offer->maximum)}} {{$offer->fiat->code}}</span>
                                </div>
                                <div class="font--sm mt-2 limit d-none">
                                    <i class="fas fa-info-circle text--danger"></i>
                                    <span class="text--danger">@langg('Please follow the limit.')</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="get" class="form-label">{{$offer->type == 'buy' ? translate('And Pay'):translate(' And Receive')}} </label> <small><code>(@langg('Amount will be calculated based on Seller/Buyer price rate.'))</code></small>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="get" name="crypto_amount">
                                    <span class="input-group-text">{{$offer->crypto->code}}</span>
                                </div>
                            </div>
                           
                            <div class="col-sm-12">
                                <button class="cmn--btn w-100 rounded submit" type="button">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3">@langg('About This Offer')</h4>
                    <div class="about-offer-area border rounded">
                       
                        <div class="about-offer-wrap">
                            <div class="about-offer-item">
                                <span class="title">{{$offer->type == 'buy' ? translate('Buyer'):translate('Seller')}} @langg('Rate')</span>
                                @if ($offer->price_type == 1)
                                <div class="info">
                                    <strong>{{amount($rate)}} {{$offer->fiat->code}}</strong> {{numFormat($offer->margin)}}% {{$offer->neg_margin == 1 ? translate('below') : translate('above')}} @langg('market')
                                </div>
                                @else
                                <div class="info">
                                    <strong>{{amount($rate)}} {{$offer->fiat->code}}</strong>
                                </div>
                                @endif
                               
                            </div>
                            <div class="about-offer-item">
                                <span class="title">@langg('Trade Time Limit')</span>
                                <div class="info">
                                    <strong>@langg('Min')</strong> - {{amount($offer->minimum)}} {{$offer->fiat->code}}
                                    <strong>@langg('Max')</strong> - {{amount($offer->maximum)}} {{$offer->fiat->code}}
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="about-offer-item">
                                    <span class="title">@langg('Trade Duration')</span>
                                    <div class="info">
                                        <strong>{{$offer->trade_duration}} @langg('Minutes')</strong>
                                    </div>
                                </div>
                                @if($offer->type == 'buy')
                                    <div class="about-offer-item">
                                        <span class="title">{{__($gs->title)}} @langg('Fees')</span>
                                        <div class="info">
                                            <strong>{{$gs->trade_fee}}%</strong>
                                        </div>
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3">@langg('About This') {{$offer->type == 'buy' ? translate('Buyer'):translate('Seller')}}</h4>
                    <div class="about-offer-area border rounded">
                        <div class="cmn--media ms-0">
                            <img src="{{getPhoto($offer->user->photo)}}" alt="clients">
                            <div class="subtitle">
                                <h5 class="m-0">{{$offer->user->username}}</h5>
                                <span class="m-0">@langg('Total Successful Trades : ') {{$offer->user->completedTrade()}}</span>
                            </div>
                        </div>
                        <ul class="user-info-list">
                           
                            @if ($offer->user->kyc_status == 1)
                                <li>
                                    @langg('Identity Verified')
                                </li>
                            @else
                                <li class="no">
                                    @langg('Identity not Verified')
                                </li>
                                 
                            @endif
                            @if ($offer->user->email_verified == 1)
                                <li>
                                    @langg('Email Verified')
                                </li>
                            @else
                                <li class="no">
                                    @langg('Email Not Verified')
                                </li>
                                 
                            @endif
                            @if ($offer->user->phone_verified == 1)
                                <li>
                                    @langg('Phone Verified')
                                </li>
                            @else
                                <li class="no">
                                    @langg('Phone Not Verified')
                                </li>
                                 
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3">@langg('Offer Terms')</h4>
                    <div class="about-offer-area border rounded">
                        {{$offer->offer_terms}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3">@langg('Trade Instructions')</h4>
                    <div class="about-offer-area border rounded">
                        {{$offer->trade_instructions}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="trade-request-section pb-100 pt-100">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="create-trade-request-wrapper  border">
                <h6 class="text-center">@langg('Please Complete Identity Verification To Unlock Full Access.') <a class="text--base" href="{{route('user.kyc.form')}}">@langg('Submit.')</a></h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Trade Request -->
@endsection

@push('script')
    <script>
        'use strict';

        var finalRate  = parseFloat("{{$rate}}");
        const min = parseFloat("{{numFormat($offer->minimum)}}")
        const max = parseFloat("{{numFormat($offer->maximum)}}")

        $('#pay').on('keyup',function () { 
            var amount = $(this).val();
            if(amount == '' && !$.isNumeric(amount)){
                $('#get').val(0)
                $('.limit').addClass('d-none')
                return false;
            }
          
            if(amount < min || amount > max) {
               $('.limit').removeClass('d-none')
               $('.submit').attr('disabled',true)
                return false;
            }
            $('.limit').addClass('d-none')
            $('.submit').attr('disabled',false)
            var finalAmout = amount / finalRate;
            $('#get').val(finalAmout.toFixed(8))
        })


        $('#get').on('keyup',function () { 
            var amount = $(this).val();
            if(amount == '' && !$.isNumeric(amount)){
                $('#pay').val(0)
                $('.limit').addClass('d-none')
                return false;
            }

            if(amount < (min / finalRate) || amount > (max / finalRate)) {
                $('.limit').removeClass('d-none')
                $('.submit').attr('disabled',true)
                return false;
            }
            $('.limit').addClass('d-none')
            $('.submit').attr('disabled',false)
            var finalAmout = amount * finalRate;
            $('#pay').val(finalAmout.toFixed(2))
        })

        $('.submit').on('click',function () { 
            if($('#get').val() == '' || $('#pay').val() == ''){
                toast('error',"@langg('Please fill up fields.')")
                return false;
            }
            $(this).attr('disabled',true)
            $("#form").submit();
        })
    </script>
@endpush