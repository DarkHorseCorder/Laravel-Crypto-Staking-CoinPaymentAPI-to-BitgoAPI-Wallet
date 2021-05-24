@extends('layouts.admin')

@section('title')
   @langg('Profile Setting')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Profile Setting')</h1>
    </div>
</section>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.profile.update')}}" class="row" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">@langg('Profile Picture')</label>
                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ getPhoto( $data->photo) }});">
                                    <label for="image-upload" id="image-label">@langg('Choose File')</label>
                                    <input type="file" name="photo" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>@langg('User Name')</label>
                                <input class="form-control" type="text" name="name" value="{{$data->name}}" required>
                            </div>
                            <div class="form-group">
                                <label>@langg('Email')</label>
                                <input class="form-control" type="email" name="email" value="{{$data->email}}" required>
                            </div>
                            <div class="form-group">
                                <label>@langg('Phone')</label>
                                <input class="form-control" type="text" name="phone" value="{{$data->phone}}" required>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        'use strict';
        $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{translate('Choose File')}}", // Default: Choose File
                label_selected: "{{translate('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

    </script>
@endpush