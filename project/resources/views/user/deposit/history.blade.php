@extends('layouts.user')

@section('title')
   @lang('Deposit History')
@endsection

@section('content')
<div class="dashboard--content-item">

     
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                  <th>@langg('TRANSACTION ID')</th>
                  <th>@langg('Amount')</th>
                  <th>@langg('Fees')</th>
                  <th>@langg('COIN PAYMENT ID')</th>
                  <th>@langg('Date')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deposits as $item)
                <tr>
                    <td data-label="@langg('TRANSACTION ID')">
                        <div>
                            {{$item->tnx}}
                        </div>
                    </td>
                    
                    <td data-label="@langg('Amount')">
                        <div>
                            {{numFormat($item->total_amount,8)}}  {{$item->currency->code}}
                        </div>
                    </td>
                    <td data-label="@langg('Fees')">
                        <div>
                           {{numFormat($item->charge,8)}}
                        </div>
                    </td>
                    <td data-label="@langg('COIN PAYMENT ID')">
                        <div>
                           {{$item->coinpayment_tnx}}
                        </div>
                    </td>
                    <td data-label="@langg('Date')">
                        <div>
                           {{dateFormat($item->created_at)}}
                        </div>
                    </td>
       
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="12">@langg('No data found!')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{$deposits->links()}}
</div>

@endsection