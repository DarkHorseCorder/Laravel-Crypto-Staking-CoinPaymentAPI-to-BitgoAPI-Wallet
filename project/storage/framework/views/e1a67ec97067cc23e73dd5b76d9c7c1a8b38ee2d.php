

<?php $__env->startSection('title'); ?>
   <?php echo translate('Support tickets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header">
        <h1><?php echo translate('Support tickets'); ?></h1>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

        <div class="row justify-content-center pb-5">
            <div class="col-lg-5 col-xl-4">
               <div class="card">
                   <div class="card-body">
                    <div class="chatbox__list__wrapper">
                        <div class="d-flex flex-wrap justify-content-between mb-3 pb-3 border-bottom border--dark">
                            <h5 class="my-2"><a href="javascript:void(0)"><?php echo translate('Tickets'); ?><i class="fas fa-arrow-right"></i></a></h5>
                            <form action="" class="my-2">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input class="form-control" name="search" value="<?php echo e($search); ?>" type="text" placeholder="<?php echo translate('Search Ticket'); ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary input-group-text text-white"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                       
                        <ul class="chat__list nav-tab nav border-0">
                            <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a class="chat__item <?php echo e(request('messages') == $item->ticket_num ? 'active':''); ?>" href="<?php echo e(filter('messages',$item->ticket_num)); ?>" data-bs-toggle="tab">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            <div class="post__creator-thumb d-flex justify-content-between">
                                               <div>
                                                <span class="username"><?php echo e($item->ticket_num); ?> </span>
                                                <small><?php echo e($item->user->email); ?></small>
                                               </div>
                                                <?php if($item->status == 0): ?>
                                                 <small class="badge badge-danger">!</small>
                                                <?php endif; ?>
                                            </div>
                                            <div class="post__creator-content">
                                                <h6 class="name d-inline-block"><?php echo e($item->subject); ?></h6>
                                            </div>
                                        </div>
                                        <ul class="chat__meta d-flex justify-content-between">
                                            <li><span class="last-msg"></span></li>
                                            <li><span class="last-chat-time"><?php echo e(dateFormat($item->created_at,'d M Y')); ?></span></li>
                                        </ul>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a class="chat__item">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            <?php echo translate('No Tickets Available'); ?>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                   </div>
                   <?php if($tickets->hasPages()): ?>
                   <div class="card-footer">
                       <?php echo e($tickets->links('admin.partials.paginate')); ?>

                   </div>
                   <?php endif; ?>
               </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show fade active" id="c1">
                                <div class="chat__msg">
                                    <div class="chat__msg-header py-2">
                                        <div class="post__creator align-items-center">
                                            
                                            <div class="post__creator-content">
                                                <h5 class="name d-inline-block"><?php echo translate('Ticket Number : #'); ?><?php echo e(request('messages')); ?></h5>
                                                
                                            </div>
                                            <a class="profile-link" href="javascript:void(0)"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="chat__msg-body">
                                        <ul class="msg__wrapper mt-3">
                                            <?php if(request('messages')): ?>
                                                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($item->admin_id == null): ?>
                                                    <li class="incoming__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator">
                                                                <div class="post__creator-content">
                                                                    <?php if($item->message): ?>
                                                                    <p><?php echo e($item->message); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if($item->file): ?>
                                                                        <div class="text-start">
                                                                            <a href="<?php echo e(asset('assets/ticket/'.$item->file)); ?>" download=""><?php echo e($item->file); ?></a>
                                                                        </div>
                                                                      <?php endif; ?>
                                                                    <span class="comment-date text--secondary"><?php echo e(diffTime($item->created_at)); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="outgoing__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator">
                                                                <div class="post__creator-content">
                                                                    <?php if($item->message): ?>
                                                                    <p class="out__msg"><?php echo e($item->message); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if($item->file): ?>
                                                                        <div class="text-end ms-auto">
                                                                            <a href="<?php echo e(asset('assets/ticket/'.$item->file)); ?>" download=""><?php echo e($item->file); ?></a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <span class="comment-date text--secondary"><?php echo e(diffTime($item->created_at)); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="incoming__msg">
                                                    <div class="msg__item">
                                                        <div class="post__creator">
                                                            <div class="post__creator-content">
                                                                <h6 class="text-center"><?php echo translate('No messages yet!!'); ?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php endif; ?>
                                            <?php else: ?>
                                            <li>
                                                <div class="msg__item">
                                                    <div class="post__creator ">
                                                        <div class="post__creator-content ">
                                                           <h6 class="text-center"><?php echo translate('No messages yet'); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php if(request('messages')): ?>
                                    <div class="chat__msg-footer">
                                        <form action="<?php echo e(route('admin.ticket.reply',request('messages'))); ?>" class="send__msg" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .badge{
            padding: 8px 9px;
            border-radius: 15px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/ticket/index.blade.php ENDPATH**/ ?>