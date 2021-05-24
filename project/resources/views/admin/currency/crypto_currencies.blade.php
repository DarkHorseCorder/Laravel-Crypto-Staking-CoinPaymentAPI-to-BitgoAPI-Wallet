@extends('layouts.admin')

@section('title')
   @langg('Currency')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto">@langg('Crypto Currencies')</h1>
      <div class="d-flex flex-wrap ">
            @if (access('add currency'))
            <a href="{{route('admin.currency.add')}}" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> @langg('Add New')</a>
            @endif
            <form action="">
              <div class="input-group has_append">
                <input type="text" class="form-control" placeholder="@langg('Currency Name/Code')" name="search" value="{{$search ?? ''}}"/>
                <div class="input-group-append">
                    <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                </div>
              </div>
            </form>

          </div>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    @foreach ($currencies as $curr)
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header {{$curr->default == 1 ? 'default' : ''}}">
          <h4><i class="fas fa-coins"></i> {{$curr->curr_name}}</h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">@langg('Currency Symbol :')
              <span class="font-weight-bold">{{$curr->symbol}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Currency Code :')
              <span class="font-weight-bold">{{$curr->code}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Currency Type :')
              <span class="font-weight-bold">{{$curr->type == 1 ? 'Fiat':'Crypto'}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">@langg('Rate ') {{'1 '.$curr->code}} =
              <span class="font-weight-bold">{{amount($curr->rate,3)}} {{$gs->curr_code}}</span>
            </li>
          </ul>
          @if (access('edit currency'))
          <a href="{{route('admin.currency.edit',$curr->id)}}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> @langg('Edit Currency')</a>  
          @endif
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