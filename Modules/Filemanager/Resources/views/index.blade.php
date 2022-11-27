@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- page-header -->
<div class="page-header">
	<ol class="breadcrumb"><!-- breadcrumb -->
		<li class="breadcrumb-item"><a href="#">File Manager</a></li>
	</ol>
</div>
<!-- End page-header -->
<!-- row opened -->
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title">File export Datatable</div> -->
			</div>
			<div class="card-body pt-0">
				<div id="elfinder"></div>
			</div>
		</div>
	</div>
</div>


@endsection('content')

@section('scripts')
		<!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

		<!--Jquery Sparkline js-->
		<script src="{{URL::asset('assets/plugins/vendors/jquery.sparkline.min.js')}}"></script>

		<!-- Chart Circle js-->
		<script src="{{URL::asset('assets/plugins/vendors/circle-progress.min.js')}}"></script>
		
        <!--Time Counter js-->
		<script src="{{URL::asset('assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/counters/counter.js')}}"></script>


		<!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

        <!-- elFinder JS (REQUIRED) -->
        <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

        <?php if($locale){ ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
        <?php } ?>

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $().ready(function() {
                $('#elfinder').elfinder({
                    // set your elFinder options here
                    <?php if($locale){ ?>
                        lang: '<?= $locale ?>', // locale
                    <?php } ?>
                    customData: { 
                        _token: '<?= csrf_token() ?>'
                    },
                    url : '<?= route("elfinder.connector") ?>',  // connector URL
                    soundPath: '<?= asset($dir.'/sounds') ?>',
                    height: 500
                });
            });
        </script>

		<!--File maanger-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
		<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
		<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

@endsection