@extends('layouts.auth')

@section('title')
   @langg('User Login')
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
                        <h3 class="section-header__title">@lang(@$login->content->first_heading)</h3>
                        <p>
                            @lang(@$login->content->first_sub_heading)
                        </p>
                    </div>
                    <form class="row gy-4" action="{{route('user.login')}}" method="post">
                        @csrf
                        <div class="col-sm-12">
                            <label for="username" class="form-label">@langg('Your email')</label>
                            <input type="email" name="email" id="username" class="form-control" required value="{{old('email')}}">
                        </div>
                        <div class="col-sm-12">
                            <label for="password" class="form-label">@langg('Your Password')</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                       
                         @if ($gs->recaptcha)
                            <div class="col-sm-12">
                                {!! NoCaptcha::display() !!}
                                {!! NoCaptcha::renderJs() !!}
                                @error('g-recaptcha-response')
                                <p class="my-2 text--danger">{{$message}}</p>
                                @enderror
                            </div>
                        @endif
                        
                        <div class="col-12 mt-2">
                          <a href="{{route('user.forgot.password')}}" class="text--base">@langg('Forgot Password?')</a>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn">@langg('Sign In')</button>
                        </div>
                        <div class="col-sm-12">
                            @langg('Not registered yet ?') <a href="{{route('user.register')}}" class="text--base">@langg('Create an Account For Free')</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="{{getPhoto($login->content->image)}}" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title">@lang(@$login->content->second_heading)</h3>
                    <p>
                        @lang(@$login->content->second_sub_heading)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
