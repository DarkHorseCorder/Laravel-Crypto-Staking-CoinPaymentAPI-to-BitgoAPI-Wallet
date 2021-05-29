@extends('layouts.admin')

@section('title')
   @langg('SMS Templates')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('SMS Templates')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @foreach ($templates as $item)
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header">
          <h4>{{$item->email_subject}}</h4>
        </div>
        <div class="card-body">
            @if (access('sms template edit'))
             <a href="{{route('admin.sms.template.edit',$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> @langg('Edit Template')</a>
            @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection

