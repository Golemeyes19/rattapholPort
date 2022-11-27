
<div class="d-flex">
	<a class="header-brand" href="{{ route('admin.websetting.websetting.edit') }}">
		<img src="{{URL::asset('assets/images/admin/logo.png')}}" class="header-brand-img main-logo" alt="">
		<img src="{{URL::asset('assets/images/admin/logo.png')}}" class="header-brand-img darklogo" alt="">
		<img src="{{URL::asset('assets/images/admin/logo.png')}}" class="header-brand-img icon-logo" alt="">
	</a><!-- logo-->
	<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
	<a href="#" data-toggle="search" class="nav-link nav-link  navsearch"><i class="fa fa-search"></i></a><!-- search icon -->

	

	<div class="d-flex order-lg-2 ml-auto header-rightmenu">

		
		<div class="dropdown">
			<a href="/" target="_blank" class="nav-link icon" id="view">
				<i class="fa fa-desktop" aria-hidden="true"></i>
			</a>
		</div>
		<!-- full-screen -->
		<div class="dropdown">
			<a  class="nav-link icon full-screen-link" id="fullscreen-button">
				<i class="fe fe-maximize-2"></i>
			</a>
		</div>
		<!-- .full-screen -->
		<!-- notifications -->
		{{-- <div class="dropdown header-notify" >
			<a href="#" class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
				<i class="fe fe-bell "></i>
				<span class="pulse bg-success"></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow " >
				<a href="#" class="dropdown-item text-center">4 New Notifications</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item d-flex pb-3">
					<div class="notifyimg bg-green">
						<i class="fe fe-mail"></i>
					</div>
					<div>
						<strong>Message Sent.</strong>
						<div class="small text-muted">12 mins ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item d-flex pb-3">
					<div class="notifyimg bg-pink">
						<i class="fe fe-shopping-cart"></i>
					</div>
					<div>
						<strong>Order Placed</strong>
						<div class="small text-muted">2  hour ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item d-flex pb-3">
					<div class="notifyimg bg-blue">
						<i class="fe fe-calendar"></i>
					</div>
					<div>
						<strong> Event Started</strong>
						<div class="small text-muted">1  hour ago</div>
					</div>
				</a>
				<a href="#" class="dropdown-item d-flex pb-3">
					<div class="notifyimg bg-orange">
						<i class="fe fe-monitor"></i>
					</div>
					<div>
						<strong>Your Admin Lanuch</strong>
						<div class="small text-muted">2  days ago</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item text-center">View all Notifications</a>
			</div>
		</div> --}}
		<!-- .notifications -->

		<!-- user -->
		<div class="dropdown header-user" >
			<a class="nav-link leading-none " data-toggle="dropdown" aria-expanded="false" >
				<span class="mr-3 d-none d-lg-block ">
					<span class="text-gray-white"><span class="ml-2"><?=Auth::guard('admin')->user()->name;?></span></span>
				</span>
				<span class="avatar avatar-md brround"><img src="<?=Auth::guard('admin')->user()->avatar;?>" alt="Profile-img" class="avatar avatar-md brround"></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
				<div class="header-user text-center mt-4 pb-4">
					<span class="avatar avatar-xxl brround"><img src="<?=Auth::guard('admin')->user()->avatar;?>" alt="Profile-img" class="avatar avatar-xxl brround"></span>
					<?php $id = Auth::guard('admin')->user()->id; ?>
					<a href="{{ route('admin.user.user.edit', $id) }}" class="dropdown-item text-center font-weight-semibold user h3 mb-0"><?=Auth::guard('admin')->user()->name;?></a>
					<small>Last Login <br><?=Auth::guard('admin')->user()->last_logedin_at;?></small>
				</div>
				<!-- <a class="dropdown-item" href="#">
					<i class="dropdown-icon mdi mdi-account-outline "></i> Spruko technologies
				</a>
				<a class="dropdown-item" href="#">
					<i class="dropdown-icon  mdi mdi-account-plus"></i> Add another Account
				</a> -->
				<div class="card-body border-top">
					<div class="row">
						<!-- <div class="col-6 text-center">
							<a class="" href=""><i class="dropdown-icon mdi  mdi-message-outline fs-30 m-0 leading-tight"></i></a>
							<div>Inbox</div>
						</div> -->
						<div class="col-12 text-center">
							<a class="" href="{{ route('admin.logout') }}"><i class="dropdown-icon mdi mdi-logout-variant fs-30 m-0 leading-tight"></i>
								<div>Log out</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- .user -->

		
	</div>
</div>
