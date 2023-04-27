<!doctype html>
<html lang="en" class="semi-dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - {{env('APP_NAME')}}</title>
	{{--All Styles--}}
	<link rel="icon" href="{{asset('admin/images/favicon-32x32.png')}}" type="image/png" />
	<link href="{{asset('admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin/css/pace.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('admin/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/icons.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('admin/css/dark-theme.css')}}"/>
	<link rel="stylesheet" href="{{asset('admin/css/semi-dark.css')}}"/>
	<link rel="stylesheet" href="{{asset('admin/css/header-colors.css')}}"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
	<style>
		.has-error {
			border: 1px solid red!important;
		}
		.swal2-popup {
			width: auto!important;
		}
		.swal2-modal .swal2-title {
			font-size: 14px;
		}
	</style>
	@stack('style')
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">

		<!--sidebar wrapper -->
		@include('admin.layouts.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
		@include('admin.layouts.header')
		<!--end header -->

		<!--start page wrapper -->
		@yield('content')
		<!--end page wrapper -->

		<!--start Footer -->
		@include('admin.layouts.footer')
		<!--end Footer -->

	</div>
	<!--end wrapper-->

	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode">
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark" checked>
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>

			<hr/>
			<h6 class="mb-0">Sidebar Backgrounds</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--end switcher-->

	{{--All Scripts--}}
	<script src="{{asset('admin/js/jquery.min.js')}}"></script>
	<script src="{{asset('admin/js/pace.min.js')}}"></script>
	<script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('admin/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('admin/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('admin/js/app.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
