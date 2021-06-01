@extends('layouts.auth')

@section('title')
   @langg('Reset Password')
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
                        <h3 class="section-header__title">@langg('Forgot Password')</h3>
                        <p>
                            @langg('Enter your Email address we have on file and a Verification code will be sent.')
                        </p>
                    </div>
                    <form class="row gy-4" action="" method="post">
                        @csrf
                        <div class="col-sm-12 form-group">
                            <label class="form--label" for="email">@langg('Email Address')</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="@langg('')" value="{{old('Enter Email Address we have on file')}}" required>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn">@langg('Send verification code')</button>
                        </div>
                      
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="{{getPhoto($login->content->image)}}" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title">@langg('Forgot Password ?')</h3>
                    <p>
                        @langg('Put your email which you have used to register your account.')
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
