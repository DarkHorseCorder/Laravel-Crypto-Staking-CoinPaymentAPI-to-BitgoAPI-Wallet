

<?php $__env->startSection('title'); ?>
   <?php echo translate('Manage Offers'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> <?php echo translate('Manage Offers'); ?></h1>
        <form action="">
            <select class="form-control" id="" onChange="window.location.href=this.value">
                <option value="<?php echo e(url('admin/manage-offers/'.'?type=')); ?>" <?php echo e(request('type') == 'all'?'selected':''); ?>><?php echo translate('All'); ?></option>
                <option value="<?php echo e(url('admin/manage-offers/'.'?type=buy')); ?>" <?php echo e(request('type') == 'buy'?'selected':''); ?>><?php echo translate('Buy'); ?></option>
                <option value="<?php echo e(url('admin/manage-offers/'.'?type=sell')); ?>" <?php echo e(request('type') == 'sell'?'selected':''); ?>><?php echo translate('Sell'); ?></option>
            </select>
          </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
   
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th><?php echo translate('Time'); ?></th>
                            <th><?php echo translate('Offer Type'); ?></th>
                            <th><?php echo translate('User'); ?></th>
                            <th><?php echo translate('Trade Duration'); ?></th>
                            <th><?php echo translate('Price Type'); ?></th>
                            <th><?php echo translate('Status'); ?></th>
                            <th><?php echo translate('Action'); ?></th>
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                 <td data-label="<?php echo translate('Time'); ?>">
                                   <?php echo e($offer->created_at->diffForHumans()); ?>

                                 </td>

                                 <td data-label="<?php echo translate('Offer Type'); ?>"><span class="badge <?php echo e($offer->type == 'buy' ? 'badge-success':'badge-primary'); ?>"><?php echo e(ucfirst($offer->type)); ?></span> <span class="badge badge-info m-1"><?php echo e($offer->crypto->code); ?></span></td>

                                 <td data-label="<?php echo translate('User'); ?>">
                                    <span><?php echo e($offer->user->name); ?></span><br>
                                    <a href="<?php echo e(route('admin.user.details',$offer->user_id)); ?>"><?php echo e($offer->user->email); ?></a>
                                </td>

                                 <td data-label="<?php echo translate('Trade Duration'); ?>"><?php echo e($offer->duration->duration); ?> <?php echo translate('Minutes'); ?></td>

                                 <td data-label="<?php echo translate('Price Type'); ?>">
                                    <?php if($offer->price_type == 1): ?>
                                        <?php if($offer->neg_margin == 1): ?>
                                         <span class="badge badge-info" data-toggle="tooltip" title="<?php echo translate('Buyer/Seller will pay  '.numformat($offer->margin).'% less than market price.'); ?>"><i class="fas fa-arrow-down"></i> <?php echo e(numformat($offer->margin).'% margin'); ?></span>
                                        <?php else: ?>
                                          <span class="badge badge-info"  data-toggle="tooltip" title="<?php echo translate('Buyer/Seller will pay  '); ?><?php echo e(numformat($offer->margin)); ?> <?php echo translate('% more than market price.'); ?>)"><i class="fas fa-arrow-up"></i> <?php echo e(numformat($offer->margin).'% margin'); ?></span>
                                        <?php endif; ?> 
                                    <?php else: ?>
                                         <span class="badge badge-primary"><?php echo e(numformat($offer->fixed_rate)); ?> <?php echo e($offer->fiat->code); ?> <?php echo translate(' (fixed)'); ?></span>
                                    <?php endif; ?>
                                 </td>
                                 <td data-label="<?php echo translate('Status'); ?>">
                                    <?php if($offer->status == 1): ?>
                                        <span class="badge  badge-success"><?php echo translate('Active'); ?></span>
                                     <?php else: ?>
                                        <span class="badge badge-warning"><?php echo translate('Inactive'); ?></span>
                                    <?php endif; ?>
                                 </td>
                               
                                 <td data-label="<?php echo translate('Action'); ?>">
                                     <a class="btn btn-primary btn-sm details m-1" data-id="<?php echo e($offer->id); ?>" href="javascript:void(0)"><?php echo translate('Details'); ?></a>
                                    <?php if($offer->status == 1): ?>
                                    <a class="btn btn-danger btn-sm status m-1" data-id="<?php echo e($offer->id); ?>" href="javascript:void(0)"><?php echo translate('Inactive'); ?></a>
                                    <?php else: ?>
                                    <a class="btn btn-success btn-sm status m-1" data-id="<?php echo e($offer->id); ?>" href="javascript:void(0)"><?php echo translate('Active'); ?></a>
                                    <?php endif; ?>
                                 </td>
                               
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php if($offers->hasPages()): ?>
                <?php echo e($offers->links('admin.partials.paginate')); ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
     <div class="modal-content">
        <div class="modal-header bg-primary border-bottom">
            <h4 class="modal-title text-white"><?php echo translate('Offer Details'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
         </div>
        <div class="modal-body text-center py-4">
            <ul class="list-group mt-2"></ul>
        </div>
          
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.manage.offer.status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                   <h5 class="msg"><?php echo translate('Are you sure to change status?'); ?></h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo translate('Confirm'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
      'use strict';
   
      $('.details').on('click',function () { 
        var url = "<?php echo e(url('admin/offer/details/')); ?>"+'/'+$(this).data('id')
        $.get(url,function (res) { 
          if(res == 'empty'){
            $('.list-group').html('<p><?php echo translate('No details found!'); ?></p>')
          }else{
            $('.list-group').html(res)
          }
          $('#modal-success').modal('show')
        })
      })
      $('.status').on('click',function () { 
         const id = $(this).data('id')
        $('#status').find('input[name=id]').val(id)
        $('#status').modal('show')
         
      })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/offer/index.blade.php ENDPATH**/ ?>