

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
                           <?php if($section->content->image): ?>
                           <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Background Image'); ?></label>
                                <div class="gallery gallery-fw"  data-item-height="450">
                                    <img class="gallery-item imageShow" data-image="<?php echo e(getPhoto(@$section->content->image)); ?>">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image"  class="custom-file-input imageUpload mb-2" id="customFile">
                                    <code class="text-danger"><?php echo translate('Image size : 1920p x 1280 px'); ?></code>
                                    <input type="hidden" name="image_size" value="1320x880">
                                    <label class="custom-file-label" for="customFile"><?php echo translate('Choose file'); ?></label>
                                </div>
                            </div>
                           <?php endif; ?>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Title'); ?></label>
                                <input type="text" name="title" class="form-control" placeholder="<?php echo translate('Banner Title'); ?>" value="<?php echo e(@$section->content->title); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""><?php echo translate('Heading'); ?></label>
                                <input type="text" name="heading" class="form-control" placeholder="<?php echo translate('Banner Heading'); ?>" value="<?php echo e(@$section->content->heading); ?>" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Sub Heading'); ?></label>
                                <input type="text" name="sub_heading" class="form-control" placeholder="<?php echo translate('Banner Sub Heading'); ?>" value="<?php echo e(@$section->content->sub_heading); ?>" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for=""><?php echo translate('Payment Heading'); ?></label>
                                <input type="text" name="payment_heading" class="form-control" placeholder="<?php echo translate('Payment Heading'); ?>" value="<?php echo e(@$section->content->payment_heading); ?>" required>
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
                    <h4><?php echo app('translator')->get(ucfirst($section->name).' Sub Content'); ?></h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> <?php echo translate('Add New'); ?></button>
                </div>
                <?php
                    $i = 0;
                ?>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th><?php echo translate('Sl'); ?></th>
                                <th><?php echo translate('Image'); ?></th>
                                <th><?php echo translate('Title'); ?></th>
                                <th><?php echo translate('Action'); ?></th>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $section->sub_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo translate('Sl'); ?>">
                                        <?php echo e(++$i); ?>

                                    </td>
                                    
                                    <td data-label="<?php echo translate('Image'); ?>">
                                        <img src="<?php echo e(getPhoto($info->image)); ?>" width="30px">
                                    </td>
                                    <td data-label="<?php echo translate('Title'); ?>"><?php echo e($info->title); ?></td>

                                    <td data-label="<?php echo translate('Action'); ?>">
                                        <div class="d-flex flex-wrap flex-lg-nowrap align-items-center justify-content-end justify-content-lg-center">
                                            <a href="javascript:void(0)" class="btn btn-primary details btn-sm m-1" data-key="<?php echo e($key); ?>" data-item="<?php echo e(json_encode($info)); ?>"  data-img="<?php echo e(getPhoto($info->image)); ?>"><i class="fas fa-edit"></i></a>

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
            <form action="<?php echo e(route('admin.frontend.sub-content.update',$section->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo translate('Add New Sub Content'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="col-form-label"><?php echo translate('Sponsor logo'); ?> <code class="text-danger">(<?php echo translate('Image size : 20 x 20px'); ?>)</code></label>
                        <div class="form-group d-flex justify-content-center">
                            <div id="image-preview" class="image-preview"
                                style="background-image:url();">
                                <label for="image-upload" id="image-label"><?php echo translate('Choose File'); ?></label>
                                <input type="file" name="image" id="image-upload" />
                                <input type="hidden" name="image_size" value="20x20"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo translate('Title'); ?></label>
                            <input class="form-control" type="text" name="title" required>
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
                        <h5 class="modal-title"><?php echo translate('Edit Sub Content'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="col-form-label"><?php echo translate('Sponsor logo'); ?> <code class="text-danger">(<?php echo translate('Image size : 20 x 20px'); ?>)</code></label>
                        <div class="form-group d-flex justify-content-center">
                            <div id="image-preview1" class="image-preview"
                                style="background-image:url();">
                                <label for="image-upload" id="image-label1"><?php echo translate('Choose File'); ?></label>
                                <input type="file" name="image" id="image-upload1" />
                                <input type="hidden" name="image_size" value="20x20"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo translate('Title'); ?></label>
                            <input class="form-control" type="text" name="title" required>
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
        'use strict'
        function imageShow(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parents('.form-group').find('.imageShow').attr('src',e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").on('change', function () {
            imageShow(this);
        });


        $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "<?php echo e(translate('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(translate('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });
        $.uploadPreview({
                input_field: "#image-upload1", // Default: .image-upload
                preview_box: "#image-preview1", // Default: .image-preview
                label_field: "#image-label1", // Default: .image-label
                label_default: "<?php echo e(translate('Choose File')); ?>", // Default: Choose File
                label_selected: "<?php echo e(translate('Update Image')); ?>", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

        $('.details').on('click',function () { 
            var data = $(this).data('item')
            $('#edit').find('input[name=sub_key]').val($(this).data('key'))
            $('#edit').find('input[name=title]').val(data.title)
            $('#edit').find('#image-preview1').css('background-image','url('+$(this).data('img')+')')
            $('#edit').modal('show')
        })
        $('.remove').on('click',function () { 
            $('#remove').find('input[name=key]').val($(this).data('key'))
            $('#remove').modal('show')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/site_contents/banner.blade.php ENDPATH**/ ?>