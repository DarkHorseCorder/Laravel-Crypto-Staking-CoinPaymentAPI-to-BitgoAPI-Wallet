<?php if(auth()->user()->kyc_status == 0): ?>
<div class="col-12 mb-3">
  <div class="p-2 rounded-3 pending">
    <h6 class="kyc__text text-center mt-1"><i class="fas fa-exclamation-triangle me-2"></i> <?php echo app('translator')->get('Please Verify your identity to remove any restrictions. '); ?> <a href="<?php echo e(route('user.kyc.form')); ?>" class="text-primary"><?php echo app('translator')->get('Take me there'); ?></a></h6>
  </div>
</div>
<?php elseif(auth()->user()->kyc_status == 2): ?>
<div class="col-12 mb-3">
  <div class="p-2 rounded-3 review">
    <h6 class="kyc__text text-center mt-1"><i class="fas fa-search-location"></i> <?php echo app('translator')->get('Your ID Verification is currently under review.'); ?></h6>
  </div>
</div>
<?php elseif(auth()->user()->kyc_status == 3): ?>
 <div class="col-12 mb-3">
  <div class="p-2 rounded-3 rejected">
    <h6 class="kyc__text text-center mt-1"><i class="fas fa-exclamation-circle"></i> <?php echo app('translator')->get('Your ID Verification Was Rejected. Please Re-submit your documents and make sure all documents you upload are real, visible front and back.'); ?>  <a href="<?php echo e(route('user.kyc.form')); ?>" class="text-primary"><?php echo app('translator')->get('Verify My Identity.'); ?></a> <a href="javascript:void(0)" class="text--warning ms-5 reason"  data-reason="<?php echo e(auth()->user()->kyc_reject_reason); ?>"><i class="fas fa-info-circle"></i> <?php echo app('translator')->get('See Reasons'); ?></a></h6>
  </div>

  <div class="modal modal-blur fade" id="modal-reason" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark"><?php echo app('translator')->get('Reason For Rejection. '); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea disabled  rows="5" class="form-control reason-text"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark ms-auto text-white" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/partials/kyc_info.blade.php ENDPATH**/ ?>