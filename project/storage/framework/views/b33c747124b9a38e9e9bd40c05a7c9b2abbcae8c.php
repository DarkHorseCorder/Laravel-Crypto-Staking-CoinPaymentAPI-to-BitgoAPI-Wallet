

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('Your offers'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard--content-item">
    <div class="table-responsive table--mobile-lg">
        <table class="table crypto-offer-table bg--body">
            <thead>
                <tr>
                    <th><?php echo translate('Date'); ?></th>
                    <th><?php echo translate('Offer ID'); ?></th>
                    <th><?php echo translate('Offer Type'); ?></th>
                    <th><?php echo translate('Pay With'); ?></th>
                    <th><?php echo translate('Trade Duration'); ?></th>
                    <th><?php echo translate('Price Type'); ?></th>
                    <th><?php echo translate('Rate per Crypto'); ?></th>
                    <th><?php echo translate('Status'); ?></th>
                    <th><?php echo translate('Action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td data-label="<?php echo translate('Date'); ?>">
                        <div>
                            <?php echo e(dateFormat($item->created_at,'d M Y')); ?>

                        </div>
                    </td>
                    
                    <td data-label="<?php echo translate('Offer ID'); ?>">
                        <div>
                            <?php echo e($item->offer_id); ?>

                        </div>
                    </td>
                    <td data-label="<?php echo translate('Offer Type'); ?>">
                        <?php if($item->type == 'sell'): ?>
                        <span class="badge badge--success">
                            <?php echo translate('Sell'); ?>
                        </span>
                        <?php else: ?>
                        <span class="badge badge--primary">
                            <?php echo translate('Buy'); ?>
                        </span>
                        <?php endif; ?>
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
                                        <i class="fas fa-arrow-<?php echo e($item->neg_margin == 1 ? 'down':'up'); ?>"></i> <?php echo e($item->margin); ?>%
                                    </span>
                                 
                                    <span data-tooltip="<?php echo e(translate('You have Quoted price that')); ?> <?php echo e(amount($item->margin)); ?>% <?php echo e(translate($item->neg_margin == 1 ? 'lower than market price':"higher than market price")); ?>" class="btn bg--section btn-sm btn--tooltip"><i class="fas fa-info"></i></span>
                                  
                                </div>
                            <?php else: ?>
                            <div class="text-center mb-2">
                                <span class="rate text--success font--sm">
                                     <?php echo e(amount($item->fixed_rate)); ?> <?php echo e($item->fiat->code); ?>

                                </span>
                            </div>
                            <?php endif; ?>

                            <span class="font--sm me-2"><?php echo translate('Limits'); ?>: <?php echo e(amount($item->minimum)); ?> – <?php echo e(amount($item->maximum)); ?> <?php echo e($item->fiat->code); ?></span>
                        
                        </div>
                    </td>
                    <td data-label="<?php echo translate('Status'); ?>">
                        <?php if($item->status == 1): ?>
                            <span class="badge  badge--success"><?php echo translate('Active'); ?></span>
                         <?php else: ?>
                            <span class="badge badge--warning"><?php echo translate('Inactive'); ?></span>
                        <?php endif; ?>
                     </td>
                    <td data-label="<?php echo translate('Action'); ?>">
                       <div>
                        <?php if($item->status == 1): ?>
                        <button class="btn btn--warning btn-sm me-1 status" data-id="<?php echo e($item->id); ?>" data-bs-toggle="tooltip" data-bs-title="<?php echo translate('Deactivate'); ?>"><i class="fas fa-ban"></i></button>
                        <?php else: ?>
                        <button class="btn btn--success btn-sm me-1 status" data-id="<?php echo e($item->id); ?>" data-bs-toggle="tooltip" data-bs-title="<?php echo translate('Activate'); ?>"><i class="fas fa-check"></i></button>
                        <?php endif; ?>
                        <a href="<?php echo e(route('user.offer.edit',$item->offer_id)); ?>" class="btn btn--primary btn-sm "><i class="fas fa-edit"></i></a>
                       </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php echo e($offers->links()); ?>

</div>

<div id="statusModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo e(route('user.offer.status')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body p-4 text-center">
                    <h5><?php echo translate('Are you sure about changing the status ?'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn  btn--danger" data-bs-dismiss="modal"><?php echo translate('No'); ?></button><button type="submit" class="btn btn--primary"><?php echo translate('Yes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $('.status').on('click',function () { 
            $('#statusModal').find('input[name=id]').val($(this).data('id'))
            $('#statusModal').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/offer/index.blade.php ENDPATH**/ ?>