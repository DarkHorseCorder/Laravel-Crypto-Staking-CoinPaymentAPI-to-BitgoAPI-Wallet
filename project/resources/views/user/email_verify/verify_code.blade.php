@extends('layouts.auth')

@section('title')
   @langg('Verify Email')
@endsection

@php
$login = App\Models\SiteContent::where('slug','login')->first();
@endphp

@section('content')

<section class="accounts-section">
    <div class="accounts-inner">
        <div class="accounts-inner__wrapper bg--section">
            <div class="accounts-left">
                <div class="accounts-left-content">
                    <a href="{{url('/')}}" class="top--icon">
                        <i class="fas fa-bolt"></i>
                    </a>
                    <div class="section-header">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title">@langg('Email Verify Code')</h3>
                        <p>
                            @langg('Enter the verification code')
                        </p>
                    </div>
                    <form class="row gy-4" action="" method="post">
                        @csrf
                        <div class="col-sm-12 form-group">
                            <label class="form--label" for="email">@langg('Verify Code') <a class="ms-3" href="{{route('user.verify.email.resend')}}">@langg('Resend Code')</a></label>
                            <input type="text" name="code" class="form-control"  placeholder="@langg('Reset Code')" value="{{old('code')}}" required>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn">@langg('Verify Code')</button>
                        </div>
                      
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="{{getPhoto($login->content->image)}}" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title">@langg('Email Verification ?')</h3>
                    <p>
                        @langg('Email Verification is required.')
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
