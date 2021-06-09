

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
                                        <th><?php echo translate('SL'); ?></th>
                                        <th><?php echo translate('Icon'); ?></th>
                                        <th><?php echo translate('URL'); ?></th>
                                        <th><?php echo translate('Action'); ?></th>
                                    </tr>
                                    <?php
                                    $i = 0;
                                    ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td data-label="<?php echo translate('SL'); ?>">
                                                <?php echo e(++$i); ?>

                                            </td>
                                            <td data-label="<?php echo translate('Icon'); ?>">
                                              <i class="<?php echo e($info->icon); ?>"></i>
                                            </td>
                                           
                                            <td data-label="<?php echo translate('URL'); ?>">
                                              <?php echo e($info->url); ?>

                                            </td>
                                           
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

            <div class="modal fade" id="add" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo e(route('admin.frontend.sub-content.update',$section->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo translate('Add Social Link'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for=""><?php echo translate('Icon'); ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control icon-value" name="icon"
                                        value="" required>
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary iconpicker" data-icon="fas fa-home"
                                                role="iconpicker"></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?php echo translate('URL'); ?></label>
                                    <input class="form-control" type="text" name="url" required>
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
                    <form action="<?php echo e(route('admin.frontend.sub-content.single.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="section" value="<?php echo e($section->id); ?>">
                        <input type="hidden" name="sub_key">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo translate('Edit Social Link'); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for=""><?php echo translate('Icon'); ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control icon-value2" name="icon"
                                        value="">
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary iconpicker2" data-icon="fas fa-home"
                                                role="iconpicker"></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?php echo translate('URL'); ?></label>
                                    <input class="form-control" type="text" name="url" required>
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
        
        $('.iconpicker').iconpicker();
        $('.iconpicker2').iconpicker();

        $('.iconpicker').on('change', function(e) {
            $('.icon-value').val(e.icon)
        })
        $('.iconpicker2').on('change', function(e) {
            $('.icon-value2').val(e.icon)
        })

        $('#add').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });
        $('#edit').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });

        $('.details').on('click',function () { 
            var data = $(this).data('item')
            $('#edit').find('input[name=sub_key]').val($(this).data('key'))
            $('#edit').find('input[name=icon]').val(data.icon)
            $('#edit').find('input[name=url]').val(data.url)
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/social.blade.php ENDPATH**/ ?>