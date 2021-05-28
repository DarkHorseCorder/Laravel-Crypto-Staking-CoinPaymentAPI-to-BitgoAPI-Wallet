@extends('layouts.admin')

@section('title')
   @lang(ucfirst($section->name).' Section')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang(ucfirst($section->name).' Section')</h1>
        <a href="{{route('admin.frontend.index')}}" class="btn btn-primary"><i class="fa fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left border-primary">
                <div class="card-body">
                    <span class="font-weight-bold">@langg('Note') : </span> <code class="text-warning">@langg('Image of this page will be in same for forgot password pages.')</code>
                </div>
            </div>
        </div>
        @if ($section->content)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang(ucfirst($section->name).' Content')</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.frontend.content.update',$section->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">@langg('Background Image')</label>
                                <div class="gallery gallery-fw"  data-item-height="450">
                                    <img class="gallery-item imageShow" data-image="{{getPhoto(@$section->content->image)}}">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image"  class="custom-file-input imageUpload mb-2" id="customFile">
                                    <code class="text-danger">@langg('Image size : 1052 x 945 px')</code>
                                    <input type="hidden" name="image_size" value="1052x945">
                                    <label class="custom-file-label" for="customFile">@langg('Choose file')</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('First Heading')</label>
                                <input type="text" name="first_heading" class="form-control" placeholder="@langg('First Heading')" value="{{@$section->content->first_heading}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('First Sub Heading')</label>
                                <input type="text" name="first_sub_heading" class="form-control" placeholder="@langg('First Sub Heading')" value="{{@$section->content->first_sub_heading}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Second Heading')</label>
                                <input type="text" name="second_heading" class="form-control" placeholder="@langg('Second Heading')" value="{{@$section->content->second_heading}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Second Sub Heading')</label>
                                <input type="text" name="second_sub_heading" class="form-control" placeholder="@langg('Second Sub Heading')" value="{{@$section->content->second_sub_heading}}" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
@endif
@endsection

@push('script')
    <script>
        'use strict'
        function imageShow(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.form-group').find('.imageShow').attr('src',e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").on('change', function () {
            imageShow(this);
        });

    </script>
@endpush