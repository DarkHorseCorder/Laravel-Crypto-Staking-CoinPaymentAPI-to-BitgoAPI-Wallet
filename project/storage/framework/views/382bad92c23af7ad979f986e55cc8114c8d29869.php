<div class="col-xl-6 col-xxl-5">
    <div class="font--sm">
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <span class="flex-shrink-0 me-2 display-6">
                <i class="fas fa-info-circle"></i>
            </span>
            <div class="me-3">
                <?php echo translate('Remember to keep all conversations within the trade chat. Trading outside of Xnet
                is against our policies and we won’t be able to assist you if
                something goes wrong.'); ?>
            </div>   
        </div>
        <div class="create-offer-wrapper p-0">
            <div
                class="alert border-0 radius-0 border-bottom bg--body d-flex align-items-center mb-0">
                <span class="flex-shrink-0 me-3 display-6">
                    <i class="fas fa-tachometer-alt"></i>
                </span>
                <?php if($trade->status == 3): ?>
                <div class="me-3">
                    <h5 class="m-0"><?php echo translate('Your Trade Was Successful ! Thank you for using Xnet.'); ?></h5>
                </div>
                <?php elseif($trade->status == 3): ?>
                <div class="me-3">
                    <h5 class="m-0"><?php echo translate('Trade Canceled'); ?></h5>
                </div>
                <?php elseif($trade->status == 4): ?>
                <div class="me-3">
                    <h5 class="m-0"><?php echo translate('A Dispute is Now Active.'); ?></h5>
                </div>
                <?php else: ?>
                <div class="me-3">
                    <?php if($trade->offer->type == 'sell'): ?>
                        <?php if($trade->trader_id == auth()->id()): ?>
                            <h5 class="m-0"><?php echo app('translator')->get('Please Make Your Payment to Receive: '.numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?></h5>
                            <span>
                                <?php echo e(numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?> <?php echo app('translator')->get("will be added to your ". $trade->crypto->code ." wallet"); ?>
                            </span>
                        <?php elseif($trade->offer_user_id == auth()->id()): ?>
                            <h5 class="m-0"><?php echo app('translator')->get(' Trading '.@$trade->offer->gateway->name); ?>:  $<?php echo e(numFormat($trade->fiat_amount)); ?> <?php echo e($trade->fiat->code); ?>) In Exchange for <?php echo e(numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?></h5>
                            <span>
                                  <?php echo app('translator')->get("Will be deducted from your ". $trade->crypto->code ." Wallet once you confirm the payment and select Release."); ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                  
                  
                    <?php if($trade->offer->type == 'buy'): ?>
                        <?php if($trade->trader_id == auth()->id()): ?>
                            <h5 class="m-0"><?php echo app('translator')->get('Please Wait For The Payment From: '.$trade->offerOwner->name); ?>, For ($<?php echo e(numFormat($trade->fiat_amount)); ?>  <?php echo e($trade->fiat->code); ?>) In Exchange For:</h5>
                            <span>
                                <?php echo e(numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?> <?php echo app('translator')->get("will be deducted from your ". $trade->crypto->code ." wallet"); ?> 
                                <h4 class="m-0"><?php echo app('translator')->get('Payment Method: '.@$trade->offer->gateway->name); ?></h5>
                            </span>
                        <?php elseif($trade->offer_user_id == auth()->id()): ?>
                            <h5 class="m-0"><?php echo app('translator')->get('Please Make Your Payment To Receive: '.numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?> </h5>
                            <span>
                                <?php echo e(numFormat($trade->crypto_amount,8)); ?> <?php echo e($trade->crypto->code); ?>  <?php echo app('translator')->get("will be added to your ". $trade->crypto->code ." wallet"); ?>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
                <?php endif; ?>
            </div>
            <div class="create-offer-body px-3 pb-3">
                <div class="alert border-0 px-0 mb-0 d-flex align-items-center">
                    <?php if($trade->offer->type == 'buy'): ?>
                      <?php if($trade->trader_id == auth()->id()): ?>
                        <div>
                            <div class="mb-3">
                                <?php echo translate('Once The Trader Submits Payment, After Confirmation please select the option RELEASE NOW, to complete the trade. 
                                If the Trader does not submit payment in time, Inform The Trader to Submit or Cancel. 
                                If the Trader is not responding you may activate a Dipsute once the timer has expired.'); ?> 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                <?php if($trade->status != 2 && $trade->status != 3 && $trade->status != 4): ?> 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#releaseModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-exchange-alt"></i> <?php echo translate('Release Now'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                <?php echo app('translator')->get('Select this option to complete trade only if the payment has been confirmed for '.@$trade->offer->gateway->name); ?>.
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <?php endif; ?>
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> <?php echo translate('Time Left'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" <?php if($trade->status != 2 && $trade->status != 3): ?> id="time" <?php endif; ?>>0m 0s</span> <span><?php echo translate('minutes'); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                               
                            </div>
                        </div>
                      <?php elseif($trade->offer_user_id == auth()->id()): ?>
                        <div>
                            <div class="mb-3">
                                <?php echo translate('Once you’ve Submitted your Payment in the chat box, Select the option Paid before the timer expires. Otherwise the system will automatically cancel your trade. So Please confirm your payment by clicking PAID.'); ?> 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                <?php if($trade->status != 2 && $trade->status != 3 && $trade->status != 4): ?> 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#paidModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-check-circle"></i> <?php echo translate('Paid'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                <?php echo app('translator')->get('Select this option once you\'ve submitted your : '.@$trade->offer->gateway->name); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <?php endif; ?>
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> <?php echo translate('Time Left'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" <?php if($trade->status != 2 && $trade->status != 3): ?> id="time" <?php endif; ?>>0m 0s</span> <span><?php echo translate('minutes'); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                              
                            </div>
                        </div>
                      <?php endif; ?>
                    <?php elseif($trade->offer->type == 'sell'): ?>
                       <?php if($trade->trader_id == auth()->id()): ?>
                        <div>
                            <div class="mb-3">
                                <?php echo translate('Once you’ve submitted your payment in the chat box, Select the option PAID before the timer expires. Otherwise the system will cancel your trade automatically. So please confirm your payment by clicking PAID.'); ?> 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                <?php if($trade->status != 2 && $trade->status != 3 && $trade->status != 1 && $trade->status != 4): ?> 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#paidModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-check-circle"></i> <?php echo translate('Paid'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                <?php echo app('translator')->get('Only Select this option once you\'ve submitted your '.@$trade->offer->gateway->name); ?> Information.
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <?php endif; ?>
                              
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> <?php echo translate('Time Left'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" <?php if($trade->status != 2 && $trade->status != 3): ?> id="time" <?php endif; ?>>0m 0s</span> <span><?php echo translate('minutes'); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                           
                            </div>
                        </div>
                       <?php elseif($trade->offer_user_id == auth()->id()): ?>
                        <div>
                            <div class="mb-3">
                                <?php echo translate('Once The Trader Submits Payment, After Confirmation please select the option RELEASE NOW, To complete the trade. 
                                If the Trader does not submit payment in time, Inform The Trader to Submit or Cancel. 
                                If the Trader is not responding you may start a DISPUTE once the timer has expired.'); ?> 
                            </div>
                            <div class="w-100 d-flex flex-wrap">
                                <?php if($trade->status != 2 && $trade->status != 3 && $trade->status != 4): ?> 
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#releaseModal" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-exchange-alt"></i> <?php echo translate('Release now'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="d-flex">
                                            <li>
                                                <?php echo app('translator')->get('Select this option to complete the trade and release bitcoin.'); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <?php endif; ?>
                        
                                <a href="javascript:void(0)" class="paid-btn flex-grow-1 m-1">
                                    <h5 class="subtitle"><i class="fas fa-history"></i> <?php echo translate('Time Left'); ?></h5>
                                    <div class="d-flex">
                                        <ul class="countdown d-flex">
                                            <li>
                                                <span class="me-1" <?php if($trade->status != 2 && $trade->status != 3): ?> id="time" <?php endif; ?>>0m 0s</span> <span><?php echo translate('minutes'); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                           
                            </div>
                        </div>
                       <?php endif; ?>
                    <?php endif; ?>
                    
                </div>
                <div class="alert alert-warning d-flex align-items-center mb-4">
                    <span class="flex-shrink-0 me-3 display-6">
                        <i class="fas fa-info"></i>
                    </span>
                    <div class="me-3">
                        <?php echo translate('As outlined in our Terms of Service, You will be responsible for understanding the risk related to transactions made on the Xnet platform and will not hold Xnet Trading liable for any losses or damages you may experience while trading. You also acknowledge that Xnet may not be able to resolve a dispute if you cannot prove or provide sufficent evidence against the buyer or seller. Please remember to read the trader offer terms and trade instructions below.'); ?>
                    </div>
                   
                </div>
               
                    <?php if($trade->offer->type == 'sell'): ?>
                        <?php if($trade->trader_id == auth()->id()): ?>
                            <?php if($trade->status != 2 && $trade->status != 3  && $trade->status != 4): ?> 
                            <div class="d-flex justify-content-end">
                                <a href="#0" class="btn btn--danger cancel"><?php echo translate('Cancel Trade'); ?></a>
                            </div>
                            <?php endif; ?>
                        <?php elseif($trade->offer_user_id == auth()->id()): ?>
                          <?php if($trade->status != 2 && $trade->status != 3  && $trade->status != 4): ?> 
                            <div class="d-flex justify-content-end trader">
                                
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if($trade->offer->type == 'buy'): ?>
                       <?php if($trade->trader_id == auth()->id()): ?>
                         <?php if($trade->status != 2 && $trade->status != 3  && $trade->status != 4): ?> 
                            <div class="d-flex justify-content-end trader">
                            
                            </div>
                          <?php endif; ?>
                        <?php elseif($trade->offer_user_id == auth()->id()): ?>
                          <?php if($trade->status != 2 && $trade->status != 3  && $trade->status != 4): ?> 
                            <div class="d-flex justify-content-end">
                                <a href="#0" class="btn btn--danger cancel"><?php echo translate('Cancel'); ?></a>
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                
            </div>
        </div>
    </div>
</div><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/trade/tradebar.blade.php ENDPATH**/ ?>