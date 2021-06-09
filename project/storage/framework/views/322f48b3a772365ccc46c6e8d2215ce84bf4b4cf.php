<span class="toTopBtn">
  <i class="fas fa-angle-up"></i>
</span>
<div class="overlayer"></div>
<div class="loader"></div>
<!-- Overlayer -->
<?php
    $socials   = App\Models\SiteContent::where('slug','social')->first();
    $languages = DB::table('languages')->get();
?>
<!-- Header -->
<header>
  <div class="navbar-top">
      <div class="container">
          <div class="d-flex flex-wrap justify-content-evenly justify-content-md-between">
              <div class="d-flex flex-wrap align-items-center">
                  <ul class="social-icons py-1 py-md-0 me-md-auto">
                    <?php $__currentLoopData = $socials->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a target="_blank" href="<?php echo e(@$item->url); ?>"><i class="<?php echo e(@$item->icon); ?>"></i></a>
                    </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div class="change-language d-md-none">
                    <select class="language-bar" onChange="window.location.href=this.value">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e(route('lang.change',$item->code)); ?>" <?php echo e(session('lang') == $item->code ? 'selected':''); ?>><?php echo app('translator')->get($item->language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
              </div>
              <ul class="contact-bar py-1 py-md-0">
                <li>
                    <a href="Tel:<?php echo e(@$contact->content->phone); ?>"><?php echo e(@$contact->content->phone); ?></a>
                </li>
                <li>
                    <a href="Mailto:<?php echo e(@$contact->content->email); ?>"><?php echo e(@$contact->content->email); ?></a>
                </li>
                  <li>
                      <div class="change-language d-none d-md-block">
                        <select class="language-bar" onChange="window.location.href=this.value">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e(route('lang.change',$item->code)); ?>" <?php echo e(session('lang') == $item->code ? 'selected':''); ?>><?php echo app('translator')->get($item->language); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                  </li>
                  <li>
                      <div class="mode--toggle d-none d-sm-block">
                          <i class="fas fa-moon"></i>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <div class="navbar-bottom">
      <div class="container">
          <div class="navbar-wrapper">
              <div class="logo me-auto">
                  <a href="<?php echo e(url('/')); ?>">
                      <img src="<?php echo e(getPhoto($gs->header_logo)); ?>"/>
                  </a>
              </div>
              <div class="nav-toggle d-lg-none">
                  <span></span>
                  <span></span>
                  <span></span>
              </div>
              <div class="nav-menu-area">
                  <div class="menu-close text--danger d-lg-none">
                      <i class="fas fa-times"></i>
                  </div>
                  <ul class="nav-menu">
                    <?php $__currentLoopData = json_decode($gs->menu); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                    <?php if($item->dropdown =='no'): ?>
                    <li>
                        <a target="<?php echo e($item->target == 'self' ? '':'_blank'); ?>" href="<?php echo e(url($item->href)); ?>"><?php echo e(__($item->title)); ?></a>
                    </li>
                        
                    <?php else: ?>
                    <li>
                        <a href="javascript:void(0)"><?php echo e(__($item->title)); ?></a>
                        <ul class="sub-nav">
                            <li>
                                <a href="<?php echo e(route('offer.list',['type' => 'buy'])); ?>"><?php echo translate('Buy'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('offer.list',['type' => 'sell'])); ?>"><?php echo translate('Sell'); ?></a>
                            </li>
                        </ul>
                    </li>
                        
                    <?php endif; ?>      

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php if(auth()->guard()->check()): ?>
                        <div class="btn__grp ms-lg-3">
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="cmn--btn"><?php echo app('translator')->get('Dashboard'); ?></a>
                            <a href="<?php echo e(route('user.logout')); ?>" class="cmn--btn btn-outline"><?php echo app('translator')->get('Logout'); ?></a>
                        </div>
                        <?php else: ?>
                        <div class="btn__grp ms-lg-3">
                            <a href="<?php echo e(route('user.login')); ?>" class="cmn--btn"><?php echo app('translator')->get('Login'); ?></a>
                            <a href="<?php echo e(route('user.register')); ?>" class="cmn--btn btn-outline"><?php echo app('translator')->get('Register'); ?></a>
                        </div>
                        <?php endif; ?>
                    </li>
                  </ul>
              </div>
              <div class="mode--toggle d-sm-none">
                  <i class="fas fa-moon"></i>
              </div>
          </div>
      </div>
  </div>
</header><?php /**PATH F:\xampp\htdocs\new\crypto\project\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>