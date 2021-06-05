@extends('layouts.auth')

@section('title')
   @langg('Two Step Authentication')
@endsection

@section('content')
   
<div class="card card-primary logincard default--card">
    <div class="card-header">
    <h4> @langg('Two Step Verification')</h4>
    </div>
    
    <div class="card-body">
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <h4>@langg('Verification Code Sent Successfully. Phone Number: '.auth()->user()->phone)</h6>
        </div>
        <div class="form-group mb-2">
            <label class="mb-1">@langg('Phone Verification Code')</label>
            <input class="form-control" type="text" name="code" required>
        </div>
        <div class="form-group d-flex justify-content-between">
            <a href="{{route('user.two.step.resend')}}" class="text-left">@langg('Didn\'t get code? Resend.')</a>
            <button type="submit" class="btn btn-primary">@langg('Submit')</button>
        </div>
    </form>
    </div>
</div>
   


@endsection
