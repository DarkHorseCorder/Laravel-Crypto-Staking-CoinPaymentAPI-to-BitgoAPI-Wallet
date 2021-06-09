

<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get(ucfirst($section->name).' Section'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 <section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1><?php echo app('translator')->get(ucfirst($section->name).' Section'); ?></h1>
        <a href="<?php echo e(route('admin.frontend.index')); ?>" class="btn btn-primary"><i class="fa fa-backward"></i> <?php echo translate('Back'); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if($section->content): ?>
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                    <h4><?php echo app('translator')->get(ucfirst($section->name).' Content'); ?></h4>
               </div>
               <div class="card-body">
                    <form action="<?php echo e(route('admin.frontend.content.update',$section->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Title'); ?></label>
                                <input type="text" name="title" class="form-control" placeholder="<?php echo translate('Service Title'); ?>" value="<?php echo e(@$section->content->title); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Heading'); ?></label>
                                <input type="text" name="heading" class="form-control" placeholder="<?php echo translate('Service Heading'); ?>" value="<?php echo e(@$section->content->heading); ?>" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Sub Heading'); ?></label>
                                <input type="text" name="sub_heading" class="form-control" placeholder="<?php echo translate('Service Sub Heading'); ?>" value="<?php echo e(@$section->content->sub_heading); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Button Name'); ?></label>
                                <input type="text" name="btn_name" class="form-control" placeholder="<?php echo translate('Button Name'); ?>" value="<?php echo e(@$section->content->btn_name); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Button URL'); ?></label>
                                <input type="text" name="btn_url" class="form-control" placeholder="<?php echo translate('Button URL'); ?>" value="<?php echo e(@$section->content->btn_url); ?>" required>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
        </div>
        <?php endif; ?>
    </div>
        <?php if(is_array($section->sub_content)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4><?php echo app('translator')->get(ucfirst($section->name).' SubContent'); ?></h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></button>
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><?php echo translate('Question'); ?></th>
                                        <th><?php echo translate('Answer'); ?></th>
                                        <th><?php echo translate('Action'); ?></th>
                                    </tr>
                                    <?php $__empty_1 = true; $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td data-label="<?php echo translate('Question'); ?>">
                                                <?php echo e($info->question); ?>

                                            </td>
                                    
                                            <td data-label="<?php echo translate('Answer'); ?>"><?php echo e(Str::limit($info->answer,30)); ?></td>
                                            <td data-label="<?php echo translate('Action'); ?>">
                                                <div class="d-flex flex-wrap flex-lg-nowrap align-items-center justify-content-end justify-content-lg-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary details btn-sm m-1" data-key="<?php echo e($key); ?>" data-item="<?php echo e(json_encode($info)); ?>"><i class="fas fa-edit"></i></a>

                                                    <a href="javascript:void(0)" class="btn btn-danger remove btn-sm m-1" data-key="<?php echo e($key); ?>" ><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                        <tr>
                                            <td class="text-center" colspan="100%"><?php echo translate('No Data Found'); ?></td>
                                        </tr>

                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo e(route('admin.frontend.sub-content.update',$section->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo translate('Add FAQ Item'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><?php echo translate('Question'); ?></label>
                                    <input class="form-control" type="text" name="question" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo translate('Answer'); ?></label>
                                    <textarea class="form-control" type="text" name="answer" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo e(route('admin.frontend.sub-content.single.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="section" value="<?php echo e($section->id); ?>">
                        <input type="hidden" name="sub_key">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo translate('Edit FAQ Item'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><?php echo translate('Question'); ?></label>
                                    <input class="form-control" type="text" name="question" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo translate('Answer'); ?></label>
                                    <textarea class="form-control" type="text" name="answer" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo translate('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="remove" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo e(route('admin.frontend.sub-content.remove')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="section" value="<?php echo e($section->id); ?>">
                        <input type="hidden" name="key">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h6 class="mt-3"><?php echo translate('Are you sure to remove?'); ?></h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo translate('Close'); ?></button>
                                <button type="submit" class="btn btn-danger"><?php echo translate('Confirm'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        
        $('.details').on('click',function () { 
            var data = $(this).data('item')

            $('#edit').find('input[name=question]').val(data.question)
            $('#edit').find('textarea[name=answer]').val(data.answer)
            $('#edit').find('input[name=sub_key]').val($(this).data('key'))
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/faq.blade.php ENDPATH**/ ?>