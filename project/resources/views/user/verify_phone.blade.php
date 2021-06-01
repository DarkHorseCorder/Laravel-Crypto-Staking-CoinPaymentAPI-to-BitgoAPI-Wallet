@extends('layouts.user')

@section('title')
   @langg('Verify phone no.')
@endsection

@section('breadcrumb')

    @langg('Verify phone no.')

@endsection

@section('content')

    <div class="row justify-content-center">
       
              @if (auth()->user()->phone_verified)
                <div class="col-md-12">
                    <div class="card default--card py-5">
                        <div class="card-body text-center">
                            <h1 class="text--success mb-3"><i class="far fa-check-circle"></i></h1>
                            <h5>@langg('Your phone number is verified')</h5>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="card default--card py-5">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group mb-4 d-flex justify-content-between">
                                   <a href="{{route('user.send.code')}}" class="btn btn--base">@langg('Send verification code')</a>
                                    <h6 class="mt-2">@langg('Your phone no : ') {{auth()->user()->phone}}</h6>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="mb-1">@langg('Verification Code')</label>
                                    <input class="form-control" type="text" name="verification_code" required>
                                </div>
                                <div class="form-group text-end">
                                <button type="submit" class="btn btn--base">@langg('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
       
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deactivated" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@langg('Deativate Two Step Authentication')</h5>
                           
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="mb-1">@langg('Provide Your Password')</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">@langg('Confirm Password')</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@langg('Close')</button>
                        <button type="submit" class="btn btn--base">@langg('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection