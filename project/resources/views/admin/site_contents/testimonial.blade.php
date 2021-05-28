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
                          
                            <div class="form-group col-md-6">
                                <label for="">@langg('Title')</label>
                                <input type="text" name="title" class="form-control" placeholder="@langg('Title')" value="{{@$section->content->title}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Heading')</label>
                                <input type="text" name="heading" class="form-control" placeholder="@langg('Heading')" value="{{@$section->content->heading}}" required>
                            </div>
                           

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
        </div>
        @endif
    </div>
        @if(is_array($section->sub_content))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>@lang(ucfirst($section->name).' SubContent')</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> @langg('Add New')</button>
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>@langg('Icon Image')</th>
                                        <th>@langg('Title')</th>
                                        <th>@langg('Details')</th>
                                        <th>@langg('Action')</th>
                                    </tr>
                                    @forelse ($section->sub_content as $key => $info)
                                        <tr>
                                            <td data-label="@langg('Icon Image')">
                                              <img src="{{getPhoto($info->image)}}" width="50px">
                                            </td>
                                            <td data-label="@langg('Title')">{{$info->name}}</td>
                                            <td data-label="@langg('Details')">{{Str::limit($info->quote,30)}}</td>
                                            <td data-label="@langg('Action')">
                                                <div class="d-flex flex-wrap flex-lg-nowrap align-items-center justify-content-end justify-content-lg-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary details btn-sm m-1" data-key="{{$key}}" data-item="{{json_encode($info)}}" data-img="{{getPhoto($info->image)}}"><i class="fas fa-edit"></i></a>

                                                    <a href="javascript:void(0)" class="btn btn-danger remove btn-sm m-1" data-key="{{$key}}" ><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                                        </tr>

                                    @endforelse
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{route('admin.frontend.sub-content.update',$section->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">@langg('Add Client Qoute')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label class="col-form-label">@langg('Icon Image') <code class="text-danger">(@langg('Image size : 120 x 120px'))</code></label>
                                <div class="form-group d-flex justify-content-center">
                                    <div id="image-preview" class="image-preview"
                                        style="background-image:url();">
                                        <label for="image-upload" id="image-label">@langg('Choose File')</label>
                                        <input type="file" name="image" id="image-upload" />
                                        <input type="hidden" name="image_size" value="120x120"/>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>@langg('Client Name')</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>@langg('Quote')</label>
                                    <textarea class="form-control" type="text" name="quote" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                                <button type="submit" class="btn btn-primary">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
                <div class="modal-dialog" role="document">
                    <form action="{{route('admin.frontend.sub-content.single.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="{{$section->id}}">
                        <input type="hidden" name="sub_key">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">@langg('Edit Client Qoute')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label class="col-form-label">@langg('Icon Image') <code class="text-danger">(@langg('Image size : 120 x 120px'))</code></label>
                                <div class="form-group  d-flex justify-content-center">
                                    <div id="image-preview1" class="image-preview"
                                        style="background-image:url();">
                                        <label for="image-upload1" id="image-label1">@langg('Choose File')</label>
                                        <input type="file" name="image" id="image-upload1" />
                                        <input type="hidden" name="image_size" value="120x120"/>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>@langg('Client Name')</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>@langg('Quote')</label>
                                    <textarea class="form-control" type="text" name="quote" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                                <button type="submit" class="btn btn-primary">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="remove" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('admin.frontend.sub-content.remove')}}" method="POST">
                        @csrf
                        <input type="hidden" name="section" value="{{$section->id}}">
                        <input type="hidden" name="key">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h6 class="mt-3">@langg('Are you sure to remove?')</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                                <button type="submit" class="btn btn-danger">@langg('Confirm')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
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

        $('.details').on('click',function () { 
            var data = $(this).data('item')
            $('#edit').find('input[name=name]').val(data.name)
            $('#edit').find('textarea[name=quote]').val(data.quote)
            $('#edit').find('input[name=sub_key]').val($(this).data('key'))
            $('#edit').find('#image-preview1').css('background-image','url('+$(this).data('img')+')')
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
    </script>
@endpush