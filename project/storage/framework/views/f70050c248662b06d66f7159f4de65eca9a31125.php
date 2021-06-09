

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Edit Offer'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">

    <div class="create-offer-wrapper">
        <div class="create-offer-body">
            <form class="create-offer-form" action="<?php echo e(route('user.offer.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($offer->id); ?>" required>
                <fieldset>
                    <div class="row gy-4">
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto"><?php echo translate('Choose your
                                Crypto Currency'); ?></label>
                            <select name="cryp_id" id="crypto"
                                class="form-control form--control bg--section">
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($offer->cryp_id == $item->id ? 'selected':''); ?>><?php echo e($item->code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto"><?php echo translate('Payment
                                Method'); ?></label>
                            <select name="gateway_id"
                                class="form-control form--control bg--section gateway_id">
                                <option value=""><?php echo translate('Select'); ?></option>
                                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" data-fiats="<?php echo e(json_encode($item->fiats())); ?>" <?php echo e($offer->gateway_id == $item->id ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                       
                        <div class="col-sm-4">
                            <label class="form-label text--primary" for="crypto"><?php echo translate('Choose your Fiat Currency'); ?></label>
                            <select name="fiat_id" disabled
                                class="form-control form--control bg--section fiat_id">
                                <option value=""><?php echo translate('Select'); ?></option>
                            </select>
                        </div>
                        
                        <div class="col-xxl-6">
                            <h5 class="text--base mb-4 mt-0"><?php echo translate('What would you like to do ?'); ?></h5>
                            <div class="action-type-wrapper">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="type" value="sell"
                                        hidden id="sell-crypto" <?php echo e($offer->type == 'sell' ? 'checked':''); ?>>
                                    <label class="transaction-crypto form-check-label" for="sell-crypto">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6><?php echo translate('Sell'); ?></h6>
                                            <p>
                                                <?php echo translate('This option will list your offer on the buy page'); ?>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="type" value="buy" hidden
                                        id="buy-crypto" <?php echo e($offer->type == 'buy' ? 'checked':''); ?>>
                                        <label class="transaction-crypto form-check-label" for="buy-crypto">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6><?php echo translate('Buy'); ?></h6>
                                            <p>
                                                <?php echo translate('This option will list your offer on the sell page'); ?>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <h5 class="text--base mb-4 mt-0"><?php echo translate('Choose Crypto Rate you want to use'); ?></h5>
                            <div class="action-type-wrapper">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="price_type"
                                        id="market-price" value="1" hidden <?php echo e($offer->price_type == 1 ? 'checked':''); ?>>
                                       <label class="transaction-crypto form-check-label" for="market-price">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6><?php echo translate('Market Price'); ?></h6>
                                            <p>
                                               <?php echo translate('Your offer price will change according to the
                                               market price of Crypto'); ?>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="price_type"
                                        id="fixed-price" value="2" hidden <?php echo e($offer->price_type == 2 ? 'checked':''); ?>>
                                    <label class="transaction-crypto form-check-label" for="fixed-price">
                                        <span class="checkmark"><i class="fas fa-check-circle"></i></span>
                                        <div>
                                            <h6><?php echo translate('Fixed Price'); ?></h6>
                                            <p>
                                                <?php echo translate('This option will keep your offer price the same
                                                unless you update it.'); ?>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                  
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0"><?php echo translate('Offer Trade Limits'); ?></h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="min" class="form-label text--primary"><?php echo translate('Minimum'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="minimum" id="min"
                                            class="form-control form--control bg--section" required value="<?php echo e(numFormat($offer->minimum)); ?>">
                                        <span class="input-group-text fiat_code"><?php echo e($offer->fiat->code); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="max" class="form-label text--primary"><?php echo translate('Maximum'); ?></label>
                                    <div class="input-group">
                                        <input type="text" id="max" name="maximum"
                                            class="form-control form--control bg--section"  required value="<?php echo e(numFormat($offer->maximum)); ?>">
                                        <span class="input-group-text fiat_code"><?php echo e($offer->fiat->code); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0"><?php echo translate('Offer rate and duration'); ?></h5>
                            <div class="row">
                                <div class="col-sm-6 rate">
                                    <?php if($offer->price_type == 1): ?>
                                    <label for="offer-margin" class="form-label text--primary"><?php echo translate('Offer
                                        Margin (%)'); ?></label>
                                    <div class="input-group">
                                        <button type="button" class="input-group-text margin_minus">-</button>
                                        <input type="text" name="margin" class="form-control form--control bg--section" value="<?php echo e($offer->neg_margin == 1 ? '-'.numFormat($offer->margin):numFormat($offer->margin)); ?>" required>
                                        <button type="button" class="input-group-text margin_plus">+</button>
                                    </div>
                                    <?php else: ?>
                                    <label for="max" class="form-label text--primary"><?php echo translate('Fixed Rate'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="fixed_rate" value="<?php echo e(numFormat($offer->fixed_rate)); ?>" class="form-control form--control bg--section" required>
                                        <span class="input-group-text fiat_code"><?php echo e($offer->fiat->code); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6">
                                    <label for="offer-limit" class="form-label text--primary"><?php echo translate('Trade Duration'); ?></label>
                                    <select name="trade_duration" id="offer-limit"
                                        class="form-control form--control bg--section">
                                        <?php $__currentLoopData = $tradeSpeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $offer->trade_duration ? 'selected' : ''); ?>><?php echo e($item->duration); ?> <?php echo translate('Minutes'); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h5 class="text--base mb-3 mt-0"><?php echo translate('Offer Terms & Trade Instructions'); ?></h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="offer-terms" class="form-label text--primary"><?php echo translate('Offer
                                        Terms'); ?></label>
                                    <textarea class="form-control  form--control bg--section"
                                        id="offer-terms" name="offer_terms" required><?php echo e($offer->offer_terms); ?></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="offer-instructions" class="form-label text--primary"><?php echo translate('Trade
                                        Instructions'); ?></label>
                                    <textarea class="form-control  form--control bg--section"
                                        id="offer-instructions" name="trade_instructions"><?php echo e($offer->trade_instructions); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label text--primary" for="crypto"><?php echo translate('Offer Status'); ?></label>
                            <select name="status"
                                class="form-control form--control bg--section">
                                <option value="1" <?php echo e($offer->status == 1 ? 'selected':''); ?>><?php echo translate('Active'); ?></option>
                                <option value="0" <?php echo e($offer->status == 0 ? 'selected':''); ?>><?php echo translate('Inactive'); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-end">
                                <button type="submit" class="cmn--btn rounded next-step"><i class="fas fa-edit"></i> <?php echo translate('Update Offer'); ?></button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        function fiat() { 
           const fiat_id = '<?php echo e($offer->fiat_id); ?>'
           const fiats = $('.gateway_id').find('option:selected').data('fiats')
           var option = '<option value=""><?php echo translate('Select'); ?></option>';
           $.each(fiats, function (i, val) { 
              option += `<option value="${val.id}" data-code="${val.code}" ${fiat_id == val.id ? 'selected':''}>${val.code}</option>`
           });
           $('.fiat_id').attr('disabled',false)
           $('.fiat_id').html(option)
        }
        fiat();
       
        $('.gateway_id').on('change',function () { 
            fiat();
        })

        $(document).on('change','.fiat_id',function () { 
            const code = $(this).find('option:selected').data('code')
            $('.fiat_code').text(code)
        })

        $('input[name=price_type]').on('change',function () {
            var input = '';
            const code = $('.fiat_id').find('option:selected').data('code') ?? '<?php echo e($gs->curr_code); ?>'
            if($(this).val() == 1){
                input += `
                <label for="offer-margin" class="form-label text--primary"><?php echo translate('Offer Margin (%)'); ?></label>
                <div class="input-group">
                    <button type="button" class="input-group-text margin_minus">-</button>
                    <input type="text" name="margin" value="0" class="form-control form--control bg--section" required>
                    <button type="button" class="input-group-text margin_plus">+</button>
                </div>
                `
            }
            if($(this).val() == 2){
                input +=`
                <label for="max" class="form-label text--primary"><?php echo translate('Fixed Rate'); ?></label>
                <div class="input-group">
                    <input type="text" name="fixed_rate" class="form-control form--control bg--section" required>
                    <span class="input-group-text fiat_code">${code}</span>
                </div>
                `
            }
            $('.rate').html(input)
        })

        $(document).on('click','.margin_plus',function () { 
            var count = $(document).find('input[name=margin]').val()
            if(count == '' || !$.isNumeric(count)) count = 0;
            $('input[name=margin]').val(++count)
        })

        $(document).on('click','.margin_minus',function () { 
            var count = $(document).find('input[name=margin]').val()
            if(count == '' || !$.isNumeric(count)) count = 0;
            $('input[name=margin]').val(--count)
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/offer/edit.blade.php ENDPATH**/ ?>