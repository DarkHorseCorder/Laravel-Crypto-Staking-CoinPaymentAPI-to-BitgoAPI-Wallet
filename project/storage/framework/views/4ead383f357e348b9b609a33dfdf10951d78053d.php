

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('API settings'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo app('translator')->get('API settings'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-left border-primary">
            <div class="card-body">
                <span class="font-weight-bold"><?php echo translate('Note'); ?> : </span> <code class="text-warning"><?php echo translate('Update fields with your coinpayment api credential.'); ?></code>
            </div>
        </div>
    </div>
    <div class="col-xl-10">
        <div class="card">
            <div class="card-header">
                <h4><?php echo translate('Api Key'); ?> (Coinpayment)</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2"><?php echo translate('Public Key'); ?> : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="public_key" type="text" value="<?php echo e(@$gs->api_settings->public_key); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2"><?php echo translate('Private Key'); ?> : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="private_key" type="text" value="<?php echo e(@$gs->api_settings->private_key); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2"><?php echo translate('Merchant ID'); ?> : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="merchant_id" type="text" value="<?php echo e(@$gs->api_settings->merchant_id); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <h6 class="mt-2"><?php echo translate('Web Hook'); ?> : </h6>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" value="<?php echo e(url('notify/coinpayment')); ?>" disabled>
                            <code><?php echo translate('Put this URL to your coinpayment web hook URL in order to user payment/deposit work perfectly. And also make sure you put an IPN secret to your coinpayment settings.'); ?></code>
                        </div>
                    </div>
                   
                    <div class="form-group mt-3 text-right">
                        <button type="submit" class="btn btn-primary"><?php echo translate('Update'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/generalsetting/api_settings.blade.php ENDPATH**/ ?>