@extends('layouts.admin')

@section('title')
   @langg('Site Contents')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Site Contents')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @foreach ($sections as $item)
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header d-flex justify-content-between">
          <h4>{{ucfirst($item->name)}} {{ $item->status != 9 ? ' Section':''}}</h4>
          @if ($item->status != 9)
            <label class="cswitch align-items-center">
              <input class="cswitch--input update" value="{{$item->id}}" type="checkbox" {{$item->status == 1 ? 'checked':''}} /><span class="cswitch--trigger wrapper"></span>
          </label>
          @endif
        </div>
        <div class="card-body">
            <a href="{{route('admin.frontend.edit',$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> @langg('Edit '.ucfirst($item->name).' Section')</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection

@push('script')
    <script>
      'use strict';
      $('.update').on('change', function () {
          var url = "{{route('admin.frontend.status.update')}}"
          var data = {
              id:$(this).val(),
              _token:"{{csrf_token()}}"
          }
          $.post(url,data,function(response) {
              if(response.error){
                  toast('error',response.error)
                  return false;
              }
              toast('success',response.success)
          })
          });
    </script>
@endpush