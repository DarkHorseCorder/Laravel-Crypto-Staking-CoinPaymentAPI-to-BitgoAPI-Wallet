@extends('layouts.user')

@section('title')
   @lang('Previous Deposit Addresses')
@endsection

@section('content')
<div class="dashboard--content-item">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{route('user.deposit.index')}}" class="btn btn--base mb-2 btn-sm"><i class="fas fa-backward"></i> @langg('Back')</a>
    </div>
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th>@langg('Created On')</th>
                    <th>@langg('Xnet Wallet Address')</th>
                    <th>@langg('Currency Type')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($addresses as $item)
                <tr>
                    <td data-label="@langg('Created At')">
                        <div>
                            {{dateFormat($item->created_at,'d M Y')}}
                        </div>
                    </td>
                    
                    <td data-label="@langg('Address')">
                        <div>
                            {{$item->address}}
                        </div>
                    </td>
                    <td data-label="@langg('Currency')">
                        <span class="badge badge--success">
                           {{$item->curr->code}}
                        </span>
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
    {{$addresses->links()}}
</div>

@endsection