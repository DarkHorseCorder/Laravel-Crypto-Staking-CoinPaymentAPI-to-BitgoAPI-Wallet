<script src="{{asset('assets/admin/js/sweetalert2@9.js')}}"></script>

@if($errors->any())
@foreach ($errors->all() as $error)
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
        title: '{{ __($error) }}'
        })
    </script>
@endforeach
@endif


@if(Session::has('success'))
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
title: '{{translate(Session::get('success'))}}'
})
</script>
@endif

@if(Session::has('error'))
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
title: '{{translate(Session::get('error'))}}'
})
</script>
@endif

@if(Session::has('info'))
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
title: '{{translate(Session::get('info'))}}'
})
</script>
@endif
@if(Session::has('warning'))
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
    title: '{{translate(Session::get('warning'))}}'
    })
</script>
@endif

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
