@extends('layouts.admin')

@section('title')
   @lang('API settings')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('API settings')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-left border-primary">
            <div class="card-body">
                <span class="font-weight-bold">@langg('Note') : </span> <code class="text-warning">@langg('Update fields with your Coinpayment API Information.')</code>
            </div>
        </div>
    </div>
    <div class="col-xl-10">
        <div class="card">
            <div class="card-header">
                <h4>@langg('Api Key') (Coinpayment)</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2">@langg('Public Key') : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="public_key" type="text" value="{{@$gs->api_settings->public_key}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2">@langg('Private Key') : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="private_key" type="text" value="{{@$gs->api_settings->private_key}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2">@langg('Merchant ID') : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="merchant_id" type="text" value="{{@$gs->api_settings->merchant_id}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2">@langg('Web Hook') : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" value="{{url('notify/coinpayment')}}" disabled>
                            <code>@langg('Put this URL to your Coinpayment web hook URL in order to user payment/deposit work perfectly. And also make sure you put an IPN secret to your Coinpayment Settings.')</code>
                        </div>
                    </div>
                   
                    <div class="form-group mt-3 text-right">
                        <button type="submit" class="btn btn-primary">@langg('Apply Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection