

<?php $__env->startSection('title'); ?>
   <?php echo translate('Currency'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex flex-wrap justify-content-between">
      <h1 class="mb-1 mr-auto"><?php echo translate('Fiat Currencies'); ?></h1>
      <div class="d-flex flex-wrap ">
            <?php if(access('add currency')): ?>
            <a href="<?php echo e(route('admin.currency.add')); ?>" class="btn btn-primary mb-1 mr-3"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></a>
            <?php endif; ?>
            <form action="">
              <div class="input-group has_append">
                <input type="text" class="form-control" placeholder="<?php echo translate('Currency Name/Code'); ?>" name="search" value="<?php echo e($search ?? ''); ?>"/>
                <div class="input-group-append">
                    <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                </div>
              </div>
            </form>

          </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 col-xl-3 currency--card">
      <div class="card card-primary">
        <div class="card-header <?php echo e($curr->default == 1 ? 'default' : ''); ?>">
          <h4><i class="fas fa-coins"></i> <?php echo e($curr->curr_name); ?></h4>
        </div>
        <div class="card-body">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Currency Symbol :'); ?>
              <span class="font-weight-bold"><?php echo e($curr->symbol); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Currency Code :'); ?>
              <span class="font-weight-bold"><?php echo e($curr->code); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Currency Type :'); ?>
              <span class="font-weight-bold"><?php echo e($curr->type == 1 ? 'Fiat':'Crypto'); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between"><?php echo translate('Rate '); ?><?php echo e('1 '.$gs->curr_code); ?> :
              <span class="font-weight-bold"><?php echo e(amount($curr->rate,$curr->type,3)); ?> <?php echo e($curr->code); ?></span>
            </li>
          </ul>
          <?php if(access('edit currency')): ?>
          <a href="<?php echo e(route('admin.currency.edit',$curr->id)); ?>" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> <?php echo translate('Edit Currency'); ?></a>  
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .default{
          background-color: #6777ef26!important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/currency/fiat_currencies.blade.php ENDPATH**/ ?>