<div class="col-xl-6 col-xxl-5">
    <div class="font--sm">
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <span class="flex-shrink-0 me-2 display-6">
                <i class="fas fa-info-circle"></i>
            </span>
            <div class="me-3">
                @langg('Remember to keep all conversations within the trade chat. Trading outside of Xnet
                is against our policies and we won’t be able to assist you if
                something goes wrong.')
            </div>   
        </div>
        <div class="create-offer-wrapper p-0">
            <div
                class="alert border-0 radius-0 border-bottom bg--body d-flex align-items-center mb-0">
                <span class="flex-shrink-0 me-3 display-6">
                    <i class="fas fa-tachometer-alt"></i>
                </span>
                @if ($trade->status == 3)
                <div class="me-3">
                    <h5 class="m-0">@langg('Your Trade Was Successful ! Thank you for using Xnet.')</h5>
                </div>
                @elseif ($trade->status == 3)
                <div class="me-3">
                    <h5 class="m-0">@langg('Trade Has been Canceled')</h5>
                </div>
                @elseif ($trade->status == 4)
                <div class="me-3">
                    <h5 class="m-0">@langg('A Dispute is Now Active.')</h5>
                </div>
                @else
                <div class="me-3">
                    @if ($trade->offer->type == 'sell')
                        @if ($trade->trader_id == auth()->id())
                            <h5 class="m-0">@lang('Please Make Your Payment to Receive: '.numFormat($trade->crypto_amount,8)) {{$trade->crypto->code}}</h5>
                            <span>
                                {{numFormat($trade->crypto_amount,8)}} {{$trade->crypto->code}} @lang("will be added to your ". $trade->crypto->code ." wallet")
                            </span>
                        @elseif($trade->offer_user_id == auth()->id())
                            <h5 class="m-0">@lang(' Trading '.@$trade->offer->gateway->name):  ${{numFormat($trade->fiat_amount)}} {{$trade->fiat->code}}) In Exchange for {{numFormat($trade->crypto_amount,8)}} {{$trade->crypto->code}}</h5>
                            <span>
                                  @lang("Will be deducted from your ". $trade->crypto->code ." Wallet once you confirm the payment and select Release.")
                            </span>
                        @endif
                    @endif
                  
                  
                    @if ($trade->offer->type == 'buy')
                        @if ($trade->trader_id == auth()->id())
                            <h5 class="m-0">@lang('Please Wait For The Payment From: '.$trade->offerOwner->name), For (${{numFormat($trade->fiat_amount)}}  {{$trade->fiat->code}}) In Exchange For:</h5>
                            <span>
                                {{numFormat($trade->crypto_amount,8)}} {{$trade->crypto->code}} @lang("will be deducted from your ". $trade->crypto->code ." wallet") 
                                <h4 class="m-0">@lang('Payment Method: '.@$trade->offer->gateway->name)</h5>
                            </span>
                        @elseif($trade->offer_user_id == auth()->id())
                            <h5 class="m-0">@lang('Please Make Your Payment To Receive: '.numFormat($trade->crypto_amount,8)) {{$trade->crypto->code}} </h5>
                            <span>
                                {{numFormat($trade->crypto_amount,8)}} {{$trade->crypto->code}}  @lang("will be added to your ". $trade->crypto->code ." wallet")
                            </span>
                        @endif
                    @endif

                </div>
                @endif
            </div>
            <div class="create-offer-body px-3 pb-3">
                <div class="alert border-0 px-0 mb-0 d-flex align-items-center">
                    @if ($trade->offer->type == 'buy')
                      @if ($trade->trader_id == auth()->id())
                        <div>
                            <div class="mb-3">
                                @langg('Once The Trader Submits Payment, After Confirmation please select the option RELEASE NOW, to complete the trade. 
                                If the Trader does not submit payment in time, Inform The Trader to Submit or Cancel. 
                                If the Trader is not responding you may activate a Dipsute once the timer has expired.') 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                @if($trade->status != 2 && $trade->status != 3 && $trade->status != 4) 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#releaseModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-exchange-alt"></i> @langg('Release Now')</h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                @lang('Select this option to complete trade only if the payment has been confirmed for '.@$trade->offer->gateway->name).
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                @endif
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> @langg('Time Left')</h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" @if($trade->status != 2 && $trade->status != 3) id="time" @endif>0m 0s</span> <span>@langg('minutes')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                               
                            </div>
                        </div>
                      @elseif($trade->offer_user_id == auth()->id())
                        <div>
                            <div class="mb-3">
                                @langg('Once you’ve Submitted your Payment in the chat box, Select the option Paid before the timer expires. Otherwise the system will automatically cancel your trade. So Please confirm your payment by clicking PAID.') 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                @if($trade->status != 2 && $trade->status != 3 && $trade->status != 4) 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#paidModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-check-circle"></i> @langg('Paid')</h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                @lang('Select this option once you\'ve submitted your : '.@$trade->offer->gateway->name)
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                @endif
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> @langg('Time Left')</h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" @if($trade->status != 2 && $trade->status != 3) id="time" @endif>0m 0s</span> <span>@langg('minutes')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                              
                            </div>
                        </div>
                      @endif
                    @elseif($trade->offer->type == 'sell')
                       @if ($trade->trader_id == auth()->id())
                        <div>
                            <div class="mb-3">
                                @langg('Once you’ve submitted your payment in the chat box, Select the option PAID before the timer expires. Otherwise the system will cancel your trade automatically. So please confirm your payment by clicking PAID.') 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                @if($trade->status != 2 && $trade->status != 3 && $trade->status != 1 && $trade->status != 4) 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#paidModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-check-circle"></i> @langg('Paid')</h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                @lang('Only Select this option once you\'ve submitted your '.@$trade->offer->gateway->name) Information.
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                @endif
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> @langg('Time Left')</h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" @if($trade->status != 2 && $trade->status != 3) id="time" @endif>0m 0s</span> <span>@langg('minutes')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                           
                            </div>
                        </div>
                       @elseif($trade->offer_user_id == auth()->id())
                        <div>
                            <div class="mb-3">
                                @langg('Once The Trader Submits Payment, After Confirmation please select the option RELEASE NOW, To complete the trade. 
                                If the Trader does not submit payment in time, Inform The Trader to Submit or Cancel. 
                                If the Trader is not responding you may start a DISPUTE once the timer has expired.') 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                @if($trade->status != 2 && $trade->status != 3 && $trade->status != 4) 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#releaseModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-exchange-alt"></i> @langg('Release now')</h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                @lang('Select this option to complete the trade and release bitcoin.')
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                @endif
                        
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> @langg('Time Left')</h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" @if($trade->status != 2 && $trade->status != 3) id="time" @endif>0m 0s</span> <span>@langg('minutes')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                           
                            </div>
                        </div>
                       @endif
                    @endif
                    
                </div>
                <div class="alert alert-warning d-flex align-items-center mb-4">
                    <span class="flex-shrink-0 me-3 display-6">
                        <i class="fas fa-info"></i>
                    </span>
                    <div class="me-3">
                        @langg('As outlined in our Terms of Service, You will be responsible for understanding the risk related to transactions made on the Xnet platform and will not hold Xnet Trading liable for any losses or damages you may experience while trading. You also acknowledge that Xnet may not be able to resolve a dispute if you cannot prove or provide sufficent evidence against the buyer or seller. Please remember to read the trader offer terms and trade instructions below.')
                    </div>
                   
                </div>
               
                    @if ($trade->offer->type == 'sell')
                        @if ($trade->trader_id == auth()->id())
                            @if($trade->status != 2 && $trade->status != 3  && $trade->status != 4) 
                            <div class="d-flex justify-content-end">
                                <a href="#0" class="btn btn--danger cancel">@langg('Cancel Trade')</a>
                            </div>
                            @endif
                        @elseif($trade->offer_user_id == auth()->id())
                          @if($trade->status != 2 && $trade->status != 3  && $trade->status != 4) 
                            <div class="d-flex justify-content-end trader">
                                
                            </div>
                          @endif
                        @endif
                    @endif

                    @if ($trade->offer->type == 'buy')
                       @if ($trade->trader_id == auth()->id())
                         @if($trade->status != 2 && $trade->status != 3  && $trade->status != 4) 
                            <div class="d-flex justify-content-end trader">
                            
                            </div>
                          @endif
                        @elseif($trade->offer_user_id == auth()->id())
                          @if($trade->status != 2 && $trade->status != 3  && $trade->status != 4) 
                            <div class="d-flex justify-content-end">
                                <a href="#0" class="btn btn--danger cancel">@langg('Cancel')</a>
                            </div>
                          @endif
                        @endif
                    @endif

                
            </div>
        </div>
    </div>
</div>