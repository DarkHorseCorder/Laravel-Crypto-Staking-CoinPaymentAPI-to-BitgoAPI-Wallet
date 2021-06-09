

<?php $__env->startSection('title'); ?>
 <?php echo app('translator')->get('KYC Details'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header justify-content-between">
        <h1><?php echo app('translator')->get('User Submitted Documents'); ?></h1>
        Government Issued ID's or Passports Are Accepted. No other documents are allowed 
        For Example: Employee ID's or College ID's are Not Acceptable.
        <a href="<?php echo e(route('admin.kyc.info')); ?>" class="btn btn-primary"><i class="fas fa-backward"></i> <?php echo app('translator')->get('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 ">
            <?php if($info->kyc_info): ?>
            <ul class="list-group">
                <?php $__currentLoopData = $info->kyc_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if($key == 'details'): ?>
                      <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                         <h6 class="mb-3"><?php echo e(ucwords(str_replace('_',' ',$k))); ?> : </h6>
                          <textarea disabled rows="5" class="form-control"><?php echo e($data); ?></textarea>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
                   <?php elseif($key == 'image'): ?>
                       <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                          <h6 class="mb-3"><?php echo e(ucwords(str_replace('_',' ',$k))); ?> : </h6>
                          <img class="mb-3 w-50" src="<?php echo e(getPhoto($data)); ?>" alt="">
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <li class="list-group-item">
                          <h6 class="mb-3"><?php echo e(ucwords(str_replace('_',' ',$key))); ?> : </h6>
                          <p class="mb-3"><?php echo e($item); ?></p>
                    </li>
                   <?php endif; ?>

                   
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php if($info->kyc_status == 2): ?>
                   <li class="list-group-item text-right">
                        <?php if(access('kyc reject')): ?>
                        <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#rejectModal"><i class="fas fa-ban"></i> <?php echo app('translator')->get('Reject'); ?></button>
                        <?php endif; ?>
                        <?php if(access('kyc approve')): ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#approveModal"><i class="fas fa-check"></i> <?php echo app('translator')->get('Approved'); ?></button>
                        <?php endif; ?>
                   </li>
                   <?php endif; ?>
                
            </ul>
            <?php else: ?>
            <h4 class="text-center"><?php echo app('translator')->get('No data submitted'); ?></h4>
            <?php endif; ?>
        </div>
            
    </div>

    
    <!-- Modal -->
    <?php if(access('kyc reject')): ?>
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo e(route('admin.kyc.reject',$info->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo app('translator')->get('Reject KYC'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <label for=""><?php echo app('translator')->get('Reject Reasons'); ?></label>
                       <textarea name="reason" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-danger"><?php echo app('translator')->get('Reject'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <?php if(access('kyc approve')): ?>
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo e(route('admin.kyc.approve',$info->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo app('translator')->get('Approve User'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                      <h6><?php echo app('translator')->get('Please Confirm your request'); ?></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('No Cancel'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes Approve'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/kyc/details.blade.php ENDPATH**/ ?>