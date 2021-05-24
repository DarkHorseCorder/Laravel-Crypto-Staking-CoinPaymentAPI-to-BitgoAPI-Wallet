@extends('layouts.admin')

@section('title')
   @langg('Add New Currency')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>@langg('Add New Currency')</h1>
        <a href="{{route('admin.currency.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-backward"></i> @langg('Back')</a>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center">

    <div class="col-md-8">
       <div class="card">
            <div class="card-body">
                @include('admin.partials.form-both')
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="col-form-label">@langg('Currency Icon')</label>
                                <div id="image-preview" class="image-preview"
                                    style="background-image:url('/');">
                                    <label for="image-upload" id="image-label">@langg('Choose File')</label>
                                    <input type="file" name="icon" id="image-upload" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@langg('Currency Name')</label>
                            <input class="form-control" type="text" name="curr_name" required value="{{old('curr_name')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@langg('Currency Code')</label>
                            <input class="form-control code" type="text" name="code" required value="{{old('code')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@langg('Currency Symbol')</label>
                            <input class="form-control" type="text" name="symbol"  required value="{{old('symbol')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@langg('Currency Type')</label>
                            <select class="form-control type" name="type" required>
                                <option value="" selected>--@langg('Select Type')--</option>
                                <option value="1">@langg('FIAT')</option>
                                <option value="2">@langg('CRYPTO')</option>
                            </select>
                        </div>
              
                        <div class="form-group col-md-6">
                            <label>@langg('Currency Rate')</label>
                            <div class="input-group has_append">
                                <div class="input-group-prepend">
                                    <div class="input-group-text cur_code">1 {{$gs->curr_code}} = </div>
                                </div>
                                <input type="text" class="form-control" placeholder="0" name="rate" value="{{ old('rate') }}"/>
                                <div class="input-group-append">
                                    <div class="input-group-text curr_text"></div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group col-md-6">
                            <label>@langg('Set As Default') </label>
                            <select class="form-control default" name="default" required>
                                <option value="" selected>--@langg('Select')--</option>
                                <option value="1">@langg('Yes')</option>
                                <option value="0">@langg('No')</option>
                            </select>
                        </div>

                       
                        <div class="form-group col-md-12">
                            <label>@langg('Status') </label>
                            <select class="form-control" name="status" required>
                                <option value="" selected>--@langg('Select')--</option>
                                <option value="1">@langg('Active')</option>
                                <option value="0">@langg('Inactive')</option>
                            </select>
                        </div>
                    </div>

                    <div class="row payments">

                    </div>
                    
                    <div class="form-group text-right col-md-12">
                        <button class="btn  btn-primary btn-lg" type="submit">@langg('Submit')</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        'use strict';
        $('.type').on('change',function () { 
            var value = $(this).find('option:selected').val()
            if($('.code').val() == ''){
                toast('error','@langg('Please put the currency code first.')')
                return false;
            }
            if(value == 2){
                $('.default').attr('disabled',true)
                $('.cur_code').text('1 '+ $('.code').val()+' =')
                $('.curr_text').text('{{$gs->curr_code}}')

                var html = `
                           
                            <div class="input-group mb-3 col-xl-6">
                                <label class="form-control-label">@langg('Deposit Charge')</label>

                                <div class="input-group has_append">
                                    <input class="form-control" type="number" name="deposit_charge" placeholder="0" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3 col-xl-6">
                                <label class="form-control-label">@langg('Withdraw Charge') </label>

                                <div class="input-group has_append">
                                    <input class="form-control" type="number" name="withdraw_charge" placeholder="0" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3 col-xl-6">
                                <label class="form-control-label">@lang('Minimum Withdraw Limit')</label>
                                <div class="input-group has_append">
                                    <input class="form-control" type="number" name="withdraw_limit_min" placeholder="0" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span>${$('.code').val()}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3 col-xl-6">
                                <label class="form-control-label">@langg('Maximum Withdraw Limit')</label>
                                <div class="input-group has_append">
                                    <input class="form-control" type="number" name="withdraw_limit_max" placeholder="0" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span>${$('.code').val()}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                       `
                $('.payments').html(html)
            } 
            if(value == 1){
                $('.default').attr('disabled',false)
                $('.cur_code').text('1 {{$gs->curr_code}} =')
                $('.curr_text').text($('.code').val())
                $('.payments').children().remove()
            }
        })
        $('.code').on('keyup',function () { 
            var type = $('.type').find('option:selected').val()
            var value = $(this).val()
            if(type == 1){
                $('.curr_text').text(value)
            }else{
                $('.cur_code').text('1 '+ $('.code').val()+' =')
            }
        })

        $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "{{translate('Choose File')}}", // Default: Choose File
                label_selected: "{{translate('Update Image')}}", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
    </script>
@endpush