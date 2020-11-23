<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        showCloseButton: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: '{{ __('Текущая температура в городе ') .json_decode(session()->get('weather'))->{'city'} .': '.json_decode(session()->get('weather'))->{'temp'} }} {!!  '&deg;C' !!}',
        footer: '{{ __('Осадки: ') . json_decode(session()->get('weather'))->{'status'} }}',
    })
</script>
