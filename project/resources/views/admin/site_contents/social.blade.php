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
                                        <th>@langg('SL')</th>
                                        <th>@langg('Icon')</th>
                                        <th>@langg('URL')</th>
                                        <th>@langg('Action')</th>
                                    </tr>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @forelse ($section->sub_content as $key => $info)
                                        <tr>
                                            <td data-label="@langg('SL')">
                                                {{++$i}}
                                            </td>
                                            <td data-label="@langg('Icon')">
                                              <i class="{{$info->icon}}"></i>
                                            </td>
                                           
                                            <td data-label="@langg('URL')">
                                              {{$info->url}}
                                            </td>
                                           
                                            <td data-label="@langg('Action')">
                                                <div class="d-flex flex-wrap flex-lg-nowrap align-items-center justify-content-end justify-content-lg-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary details btn-sm m-1" data-key="{{$key}}" data-item="{{json_encode($info)}}"><i class="fas fa-edit"></i></a>

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
                                <h5 class="modal-title">@langg('Add Social Link')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">@langg('Icon')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control icon-value" name="icon"
                                        value="" required>
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary iconpicker" data-icon="fas fa-home"
                                                role="iconpicker"></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>@langg('URL')</label>
                                    <input class="form-control" type="text" name="url" required>
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
                                <h5 class="modal-title">@langg('Edit Social Link')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">@langg('Icon')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control icon-value2" name="icon"
                                        value="">
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary iconpicker2" data-icon="fas fa-home"
                                                role="iconpicker"></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>@langg('URL')</label>
                                    <input class="form-control" type="text" name="url" required>
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
                                <h6 class="mt-3">@langg('Are you sure you want to remove this?')</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Cancel')</button>
                                <button type="submit" class="btn btn-danger">@langg('Yes')</button>
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
        
        $('.iconpicker').iconpicker();
        $('.iconpicker2').iconpicker();

        $('.iconpicker').on('change', function(e) {
            $('.icon-value').val(e.icon)
        })
        $('.iconpicker2').on('change', function(e) {
            $('.icon-value2').val(e.icon)
        })

        $('#add').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });
        $('#edit').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });

        $('.details').on('click',function () { 
            var data = $(this).data('item')
            $('#edit').find('input[name=sub_key]').val($(this).data('key'))
            $('#edit').find('input[name=icon]').val(data.icon)
            $('#edit').find('input[name=url]').val(data.url)
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
    </script>
@endpush