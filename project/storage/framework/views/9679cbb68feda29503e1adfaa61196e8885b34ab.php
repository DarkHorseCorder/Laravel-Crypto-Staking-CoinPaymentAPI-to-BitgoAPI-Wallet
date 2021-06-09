

<?php $__env->startSection('title'); ?>
   <?php echo translate('Site Support'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php echo translate('Site Support'); ?>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <div class="dashboard--content-item">
        <div class="row justify-content-center pb-5">
            <div class="col-lg-4">
               <div class="card default--card h-100">
                   <div class="card-body">
                    <div class="chatbox__list__wrapper">
                        <div class="d-flex justify-content-between py-4 border-bottom border--dark">
                            <h4 class="mt-2"><a href="javascript:void(0)"><?php echo translate('Report WebSite Problems Only No Disputes'); ?></a></h4>
                            <button class="btn btn--base btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#modelId"><i class="fas fa-plus me-2"></i> <?php echo translate('Create New Ticket'); ?></button>
                        </div>
         
                        <ul class="chat__list nav-tab nav border-0">
                            <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a class="chat__item <?php echo e(request('messages') == $item->ticket_num ? 'active':''); ?>" href="<?php echo e(filter('messages',$item->ticket_num)); ?>">
                                    <div class="item__inner">
                                        <div class="post__creator">
                                            <div class="post__creator-thumb d-flex justify-content-between">
                                                <span class="username"> <?php echo e(dateFormat($item->created_at,'M d Y')); ?></span>
                                                <?php if($item->status == 1): ?>
                                                <small class="badge bg-danger">!</small>
                                                <?php endif; ?>
                                            </div>
                                            <div class="post__creator-content">
                                                <h4 class="name d-inline-block"><?php echo e($item->subject); ?> </h4>
                                            </div>
                                        </div>
                        
                                        <ul class="chat__meta d-flex justify-content-between">
                                            <li><span class="last-msg"></span></li>
                                            <li><span class="last-chat-time"></span></li>
                                        </ul>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a class="chat__item">
                                    <div class="item__inner">
                                        <div class="post__creator text-center">
                                            <?php echo translate('No Active Tickets'); ?>
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
                       <?php echo e($tickets->links()); ?>

                   </div>
                   <?php endif; ?>
               </div>
            </div>
            <div class="col-lg-8">
                <div class="card default--card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show fade active" id="c1">
                                <div class="chat__msg">
                                    <div class="chat__msg-header py-2 border-bottom">
                                        <div class="post__creator align-items-center">
                                            
                                            <div class="post__creator-content">
                                                <h4 class="name d-inline-block"><?php echo translate('Support Ticket Number: '); ?> <?php echo e(request('messages')); ?></h4>
                                            </div>
                                            <a class="profile-link" href="javascript:void(0)"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="chat__msg-body">
                                        <ul class="msg__wrapper mt-3">
                                            <?php if(request('messages')): ?>
                                                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php if($item->admin_id == null): ?>
                                                    <li class="outgoing__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator ">
                                                                <div class="post__creator-content">
                                                                    <?php if($item->message): ?>
                                                                    <p class="out__msg"><?php echo e($item->message); ?></p>
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
                                                    <li class="incoming__msg">
                                                        <div class="msg__item">
                                                            <div class="post__creator">
                                                                <div class="post__creator-content">
                                                                    <?php if($item->message): ?>
                                                                    <p><?php echo e($item->message); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if($item->file): ?>
                                                                        <div class="ms-auto">
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
                                                    <div class="post__creator">
                                                        <div class="post__creator-content">
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
                                        <form action="<?php echo e(route('user.ticket.reply',request('messages'))); ?>" class="send__msg" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="input-group">
                                                <input id="upload-file" type="file" name="file" class="form-control d-none">
                                                <label class="-formlabel upload-file" for="upload-file"><i class="fas fa-paperclip"></i>
                                            </div>
                                            <div class="input-group">
                                                <textarea class="form-control form--control shadow-none" name="message"></textarea>
                                                <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                          
                                            
                                        </form>
                                        <small class="files mt-2 text--base"></small>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="<?php echo e(route('user.ticket.open')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo translate('Open A New Ticket'); ?></h5> 
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="mb-2"><?php echo translate('Problem: For Example: Offer Page Not Loading'); ?></label>
                                <input class="form-control shadow-none " type="text" name="subject" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo translate('Cancel'); ?></button>
                            <button type="submit" class="btn btn--base"><?php echo translate('Submit'); ?></button>
                        </div>
                    </div>
               </form>
            </div>
        </div>
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $("#upload-file").on('change', function () {
             $('.files').text('File : '+this.files[0].name) ;
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\custom\exchange\project\resources\views/user/ticket/index.blade.php ENDPATH**/ ?>