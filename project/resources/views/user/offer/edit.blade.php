@extends('layouts.user')

@section('title')
   @lang('Edit Offer')
@endsection

@section('content')
<div class="dashboard--content-item">

    <div class="create-offer-wrapper">
        <div class="create-offer-body">
            <form class="create-offer-form" action="{{route('user.offer.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$offer->id}}" required>
                <fieldset>
                    <div class="row gy-4">
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto">@langg('Choose your
                                Crypto Currency')</label>
                            <select name="cryp_id" id="crypto"
                                class="form-control form--control bg--section">
                                @foreach ($currencies as $item)
                                <option value="{{$item->id}}" {{$offer->cryp_id == $item->id ? 'selected':''}}>{{$item->code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto">@langg('Payment
                                Method')</label>
                            <select name="gateway_id"
                                class="form-control form--control bg--section gateway_id">
                                <option value="">@langg('Select')</option>
                                @foreach ($paymentMethods as $item)
                                <option value="{{$item->id}}" data-fiats="{{json_encode($item->fiats())}}" {{$offer->gateway_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto">@langg('Choose your Fiat Currency')</label>
                            <select name="fiat_id" disabled
                                class="form-control form--control bg--section fiat_id">
                                <option value="">@langg('Select')</option>
                            </select>
                        </div>
                        
                        <div class="col-xxl-6">
                            <h5 class="text--base mb-4 mt-0">@langg('What would you like to do ?')</h5>
                            <div class="action-type-wrapper">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="type" value="sell"
                                        hidden id="sell-crypto" {{$offer->type == 'sell' ? 'checked':''}}>
                                    <label class="transaction-crypto form-check-label" for="sell-crypto">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6>@langg('Sell')</h6>
                                            <p>
                                                @langg('This option will list your offer on the buy page')
                                            </p>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="type" value="buy" hidden
                                        id="buy-crypto" {{$offer->type == 'buy' ? 'checked':''}}>
                                        <label class="transaction-crypto form-check-label" for="buy-crypto">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6>@langg('Buy')</h6>
                                            <p>
                                                @langg('This option will list your offer on the sell page')
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <h5 class="text--base mb-4 mt-0">@langg('Choose Crypto Rate you want to use')</h5>
                            <div class="action-type-wrapper">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="price_type"
                                        id="market-price" value="1" hidden {{$offer->price_type == 1 ? 'checked':''}}>
                                       <label class="transaction-crypto form-check-label" for="market-price">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6>@langg('Market Price')</h6>
                                            <p>
                                               @langg('Your offer price will change according to the
                                               market price of Crypto')
                                            </p>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="price_type"
                                        id="fixed-price" value="2" hidden {{$offer->price_type == 2 ? 'checked':''}}>
                                    <label class="transaction-crypto form-check-label" for="fixed-price">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6>@langg('Fixed Price')</h6>
                                            <p>
                                                @langg('This option will keep your offer price the same
                                                unless you update it.')
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                  
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0">@langg('Offer Trade Limits')</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="min" class="form-label text--primary">@langg('Minimum')</label>
                                    <div class="input-group">
                                        <input type="text" name="minimum" id="min"
                                            class="form-control form--control bg--section" required value="{{numFormat($offer->minimum)}}">
                                        <span class="input-group-text fiat_code">{{$offer->fiat->code}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="max" class="form-label text--primary">@langg('Maximum')</label>
                                    <div class="input-group">
                                        <input type="text" id="max" name="maximum"
                                            class="form-control form--control bg--section"  required value="{{numFormat($offer->maximum)}}">
                                        <span class="input-group-text fiat_code">{{$offer->fiat->code}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0">@langg('Offer rate and duration')</h5>
                            <div class="row">
                                <div class="col-sm-6 rate">
                                    @if ($offer->price_type == 1)
                                    <label for="offer-margin" class="form-label text--primary">@langg('Offer
                                        Margin (%)')</label>
                                    <div class="input-group">
                                        <button type="button" class="input-group-text margin_minus">-</button>
                                        <input type="text" name="margin" class="form-control form--control bg--section" value="{{$offer->neg_margin == 1 ? '-'.numFormat($offer->margin):numFormat($offer->margin)}}" required>
                                        <button type="button" class="input-group-text margin_plus">+</button>
                                    </div>
                                    @else
                                    <label for="max" class="form-label text--primary">@langg('Fixed Rate')</label>
                                    <div class="input-group">
                                        <input type="text" name="fixed_rate" value="{{numFormat($offer->fixed_rate)}}" class="form-control form--control bg--section" required>
                                        <span class="input-group-text fiat_code">{{$offer->fiat->code}}</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="offer-limit" class="form-label text--primary">@langg('Trade Duration')</label>
                                    <select name="trade_duration" id="offer-limit"
                                        class="form-control form--control bg--section">
                                        @foreach ($tradeSpeeds as $item)
                                        <option value="{{$item->id}}" {{$item->id == $offer->trade_duration ? 'selected' : ''}}>{{$item->duration}} @langg('Minutes')</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0">@langg('Offer Terms & Trade Instructions')</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="offer-terms" class="form-label text--primary">@langg('Offer
                                        Terms')</label>
                                    <textarea class="form-control  form--control bg--section"
                                        id="offer-terms" name="offer_terms" required>{{$offer->offer_terms}}</textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="offer-instructions" class="form-label text--primary">@langg('Trade
                                        Instructions')</label>
                                    <textarea class="form-control  form--control bg--section"
                                        id="offer-instructions" name="trade_instructions">{{$offer->trade_instructions}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label text--primary" for="crypto">@langg('Offer Status')</label>
                            <select name="status"
                                class="form-control form--control bg--section">
                                <option value="1" {{$offer->status == 1 ? 'selected':''}}>@langg('Active')</option>
                                <option value="0" {{$offer->status == 0 ? 'selected':''}}>@langg('Inactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-end">
                                <button type="submit" class="cmn--btn rounded next-step"><i class="fas fa-edit"></i> @langg('Update Offer')</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        'use strict';
        function fiat() { 
           const fiat_id = '{{$offer->fiat_id}}'
           const fiats = $('.gateway_id').find('option:selected').data('fiats')
           var option = '<option value="">@langg('Select')</option>';
           $.each(fiats, function (i, val) { 
              option += `<option value="${val.id}" data-code="${val.code}" ${fiat_id == val.id ? 'selected':''}>${val.code}</option>`
           });
           $('.fiat_id').attr('disabled',false)
           $('.fiat_id').html(option)
        }
        fiat();
       
        $('.gateway_id').on('change',function () { 
            fiat();
        })

        $(document).on('change','.fiat_id',function () { 
            const code = $(this).find('option:selected').data('code')
            $('.fiat_code').text(code)
        })

        $('input[name=price_type]').on('change',function () {
            var input = '';
            const code = $('.fiat_id').find('option:selected').data('code') ?? '{{$gs->curr_code}}'
            if($(this).val() == 1){
                input += `
                <label for="offer-margin" class="form-label text--primary">@langg('Offer Margin (%)')</label>
                <div class="input-group">
                    <button type="button" class="input-group-text margin_minus">-</button>
                    <input type="text" name="margin" value="0" class="form-control form--control bg--section" required>
                    <button type="button" class="input-group-text margin_plus">+</button>
                </div>
                `
            }
            if($(this).val() == 2){
                input +=`
                <label for="max" class="form-label text--primary">@langg('Fixed Rate')</label>
                <div class="input-group">
                    <input type="text" name="fixed_rate" class="form-control form--control bg--section" required>
                    <span class="input-group-text fiat_code">${code}</span>
                </div>
                `
            }
            $('.rate').html(input)
        })

        $(document).on('click','.margin_plus',function () { 
            var count = $(document).find('input[name=margin]').val()
            if(count == '' || !$.isNumeric(count)) count = 0;
            $('input[name=margin]').val(++count)
        })

        $(document).on('click','.margin_minus',function () { 
            var count = $(document).find('input[name=margin]').val()
            if(count == '' || !$.isNumeric(count)) count = 0;
            $('input[name=margin]').val(--count)
        })
    </script>
@endpush