@extends('layouts.admin')

@section('title')
    @langg('Cookie Concent')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
    <h1>@langg('Cookie Concent')</h1>
    </div>
</section>
@endsection
@section('content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                    
                    @csrf

                    <div class="row">
                    
                    
                        <div class="form-group col-md-6">
                            <label for="">@langg('Cookie Status')</label>
                            <select name="status" id="" class="form-control" required>

                                <option value="1" {{@$gs->cookie->status ? 'selected' : ''}}>@langg('Yes')</option>
                                <option value="0" {{@$gs->cookie->status ? '' : 'selected'}}>@langg('No')</option>
                            
                            </select>
                        
                        </div> 
                        
                        <div class="form-group col-md-6">
                        
                            <label for="">@langg('Cookie Button Text')</label>
                            <input type="text" name="button_text" class="form-control"  value="{{@$gs->cookie->button_text}}" required>
                        
                        </div> 
                        
                        <div class="form-group col-md-12">
                        
                            <label for="">@langg('Cookie condition text')</label>

                            <textarea name="cookie_text" id="" cols="30" rows="10" class="form-control" required>{{translate(@$gs->cookie->cookie_text)}}</textarea>
                        
                        </div> 
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">@langg('Update')</button>
                        </div>
                    
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
