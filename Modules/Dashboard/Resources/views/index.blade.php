@extends('layouts.app')

@section('styles')

	<!-- Morris  Charts css-->
	<link href="{{URL::asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" />

@endsection

@section('content')

					    <!-- page-header -->
						<div class="page-header">
							<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{ __('admin.homepage') }}</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol><!-- End breadcrumb -->
						</div>
						<!-- End page-header -->

						<div class="row">
							<div class="col-sm-12 col-lg-12 col-xxl-6">
								<div class="card">
									<div class="card-header custom-header pb-0">
										<div>
											<h3 class="card-title">{{ __('dashboard_admin.welcome') }} {{$data['companyname']}}</h3>
										</div>
										<div class="card-options">
											<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
												<span class="fa fa-ellipsis-v"></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-right" role="menu">
												<li><a href="#"><i class="si si-plus mr-2"></i>{{ __('dashboard_admin.add') }}</a></li>
												<li><a href="#"><i class="si si-trash mr-2"></i>{{ __('dashboard_admin.remove') }}</a></li>
												<li><a href="#"><i class="si si-eye mr-2"></i>{{ __('dashboard_admin.view') }}</a></li>
												<li><a href="#"><i class="si si-settings mr-2"></i>{{ __('dashboard_admin.more') }}</a></li>
											</ul>
										</div>
									</div>
									<div class="card-body pt-3 pb-3">
										<p class="text-muted">{{ __('dashboard_admin.detail') }}</p>

										<p class="text-muted">{{ __('dashboard_admin.requirement') }}</p>
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-lg-12 col-xxl-6">
								<div class="card">
									<div class="card-header custom-header pb-0">
										<div>
											<h3 class="card-title">{{ __('dashboard_admin.user_manual') }}</h3>
										</div>
										<div class="card-options">
											<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
												<span class="fa fa-ellipsis-v"></span>
											</a>
											<ul class="dropdown-menu dropdown-menu-right" role="menu">
												<li><a href="#"><i class="si si-plus mr-2"></i>{{ __('dashboard_admin.add') }}</a></li>
												<li><a href="#"><i class="si si-trash mr-2"></i>{{ __('dashboard_admin.remove') }}</a></li>
												<li><a href="#"><i class="si si-eye mr-2"></i>{{ __('dashboard_admin.view') }}</a></li>
												<li><a href="#"><i class="si si-settings mr-2"></i>{{ __('dashboard_admin.more') }}</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection('content')

@section('scripts')
<!--Jquery Sparkline js-->
<script src="{{URL::asset('assets/plugins/vendors/jquery.sparkline.min.js')}}"></script>
<!-- Chart Circle js-->
<script src="{{URL::asset('assets/plugins/vendors/circle-progress.min.js')}}"></script>
<!--Time Counter js-->
<script src="{{URL::asset('assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
<script src="{{URL::asset('assets/plugins/counters/counter.js')}}"></script>
<!-- ApexChart -->
<script src="{{URL::asset('assets/plugins/apexcharts/apexcharts.js')}}"></script>
<!-- ECharts js -->
<script src="{{URL::asset('assets/plugins/echarts/echarts.js')}}"></script>
<!--Morris  Charts js-->
<script src="{{URL::asset('assets/plugins/morris/raphael-min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/morris/morris.js')}}"></script>
<!-- Custom-charts js-->
<script src="{{URL::asset('assets/js/index5.js')}}"></script>
<!-- Custom-charts laravel module asset-->
{{-- Laravel Mix - CSS File --}}
{{-- <link rel="stylesheet" href="{{ mix('css/mwz.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}"> --}}
{{-- Laravel Mix - JS File --}}
<script src="{{ mix('js/mwz.js')  }}"></script>
<script src="{{ mix('js/dashboard.js') }}"></script>
@endsection