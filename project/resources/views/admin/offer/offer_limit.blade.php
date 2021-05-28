@extends('layouts.admin')

@section('title')
   @langg('Offer limit')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto">@langg('Manage Offer Limits')</h1>
      <div class="d-flex flex-wrap ">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> @langg('Add New')</a>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @forelse ($limits as $item)
    <div class="col-sm-6 col-md-4 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header m-0 border-0 pb-0">
           <ul class="list-group w-100">
               <li class="list-group-item d-flex flex-wrap justify-content-between">@langg('Offer Limit :')<span>{{$item->offer_limit}}</span></li>
               <li class="list-group-item d-flex flex-wrap justify-content-between">@langg('Complete Trade :')<span>{{$item->trade_complete}}</span></li>
        
           </ul>
        </div>
        <div class="card-body d-flex flex-wrap justify-content-between">
          <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block edit" data-item="{{$item}}"><i class="fas fa-edit"></i> @langg('Edit')</a>  
          <a href="javascript:void(0)" class="btn btn-danger btn-sm  btn-block remove" data-item="{{$item}}"><i class="fas fa-trash-alt"></i> @langg('Remove')</a>  
        </div>
      </div>
    </div>
    @empty
    <div class="col-md-12">
        <h4 class="text-center">@langg('No offer limits found!!')</h4>
    </div>
    @endforelse
    @if ($limits->hasPages())
    <div class="col-md-12">
        {{$limits->links()}}
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
                    <h5 class="modal-title">@langg('Add Limits')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                       <label>@langg('Offer Limit Count')</label>
                       <input class="form-control" type="number" name="offer_limit" required>
                   </div>
                   <div class="form-group">
                       <label>@langg('Required Trade Complete')</label>
                       <input class="form-control" type="number" name="trade_complete" required>
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
        <form action="{{route('admin.offer.limit.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@langg('Edit Limits')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@langg('Offer Limit Count')</label>
                        <input class="form-control" type="number" name="offer_limit" required>
                    </div>
                    <div class="form-group">
                        <label>@langg('Required Trade Complete')</label>
                        <input class="form-control" type="number" name="trade_complete" required>
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
        <form action="{{route('admin.offer.limit.remove')}}" method="POST">
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
            $('#edit').find('input[name=offer_limit]').val(item.offer_limit)
            $('#edit').find('input[name=trade_complete]').val(item.trade_complete)
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