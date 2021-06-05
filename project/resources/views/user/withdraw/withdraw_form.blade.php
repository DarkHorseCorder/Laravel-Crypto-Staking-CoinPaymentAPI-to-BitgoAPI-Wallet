@extends('layouts.user')

@section('title')
    @langg('Send') {{$curr->code}}
@endsection

@section('content')
<div class="dashboard--content-item">
    <div class="row gy-5">
        <div class="col-lg-5 col-xxl-4">
            <div class="sticky-deposit">
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <img src="{{getPhoto($curr->icon)}}" alt="wallet">
                        </div>
                        <div class="dashboard-card__header__cont">
                            <h6 class="name">@langg('Available Balance')</h6>
                            <div class="balance">{{numFormat($wallet->balance,8)}} {{$curr->code}}</div>
                            <div class="balance">{{numFormat($wallet->balance * $wallet->curr->rate,8)}} {{$gs->curr_code}}</div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <img src="{{getPhoto('discount.png')}}" alt="payment">
                        </div>
                        <div class="dashboard-card__header__cont">
                            <h6 class="name text--danger">@langg('Xnet Withdraw Fee:')</h6>
                            <div class="balance">{{$curr->charges->withdraw_charge}}%</div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <img src="{{getPhoto('limit.png')}}" alt="payment">
                        </div>
                        <div class="dashboard-card__header__cont">
                            <h6 class="name text--primary">@langg('Withdraw Limits - Recommended Minimum $60 USD in') {{$curr->code}}</h6>
                            <div class="balance">@langg('Maximum Withdraw Limit : ') {{$curr->charges->withdraw_limit_max}} {{$curr->code}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xxl-8">
            <div class="dashboard--content-item">
                <div class="create-offer-wrapper py-lg-5">
                    <div class="create-offer-body py-2">
                        <form class="create-offer-form" method="POST" action="{{route('user.withdraw.submit')}}">
                            @csrf
                            <h5 class="text--base mb-3 mt-0">@langg('Withdraw') {{$curr->curr_name}}
                            </h5>
                            <div class="row gy-3">
                                <div class="col-sm-6">
                                    <label for="wallet-address" class="form-label text--primary">{{$curr->curr_name}} @langg('Send to
                                        Address')</label>
                                        <input type="text" name="wallet_address" class="form-control form--control bg--section" id="wallet-address" value="{{old('wallet_address')}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="withdraw-amount" class="form-label text--primary">@langg('Send
                                        Amount')</label>
                                    <input type="text" name="amount" class="form-control form--control bg--section"
                                        id="withdraw-amount" required value="{{old('amount')}}">
                                </div>
                                <input type="hidden" name="currency_id" value="{{$curr->id}}" required>
                                <input type="hidden" name="wallet_id" value="{{$wallet->id}}" required>
                                <div class="col-sm-12">
                                    <button type="submit" class="cmn--btn rounded w-100">
                                        @langg('Submit') </button>
                                    <p class="mt-3"><span class="text-danger">@langg('Please Note')</span> : @langg('Once you Submit your transaction, This action cannot be undone or refunded. Please double check your Send To Address').</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
