

<?php $__env->startSection('title'); ?>
    <?php echo translate('Contact Us'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="contact-section pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pe-xl-5">
               
                    <form class="contact-form row g-4" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="col-sm-6 form-group">
                            <label class="form--label" for="name"><?php echo translate('Your Name'); ?></label>
                            <input type="text" name="name" class="form-control form--control bg--section mt-1" id="name"
                                placeholder="<?php echo translate('Your Name'); ?>" required value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="form--label" for="email"><?php echo translate('Your Email Address'); ?></label>
                            <input type="text" name="email" class="form-control form--control bg--section mt-1" id="email"
                                placeholder="<?php echo translate('Your Email Address'); ?>" required value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="form--label" for="subject"><?php echo translate('Subject'); ?></label>
                            <input type="text" name="subject" class="form-control form--control bg--section mt-1" id="subject"
                                placeholder="<?php echo translate('Subject'); ?>" required value="<?php echo e(old('subject')); ?>">
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="form--label" for="message"><?php echo translate('Your Message'); ?></label>
                            <textarea id="message" name="message" class="form-control form--control bg--section mt-1"
                                placeholder="<?php echo translate('Your Message'); ?>" required><?php echo e(old('subject')); ?></textarea>
                        </div>
                       
                        <div class="col-xl-12 form-group">
                            <button type="submit" class="cmn--btn"><?php echo translate('Send Message'); ?></button>
                        </div>
                    </form>
                
            </div>
            <div class="col-lg-6">
                <div class="section-title mb-4 pb-3">
                    <h6 class="subtitle section-header__subtitle"><?php echo app('translator')->get(@$contact->content->title); ?></h6>
                    <h2 class="title section-header__title"><?php echo app('translator')->get(@$contact->content->heading); ?></h2>
                    <p>
                       <?php echo app('translator')->get(@$contact->content->sub_heading); ?>
                    </p>
                </div>
                <div class="contact-content">
                    <div class="contact__item">
                        <div class="contact__item-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact__item-cont">
                            <h5 class="contact__item-title"><?php echo translate('Phone'); ?></h5>
                            <a href="Tel:<?php echo e(@$contact->content->phone); ?>" class="text--base"><?php echo e(@$contact->content->phone); ?></a>
                        </div>
                    </div>
                    <div class="contact__item">
                        <div class="contact__item-icon">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="contact__item-cont">
                            <h5 class="contact__item-title"><?php echo translate('Email'); ?></h5>
                            <a href="<?php echo e(@$contact->content->email); ?>" class="text--base"><?php echo e(@$contact->content->email); ?></a>
                        </div>
                    </div>
                    <div class="contact__item">
                        <div class="contact__item-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact__item-cont">
                            <h5 class="contact__item-title"><?php echo translate('Address'); ?></h5>
                            <span class="text--base"><?php echo e(@$contact->content->address); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/frontend/contact.blade.php ENDPATH**/ ?>