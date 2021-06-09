

<?php $__env->startSection('title'); ?>
    <?php echo translate('Offer List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Crypto Offer -->
<section class="crypto-offer-section overflow-hidden pb-100 pt-100">
    <div class="container">
        <div class="row gy-5">
            <div class="col-xl-4 col-xxl-3">
                <aside class="crypto-sidebar">
                    <div class="close-crypto-sidebar d-xl-none">
                        <i class="fas fa-times"></i>
                    </div>
                    <form class="row gy-4 align-items-end" action="" method="GET">
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base"><?php echo translate('Buy or Sell'); ?></label>
                                        <select name="type" class="form-control">
                                            <option value="buy" <?php echo e(request('type') == 'buy' ? 'selected':''); ?>><?php echo translate('Buy'); ?></option>
                                            <option value="sell" <?php echo e(request('type') == 'sell' ? 'selected':''); ?>><?php echo translate('Sell'); ?></option>
                                        </select>
                                    </div>
                                    <div class="crypto-widget">
                                        <label class="form-label text--base" for="amount"><?php echo translate('Amount'); ?></label>
                                        <input type="number" class="form-control" id="amount" placeholder="<?php echo translate('Enter Amount'); ?>" value="<?php echo e(request('amount')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base"><?php echo translate('Crypto Currency'); ?></label>
                                        <select name="crypto" class="form-control">
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($item->code); ?>" <?php echo e(request('crypto') == $item->code ? 'selected':''); ?>><?php echo e($item->code); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget bg--section border rounded">
                                <div class="widget-body border-0">
                                    <div class="crypto-widget">
                                        <label class="form-label text--base"><?php echo translate('Payment Method'); ?></label>
                                        <select name="gateway" class="form-control gateway_id">
                                            <option value=""><?php echo translate('Select One'); ?></option>
                                            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->slug); ?>" data-currency="<?php echo e(json_encode($item->fiats())); ?>" <?php echo e(request('gateway') == $item->slug ? 'selected':''); ?>><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="crypto-widget">
                                        <label class="form-label text--base"><?php echo translate('Currency'); ?></label>
                                        <select name="currency" class="form-control fiats" disabled>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="w-100 cmn--btn rounded" type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </aside>
            </div>
            <div class="col-xl-8 col-xxl-9">
                <div class="d-xl-none mb-4">
                    <button class="cmn--btn filter-button rounded" type="button"><i class="fas fa-filter"></i>
                        <?php echo translate('Filter
                        Search'); ?></button>
                </div>
                <div class="table-responsive table--mobile-lg">
                    <table class="table crypto-offer-table bg--body">
                        <thead>
                            <tr>
                                <?php if(request('type') == 'buy'): ?>
                                   <th><?php echo translate('Buy From'); ?></th>
                                <?php endif; ?>
                               
                                <?php if(request('type') == 'sell'): ?>
                                   <th><?php echo translate('Sell To'); ?></th>
                                <?php endif; ?>

                                <?php if(request('type') == 'sell'): ?>
                                  <th><?php echo translate('Get Paid With'); ?></th>
                                <?php endif; ?>
                                <?php if(request('type') == 'buy'): ?>
                                  <th><?php echo translate('Pay With'); ?></th>
                                <?php endif; ?>
                                <th><?php echo translate('Trade Duration'); ?></th>
                                <th><?php echo translate('Price Type'); ?></th>
                                <th><?php echo translate('Rate per Crypto'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td data-label="<?php echo e(translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')); ?>">
                                    <div class="table-buyer">
                                        <img src="<?php echo e(getPhoto($item->user->photo)); ?>">
                                        <h6 class="m-0 subtitle"><?php echo e($item->user->username); ?></h6>
                                    </div>
                                </td>

                                <td data-label="<?php echo translate('Pay With'); ?>">
                                    <div class="text-center">
                                        <h6 class="m-0">
                                           <?php echo e($item->gateway->name); ?>

                                        </h6>
                                    </div>
                                </td>
                                <td data-label="<?php echo translate('Trade Duration'); ?>">
                                    <div class="text-center">
                                        <?php echo e($item->duration->duration); ?> <?php echo translate('Minutes'); ?>
                                    </div>
                                </td>
                                <td data-label="<?php echo translate('Trade Duration'); ?>">
                                    <?php if($item->price_type == 1): ?>
                                    <span class="badge badge--success">
                                        <?php echo translate('Market Price'); ?>
                                    </span>
                                    <?php else: ?>
                                    <span class="badge badge--primary">
                                        <?php echo translate('Fixed Price'); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                      
                                <td data-label="<?php echo translate('Rate per Crypto'); ?>">
                                    <div class="text-center pt-3 pt-md-0">
                                        <h6 class="m-0 mb-md-1"><?php echo e(amount($item->crypto->rate * $item->fiat->rate)); ?> <?php echo e($item->fiat->code); ?> / <?php echo e($item->crypto->code); ?></h6>
                                        <?php if($item->price_type == 1): ?>
                                            <div class="text-center mb-2">
                                                <span class="rate text--<?php echo e($item->neg_margin == 1 ? 'danger':'success'); ?> font--sm">
                                                    <i class="fas fa-arrow-<?php echo e($item->neg_margin == 1 ? 'down':'up'); ?>"></i> <?php echo e(numFormat($item->margin)); ?>%
                                                </span>
                                             
                                                <span data-tooltip="<?php echo e(translate('Quoted price that')); ?> <?php echo e(numFormat($item->margin)); ?>% <?php echo e(translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")); ?>" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                            </div>
                                        <?php else: ?>
                                        <div class="text-center mb-2">
                                            <span class="rate text--success font--sm">
                                                <?php echo e(amount($item->fixed_rate)); ?> <?php echo e($item->fiat->code); ?>

                                            </span>
                                        </div>
                                        <?php endif; ?>
            
                                        <span class="font--sm me-2"><?php echo translate('Limits'); ?>: <?php echo e(amount($item->minimum)); ?> – <?php echo e(amount($item->maximum)); ?> <?php echo e($item->fiat->code); ?></span>
                                    
                                       
                                          <a href="<?php echo e(route('user.trade.create',$item->offer_id)); ?>" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> <?php echo e(translate(request('type') == 'buy' ? 'Buy' : 'Sell')); ?> </a>
                                       
                                    </div>
                                </td>
                               
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-center" colspan="12"><?php echo translate('No offers found!'); ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($offers->links()); ?>

            </div>
        </div>
    </div>
</section>
<!-- Crypto Offer -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.gateway_id').on('change',function () { 
           const currency = $(this).find('option:selected').data('currency')
           var option = '<option value=""><?php echo translate('Select'); ?></option>';
           $.each(currency, function (i, val) { 
              option += `<option value="${val.code}">${val.code}</option>`
           });
           $('.fiats').attr('disabled',false)
           $('.fiats').html(option)
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/frontend/offers.blade.php ENDPATH**/ ?>