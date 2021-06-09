 
<?php if(auth()->guard()->guest()): ?>
     <!-- CTAs Section -->
<section class="ctas-section">
    <div class="container">
        <div class="ctas__wrapper">
            <div class="ctas-button">
                <a href="<?php echo e(route('user.login')); ?>" class="link">&nbsp;</a>
                <h2 class="title"><?php echo translate('Login'); ?></h2>
                <div class="text">
                    <?php echo translate('Already have account ? Login to trade.'); ?>
                </div>
            </div>
            <div class="ctas-button">
                <a href="<?php echo e(route('user.register')); ?>" class="link">&nbsp;</a>
                <h2 class="title"><?php echo translate('Join Xnet'); ?></h2>
                <div class="text">
                   <?php echo translate('Don\'t have an account ? Create One Now.'); ?>
                    </spandiv>
                </div>
            </div>
        </div>
</section>
<!-- CTAs Section -->
<?php endif; ?>
 
 <!-- Footer Section -->
 <footer class="bg_img" data-img="<?php echo e(getPhoto($bg)); ?>">
    <div class="banner-overlay bg--gradient">&nbsp;</div>
    <div class="footer-top position-relative">
        <div class="container">
            <div class="footer-wrapper">
                <div class="footer-logo">
                    <a href="<?php echo e(url('/')); ?>">
                        <img src="<?php echo e(getPhoto($gs->header_logo)); ?>" alt="logo">
                    </a>
                </div>
                <div class="footer-links">
                    <h5 class="title"><?php echo translate('Menu'); ?></h5>
                    <ul>
                        <?php $__currentLoopData = json_decode($gs->menu); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->dropdown == 'no'): ?>
                            <li>
                            <a target="<?php echo e($item->target == 'self' ? '':'_blank'); ?>" href="<?php echo e(url($item->href)); ?>"><?php echo e(__($item->title)); ?></a>
                            </li>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="footer-links mobile-second-item">
                    <h5 class="title"><?php echo app('translator')->get('Get Started'); ?></h5>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('Buy Crypto'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('Sell Crypto'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Sign Up'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Sign In'); ?></a>
                        </li>
                    </ul>
                </div>

                <div class="footer-links mobile-second-item">
                    <h5 class="title"><?php echo app('translator')->get('Pages'); ?></h5>
                    <ul>
                       
                        <li>
                            <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('Frequently Asked Questions'); ?></a>
                        </li>
                        <?php $__currentLoopData = DB::table('pages')->where('lang',app()->currentLocale())->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->slug != 'about'): ?>
                                <li>
                                    <a href="<?php echo e(route('pages',[$item->id,$item->slug])); ?>"><?php echo app('translator')->get($item->title); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                
                
                <div class="footer-comunity">
                    <?php
                      $socials = App\Models\SiteContent::where('slug','social')->first();
                    ?>
                    <h5 class="title"><?php echo translate('Social Links'); ?></h5>
                    <ul class="social-icons justify-content-start mt-0 mb-4">
                        <?php $__currentLoopData = $socials->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a target="_blank" href="<?php echo e(@$item->url); ?>"><i class="<?php echo e(@$item->icon); ?>"></i></a>
                            </li>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom position-relative py-4 border-top">
        <div class="container text-center d-flex flex-wrap justify-content-evenly justify-content-md-between">
            <p class="m-0">
                &copy; <?php echo translate('All Right Reserved by'); ?> <a href="<?php echo e(url('/')); ?>" class="text--base"><?php echo e($gs->title); ?></a>
            </p>
          
            <ul class="bottom-menu d-flex flex-wrap justify-content-center">
                <?php
                $policies = App\Models\SiteContent::where('slug','policies')->first();
                ?>
                <?php $__currentLoopData = $policies->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(app()->currentLocale() == $item->lang): ?>
                        <li>
                            <a class="text--base <?php echo e($loop->first ? '':'ms-3'); ?>" href="<?php echo e(route('terms.details',[$key,Str::slug($item->title)])); ?>"><?php echo e(__($item->title)); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</footer>
<!-- Footer Section --><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>