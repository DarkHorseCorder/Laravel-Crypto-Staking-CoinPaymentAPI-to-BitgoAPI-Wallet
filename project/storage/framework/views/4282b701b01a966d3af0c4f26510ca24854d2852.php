

<?php $__env->startSection('title'); ?>
   <?php echo translate('Identity Verifications'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo translate('Identity Verifications'); ?></h1>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="" onChange="window.location.href=this.value">
                        <option value="<?php echo e(url('admin/kyc-info?status=pending')); ?>" <?php echo e(request('status') == 'pending'?'selected':''); ?>><?php echo app('translator')->get('Pending'); ?></option>
                        <option value="<?php echo e(url('admin/kyc-info/?status=approved')); ?>" <?php echo e(request('status') == 'approved'?'selected':''); ?>><?php echo app('translator')->get('Approved'); ?></option>
                        <option value="<?php echo e(url('admin/kyc-info/?status=rejected')); ?>" <?php echo e(request('status') == 'rejected'?'selected':''); ?>><?php echo app('translator')->get('Rejected'); ?></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group has_append ">
                      <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('email'); ?>" name="search" value=""/>
                      <div class="input-group-append">
                          <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                      </div>
                    </div>
                </div>
                
            </div>
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
                            <th><?php echo app('translator')->get('User ID'); ?></th>
                            <th><?php echo app('translator')->get('User Name'); ?></th>
                            <th><?php echo app('translator')->get('Email Address'); ?></th>
                            <th><?php echo app('translator')->get('Identity Status'); ?></th>
                            <th><?php echo app('translator')->get('More Information'); ?></th>
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $userKycInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td data-label="<?php echo app('translator')->get('Sl'); ?>"><?php echo e($key + $userKycInfo->firstItem()); ?></td>
                    
                                 <td data-label="<?php echo app('translator')->get('Name'); ?>">
                                   <?php echo e($info->name); ?>

                                 </td>
                                 <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e($info->email); ?></td>
                                 <td data-label="<?php echo app('translator')->get('KYC Status'); ?>">
                                    <?php if($info->kyc_status == 1): ?>
                                        <span class="badge badge-success"><?php echo app('translator')->get('Approved'); ?></span>
                                    <?php elseif($info->kyc_status == 2): ?>
                                         <span class="badge badge-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php elseif($info->kyc_status == 3): ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                    <?php endif; ?>
                                 </td>
                                 <?php if(access('kyc details')): ?>
                                 <td data-label="<?php echo app('translator')->get('Details'); ?>">
                                     <a class="btn btn-info details" href="<?php echo e(route('admin.kyc.details',$info->id)); ?>"><?php echo app('translator')->get('View Documents'); ?></a>
                                 </td>
                                 <?php else: ?>
                                 <td><?php echo app('translator')->get('N/A'); ?></td>
                                 <?php endif; ?>
                               
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td class="text-center" colspan="100%"><?php echo app('translator')->get('No Data Found'); ?></td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php if($userKycInfo->hasPages()): ?>
                <?php echo e($userKycInfo->links('admin.partials.paginate')); ?>

            <?php endif; ?>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/kyc/kyc_info.blade.php ENDPATH**/ ?>