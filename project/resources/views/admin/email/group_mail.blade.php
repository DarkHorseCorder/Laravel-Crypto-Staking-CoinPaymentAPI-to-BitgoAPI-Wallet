@extends('layouts.admin')

@section('title')
   @langg('Group Email')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Group Email')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
       <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary">{{ translate('Group Mail Form') }}</h6>
             <a href="{{route('admin.user.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @langg('Back')</a>
          </div>
          <div class="card-body">
             <form action="{{route('admin.group.submit')}}" enctype="multipart/form-data" method="POST">
                 @csrf
                 
                 <div class="row">
                     <div class="col-md-12">
                     <div class="form-group">
                         <label for="subject">{{ translate('Email Subject') }}</label>
                         <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ translate('Email Subject') }}">
                     </div>
                     </div>
             
                     <div class="col-md-12">
                        <div class="form-group">
                            <label for="body">{{ translate('Message') }}</label>
                            <textarea id="body" class="form-control summernote" name="message" rows="5" placeholder="{{ translate('Description') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('Submit') }}</button>
                    </div>
             </form>
          </div>
       </div>
    </div>
 </div>
@endsection