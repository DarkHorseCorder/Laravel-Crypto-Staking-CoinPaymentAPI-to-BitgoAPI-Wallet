@extends('layouts.admin')

@section('title')
   @langg('Change Password')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Change Password')</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.password.update')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>@langg('Old Password')</label>
                        <input class="form-control" type="password" name="old_password"  required>
                    </div>
                    <div class="form-group">
                        <label>@langg('New Password')</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>@langg('Confirm Password')</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg">@langg('Submit')</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection