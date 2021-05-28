@extends('layouts.admin')

@section('title')
   @langg('Payment Gateways (FIAT)')
@endsection

@section('breadcrumb')
 <section class="section">
	<div class="section-header justify-content-between">
		<h1>@langg('Payment Gateways (FIAT)')</h1>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#add" class="btn btn-primary"><i class="fas fa-plus"></i> @langg('Add New')</a>
	</div>
</section>
@endsection

@section('content')
<div class="row">
    @foreach ($gateways as $item)
    <div class="col-md-6 col-lg-6 col-xl-3">
      <div class="card card-primary">
        <div class="card-header justify-content-center">
          <h4><i class="fas fa-money-check-alt"></i> {{$item->name}}</h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">@langg('Total Currency :')
              <span class="font-weight-bold">{{count($item->currency_id)}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Status :')
              <span class="badge badge-{{$item->status == 1 ? 'success' : 'danger'}}">{{$item->status == 1 ? 'Active' : 'Inactive'}}</span>
            </li>
          </ul>
            <a href="javascript:void(0)" class="btn btn-primary btn-block edit" data-item="{{$item}}" data-route="{{route('admin.gateway.update',$item)}}"><i class="fas fa-edit"></i> @langg('Edit Gateway')</a>
        </div>
      </div>
    </div>
    @endforeach
    <div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">@langg('Add New Gateway')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>@langg('Gateway Name')</label>
                  <input class="form-control" type="text" name="name" required>
                </div>

                <div class="form-group">
                  <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                      <input class="cswitch--input update" name="status" type="checkbox"/><span class="cswitch--trigger wrapper"></span>
                      <span class="cswitch--label font-weight-bold">@langg('Status')</span>
                  </label>
                </div>

                <div class="form-group border p-3">
                  @foreach(DB::table('currencies')->where('type',1)->get() as $dcurr)
                  <input  name="currency_id[]" type="checkbox" id="currency_id{{$dcurr->id}}" value="{{$dcurr->id}}">
                  <label class="mr-4 currency_label" for="currency_id{{$dcurr->id}}">{{$dcurr->code}}</label>
                  @endforeach
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

    {{-- edit --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">@langg('Edit Gateway')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>@langg('Gateway Name')</label>
                  <input class="form-control" type="text" name="name" required>
                </div>

                <div class="form-group">
                  <label class="cswitch d-flex justify-content-between align-items-center border p-2">
                      <input class="cswitch--input update" name="status" type="checkbox"/><span class="cswitch--trigger wrapper"></span>
                      <span class="cswitch--label font-weight-bold">@langg('Status')</span>
                  </label>
                </div>

                <div class="form-group border p-3">
                  @foreach(DB::table('currencies')->where('type',1)->get() as $dcurr)
                  <input class="curr"  name="currency_id[]" type="checkbox" id="currency_id{{$dcurr->id}}" value="{{$dcurr->id}}">
                  <label class="mr-4 currency_label" for="currency_id{{$dcurr->id}}">{{$dcurr->code}}</label>
                  @endforeach
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
</div>
@endsection


@push('style')
    <style>
      .currency_label{
        font-size: 18px!important;
      }
    </style>
@endpush

@push('script')
    <script>
      'use strict';
      $('.edit').on('click',function () { 
        var item = $(this).data('item')
        const modal = $('#edit')
        modal.find('input[name=name]').val(item.name)
        if(item.status == 1) modal.find('input[name=status]').attr('checked',true)
        var item_curr = item.currency_id;

        $.each(modal.find('.curr'), function (i, val) {
          var id = val.id;
          var curr_id = id.replace("currency_id", "")
          if(item_curr.includes(curr_id)) $(val).attr('checked',true)
          else $(val).attr('checked',false)
        });
        modal.find('form').attr('action',$(this).data('route'))
        modal.modal('show')
      })
    </script>
@endpush