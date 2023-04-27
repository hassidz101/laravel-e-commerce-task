<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{asset('admin/images/favicon-32x32.png')}}" type="image/png" />
	<link href="{{asset('admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/css/pace.min.css')}}" rel="stylesheet" />
	<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('admin/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/icons.css')}}" rel="stylesheet">
	<title>{{env('APP_NAME')}} Admin Login</title>
</head>

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
	<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
		<div class="container-fluid">
			<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
				<div class="col mx-auto">

					<div class="card shadow-none">
						<div class="card-body">
							<div class="border p-4 rounded">
								<div class="text-center mb-4">
									<h3 class="">Sign in</h3>
									<p class="mb-0">{{env('APP_NAME')}} Admin Login</p>
								</div>
								<div class="form-body">
									@if ($errors->any())
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif
									<form class="row g-4" action="{{route('admin.login.process')}}" method="post">
										@csrf
										<div class="col-12">
											<label for="inputEmailAddress" class="form-label">Email Address</label>
											<input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="Email Address" required>
										</div>
										<div class="col-12">
											<label for="inputChoosePassword" class="form-label">Enter Password</label>
											<div class="input-group" id="show_hide_password">
												<input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="Enter Password" required>
                                                <a href="javascript:void(0);" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
												<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
											</div>
										</div>
										<div class="col-12">
											<div class="d-grid">
												<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</div>
</div>
<!--end wrapper-->

<script src="{{asset("admin/js/jquery.min.js")}}"></script>
<script src="{{asset('admin/js/pace.min.js')}}"></script>
<script src="{{asset("admin/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("admin/plugins/simplebar/js/simplebar.min.js")}}"></script>
<script src="{{asset("admin/plugins/metismenu/js/metisMenu.min.js")}}"></script>
<script src="{{asset("admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js")}}"></script>
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<script src="{{asset("admin/js/app.js")}}"></script>
</body>
</html>
