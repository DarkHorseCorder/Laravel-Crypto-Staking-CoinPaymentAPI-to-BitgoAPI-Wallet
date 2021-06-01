@extends('layouts.user')

@section('title')
   @langg('Change Password')
@endsection


@section('content')

    <div class="dashboard--content-item">

        <form method="POST" action="">
          <div class="profile--card">
                @csrf
                <div class="row gy-4">
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2">@langg('Old Password')</label>
                        <input class="form-control" type="password" name="old_pass" required>
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2">@langg('New Password')</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2">@langg('Confirm Password')</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-end">
                            <button type="submit" class="cmn--btn">@langg('Update Password')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

