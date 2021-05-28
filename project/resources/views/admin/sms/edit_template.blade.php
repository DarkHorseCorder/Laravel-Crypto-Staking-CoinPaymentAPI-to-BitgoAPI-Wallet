@extends('layouts.admin')

@section('title')
   @langg('SMS Template')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@langg('Edit SMS Template')</h1>
        <a class="btn btn-primary" href="{{route('admin.sms.templates')}}"><i class="fas fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-lg-10">
       <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
             <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit SMS Template Form') }}</h6>
          </div>
          <div class="card-body">
           <div class="gocover" style="background: url({{asset('assets/images/'.$gs->dashboard_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
           <form id="geniusformUpdate" action="{{route('admin.sms.template.update',$data->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @include('admin.partials.form-both')
             <div class="row justify-content-center mb-3" >
                <div class="col-md-12">
                   <p>{{ __('Use the BB codes, it show the data dynamically in your sms.') }}</p>
                   <br>
                   <table class="table table-bordered">
                      <thead>
                         <tr>
                            <th>{{ __('Meaning') }}</th>
                            <th>{{ __('BB Code') }}</th>
                         </tr>
                      </thead>
                      <tbody>
                    
                          @if($data->codes)
                            @foreach ($data->codes as $code => $meaning)
                                <tr>
                                    <td>{{ __($meaning) }}</td>
                                    <td class="font-weight-bold">{{'{'.$code.'}'}}</td>
                                </tr>
                            @endforeach
                         @endif
                      </tbody>
                   </table>
                </div>
             </div>
            
                <div class="form-group">
                   <label for="type">{{ __('Email Type') }}</label>
                   <input type="text" class="form-control" disabled="" value="{{$data->email_type}}" id="type" placeholder="{{ __('Email Type') }}">
                </div>
                <div class="form-group">
                   <label for="type">{{ __('Email Subject') }}</label>
                   <input type="text" class="form-control" name="email_subject" value="{{$data->email_subject}}" id="type" placeholder="{{ __('Email Subject') }}">
                </div>
                <div class="form-group">
                   <label for="description">{{ __('Email Body') }}</label>
                   <textarea id="area1" class="form-control" rows="10" name="sms" placeholder="{{ __('Email Body') }}">{{$data->sms}}</textarea>
                </div>
                <div class="row">
                   <div class="col-lg-4">
                      <div class="left-area">
                      </div>
                   </div>
                   
                     <div class="col-lg-12 text-right">
                        <button class="btn btn-primary btn-lg" type="submit">{{ __('Update') }}</button>
                     </div>
                   
                </div>
             </form>
          </div>
       </div>
    </div>
  </div>
@endsection

@push('script')
    <script>
         $(function() {
            'use strict'
            $('.summernote').summernote();
        })
    </script>
@endpush