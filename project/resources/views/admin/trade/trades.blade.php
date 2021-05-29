@extends('layouts.admin')

@section('title')
   @lang('Trades')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('Trades')</h1>
    </div>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                <form action="" class="d-flex flex-wrap justify-content-end">
                    <div class="form-group m-1 flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{request('search')}}" name="search" placeholder="@langg('Trade Code')">
                            <div class="input-group-append">
                                <button class="input-group-text btn btn-primary text-white" id="my-addon"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                   </form>
               </div>
               <div class="card-body">
                <div class="table-responsive table--mobile-lg">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>@langg('Trade Code')</th>
                                <th>@langg('Offer Owner')</th>
                                <th>@langg('Requested By')</th>
                                <th>@langg('Type/Fee/Duration')</th>
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
                                
                             
                                <td data-label="@langg('Offer Owner')">
                                    <div class="">
                                        <h6 class="m-0">
                                           <a href="{{route('admin.user.details',$item->offer_user_id)}}">{{ $item->offerOwner->name}}</a>
                                        </h6>
                                    </div>
                                </td>
                                <td data-label="@langg('Requested By')">
                                    <div class="">
                                        <h6 class="m-0">
                                           <a href="{{route('admin.user.details',$item->trader_id)}}">{{ $item->trader->name}}</a>
                                        </h6>
                                    </div>
                                </td>

                                <td data-label="@langg('Type/Fee/Duration')" class="p-3">
                                    <div class=" pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1">{{ucfirst($item->offer->type)}}</h6>
                                        <div class="mb-2">
                                            <span class="rate text-success font--sm">
                                                  {{numFormat($item->trade_fee,8)}} {{$item->crypto->code}}
                                            </span>
                                        </div>
                                        <span class="font--sm me-2">{{$item->trade_duration}} @langg('Minutes')</span>
                                    </div>
                                </td>
                             
                                <td data-label="@langg('Amount/Rates')" class="p-3">
                                    <div class="pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1">{{numFormat($item->crypto_amount,8)}} {{$item->crypto->code}}</h6>
                                        <div class="mb-2">
                                            <span class="rate text-success font--sm">
                                                 {{amount($item->rate)}} {{$item->fiat->code}}
                                            </span>
                                        </div>
                                        <span class="font--sm me-2">{{amount($item->fiat_amount)}} {{$item->fiat->code}}</span>
                                    </div>
                                </td>
                                <td data-label="@langg('Status')">
                                    @if ($item->status == 0)
                                    <span class="badge badge-warning text-white">
                                        @langg('Trade Escrowed')
                                    </span>
                                    @elseif($item->status == 1)
                                    <span class="badge badge-primary">
                                        @langg('Paid')
                                    </span>
                                    @elseif($item->status == 2)
                                    <span class="badge badge-danger">
                                        @langg('Canceled')
                                    </span>
                                    @elseif($item->status == 3)
                                    <span class="badge badge-success">
                                        @langg('Compleled/Released')
                                    </span>
                                    @elseif($item->status == 4)
                                    <span class="badge badge-info">
                                        @langg('Disputed')
                                    </span>
                                    @endif
                                </td>
                      
                               
                                <td data-label="@langg('Action')">
                                   <div>
                                        <a href="{{route('admin.trade.details',$item->trade_code)}}" class="btn btn-success btn-sm ">@langg('Details') <i class="fas fa-arrow-right"></i></i></a>
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
               @if ($trades->hasPages())
                <div class="card-footer">
                    {{$trades->links()}}
                </div>
               @endif
           </div>
        </div>
    </div>
@endsection