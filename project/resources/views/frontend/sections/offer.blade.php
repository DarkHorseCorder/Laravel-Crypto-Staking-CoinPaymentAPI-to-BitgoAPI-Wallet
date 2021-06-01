
@php
    $offers = App\Models\Offer::with(['gateway','crypto','fiat','duration','user'])->where('status',1)->latest()->take(5)->get();
@endphp
<section class="crypto-but-sell pt-50 pb-100">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle">@lang(@$section->content->title)</h6>
            <h3 class="section-header__title">@lang(@$section->content->heading)</h3>
        </div>
        <div class="crypto-table-wrapper bg--section">
            <div class="crypto-table-header">
                <ul class="nav nav-tabs nav--tabs m-0">
                    <li class="nav-item">
                        <a href="#buy" data-bs-toggle="tab" class="active">@langg('Buy')</a>
                    </li>
                    <li class="nav-item">
                        <a href="#sell" data-bs-toggle="tab">@langg('Sell')</a>
                    </li>
                </ul>
            </div>
            <div class="crypto-table-body mx-3 mb-3 rounded">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="buy">
                        <div class="table-responsive table--mobile-lg">
                            <table class="table bg--body">
                                <thead>
                                    <tr>
                                        <th>@langg('Buy From')</th>
                                        <th>@langg('Pay With')</th>
                                        <th>@langg('Trade Duration')</th>
                                        <th>@langg('Price Type')</th>
                                        <th>@langg('Rate per Crypto')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($offers->where('type','sell') as $item)
                                    <tr>
                                        <td data-label="{{translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')}}">
                                            <div class="table-buyer">
                                                <img src="{{getPhoto($item->user->photo)}}">
                                                <h6 class="m-0 subtitle">{{$item->user->name}}</h6>
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
                                            
                                               
                                                  <a href="{{route('user.trade.create',$item->offer_id)}}" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> {{translate('buy')}} </a>
                                               
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
                    </div>
                    <div class="tab-pane fade" id="sell">
                        <div class="table-responsive table--mobile-lg">
                            <table class="table bg--body">
                                <thead>
                                    <tr>
                                   
                             
                                    <th>@langg('Sell To')</th>
                                    <th>@langg('Get Paid With')</th>
                                     <th>@langg('Trade Duration')</th>
                                     <th>@langg('Price Type')</th>
                                     <th>@langg('Rate per Crypto')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($offers->where('type','buy') as $item)
                                    <tr>
                                        <td data-label="{{translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')}}">
                                            <div class="table-buyer">
                                                <img src="{{getPhoto($item->user->photo)}}">
                                                <h6 class="m-0 subtitle">{{$item->user->name}}</h6>
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
                                                     
                                                        <span data-tooltip="{{translate('You have Quoted price that')}} {{numFormat($item->margin)}}% {{translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")}}" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                                    </div>
                                                @else
                                                <div class="text-center mb-2">
                                                    <span class="rate text--success font--sm">
                                                        {{amount($item->fixed_rate)}} {{$item->fiat->code}}
                                                    </span>
                                                </div>
                                                @endif
                    
                                                <span class="font--sm me-2">@langg('Limits'): {{amount($item->minimum)}} – {{amount($item->maximum)}} {{$item->fiat->code}}</span>
                                            
                                               
                                                  <a href="{{route('user.trade.create',$item->offer_id)}}" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> {{translate( 'Sell' )}} </a>
                                               
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>