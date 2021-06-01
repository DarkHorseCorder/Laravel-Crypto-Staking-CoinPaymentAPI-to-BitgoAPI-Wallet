@extends('layouts.user')

@section('title')
   @langg('Profile Settings')
@endsection


@section('content')

    <div class="dashboard--content-item">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="profile--card">
            <div class="user--profile mb-5">
                <div class="thumb">
                    <img src="{{getPhoto($user->photo)}}" alt="clients">
                </div>
                <div class="remove-thumb">
                    <i class="fas fa-times"></i>
                </div>
                <div class="content">
                    <div>
                        <h3 class="title">
                            {{$user->name}}
                        </h3>
                        <a href="#0" class="text--base">
                           {{$user->email}}
                        </a>
                    </div>
                    <div class="mt-4">
                        <label class="btn btn-sm btn--base text--dark">
                            @langg('Update Profile Picture')
                            <input type="file" name="photo" id="profile-image-upload" hidden>
                        </label>
                        <div class="text--primary mt-2 font--sm">
                           @langg('Image size should be') 300x300
                        </div>
                    </div>
                </div>
            </div>
           
                @csrf
                <div class="row gy-4">
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('User Name')</label> - Do Copy Not Other User Names
                        <input class="form-control" type="text" name="name" value="{{$user->name}}" required>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('Email Address')</label>
                        <input class="form-control" type="email" value="{{$user->email}}" disabled>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('Mobile Phone Number')</label>
                        @if ($user->phone_verified)
                        <input class="form-control" type="text" value="{{$user->phone}}" disabled>
                        @else
                        <input class="form-control" name="phone" type="text" value="{{$user->phone}}" required>
                        @endif
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('Country')</label>
                        <input class="form-control" type="text" value="{{$user->country}}" disabled>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('Home Address')</label> - Do Not Enter City or State
                        <input class="form-control" type="text" name="city" value="{{$user->city}}">
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2">@langg('Zip code')</label> - Only For U.S. Residents, other countries 0000
                        <input class="form-control" type="text" name="zip" value="{{$user->zip}}">
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2">@langg('Legal First and Last Name')</label>
                        <input class="form-control" type="text" name="address" value="{{$user->address}}">
                    </div>
                    <div class="col-sm-12">
                        <div class="text-end">
                            <button type="submit" class="cmn--btn">@langg('Update Profile')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        var prevImg = $('.user--profile .thumb').html();
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var uploadedFile = new FileReader();
                uploadedFile.onload = function (e) {
                    var preview = $('.user--profile').find('.thumb');
                    preview.html(`<img src="${e.target.result}" alt="user">`);
                    preview.addClass('image-loaded');
                    preview.hide();
                    preview.fadeIn(650);
                    $(".image-view").hide();
                    $(".remove-thumb").show();
                }
                uploadedFile.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-image-upload").on('change', function () {
            proPicURL(this);
        });
        $(".remove-thumb").on('click', function () {
            $(".user--profile .thumb").html(prevImg);
            $(".user--profile .thumb").removeClass('image-loaded');
            $(".image-view").show();
            $(this).hide();
        })

    </script>
@endpush