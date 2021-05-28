@extends('layouts.admin')

@section('title')
   @lang(ucfirst($section->name).' Section')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang(ucfirst($section->name))</h1>
        <a href="{{route('admin.frontend.index')}}" class="btn btn-primary"><i class="fa fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection

@section('content')
    <div class="row">
        @if ($section->content)
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                    <h6>@lang(ucfirst($section->name).' Content')</h6>
               </div>
               <div class="card-body">
                    <form action="{{route('admin.frontend.content.update',$section->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          
                            <div class="form-group col-md-6">
                                <label for="">@langg('Title')</label>
                                <input type="text" name="title" class="form-control" placeholder="@langg('Title')" value="{{@$section->content->title}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Heading')</label>
                                <input type="text" name="heading" class="form-control" placeholder="@langg('Heading')" value="{{@$section->content->heading}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Sub Heading')</label>
                                <input type="text" name="sub_heading" class="form-control" placeholder="@langg('Sub Heading')" value="{{@$section->content->sub_heading}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Phone No.')</label>
                                <input type="text" name="phone" class="form-control" placeholder="@langg('Phone No.')" value="{{@$section->content->phone}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Email')</label>
                                <input type="text" name="email" class="form-control" placeholder="@langg('Email')" value="{{@$section->content->email}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Address')</label>
                                <input type="text" name="address" class="form-control" placeholder="@langg('Address')" value="{{@$section->content->address}}" required>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">@langg('Submit')</button>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
        </div>
        @endif
      
    </div>
@endsection
