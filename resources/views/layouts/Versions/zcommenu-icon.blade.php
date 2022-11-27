<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="MWZ - Netdesign Host" name="description">
		<meta content="MWZ - Netdesign Host" name="author">
		<meta name="keywords" content="Z.com "/>

		<!-- Title -->
		<title>Z.com MWZ Theme</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        @include('layouts.verticalmenu.vertical-light.styles')

	</head>

	<body class="app sidebar-mini">

		<!--Global-Loader-->
		<div id="global-loader">
			<img src="{{URL::asset('assets/images/brand/icon.png')}}" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
				<!--app-header-->
				<div class="app-header header d-flex">
					<div class="container-fluid">

						@include('layouts.components.zcomapp-header')

					</div>
				</div>
				<!--/app-header-->

				<!--News Ticker-->
				<!-- <div class="container-fluid bg-white news-ticker">

					@include('layouts.components.news-ticket')

				</div> -->
				<!--/News Ticker-->

                @include('layouts.components.zcomsidebar-menu')

                <!-- app-content-->
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">

                        @yield('content')

					</div>


					@yield('modals')

				</div>
				<!-- End app-content-->
			</div>

            @include('layouts.components.zcomfooter')

		</div>
		<!-- End Page -->
		
		<!-- vertical-light.scripts -->
        @include('layouts.verticalmenu.vertical-light.scripts')

	</body>
</html>
