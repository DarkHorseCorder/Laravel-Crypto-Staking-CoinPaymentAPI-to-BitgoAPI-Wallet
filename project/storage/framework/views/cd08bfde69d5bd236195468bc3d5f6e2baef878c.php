 <nav class="navbar navbar-expand-lg main-navbar">
    
          <ul class="navbar-nav mr-auto icon-menu">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li class="mt-1">
              <div class="change-language  ms-auto mr-3 text--title">
                <select class="language-bar" onChange="window.location.href=this.value">
                  <?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e(route('lang.change',$item->code)); ?>" <?php echo e(session('lang') == $item->code ? 'selected':''); ?>><?php echo app('translator')->get($item->language); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
               </div>
             </li>
          </ul>
      
        <ul class="navbar-nav navbar-right">

         <li class="">
             <a target="_blank" href="<?php echo e(route('front.index')); ?>" class="nav-link nav-link-lg"><i class="fas fa-home pr-1"></i></a>
         </li>
        
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo e(getPhoto(admin()->photo)); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo e(admin()->email); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
             <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?php echo translate('Profile Setting'); ?>
              </a>
             <a href="<?php echo e(route('admin.password')); ?>" class="dropdown-item has-icon">
                <i class="fas fa-key"></i> <?php echo translate('Change Password'); ?>
              </a>
          
              <div class="dropdown-divider"></div>
              <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> <?php echo translate('Logout'); ?>
              </a>
            </div>
          </li>
        </ul>
      </nav><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/admin/partials/topbar.blade.php ENDPATH**/ ?>