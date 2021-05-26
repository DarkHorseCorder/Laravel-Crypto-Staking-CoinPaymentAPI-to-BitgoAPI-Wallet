@extends('layouts.admin')

@section('title')
   @langg('Manage Language')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@langg('Manage Language')</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modelId"> <i class="fas fa-plus"></i> @langg('Add New Language')</button>
    </div>
</section>
@endsection


@section('content')

<div class="row">
    @foreach ($languages as $lang)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 currency--card">
      <div class="card card-primary">
        <div class="card-header d-flex justify-content-between {{$lang->is_default == 1 ? 'default' : ''}}">
          <h4><i class="fas fa-language"></i> {{$lang->language}}</h4>
          @if($lang->is_default != 1)
          <a href="javascript:void(0)" class="btn btn-danger btn-sm remove" data-id="{{$lang->id}}"><i class="fas fa-trash-alt"></i></a>
          @endif
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">@langg('Language Code :')
              <span class="font-weight-bold">{{$lang->code}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Set as default :')
               <label class="cswitch d-flex justify-content-between align-items-center">
                  <input class="cswitch--input update" value="{{$lang->id}}" type="checkbox" {{$lang->is_default == 1 ? 'checked  disabled' : ''}} />
                  <span class="cswitch--trigger wrapper"></span>
              </label>
            </li>
          </ul>
        
          <a href="{{route('admin.language.edit',$lang->id)}}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> @langg('Edit Language')</a>  
          
        </div>
      </div>
    </div>
    @endforeach
</div>

@if ($languages->hasPages())
 {{ $languages->links('admin.partials.paginate') }}
@endif

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.language.store')}}" method="POST">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@langg('Add New Language')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>@langg('Language Name')</label>
                  <input class="form-control" type="text" name="name" required>
               </div>
               <div class="form-group">
                  <label>@langg('Language Code')</label>
                  <input class="form-control" type="text" name="code" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
               <button type="submit" class="btn btn-primary">@langg('Save')</button>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.remove.language')}}" method="POST">
         @csrf
         <input type="hidden" name="id">
         <div class="modal-content">
            <div class="modal-body">
              <h5 class="mt-3">@langg('Are you sure to remove?')</h5>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
               <button type="submit" class="btn btn-danger">@langg('Confirm')</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection

@push('script')
    <script>
       'use strict';
       $('.update').on('change', function () {
            var url = "{{route('admin.update-status.language')}}"
            var val = $(this).val()
            var data = {
               id:val,
               _token:"{{csrf_token()}}"
            }
            $(this).attr('disabled',true)
            $.post(url,data,function(response) {
               if(response.error){
                  toast('error',response.error)
                  return false;
               }
               $(document).find('.cswitch input[type=checkbox]').each(function() {
                  if ($(this).is(":checked")) {
                     $(this).attr('checked',false)
                     $(this).attr('disabled',false)
                  }
               });
               toast('success',response.success)
            })
            
         });

         $('.remove').on('click',function () { 
            $('#removeModal').find('input[name=id]').val($(this).data('id'))
            $('#removeModal').modal('show')
         })
    </script>
@endpush
