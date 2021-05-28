@extends('layouts.admin')

@section('title')
   @lang(ucfirst($section->name).' Section')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@lang(ucfirst($section->name).' Section')</h1>
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
                    <h4>@lang(ucfirst($section->name).' Content')</h4>
               </div>
               <div class="card-body">
                    <form action="{{route('admin.frontend.content.update',$section->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          
                            <div class="form-group col-md-6">
                                <label for="">@langg('Title')</label>
                                <input type="text" name="title" class="form-control" placeholder="@langg('Offer section Title')" value="{{@$section->content->title}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">@langg('Heading')</label>
                                <input type="text" name="heading" class="form-control" placeholder="@langg('Offer section Heading')" value="{{@$section->content->heading}}" required>
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
