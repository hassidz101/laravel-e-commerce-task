<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('admin/images/favicon-32x32.png')}}" type="image/png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
    @stack('style')
</head>
<body>
<!-- Navigation-->
@include('front.layouts.navigation')
<!-- Header-->
@include('front.layouts.header')
<!-- Section-->
@yield('content')
<!-- Footer-->
@include('front.layouts.footer')
<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function alertyFy(message,icon,timer=3000) {
        Swal.fire({
            title: message,
            icon: icon,
            showConfirmButton: false,
            position: 'top-right',
            timer: timer
        });
        return false;
    }
</script>
@stack('script')
</body>
</html>
