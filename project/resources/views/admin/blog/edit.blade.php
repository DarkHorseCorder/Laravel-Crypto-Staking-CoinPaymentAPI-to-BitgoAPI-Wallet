@extends('layouts.admin')
@section('title')
   @langg('Edit Blog')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@langg('Edit Blog')</h1>
        <a href="{{route('admin.blog.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Blog Form') }}</h6>
         </div>
         <div class="card-body">
           
            <form action="{{route('admin.blog.update',$blog->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-12 ShowImage mb-3  text-center">
                    <img src="{{ getPhoto($blog->photo) }}" class="img-fluid" alt="image" width="400">
                 </div>
                <div class="form-group">
                    <label for="title">{{ __('Blog Title') }}</label>
                    <input type="text" class="form-control" name="title" value="{{$blog->title}}" required placeholder="{{ __('Blog Title') }}">
                </div>
            
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="categorys">{{ __('Category') }}</label>
                            <select class="form-control  mb-3" id="categorys" name="category_id" required>
                                @foreach ($categories as $item)
                                <option value="{{$item->id}}" {{$blog->category_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                          </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">{{ __('Blog Photo') }}</label>
                            <span class="ml-3">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="image" accept="image/*">
                                <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="area1" class="form-control summernote" name="description" placeholder="{{ __('Description') }}" required>{{$blog->description}}</textarea>
                </div>

             
                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select class="form-control  mb-3"  name="status" required>
                            <option value="1" {{$blog->status == 1 ? 'selected':''}}>{{translate('Active')}}</option>
                            <option value="0" {{$blog->status == 0 ? 'selected':''}}>{{translate('Inactive')}}</option>
                        </select>
                    </div>        
              
           
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
      <!-- Form Sizing -->
      <!-- Horizontal Form -->
   </div>
</div>
<!--Row-->
@endsection