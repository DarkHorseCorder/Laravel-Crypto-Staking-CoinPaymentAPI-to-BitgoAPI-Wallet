@extends('layouts.admin')
@section('title')
   @langg('Edit Page')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@langg('Edit Page')</h1>
        <a href="{{route('admin.page.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @langg('Back') </a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card mb-4">
         <div class="card-body">
          
            <form action="{{route('admin.page.update',$page->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <div class="form-group">
                  <label for="inp-name">{{ __('Language') }}</label>
                  <select name="lang" class="form-control">
                     @foreach (DB::table('languages')->get() as $item)
                       <option value="{{$item->code}}" {{$page->lang == $item->code ? 'selected':''}}>{{$item->language}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="inp-name">{{ __('Title') }}</label>
                  <input type="text" class="form-control" id="inp-name" name="title"  placeholder="{{ __('Enter Title') }}" value="{{$page->title}}" required>
               </div>
               <div class="form-group">
                  <label for="description">{{ __('Description') }}</label>
                  <textarea id="area1" class="form-control summernote" name="details" placeholder="{{ __('Description') }}">{{$page->details}}</textarea>
              </div>
               <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection