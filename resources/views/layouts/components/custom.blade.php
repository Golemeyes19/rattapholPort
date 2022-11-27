<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Z.com MWZ Frameork">
		<meta content="Z.com MWZ Frameork" name="author">
		<meta name="keywords" content="Z.com MWZ Frameork"/>

		<!-- Title -->
		<title>Z.com MWZ Frameork</title>

        @include('layouts.components.custom-styles')

	</head>
	<body class="bg-account ">
	    <!-- page -->
		<div class="page h-100">

            @yield('content')

		</div>
		<!-- page End-->

        @include('layouts.components.custom-scripts')

	</body>
</html>