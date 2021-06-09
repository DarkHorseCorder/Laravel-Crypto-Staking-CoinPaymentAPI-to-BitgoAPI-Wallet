<div class="dashboard-header bg--gradient">
  <div class="navbar-top">
      <div class="container-fluid">
          <ul class="d-flex align-items-center justify-content-between py-1 py-md-0">
              <li>
                  <div class="nav-toggle me-3">
                      <span></span>
                      <span></span>
                      <span></span>
                  </div>
              </li>
              <li class="me-3">
                  <div class="change-language">
                    <select class="language-bar" onChange="window.location.href=this.value">
                      <?php $__currentLoopData = DB::table('languages')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(route('lang.change',$item->code)); ?>" <?php echo e(session('lang') == $item->code ? 'selected':''); ?>><?php echo translate($item->language); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
              </li>
              <li class="ms-auto position-relative">
                  <a href="javascript:void(0)" class="dashboard-header-profile">
                      <img src="<?php echo e(getPhoto(auth()->user()->photo)); ?>" alt="clients">
                      <div class="name d-none d-sm-block">
                          <?php echo e(auth()->user()->name); ?>

                      </div>
                  </a>
                  <div class="user-toggle-menu">
                      <ul>
                        <li><a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>"> <i class="fas fa-user"></i><?php echo translate('Profile Settings'); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('user.two.step')); ?>"><i class="fas fa-lock"></i><?php echo translate('Two Step Authentication'); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('user.ticket.index')); ?>"><i class="fas fa-ticket-alt"></i> <?php echo translate('Support Ticket'); ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>"><i class="fas fa-sign-out-alt"></i> <?php echo translate('Logout'); ?></a></li>
                      </ul>
                  </div>
              </li>
              <li>
                  <div class="mode--toggle">
                      <i class="fas fa-moon"></i>
                  </div>
              </li>
          </ul>
      </div>
  </div>

</div><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/partials/header.blade.php ENDPATH**/ ?>