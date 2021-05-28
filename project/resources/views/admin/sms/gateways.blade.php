@extends('layouts.admin')

@section('title')
   @langg('SMS gateways')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('SMS gateways')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">
    @foreach ($gateways as $item)
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header {{$item->status == 1 ? 'default' : ''}}">
          <h4>{{$item->name}}</h4>
        </div>
        <div class="card-body">
          <a href="{{route('admin.sms.edit',$item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> @langg('Edit Configuration')</a>
         
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection

@push('style')
    <style>
        .default{
          background-color: #6777ef26!important;
        }
    </style>
@endpush