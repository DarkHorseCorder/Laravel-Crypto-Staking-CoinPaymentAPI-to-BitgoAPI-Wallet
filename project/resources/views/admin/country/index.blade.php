@extends('layouts.admin')

@section('title')
   @langg('Manage Country')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
        <h1 class="mt-2">@langg('Manage Country')</h1>
        <form action="">
            <div class="input-group has_append mt-2">
              <input type="text" class="form-control" placeholder="@langg('Country Name')" name="search" value="{{$search ?? ''}}"/>
              <div class="input-group-append">
                  <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
              </div>
            </div>
          </form>
        @if (access('add country'))
        <button class="btn btn-primary mt-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> @langg('Add New')</button>
        @endif
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @forelse ($countries as $country)
    <div class="col-sm-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header">
          <h4>{{$country->name}}</h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">@langg('Flag')
                <img src="{{$country->flag}}" width="50px" height="45px">
                 
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Currency')
              <span class="font-weight-bold">{{$country->currency->code}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Country Code')
              <span class="font-weight-bold">{{$country->code}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Dial Code')
              <span class="font-weight-bold">{{$country->dial_code}}</span>
            </li>
            
          </ul>
            @if (access('update country'))
            <a href="javascript:void(0)" data-target="#editModal" data-toggle="modal" data-id="{{$country->id}}" data-curr="{{$country->currency_id}}" class="btn btn-primary btn-block edit"><i class="fas fa-edit"></i> @langg('Edit Country')</a>
                
            @endif
        </div>
      </div>
    </div>
    @empty
    <div class="col-md-12 text-center">
        <h5>@langg('No Country Found')</h5>
    </div>
    @endforelse
</div>

<!-- Modal -->
@if (access('add country'))
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@langg('Add new country')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <form action="{{route('admin.country.store')}}" method="POST">
                  @csrf
                   <div class="form-group">
                     <label for="">@langg('Select Country')</label>
                     <select name="unique_key" class="form-control js-example-basic-single">
                         @foreach ($countryJson as $key => $item)
                          <option value="{{$key}}">{{$item->name}}</option>
                         @endforeach
                     </select>
                   </div>

                   <div class="form-group">
                        <label for="">@langg('Select Currency')</label>
                        <select name="currency" class="form-control js-example-basic-single">
                            @foreach ($currencies as $curr)
                            <option value="{{$curr->id}}">{{$curr->code}}</option>
                            @endforeach
                        </select>
                   </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                <button type="submit" class="btn btn-primary">@langg('Save')</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endif
@if (access('update country'))
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@langg('Edit country')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <form action="{{route('admin.country.update')}}" method="POST">
                  @csrf
                  <input type="hidden" name="id">
                   <div class="form-group">
                        <label for="">@langg('Select Currency')</label>
                        <select name="currency" class="form-control editCurr">
                            @foreach ($currencies as $curr)
                             <option value="{{$curr->id}}">{{$curr->code}}</option>
                            @endforeach
                        </select>
                   </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                <button type="submit" class="btn btn-primary">@langg('Save')</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endif
@endsection

@push('script')
    <script>
        'use strict';
        $(document).ready(function() {
           $('.js-example-basic-single').select2({
            dropdownParent: $('#addModal')
           });
        });
        $(document).ready(function() {
           $('.editCurr').select2({
            dropdownParent: $('#editModal')
           });
        });

        $('.edit').on('click',function () { 
            $('#editModal').find('select[name=currency]').val($(this).data('curr'))
            $('#editModal').find('input[name=id]').val($(this).data('id'))
        })

   
    </script>
@endpush