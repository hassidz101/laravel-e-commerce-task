<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('admin/images/favicon-32x32.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Admin</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>

	<ul class="metismenu" id="menu">
		{{--All Products--}}
		<li>
			<a href="{{route('admin.product.list')}}">
				<div class="parent-icon"><i class='bx bxl-product-hunt'></i></div>
				<div class="menu-title">All Products</div>
			</a>
		</li>

        {{--Add Product--}}
        <li>
            <a href="{{route('admin.manage.product')}}">
                <div class="parent-icon"><i class='bx bx-add-to-queue'></i></div>
                <div class="menu-title">Add Product</div>
            </a>
        </li>

		{{--Site--}}
		<li>
			<a href="{{env('APP_URL')}}" target="_blank">
				<div class="parent-icon"><i class='bx bx-world'></i></div>
				<div class="menu-title">Site</div>
			</a>
		</li>

		{{--Logout--}}
		<li>
			<a href="{{route('admin.logout.process')}}">
				<div class="parent-icon"><i class='bx bx-log-out'></i></div>
				<div class="menu-title">Logout</div>
			</a>
		</li>

	</ul>
</div>
