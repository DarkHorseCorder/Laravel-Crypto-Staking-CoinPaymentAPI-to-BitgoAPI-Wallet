@extends('layouts.auth')

@section('title')
   @langg('User Register')
@endsection

@php
$register = \App\Models\SiteContent::where('id',19)->first();
@endphp

@section('content')
<section class="accounts-section">
    <div class="accounts-inner">
        <div class="accounts-inner__wrapper bg--section">
            <div class="accounts-left">
                <div class="accounts-left-content mw-100">
                    <a href="{{url('/')}}" class="top--icon">
                        <i class="fas fa-bolt"></i>
                    </a>
                    <div class="section-header">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title">@lang(@$register->content->first_heading)</h3>
                        <p>
                            @lang(@$register->content->first_sub_heading)
                        </p>
                    </div>
                    <form class="row g-4" action="" method="POST">
                        @csrf
                        <div class="col-sm-6 form-group">
                            <label class="form--label">@langg('Create User Name')</label>
                            <input type="text" class="form-control" name="name" placeholder="@langg('Do Not Copy Others')" required value="{{old('name')}}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label">@langg('Email Address')</label>
                            <input type="email" class="form-control" name="email" placeholder="@langg('Enter email')" required value="{{old('email')}}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label">@langg('Country')</label>
                            <select name="country" class="form-control country" required>
                                <option value="">@langg('Select')</option>
                                @foreach ($countries as $item)
                                    <option value="{{$item->name}}" data-dial_code="{{$item->dial_code}}" {{@$info->geoplugin_countryCode == $item->code ? 'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-sm-6 form-group">
                             <label class="form--label">@langg('Mobile Phone Number')</label>
                            <input type="hidden" name="dial_code">
                            <div class="input-group">
                                <span class="input-group-text d_code"></span>
                                <input type="text" name="phone"  class="form-control" placeholder="@langg('Phone Number')" required value="{{old('phone')}}">
                            </div>
                        </div>
    
                        <div class="col-sm-12 form-group">
                            <label class="form--label">@langg('Legal First and Last Name')</label>
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="@langg('Enter Your Name as it appears on your ID')" required>
                        </div>
                           <div class="col-sm-6 form-group">
                            <label class="form--label">@langg('Password')</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control"  placeholder="@langg('Do Not Use 1234')"  autocomplete="off" required>
                            </div>
                          </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label">@langg('Confirm Password')</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_confirmation" class="form-control"  placeholder="@langg('Confirm Password')"  autocomplete="off">
                            </div>
                        </div>
                        @if ($gs->recaptcha)
                            <div class="col-sm-12 form-group">
                                {!! NoCaptcha::display() !!}
                                {!! NoCaptcha::renderJs() !!}
                                @error('g-recaptcha-response')
                                <p class="my-2 text--danger">{{$message}}</p>
                                @enderror
                            </div>
                        @endif
                        <div class="col-xl-12 form-group">
                            <div class="d-flex flex-wrap justify-content-between">
    
                                <div>
                                    <a class="text--base" href="{{route('user.login')}}">@langg('Already have an Account ?')</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 form-group">
                            <button type="submit" class="btn btn--base">@langg('Create Account')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="accounts-right bg--blue">
                <img src="{{getPhoto(@$register->content->image)}}" alt="images">
                <div class="section-header text-center text-white mb-0">
                    <h6 class="section-header__subtitle"></h6>
                    <h3 class="section-header__title">@lang(@$register->content->second_heading)</h3>
                    <p>
                        @lang(@$register->content->second_sub_heading)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    
    <script>
      'use strict';
     function auto() {
        var code = $('.country option:selected').data('dial_code')
        $('.d_code').text(code)
        $('input[name=dial_code]').val(code)
      }
      auto();
      $('.country').on('change',function () {
        auto();
      })

    
      

    </script>
@endpush
