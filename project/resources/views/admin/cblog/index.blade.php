@extends('layouts.admin')

@section('title')
   @langg('Blog Categories')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Blog Categories')</h1>
    </div>
</section>
@endsection

@section('content')


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
               <i class="fas fa-plus"></i> @langg('Add New')
             </button>

         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                   <th>@langg('Name')</th>
                   <th>@langg('Slug')</th>
                   <th>@langg('Status')</th>
                   <th class="text-right">@langg('Action')</th>
               </tr>
               @forelse ($categories as $item)
                   <tr>

                        <td data-label="@langg('Name')">
                          {{$item->name}}
                        </td>
                        <td data-label="@langg('Slug')">
                          {{$item->slug}}
                        </td>
                      
                        <td data-label="@langg('Status')">
                           @if ($item->status == 1)
                           <span class="badge badge-success"> @langg('Active') </span>
                           @else
                           <span class="badge badge-warning"> @langg('Inactive') </span>
                           @endif
                        </td>
                        <td data-label="@langg('Action')" class="text-right">
                           <a href="javascript:void()" class="btn btn-primary approve btn-sm edit" data-route="{{route('admin.bcategory.update',$item->id)}}" data-item="{{$item}}" data-toggle="tooltip" title="@langg('Edit')"><i class="fas fa-edit"></i></a>
                           
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

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.bcategory.store')}}" method="POST">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@langg('Add new category')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>@langg('Name')</label>
                  <input class="form-control" type="text" name="name">
               </div>
               <div class="form-group">
                  <label>@langg('Status')</label>
                  <select name="status" class="form-control">
                     <option value="1">@langg('Active')</option>
                     <option value="0">@langg('Inactive')</option>
                  </select>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="" method="POST">
         @csrf
         @method('PUT')
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@langg('Edit category')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>@langg('Name')</label>
                  <input class="form-control" type="text" name="name">
               </div>
               <div class="form-group">
                  <label>@langg('Status')</label>
                  <select name="status" class="form-control">
                     <option value="1">@langg('Active')</option>
                     <option value="0">@langg('Inactive')</option>
                  </select>
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

@endsection

@push('script')
    <script>
       'use strict';
       $('.edit').on('click',function () { 
          var data = $(this).data('item')
          $('#edit').find('input[name=name]').val(data.name)
          $('#edit').find('select[name=status]').val(data.status)
          $('#edit').find('form').attr('action',$(this).data('route'))
          $('#edit').modal('show')
       })
    </script>
@endpush

