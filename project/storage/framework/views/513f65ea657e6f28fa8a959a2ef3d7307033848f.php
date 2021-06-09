

<?php $__env->startSection('title'); ?>
   <?php echo translate('Profile Settings'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="dashboard--content-item">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="profile--card">
            <div class="user--profile mb-5">
                <div class="thumb">
                    <img src="<?php echo e(getPhoto($user->photo)); ?>" alt="clients">
                </div>
                <div class="remove-thumb">
                    <i class="fas fa-times"></i>
                </div>
                <div class="content">
                    <div>
                        <h3 class="title">
                            <?php echo e($user->name); ?>

                        </h3>
                        <a href="#0" class="text--base">
                           <?php echo e($user->email); ?>

                        </a>
                    </div>
                    <div class="mt-4">
                        <label class="btn btn-sm btn--base text--dark">
                            <?php echo translate('Update Profile Picture'); ?>
                            <input type="file" name="photo" id="profile-image-upload" hidden>
                        </label>
                        <div class="text--primary mt-2 font--sm">
                           <?php echo translate('Image size should be'); ?> 300x300
                        </div>
                    </div>
                </div>
            </div>
           
                <?php echo csrf_field(); ?>
                <div class="row gy-4">
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('User Name'); ?></label> - Do Copy Not Other User Names
                        <input class="form-control" type="text" name="name" value="<?php echo e($user->name); ?>" required>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('Email Address'); ?></label>
                        <input class="form-control" type="email" value="<?php echo e($user->email); ?>" disabled>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('Mobile Phone Number'); ?></label>
                        <?php if($user->phone_verified): ?>
                        <input class="form-control" type="text" value="<?php echo e($user->phone); ?>" disabled>
                        <?php else: ?>
                        <input class="form-control" name="phone" type="text" value="<?php echo e($user->phone); ?>" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('Country'); ?></label>
                        <input class="form-control" type="text" value="<?php echo e($user->country); ?>" disabled>
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('Home Address'); ?></label> - Do Not Enter City or State
                        <input class="form-control" type="text" name="city" value="<?php echo e($user->city); ?>">
                    </div>
                    <div class="col-sm-6 col-xxl-4">
                        <label class="mb-2"><?php echo translate('Zip code'); ?></label> - Only For U.S. Residents, other countries 0000
                        <input class="form-control" type="text" name="zip" value="<?php echo e($user->zip); ?>">
                    </div>
                    <div class="col-sm-6 col-xxl-12">
                        <label class="mb-2"><?php echo translate('Legal First and Last Name'); ?></label>
                        <input class="form-control" type="text" name="address" value="<?php echo e($user->address); ?>">
                    </div>
                    <div class="col-sm-12">
                        <div class="text-end">
                            <button type="submit" class="cmn--btn"><?php echo translate('Update Profile'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        var prevImg = $('.user--profile .thumb').html();
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var uploadedFile = new FileReader();
                uploadedFile.onload = function (e) {
                    var preview = $('.user--profile').find('.thumb');
                    preview.html(`<img src="${e.target.result}" alt="user">`);
                    preview.addClass('image-loaded');
                    preview.hide();
                    preview.fadeIn(650);
                    $(".image-view").hide();
                    $(".remove-thumb").show();
                }
                uploadedFile.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-image-upload").on('change', function () {
            proPicURL(this);
        });
        $(".remove-thumb").on('click', function () {
            $(".user--profile .thumb").html(prevImg);
            $(".user--profile .thumb").removeClass('image-loaded');
            $(".image-view").show();
            $(this).hide();
        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/user/profile.blade.php ENDPATH**/ ?>