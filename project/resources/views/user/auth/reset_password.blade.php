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
                            <h3 class="section-header__title">@langg('Reset Password')</h3>
                            <p>
                                @langg('Reset Your Password.')
                            </p>
                        </div>
                        <form class="row gy-4" action="" method="post">
                            @csrf
                            <div class="col-sm-12 form-group">
                                <label class="form--label" for="email">@langg('Email')</label>
                                <input type="text" value="{{session('email')}}" class="form-control" id="email" disabled>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label class="form--label" for="email">@langg('New Password')</label>
                                <input type="password" name="password" class="form-control" id="email"
                                       placeholder="@langg('Password')"  required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label class="form--label" for="email">@langg('Confirm Password')</label>
                                <input type="password" name="password_confirmation" class="form-control" id="email"
                                    placeholder="@langg('Confirm Password')"  required>
                            </div>
    
                            <div class="col-sm-12">
                                <button type="submit" class="cmn--btn">@langg('Change Password')</button>
                            </div>
                          
                        </form>
                    </div>
                </div>
                <div class="accounts-right bg--blue">
                    <img src="{{getPhoto($login->content->image)}}" alt="images">
                    <div class="section-header text-center text-white mb-0">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title">@langg('Password Reset')</h3>
                        <p>
                            @langg('Reset your password and do not share with anyone.')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
