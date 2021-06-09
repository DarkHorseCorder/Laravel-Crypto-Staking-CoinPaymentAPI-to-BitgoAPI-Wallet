<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($gs->title.'-'); ?><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" href="<?php echo e(getPhoto($gs->favicon)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/font-awsome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/selectric.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/tagify.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/colorpicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">

    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
  
<div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
         <?php echo $__env->make('admin.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-sidebar">
         <?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <?php echo $__env->yieldContent('breadcrumb'); ?>
        
        <?php echo $__env->yieldContent('content'); ?>
      </div>
      
    </div>
  </div>


    <?php echo $__env->make('notify.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/admin/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/nicescroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/summernote.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/tagify.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/sortable.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/moment-a.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/stisla.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/colorpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/jquery.uploadpreview.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/custom.js')); ?>"></script>

    <script>
      'use strict'
      var form_error   = "<?php echo e(__('Please fill all the required fields')); ?>";
      var mainurl = "<?php echo e(url('/')); ?>";
      var lang  = {
            'new': '<?php echo e(__('ADD NEW')); ?>',
            'edit': '<?php echo e(__('EDIT')); ?>',
            'details': '<?php echo e(__('DETAILS')); ?>',
            'update': '<?php echo e(__('Status Updated Successfully.')); ?>',
            'sss': '<?php echo e(__('Success !')); ?>',
            'active': '<?php echo e(__('Activated')); ?>',
            'deactive': '<?php echo e(__('Deactivated')); ?>',
            'loading': '<?php echo e(__('Please wait Data Processing...')); ?>',
            'submit': '<?php echo e(__('Submit')); ?>',
            'enter_name': '<?php echo e(__('Enter Name')); ?>',
            'enter_price': '<?php echo e(__('Enter Price')); ?>',
            'per_day': '<?php echo e(__('Per Day')); ?>',
            'per_month': '<?php echo e(__('Per Month')); ?>',
            'per_year': '<?php echo e(__('Per Year')); ?>',
            'one_time': '<?php echo e(__('One Time')); ?>',
            'enter_title': '<?php echo e(__('Enter Title')); ?>',
            'enter_content': '<?php echo e(__('Enter Content')); ?>',
            'extra_price_name' : '<?php echo e(__('Enter Name')); ?>',
            'extra_price' : '<?php echo e(__('Enter Price')); ?>',
            'policy_title' : '<?php echo e(__('Enter Title')); ?>',
            'policy_content' : '<?php echo e(__('Enter Content')); ?>',
        };
  
    </script>
    <script>
      'use strict';
     $('.summernote').summernote()
     $('.note-codable').on('blur', function() {
      var codeviewHtml        = $(this).val();
      var $summernoteTextarea = $(this).closest('.note-editor').siblings('textarea');
      $summernoteTextarea.val(codeviewHtml);
    });
    </script>
    <?php echo $__env->yieldPushContent('script'); ?>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/layouts/admin.blade.php ENDPATH**/ ?>