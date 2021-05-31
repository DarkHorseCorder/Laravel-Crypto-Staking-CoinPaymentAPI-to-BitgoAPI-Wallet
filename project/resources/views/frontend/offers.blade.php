@extends('layouts.frontend')

@section('title')
    @langg('Offer List')
@endsection

@section('content')
    <!-- Crypto Offer -->
<section class="crypto-offer-section overflow-hidden pb-100 pt-100">
    <div class="container">
        <div class="row gy-5">
            <div class="col-xl-4 col-xxl-3">
                <aside class="crypto-sidebar">
                    <div class="close-crypto-sidebar d-xl-none">
                        <i class="fas fa-times"></i>
                    </div>
                    <form class="row gy-4 align-items-end" action="" method="GET">
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base">@langg('Buy or Sell')</label>
                                        <select name="type" class="form-control">
                                            <option value="buy" {{request('type') == 'buy' ? 'selected':''}}>@langg('Buy')</option>
                                            <option value="sell" {{request('type') == 'sell' ? 'selected':''}}>@langg('Sell')</option>
                                        </select>
                                    </div>
                                    <div class="crypto-widget">
                                        <label class="form-label text--base" for="amount">@langg('Amount')</label>
                                        <input type="number" class="form-control" id="amount" placeholder="@langg('Enter Amount')" value="{{request('amount')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base">@langg('Crypto Currency')</label>
                                        <select name="crypto" class="form-control">
                                            @foreach ($currencies as $item)
                                             <option value="{{$item->code}}" {{request('crypto') == $item->code ? 'selected':''}}>{{$item->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base">@langg('Payment Method')</label>
                                        <select name="gateway" class="form-control gateway_id">
                                            <option value="">@langg('Select One')</option>
                                            @foreach ($paymentMethods as $item)
                                            <option value="{{$item->slug}}" data-currency="{{json_encode($item->fiats())}}" {{request('gateway') == $item->slug ? 'selected':''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="crypto-widget">
                                        <label class="form-label text--base">@langg('Currency')</label>
                                        <select name="currency" class="form-control fiats" disabled>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="w-100 cmn--btn rounded" type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </aside>
            </div>
            <div class="col-xl-8 col-xxl-9">
                <div class="d-xl-none mb-4">
                    <button class="cmn--btn filter-button rounded" type="button"><i class="fas fa-filter"></i>
                        @langg('Filter
                        Search')</button>
                </div>
                <div class="table-responsive table--mobile-lg">
                    <table class="table crypto-offer-table bg--body">
                        <thead>
                            <tr>
                                @if (request('type') == 'buy')
                                   <th>@langg('Buy From')</th>
                                @endif
                               
                                @if (request('type') == 'sell')
                                   <th>@langg('Sell To')</th>
                                @endif

                                @if (request('type') == 'sell')
                                  <th>@langg('Get Paid With')</th>
                                @endif
                                @if (request('type') == 'buy')
                                  <th>@langg('Pay With')</th>
                                @endif
                                <th>@langg('Trade Duration')</th>
                                <th>@langg('Price Type')</th>
                                <th>@langg('Rate per Crypto')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($offers as $item)
                            <tr>
                                <td data-label="{{translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')}}">
                                    <div class="table-buyer">
                                        <img src="{{getPhoto($item->user->photo)}}">
                                        <h6 class="m-0 subtitle">{{$item->user->username}}</h6>
                                    </div>
                                </td>

                                <td data-label="@langg('Pay With')">
                                    <div class="text-center">
                                        <h6 class="m-0">
                                           {{$item->gateway->name}}
                                        </h6>
                                    </div>
                                </td>
                                <td data-label="@langg('Trade Duration')">
                                    <div class="text-center">
                                        {{$item->duration->duration}} @langg('Minutes')
                                    </div>
                                </td>
                                <td data-label="@langg('Trade Duration')">
                                    @if ($item->price_type == 1)
                                    <span class="badge badge--success">
                                        @langg('Market Price')
                                    </span>
                                    @else
                                    <span class="badge badge--primary">
                                        @langg('Fixed Price')
                                    </span>
                                    @endif
                                </td>
                      
                                <td data-label="@langg('Rate per Crypto')">
                                    <div class="text-center pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1">{{amount($item->crypto->rate * $item->fiat->rate)}} {{$item->fiat->code}} / {{$item->crypto->code}}</h6>
                                        @if ($item->price_type == 1)
                                            <div class="text-center mb-2">
                                                <span class="rate text--{{$item->neg_margin == 1 ? 'danger':'success'}} font--sm">
                                                    <i class="fas fa-arrow-{{$item->neg_margin == 1 ? 'down':'up'}}"></i> {{numFormat($item->margin)}}%
                                                </span>
                                             
                                                <span data-tooltip="{{translate('Quoted price that')}} {{numFormat($item->margin)}}% {{translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")}}" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                            </div>
                                        @else
                                        <div class="text-center mb-2">
                                            <span class="rate text--success font--sm">
                                                {{amount($item->fixed_rate)}} {{$item->fiat->code}}
                                            </span>
                                        </div>
                                        @endif
            
                                        <span class="font--sm me-2">@langg('Limits'): {{amount($item->minimum)}} – {{amount($item->maximum)}} {{$item->fiat->code}}</span>
                                    
                                       
                                          <a href="{{route('user.trade.create',$item->offer_id)}}" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> {{translate(request('type') == 'buy' ? 'Buy' : 'Sell')}} </a>
                                       
                                    </div>
                                </td>
                               
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="12">@langg('No offers found!')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{$offers->links()}}
            </div>
        </div>
    </div>
</section>
<!-- Crypto Offer -->
@endsection

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