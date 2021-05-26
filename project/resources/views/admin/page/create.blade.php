@extends('layouts.admin')
@section('title')
   @langg('Create Page')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@langg('Create Page')</h1>
        <a href="{{route('admin.page.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @langg('Back') </a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-body">
           
            <form action="{{route('admin.page.store')}}" method="POST" enctype="multipart/form-data">
              
               @csrf
               <div class="form-group">
                  <label for="inp-name">{{ __('Language') }}</label>
                  <select name="lang" class="form-control">
                     @foreach (DB::table('languages')->get() as $item)
                       <option value="{{$item->code}}">{{$item->language}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="inp-name">{{ __('Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="title"  placeholder="{{ __('Enter Title') }}" value="" required>
               </div>
               <div class="form-group">
                  <label for="description">{{ __('Description') }}</label>
                  <textarea id="area1" class="form-control summernote" name="details" placeholder="{{ __('Description') }}"></textarea>
              </div>
         
               <button type="submit"  class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
      <!-- Form Sizing -->
      <!-- Horizontal Form -->
   </div>
</div>
<!--Row-->
@endsection