@extends('layouts.customapp')

@section('custom-styles')

@endsection

@section('content')

			<!-- page-content -->
			<div class="page-content">
				<div class="container text-center text-dark">
					<div class="row">
						<div class="col-lg-4 d-block mx-auto">
							<div class="row">
								<div class="col-xl-12 col-md-12 col-md-12">
									<div class="card">
										<div class="card-body">
											<div class="text-center mb-6">
												<img src="{{URL::asset('assets/images/admin/logo.png')}}" class="" alt="">
											</div>
											 @if (session()->has('errors'))
												<div class="alert alert-danger mb-0" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong> {{ session('errors') }}</span>
												</div>
											@endif
											
											@if (session('status'))
												<div class="alert alert-success" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
													<span class="alert-inner--text"><strong>Success!</strong> {{ session('status') }}</span>
												</div>
											    
											@endif

											<form action="/admin" method="post">
												 @csrf
											<h3>{{ __('user_admin.login') }}</h3>
											<p class="text-muted">{{ __('user_admin.sign_your_account') }}</p>
											<div class="input-group mb-3">
												<span class="input-group-addon bg-white"><i class="fa fa-user"></i></span>
												<input type="text" name="username"  class="form-control" placeholder="{{ __('user_admin.username') }}">
											</div>
											<div class="input-group mb-4">
												<span class="input-group-addon bg-white"><i class="fa fa-unlock-alt"></i></span>
												<input type="password" name="password" class="form-control" placeholder="{{ __('user_admin.password') }}">
											</div>
											<div class="row">
												<div class="col-12">
													<button type="submit" class="btn btn-primary btn-block">{{ __('user_admin.login') }}</button>
												</div>
												<!-- <div class="col-12">
													<a href="{{url('forgot-password')}}" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
												</div> -->
											</div>
											</form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- page-content end -->

@endsection('content')

@section('custom-scripts')

@endsection