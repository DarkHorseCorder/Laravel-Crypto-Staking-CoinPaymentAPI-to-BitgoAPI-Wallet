@extends('layouts.user')

@section('title')
   @langg('Two Step Authentication')
@endsection

@section('breadcrumb')
    @langg('Two Step Authentication')
@endsection

@section('content')

    <div class="row justify-content-center">
        @if ($gs->two_fa)
              @if (auth()->user()->two_fa_status)
                <div class="col-md-12">
                    <div class="card default--card">
                        <div class="card-body text-center">
                            <h1 class="text--success"><i class="far fa-check-circle"></i></h1>
                            <h5>@langg('Your Phone Number Has been Verified')</h5>
                            <span><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deactivated">@langg('Deactivate Two Step Authentication')</a></span>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="card default--card">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group mb-2">
                                    <label class="mb-1">@langg('Provide Your Password')</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="mb-1">@langg('Confirm Password')</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <div class="form-group text-end">
                                <button type="submit" class="btn btn--base">@langg('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
        <div class="col-md-12">
            <div class="card default--card">
                <div class="card-body text-center  p-4">
                    <h2 class="text-warning mb-2"><i class="fas fa-exclamation-triangle"></i></h2>
                    <h4>@langg('Two step authentication is temporary unavailable.')</h4>
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
                        <h5 class="modal-title">@langg('Deactivate Two Step Authentication')</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="mb-1">@langg('Enter Password')</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">@langg('Confirm Password')</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@langg('Cancel')</button>
                        <button type="submit" class="btn btn--base">@langg('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection