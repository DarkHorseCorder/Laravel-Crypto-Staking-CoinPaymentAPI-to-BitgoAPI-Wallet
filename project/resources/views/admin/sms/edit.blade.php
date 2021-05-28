@extends('layouts.admin')

@section('title')
   @langg('Edit Config')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@langg('Edit Config : '.$gateway->name)</h1>
        <a href="{{route('admin.sms.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($gateway->status == 1)
                <div class="card-header">
                    <span class="badge badge-success">@langg('Default')</span>
                </div>
                @endif
                <div class="card-body">
                    <form action="{{route('admin.sms.update',$gateway->id)}}" method="POST">
                        @csrf
                        @foreach ($gateway->config as $key => $value)
                        <div class="form-group">
                            <label>{{ucfirst(str_replace('_',' ',$key))}}</label>
                            <input class="form-control" type="text" name="{{$key}}" value="{{$value}}" required>
                        </div>
                        @endforeach
                        @if ($gateway->status != 1)
                        <div class="form-group border p-2 rounded">
                            <label class="cswitch mb-0 d-flex justify-content-between align-items-center">
                                <input class="cswitch--input permission" name="status" type="checkbox" />
                                <span class="cswitch--trigger wrapper"></span>
                                <span class="cswitch--label font-weight-bold ">@langg('Set as default gateway')</span>
                            </label>
                        </div>
                        @endif
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg">@langg('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection