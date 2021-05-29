@extends('layouts.admin')

@section('title')
   @langg('Trade Durations')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto">@langg('Trade Durations')</h1>
      <div class="d-flex flex-wrap ">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> @langg('Add New')</a>
          </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @forelse ($durations as $item)
    <div class="col-md-3 col-lg-3 col-xl-2 currency--card">
      <div class="card card-primary">
        <div class="card-header  d-flex justify-content-center">
            <h5 class="text-center text-primary"> <i class="far fa-clock clock"></i> {{$item->duration}} @langg(' Minutes')</h5>
        </div>
        <div class="card-body d-flex flex-wrap justify-content-between">
          <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block edit" data-item="{{$item}}"><i class="fas fa-edit"></i> @langg('Edit')</a>  
          <a href="javascript:void(0)" class="btn btn-danger btn-sm  btn-block remove" data-item="{{$item}}"><i class="fas fa-trash-alt"></i> @langg('Remove')</a>  
        </div>
      </div>
    </div>
    @empty
    <div class="col-md-12">
        <h4 class="text-center">@langg('No trade duration found!!')</h4>
    </div>
    @endforelse
    @if ($durations->hasPages())
    <div class="col-md-12">
        {{$durations->links()}}
    </div>
    @endif
</div>


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@langg('Add Duration')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                       <label>@langg('Duration in minute')</label>
                       <input class="form-control" type="text" name="duration" required>
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
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('admin.trade.duration.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@langg('Edit Duration')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                       <label>@langg('Duration in minute')</label>
                       <input class="form-control" type="text" name="duration" required>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    <button type="submit" class="btn btn-primary">@langg('Update')</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- delete --}}
<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('admin.trade.duration.remove')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                   <h4>@langg('Are you sure to remove?')</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Cancel')</button>
                    <button type="submit" class="btn btn-danger">@langg('Remove')</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('style')
    <style>
        .clock{
            font-size: 18px!important
        }
    </style>
@endpush

@push('script')
    <script>
        'use strict';
        $('.edit').on('click',function () { 
            const item = $(this).data('item')
            $('#edit').find('input[name=duration]').val(item.duration)
            $('#edit').find('input[name=id]').val(item.id)
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            const item = $(this).data('item')
            $('#remove').find('input[name=id]').val(item.id)
            $('#remove').modal('show')
        })
    </script>
@endpush