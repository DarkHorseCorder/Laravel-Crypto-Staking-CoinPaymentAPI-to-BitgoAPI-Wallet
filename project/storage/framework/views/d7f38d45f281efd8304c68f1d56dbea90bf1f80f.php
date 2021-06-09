<script src="<?php echo e(asset('assets/admin/js/sweetalert2@9.js')); ?>"></script>

<?php if($errors->any()): ?>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
        Toast.fire({
        icon: 'error',
        title: '<?php echo e(__($error)); ?>'
        })
    </script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if(Session::has('success')): ?>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
Toast.fire({
icon: 'success',
title: '<?php echo e(translate(Session::get('success'))); ?>'
})
</script>
<?php endif; ?>

<?php if(Session::has('error')): ?>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
Toast.fire({
icon: 'error',
title: '<?php echo e(translate(Session::get('error'))); ?>'
})
</script>
<?php endif; ?>

<?php if(Session::has('info')): ?>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
Toast.fire({
icon: 'info',
title: '<?php echo e(translate(Session::get('info'))); ?>'
})
</script>
<?php endif; ?>
<?php if(Session::has('warning')): ?>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
    Toast.fire({
    icon: 'warning',
    title: '<?php echo e(translate(Session::get('warning'))); ?>'
    })
</script>
<?php endif; ?>

<script>
    function toast(type,msg) { 
      const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
        Toast.fire({
            icon: type,
            title: msg
        })
    }

    function amount(amount,type) { 
        if(type == 2){
            return amount.toFixed(8);
        }else{
            return amount.toFixed();
        }
    }
   
  </script>
<?php /**PATH C:\xampp\htdocs\cc\crypto\project\resources\views/notify/alert.blade.php ENDPATH**/ ?>