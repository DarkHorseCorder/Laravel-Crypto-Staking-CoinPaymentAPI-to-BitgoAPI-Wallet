

<?php $__env->startSection('title'); ?>
   <?php echo translate('Currency'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto"><?php echo translate('Manage Currency'); ?></h1>
      <a href="javascript:void(0)" data-toggle="modal" data-target="#currency_api" class="btn btn-primary mb-1 mr-3"><i class="fas fa-coins"></i> <?php echo translate('Currency rate API'); ?></a>
          
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row align-items-center justify-content-center">
  <div class="col-md-6 col-lg-6 col-xl-4 currency--card">
    <div class="card card-primary">
      <div class="card-header">
        <h4><?php echo translate('Fiat Currencies'); ?></h4>
      </div>
      <div class="card-body text-center">
        <img class="w-50 mb-3" src="<?php echo e(getPhoto('money.png')); ?>" alt="">
        <a href="<?php echo e(route('admin.currency.manage','fiat')); ?>" class="btn btn-primary btn-block"><i class="fas fa-arrow-right"></i> <?php echo translate('See All'); ?></a>  
       </div>
    </div>
  </div>

    <div class="col-md-6 col-lg-6 col-xl-4 currency--card">
      <div class="card card-primary">
        <div class="card-header">
          <h4><?php echo translate('Crypto Currencies'); ?></h4>
        </div>
        <div class="card-body text-center">
         <img class="w-50 mb-3" src="<?php echo e(getPhoto('bitcoin.png')); ?>" alt="">
         <a href="<?php echo e(route('admin.currency.manage','crypto')); ?>" class="btn btn-primary btn-block"><i class="fas fa-arrow-right"></i> <?php echo translate('See All'); ?></a>  
        </div>
      </div>
    </div>
   
    <div class="modal fade" id="currency_api" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <form action="<?php echo e(route('admin.currency.api.update')); ?>" method="POST">
          <?php echo csrf_field(); ?>
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title"><?php echo translate('Currency API Key'); ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <div class="card border-left border-primary">
                              <div class="card-body">
                                  <span class="font-weight-bold"><?php echo translate('Note'); ?> :  </span> <code class="text-warning"><?php echo translate('If you want to update your currency rates autometically, You must set the API key. You will find API key in the mentioned API provider. And you have to set up the cron job to your server. Cron job URL is : '.url('/currency-rate')); ?></code>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="font-weight-bold"><?php echo translate('Fiat Currency API Key'); ?></label>
                          ( <small><?php echo translate('For the api key please visit :'); ?> 
                              <a target="_blank" class="text-info" href="https://currencylayer.com/"><?php echo translate('Currency Layer'); ?></a>
                           </small> )
                          <input class="form-control" type="text" name="fiat_access_key" placeholder="<?php echo translate('Fiat Currency API Key'); ?>" required value="<?php echo e($gs->fiat_access_key); ?>">
                      </div>
    
                      <div class="form-group">
                          <label class="font-weight-bold"><?php echo translate('Crypto Currency API Key'); ?></label>
                          ( <small><?php echo translate('For the api key please visit :'); ?>
                              <a target="_blank" class="text-info" href="https://coinlayer.com/"><?php echo translate('Coin Layer'); ?></a>
                          </small> )
                          <input class="form-control" type="text" name="crypto_access_key" placeholder="<?php echo translate('Crypto Currency Rate Api Key'); ?>" required value="<?php echo e($gs->crypto_access_key); ?>">
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                      <button type="submit" class="btn btn-primary"><?php echo translate('Update'); ?></button>
                  </div>
              </div>
         </form>
      </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .default{
          background-color: #6777ef26!important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/currency/index.blade.php ENDPATH**/ ?>