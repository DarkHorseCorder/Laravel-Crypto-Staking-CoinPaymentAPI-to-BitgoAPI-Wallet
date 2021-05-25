@extends('layouts.admin')
@section('breadcrumb')
 <section class="section">
        <div class="section-header">
        <h1>@langg('Logo Settings')</h1>
        </div>
</section>
@endsection
@section('title')
   @langg('Site Logo and Favicon')
@endsection
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
               <h6 class="text-primary"> @langg('Logo')</h6>
            </div>
            <div class="card-body">
              <form id="geniusformUpdate" action="{{ route('admin.gs.update') }}" enctype="text/plain" method="POST">
                @csrf
              
                 <div class="form-group d-flex justify-content-center">
                    <div id="image-preview" class="image-preview image-preview_alt"
                        style="background-image:url({{ getPhoto($gs->header_logo) }});">
                        <label for="image-upload" id="image-label">@langg('Choose File')</label>
                        <input type="file" name="header_logo" id="image-upload" />
                    </div>
                 </div>
                   <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
    </div>

   
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Favicon') }}</h6>
        </div>
        <div class="card-body">
            <form id="geniusformUpdate" action="{{ route('admin.gs.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="form-group d-flex justify-content-center">
                <div id="image-preview1" class="image-preview image-preview_alt"
                    style="background-image:url({{ getPhoto($gs->favicon) }});">
                    <label for="image-upload1" id="image-label">@langg('Choose File')</label>
                    <input type="file" name="favicon" id="image-upload1" />
                </div>
             </div>
             <div class="form-group row">
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
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
        $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1", // Default: .image-label
                label_default: "{{translate('Choose File')}}", // Default: Choose File
                label_selected: "{{translate('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
    </script>
@endpush