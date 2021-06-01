@extends('layouts.user')
@section('title')
    @langg('User Dashboard')
@endsection

@section('content')
<div class="dashboard--content-item">
  <div class="dashboard--wrapper">
      @foreach ($wallets as $item)
        <div class="dashboard--width">
            <div class="dashboard-card">
                <div class="dashboard-card__header">
                    <div class="dashboard-card__header__icon">
                        <img src="{{getPhoto($item->curr->icon)}}" alt="wallet">
                    </div>
                    <div class="dashboard-card__header__cont">
                        <h4 class="name">{{$item->curr->code}}</h4>
                        <div class="balance">{{numFormat($item->balance,8)}}</div>
                        <div class="balance">{{numFormat($item->balance*$item->curr->rate,8)}} {{$gs->curr_code}}</div>
                    </div>
                </div>
                <div class="dashboard-card__content">
                    <h6 class="m-0"><span class="text--base">1 {{$item->curr->code}}</span> = <span>{{amount($item->curr->rate)}} {{$gs->curr_code}}</span>
                    </h6>
                </div>
            </div>
        </div>
      @endforeach
    
  </div>
</div>

<div class="dashboard--content-item">
    <h5 class="dashboard-title">@langg('Latest Trade Requests')</h5>
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th>@langg('Trade Code')</th>
                    <th>@langg('Type/Fee/Duration')</th>
                    <th>@langg('Requested By')</th>
                    <th>@langg('Amount/Rates')</th>
                    <th>@langg('Status')</th>
                    <th>@langg('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trades as $item)
                <tr>
                    <td data-label="@langg('Trade Code')">
                        <div>
                            {{$item->trade_code}}
                        </div>
                    </td>
                    
                    <td data-label="@langg('Trade Basic')">
                        <div class="text-center">
                            <h6 class="m-0 mb-lg-1">{{ucfirst($item->offer->type)}}</h6>
                            <div class="text-center mb--lg-2 d-flex d-lg-block">
                                <span class="rate text--success font--sm d-block">
                                      {{numFormat($item->trade_fee,8)}} {{$item->crypto->code}}
                                </span>
                            </div>
                            <span class="font--sm me-2">{{$item->trade_duration}} @langg('Minutes')</span>
                        </div>
                    </td>
               
                    <td data-label="@langg('Requested By')">
                        <div class="text-center">
                            <h6 class="m-0">
                               {{$item->trader->id == auth()->id() ? 'You' : $item->trader->username}}
                            </h6>
                        </div>
                    </td>
           
                    <td data-label="@langg('Amount/Rates')">
                        <div class="text-center pt-3 pt-md-0">
                            <h6 class="m-0 mb-md-1">{{numFormat($item->crypto_amount,8)}} {{$item->crypto->code}}</h6>
                            <div class="text-center mb-2">
                                <span class="rate text--success font--sm">
                                        {{amount($item->rate)}} {{$item->fiat->code}}
                                </span>
                            </div>
                            <span class="font--sm me-2">{{amount($item->fiat_amount)}} {{$item->fiat->code}}</span>
                        </div>
                    </td>
                    <td data-label="@langg('Status')">
                        @if ($item->status == 0)
                        <span class="badge badge--warning text-white">
                            @langg('Trade Funds Escrowed')
                        </span>
                        @elseif($item->status == 1)
                        <span class="badge badge--primary">
                            @langg('Paid')
                        </span>
                        @elseif($item->status == 2)
                        <span class="badge badge--danger">
                            @langg('Canceled')
                        </span>
                        @elseif($item->status == 3)
                        <span class="badge badge--success">
                            @langg('Completed/Released')
                        </span>
                        @elseif($item->status == 4)
                        <span class="badge badge--info">
                            @langg('Disputed')
                        </span>
                        @endif
                    </td>
          
                   
                    <td data-label="@langg('Action')">
                       <div>
                            <a href="{{route('user.trade.details',$item->trade_code)}}" class="btn btn--success btn-sm ">@langg('Details') <i class="fas fa-arrow-right"></i></i></a>
                       </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="12">@langg('No trades found!')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
  
</div>

@endsection
