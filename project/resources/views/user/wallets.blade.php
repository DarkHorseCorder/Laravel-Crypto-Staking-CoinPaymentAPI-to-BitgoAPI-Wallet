@extends('layouts.user')

@section('title')
    @langg('Deposit')
@endsection

@section('content')

<div class="dashboard--content-item">
    <div class="dashboard--wrapper">
        @foreach ($wallets as $item)
            <div class="dashboard--width">
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <img src="{{getPhoto($item->curr->icon)}}" alt="wallet">
                        </div>
                        <div class="dashboard-card__header__cont">
                            <h4 class="name">{{$item->curr->code}}</h4>
                            <div class="balance">{{numFormat($item->balance,8)}} {{$item->curr->code}}</div>
                            <div class="balance">{{numFormat($item->balance*$item->curr->rate,8)}} {{$gs->curr_code}}</div>
                        </div>
                    </div>
                    <div class="dashboard-card__content">
                        <div class="deposit-btn-grp">
                            @if (request()->routeIs('user.deposit.index'))
                            <a href="javascript:void(0)" data-code="{{$item->curr->code}}" data-charge="{{@$item->curr->charges->deposit_charge}}" class="btn btn-sm btn--primary deposit">@langg('See Deposit Address')</a>

                            <a href="{{route('user.deposit.address.existing',$item->curr->code)}}" class="btn btn-sm btn--info btn-block">@langg('Previous Addresses')</a>
                            @endif
                            @if (request()->routeIs('user.withdraw.wallets'))
                              <a href="{{route('user.withdraw.form',$item->curr->code)}}" class="btn btn-sm btn--info btn-block">@langg('Withdraw')</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
       
    </div>
</div>

<div id="addressModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <label class="form-label text--primary">@langg('Deposit Address')</label>
                <div class="input-group">
                    <input type="text"  class="form-control form--control bg--section address"  readonly>
                    <button type="button" class="input-group-text copy">@langg('Copy')</button>
                    <code class="charge">@langg('')</code>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn--dark" data-bs-dismiss="modal">@langg('Close')</button>
            </div>
        
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        'use strict';
        $('.deposit').on('click', function () { 
            var code = $(this).data('code')
            $(this).html('<i class="fas fa-spinner fa-spin"></i>')
            $('.charge').text($(this).data('charge')+'% '+'@langg('Deposit fee will be deducted from all deposits.')')
            $.post("{{route('user.deposit.address')}}", {code:code,_token:'{{csrf_token()}}'}, function(res) {
                if(res.error == 'ok'){
                    $('.deposit').html('See Deposit Address')
                    $('#addressModal').find('.address').val(res.result.address)
                    $('#addressModal').modal('show')  
                }
                else{
                    toast('error',res.error);
                    $('.deposit').html('Get Deposit Address')
                    return false
                }
            });
        })

        $(".copy").on("click", () => {
			var textInput = $('.address');
			textInput.select();
			document.execCommand("copy");
            toast('success','@langg('Address copied')');
            return false;
		});

    </script>
@endpush

