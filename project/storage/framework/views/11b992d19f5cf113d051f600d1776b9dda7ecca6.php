
<?php
    $offers = App\Models\Offer::with(['gateway','crypto','fiat','duration','user'])->where('status',1)->latest()->take(5)->get();
?>
<section class="crypto-but-sell pt-50 pb-100">
    <div class="container">
        <div class="section-header">
            <h6 class="section-header__subtitle"><?php echo app('translator')->get(@$section->content->title); ?></h6>
            <h3 class="section-header__title"><?php echo app('translator')->get(@$section->content->heading); ?></h3>
        </div>
        <div class="crypto-table-wrapper bg--section">
            <div class="crypto-table-header">
                <ul class="nav nav-tabs nav--tabs m-0">
                    <li class="nav-item">
                        <a href="#buy" data-bs-toggle="tab" class="active"><?php echo translate('Buy'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#sell" data-bs-toggle="tab"><?php echo translate('Sell'); ?></a>
                    </li>
                </ul>
            </div>
            <div class="crypto-table-body mx-3 mb-3 rounded">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="buy">
                        <div class="table-responsive table--mobile-lg">
                            <table class="table bg--body">
                                <thead>
                                    <tr>
                                        <th><?php echo translate('Buy From'); ?></th>
                                        <th><?php echo translate('Pay With'); ?></th>
                                        <th><?php echo translate('Trade Duration'); ?></th>
                                        <th><?php echo translate('Price Type'); ?></th>
                                        <th><?php echo translate('Rate per Crypto'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $offers->where('type','sell'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="<?php echo e(translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')); ?>">
                                            <div class="table-buyer">
                                                <img src="<?php echo e(getPhoto($item->user->photo)); ?>">
                                                <h6 class="m-0 subtitle"><?php echo e($item->user->name); ?></h6>
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
                                            
                                               
                                                  <a href="<?php echo e(route('user.trade.create',$item->offer_id)); ?>" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> <?php echo e(translate('buy')); ?> </a>
                                               
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
                    </div>
                    <div class="tab-pane fade" id="sell">
                        <div class="table-responsive table--mobile-lg">
                            <table class="table bg--body">
                                <thead>
                                    <tr>
                                   
                             
                                    <th><?php echo translate('Sell To'); ?></th>
                                    <th><?php echo translate('Get Paid With'); ?></th>
                                     <th><?php echo translate('Trade Duration'); ?></th>
                                     <th><?php echo translate('Price Type'); ?></th>
                                     <th><?php echo translate('Rate per Crypto'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $offers->where('type','buy'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="<?php echo e(translate(request('type') == 'buy' ? 'Buy From' : 'Sell To')); ?>">
                                            <div class="table-buyer">
                                                <img src="<?php echo e(getPhoto($item->user->photo)); ?>">
                                                <h6 class="m-0 subtitle"><?php echo e($item->user->name); ?></h6>
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
                                                     
                                                        <span data-tooltip="<?php echo e(translate('You have Quoted price that')); ?> <?php echo e(numFormat($item->margin)); ?>% <?php echo e(translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")); ?>" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                                    </div>
                                                <?php else: ?>
                                                <div class="text-center mb-2">
                                                    <span class="rate text--success font--sm">
                                                        <?php echo e(amount($item->fixed_rate)); ?> <?php echo e($item->fiat->code); ?>

                                                    </span>
                                                </div>
                                                <?php endif; ?>
                    
                                                <span class="font--sm me-2"><?php echo translate('Limits'); ?>: <?php echo e(amount($item->minimum)); ?> – <?php echo e(amount($item->maximum)); ?> <?php echo e($item->fiat->code); ?></span>
                                            
                                               
                                                  <a href="<?php echo e(route('user.trade.create',$item->offer_id)); ?>" class="btn btn--base text--dark btn-sm"><i class="fab fa-ethereum"></i> <?php echo e(translate( 'Sell' )); ?> </a>
                                               
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/frontend/sections/offer.blade.php ENDPATH**/ ?>