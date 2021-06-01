@extends('layouts.user')

@section('title')
   @lang('Your offers')
@endsection

@section('content')
<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th>@langg('Date')</th>
                    <th>@langg('Offer ID')</th>
                    <th>@langg('Offer Type')</th>
                    <th>@langg('Pay With')</th>
                    <th>@langg('Trade Duration')</th>
                    <th>@langg('Price Type')</th>
                    <th>@langg('Rate per Crypto')</th>
                    <th>@langg('Status')</th>
                    <th>@langg('Action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $item)
                <tr>
                    <td data-label="@langg('Date')">
                        <div>
                            {{dateFormat($item->created_at,'d M Y')}}
                        </div>
                    </td>
                    
                    <td data-label="@langg('Offer ID')">
                        <div>
                            {{$item->offer_id}}
                        </div>
                    </td>
                    <td data-label="@langg('Offer Type')">
                        @if ($item->type == 'sell')
                        <span class="badge badge--success">
                            @langg('Sell')
                        </span>
                        @else
                        <span class="badge badge--primary">
                            @langg('Buy')
                        </span>
                        @endif
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
                                        <i class="fas fa-arrow-{{$item->neg_margin == 1 ? 'down':'up'}}"></i> {{$item->margin}}%
                                    </span>
                                 
                                    <span data-tooltip="{{translate('You have Quoted price that')}} {{amount($item->margin)}}% {{translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")}}" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                  
                                </div>
                            @else
                            <div class="text-center mb-2">
                                <span class="rate text--success font--sm">
                                     {{amount($item->fixed_rate)}} {{$item->fiat->code}}
                                </span>
                            </div>
                            @endif

                            <span class="font--sm me-2">@langg('Limits'): {{amount($item->minimum)}} – {{amount($item->maximum)}} {{$item->fiat->code}}</span>
                        
                        </div>
                    </td>
                    <td data-label="@langg('Status')">
                        @if($item->status == 1)
                            <span class="badge  badge--success">@langg('Active')</span>
                         @else
                            <span class="badge badge--warning">@langg('Inactive')</span>
                        @endif
                     </td>
                    <td data-label="@langg('Action')">
                       <div>
                        @if ($item->status == 1)
                        <button class="btn btn--warning btn-sm me-1 status" data-id="{{$item->id}}" data-bs-toggle="tooltip" data-bs-title="@langg('Deactivate')"><i class="fas fa-ban"></i></button>
                        @else
                        <button class="btn btn--success btn-sm me-1 status" data-id="{{$item->id}}" data-bs-toggle="tooltip" data-bs-title="@langg('Activate')"><i class="fas fa-check"></i></button>
                        @endif
                        <a href="{{route('user.offer.edit',$item->offer_id)}}" class="btn btn--primary btn-sm "><i class="fas fa-edit"></i></a>
                       </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$offers->links()}}
</div>

<div id="statusModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('user.offer.status')}}">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body p-4 text-center">
                    <h5>@langg('Are you sure about changing the status ?')</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal">@langg('No')</button><button type="submit" class="btn btn--primary">@langg('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        'use strict';
        $('.status').on('click',function () { 
            $('#statusModal').find('input[name=id]').val($(this).data('id'))
            $('#statusModal').modal('show')
        })
    </script>
@endpush