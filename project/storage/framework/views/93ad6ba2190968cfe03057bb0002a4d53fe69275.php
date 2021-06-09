

<?php $__env->startSection('title'); ?>
    <?php echo translate('Create trade request'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Trade Request -->
<?php if(kycTradeLimit()): ?>
<section class="trade-request-section pb-100 pt-100">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="create-trade-request-wrapper  border">
                    <h3 class="title"><?php echo translate('How much do you want to'); ?> <?php echo e($offer->type == 'buy' ? translate('Sell'):translate('Buy')); ?></h3>
                    <h6 class="title">1 <span class="text--base"><?php echo e($offer->crypto->code); ?></span> = <?php echo e(amount($offer->crypto->rate * $offer->fiat->rate)); ?> <?php echo e($offer->fiat->code); ?></h6>
                
                    <form action="<?php echo e(route('user.trade.submit')); ?>" method="POST" id="form">
                        <?php echo csrf_field(); ?>
                      
                        <input type="hidden" name="offer_id" value="<?php echo e($offer->id); ?>">
                        <input type="hidden" name="crypto_id" value="<?php echo e($offer->cryp_id); ?>">
                        <input type="hidden" name="fiat_id" value="<?php echo e($offer->fiat_id); ?>">
                     
                        <div class="row g-3 g-md-4">
                            <div class="col-sm-6">
                                <label for="pay" class="form-label"><?php echo e($offer->type == 'buy' ? translate('I will receive'):translate('I will pay')); ?></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="pay" placeholder="<?php echo translate('Enter Amount'); ?>" name="fiat_amount">
                                    <span class="input-group-text"><?php echo e($offer->fiat->code); ?></span>
                                </div>
                                <div class="font--sm mt-2">
                                    <i class="fas fa-info-circle"></i>
                                    <?php echo translate('Minimum : '); ?> <span class="text--base"><?php echo e(amount($offer->minimum)); ?> <?php echo e($offer->fiat->code); ?></span> <?php echo translate('and'); ?>
                                    <?php echo translate('Maximum : '); ?> <span class="text--base"><?php echo e(amount($offer->maximum)); ?> <?php echo e($offer->fiat->code); ?></span>
                                </div>
                                <div class="font--sm mt-2 limit d-none">
                                    <i class="fas fa-info-circle text--danger"></i>
                                    <span class="text--danger"><?php echo translate('Please follow the limit.'); ?></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="get" class="form-label"><?php echo e($offer->type == 'buy' ? translate('And Pay'):translate(' And Receive')); ?> </label> <small><code>(<?php echo translate('Amount will be calculated based on Seller/Buyer price rate.'); ?>)</code></small>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="get" name="crypto_amount">
                                    <span class="input-group-text"><?php echo e($offer->crypto->code); ?></span>
                                </div>
                            </div>
                           
                            <div class="col-sm-12">
                                <button class="cmn--btn w-100 rounded submit" type="button"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3"><?php echo translate('About This Offer'); ?></h4>
                    <div class="about-offer-area border rounded">
                       
                        <div class="about-offer-wrap">
                            <div class="about-offer-item">
                                <span class="title"><?php echo e($offer->type == 'buy' ? translate('Buyer'):translate('Seller')); ?> <?php echo translate('Rate'); ?></span>
                                <?php if($offer->price_type == 1): ?>
                                <div class="info">
                                    <strong><?php echo e(amount($rate)); ?> <?php echo e($offer->fiat->code); ?></strong> <?php echo e(numFormat($offer->margin)); ?>% <?php echo e($offer->neg_margin == 1 ? translate('below') : translate('above')); ?> <?php echo translate('market'); ?>
                                </div>
                                <?php else: ?>
                                <div class="info">
                                    <strong><?php echo e(amount($rate)); ?> <?php echo e($offer->fiat->code); ?></strong>
                                </div>
                                <?php endif; ?>
                               
                            </div>
                            <div class="about-offer-item">
                                <span class="title"><?php echo translate('Trade Time Limit'); ?></span>
                                <div class="info">
                                    <strong><?php echo translate('Min'); ?></strong> - <?php echo e(amount($offer->minimum)); ?> <?php echo e($offer->fiat->code); ?>

                                    <strong><?php echo translate('Max'); ?></strong> - <?php echo e(amount($offer->maximum)); ?> <?php echo e($offer->fiat->code); ?>

                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="about-offer-item">
                                    <span class="title"><?php echo translate('Trade Duration'); ?></span>
                                    <div class="info">
                                        <strong><?php echo e($offer->trade_duration); ?> <?php echo translate('Minutes'); ?></strong>
                                    </div>
                                </div>
                                <?php if($offer->type == 'buy'): ?>
                                    <div class="about-offer-item">
                                        <span class="title"><?php echo e(__($gs->title)); ?> <?php echo translate('Fees'); ?></span>
                                        <div class="info">
                                            <strong><?php echo e($gs->trade_fee); ?>%</strong>
                                        </div>
                                    </div> 
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3"><?php echo translate('About This'); ?> <?php echo e($offer->type == 'buy' ? translate('Buyer'):translate('Seller')); ?></h4>
                    <div class="about-offer-area border rounded">
                        <div class="cmn--media ms-0">
                            <img src="<?php echo e(getPhoto($offer->user->photo)); ?>" alt="clients">
                            <div class="subtitle">
                                <h5 class="m-0"><?php echo e($offer->user->username); ?></h5>
                                <span class="m-0"><?php echo translate('Total Successful Trades : '); ?> <?php echo e($offer->user->completedTrade()); ?></span>
                            </div>
                        </div>
                        <ul class="user-info-list">
                           
                            <?php if($offer->user->kyc_status == 1): ?>
                                <li>
                                    <?php echo translate('Identity Verified'); ?>
                                </li>
                            <?php else: ?>
                                <li class="no">
                                    <?php echo translate('Identity not Verified'); ?>
                                </li>
                                 
                            <?php endif; ?>
                            <?php if($offer->user->email_verified == 1): ?>
                                <li>
                                    <?php echo translate('Email Verified'); ?>
                                </li>
                            <?php else: ?>
                                <li class="no">
                                    <?php echo translate('Email Not Verified'); ?>
                                </li>
                                 
                            <?php endif; ?>
                            <?php if($offer->user->phone_verified == 1): ?>
                                <li>
                                    <?php echo translate('Phone Verified'); ?>
                                </li>
                            <?php else: ?>
                                <li class="no">
                                    <?php echo translate('Phone Not Verified'); ?>
                                </li>
                                 
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3"><?php echo translate('Offer Terms'); ?></h4>
                    <div class="about-offer-area border rounded">
                        <?php echo e($offer->offer_terms); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-offer">
                    <h4 class="title mb-3 pt-3"><?php echo translate('Trade Instructions'); ?></h4>
                    <div class="about-offer-area border rounded">
                        <?php echo e($offer->trade_instructions); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="trade-request-section pb-100 pt-100">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="create-trade-request-wrapper  border">
                <h6 class="text-center"><?php echo translate('Please Complete Identity Verification To Unlock Full Access.'); ?> <a class="text--base" href="<?php echo e(route('user.kyc.form')); ?>"><?php echo translate('Submit.'); ?></a></h6>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Trade Request -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';

        var finalRate  = parseFloat("<?php echo e($rate); ?>");
        const min = parseFloat("<?php echo e(numFormat($offer->minimum)); ?>")
        const max = parseFloat("<?php echo e(numFormat($offer->maximum)); ?>")

        $('#pay').on('keyup',function () { 
            var amount = $(this).val();
            if(amount == '' && !$.isNumeric(amount)){
                $('#get').val(0)
                $('.limit').addClass('d-none')
                return false;
            }
          
            if(amount < min || amount > max) {
               $('.limit').removeClass('d-none')
               $('.submit').attr('disabled',true)
                return false;
            }
            $('.limit').addClass('d-none')
            $('.submit').attr('disabled',false)
            var finalAmout = amount / finalRate;
            $('#get').val(finalAmout.toFixed(8))
        })


        $('#get').on('keyup',function () { 
            var amount = $(this).val();
            if(amount == '' && !$.isNumeric(amount)){
                $('#pay').val(0)
                $('.limit').addClass('d-none')
                return false;
            }

            if(amount < (min / finalRate) || amount > (max / finalRate)) {
                $('.limit').removeClass('d-none')
                $('.submit').attr('disabled',true)
                return false;
            }
            $('.limit').addClass('d-none')
            $('.submit').attr('disabled',false)
            var finalAmout = amount * finalRate;
            $('#pay').val(finalAmout.toFixed(2))
        })

        $('.submit').on('click',function () { 
            if($('#get').val() == '' || $('#pay').val() == ''){
                toast('error',"<?php echo translate('Please fill up fields.'); ?>")
                return false;
            }
            $(this).attr('disabled',true)
            $("#form").submit();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/frontend/create_trade.blade.php ENDPATH**/ ?>