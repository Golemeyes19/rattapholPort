@extends('layouts.app')

@section('styles')

<!--Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

<!-- Time picker css-->
<link href="{{URL::asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet" />

<!-- Date Picker css-->
<link href="{{URL::asset('assets/plugins/spectrum-date-picker/spectrum.css')}}" rel="stylesheet" />

<!-- File Uploads css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/dropify.css')}}" rel="stylesheet" type="text/css" />

<!--Mutipleselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/multipleselect/multiple-select.css')}}">



@endsection

@section('content')

<!-- page-header -->
<div class="page-header">
	<ol class="breadcrumb"><!-- breadcrumb -->
		<li class="breadcrumb-item"><a href="{{route('admin.user.user.index')}}">{{ __('user_admin.user') }}</a></li>
	@if (empty($user->id))
		<li class="breadcrumb-item active" aria-current="page">{{ __('user_admin.add') }}</li>
	@else
		<li class="breadcrumb-item active" aria-current="page">{{ __('user_admin.edit') }}</li>
	@endif
	</ol>
</div>
<!-- End page-header -->

<!-- row -->
<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-header pb-0">
				<h3 class="mb-0 card-title">{{ __('user_admin.user_form') }}</h3>
			</div>
			<form id="user_frm" name="user_frm" method="POST" onsubmit="setSave(); return false;" enctype="multipart/form-data" >
				@csrf
				<input type="hidden" name="id" id="user_id" value="{{ !empty($user->id) ? $user->id :'0' }}">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.name') }}</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="{{ __('user_admin.name') }}" value="{{ !empty($user->name) ? $user->name :'' }}">
							</div>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.email') }}</label>
								<input type="email" class="form-control" id="email"  name="email" placeholder="youremail@domain.com" value="{{ !empty($user->email) ? $user->email :'' }}">
							</div>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.username') }}</label>
								<input <?=(!empty($user->id))?'readonly':'';?> type="text" class="form-control" name="username" id="username" placeholder="{{ __('user_admin.username') }}" value="{{ !empty($user->username) ? $user->username :'' }}">
							</div>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.password') }}</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="{{ __('user_admin.password') }}" value="{{ !empty($user->password) ? '********' :'' }}">
							</div>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.re_password') }}</label>
								<input type="password" class="form-control" id="re_password" name="re_password" placeholder="{{ __('user_admin.re_password') }}" value="{{ !empty($user->password) ? '********' :'' }}">
							</div>
							<?php if($enable_feature['group']){ ?>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.group') }}</label>
								<select name="group_id" class="form-control select2-show-search" data-placeholder="Choose Parent" onchange="setChangeGroup(this.value);">
									@foreach ($groups as $group)
									@if ( !empty($user->group_id) && $group->id == $user->group_id)
									<option value="{{ $group->id  }}" selected="selected">{{ $group->name }}</option>
									@else
									<option value="{{ $group->id  }}" >{{ $group->name }}</option>
									@endif

									@endforeach
								</select>
							</div>
							<?php }else{ ?>
								<input type="hidden" name="group_id" value="1">
							<?php } ?>
							<div class="form-group required">
								<label class="form-label">{{ __('user_admin.avatar') }}</label>
								<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<input type="file" name="avatar" class="dropify" data-default-file="{{ !empty($user->avatar) ? $user->avatar :'' }}" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group " style="display:none">
								<label class="form-label required">{{ __('user_admin.language') }}</label>
								<select name="locale" class="form-control select2-show-search" data-placeholder="Choose Locale" >
									@if ( empty($user->locale) || (!empty($user->locale)&&$user->locale=='th'))
									<option value="th" selected="selected">{{ __('user_admin.th') }}</option>
									<option value="en" >{{ __('user_admin.en') }}</option>
									@else
									<option value="th" >{{ __('user_admin.th') }}</option>
									<option value="en" selected="selected" >{{ __('user_admin.en') }}</option>
									@endif
								</select>
							</div>
							<div class="form-group ">
								<label class="form-label required">{{ __('user_admin.status') }}</label>
								@if ( !isset($user->status) || (isset($user->status)&&$user->status == 1) )
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="status_enable" value="1" checked="checked">
									<label class="form-check-label" for="status_enable">{{ __('user_admin.status_enable') }}</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
									<label class="form-check-label" for="status_disable">{{ __('user_admin.status_disable') }}</label>
								</div>
								@else
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="status_enable" value="1">
									<label class="form-check-label" for="status_enable">{{ __('user_admin.status_enable') }}</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="status_disable"  value="0"  checked="checked">
									<label class="form-check-label" for="status_disable">{{ __('user_admin.status_disable') }}</label>
								</div>
								@endif
							</div>
							<?php if($enable_feature['api']){ ?>
							<div class="form-group">
								<label class="form-label required">{{ __('user_admin.api_enables') }}</label>
									@if (empty($user->api_enable) || (!empty($user->api_enable)&&$user->api_enable==1) )
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="api_enable" id="api_enable" value="1" checked="checked">
										<label class="form-check-label" for="api_enable">	{{ __('user_admin.api_enable') }}</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="api_enable" id="api_disable"  value="0">
										<label class="form-check-label" for="api_disable">	{{ __('user_admin.api_disable') }}</label>
									</div>
									@else
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="api_enable" id="api_enable" value="1" >
										<label class="form-check-label" for="api_enable">	{{ __('user_admin.api_enable') }}</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="api_enable" id="api_disable" checked="checked" value="0">
										<label class="form-check-label" for="api_disable">	{{ __('user_admin.api_disable') }}</label>
									</div>
									@endif
							</div>
						<?php }else{ ?>
							<input type="hidden" name="api_enable" value="0">
						<?php } ?>
						</div>
						<?php if($enable_feature['role']){ ?>
						<div class="col-md-6">
							<label class="form-label">{{ __('user_admin.permission') }}</label>
							<ul id="show_roles" class="treeview">
								<?php foreach($roles as $rm_k => $rm_p){ ?>
									<li><a href="#"><?=$rm_k?></a>
										<ul>
											<?php foreach($rm_p as $rmm_k => $rmm_p){ 
												$all_check = '';
												if(!empty($user->role[$rm_k][$rmm_k])){
													$all_check = (in_array('all',$user->role[$rm_k][$rmm_k]))?'checked="checked"':'';
												}
												?>
												<li><div class="form-check form-check-inline"><input class="form-check-input <?=$rm_k?>_<?=$rmm_k?>" name="role[<?=$rm_k?>][<?=$rmm_k?>][all]" type="checkbox" id="<?=$rm_k?>_<?=$rmm_k?>_all" value="all" onclick="setCheckAllPermission(this,'<?=$rm_k?>_<?=$rmm_k?>');" <?=$all_check?> ></div><strong><?=$rmm_k.' :  '?></strong>
													<?php foreach($rmm_p as $rmmm_k => $rmmm_p){ 

														$module_role_checked= '';
														if(!empty($user->role[$rm_k][$rmm_k])){
															$module_role_checked = (in_array($rmmm_k,$user->role[$rm_k][$rmm_k]))?'checked="checked"':'';
														}

														?>
														<div class="form-check form-check-inline">
															<input class="form-check-input <?=$rm_k?>_<?=$rmm_k?>" name="role[<?=$rm_k?>][<?=$rmm_k?>][<?=$rmmm_k?>]" type="checkbox" id="<?=$rm_k?>_<?=$rmm_k?>_<?=$rmmm_k?>" value="<?=$rmmm_k?>" <?=$module_role_checked?> >
															<label class="form-check-label" for="<?=$rmm_k?>_<?=$rmmm_k?>"><?=$rmmm_k?></label>
														</div>
													<?php } ?>
												</li>
											<?php } ?>

										</ul>
									</li>
								<?php } ?>
							</ul>
						</div>
						<?php }else{ ?>
							<input type="hidden" name="role[]" value="">
						<?php }?>
						<div class="col-md-12 ">
							<div class="form-group mb-1">
								<div class="btn-list">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ __('user_admin.save') }}</button>
									<button onclick="mwz_redirect('{{ route('admin.user.user.index') }}');" type="button" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{ __('user_admin.cancel') }}</button>
								</div>
							</div>
						</div>
					</div>
						
				</div>
			</form>
		</div>
	</div>
</div>
<!-- .row -->	

@endsection('content')

@section('scripts')

<!--Jquery Sparkline js-->
<script src="{{URL::asset('assets/plugins/vendors/jquery.sparkline.min.js')}}"></script>

<!-- File uploads js -->
<script src="{{URL::asset('assets/plugins/fileuploads/js/dropify.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/dropify-demo.js')}}"></script>

<!--Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<!-- <script src="{{URL::asset('assets/js/form-elements.js')}}"></script> -->

<!--MutipleSelect js-->
<script src="{{URL::asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/multipleselect/multi-select.js')}}"></script>

<!--ckeditor js-->
<script src="{{URL::asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
<!-- <script src="{{URL::asset('assets/js/formeditor.js')}}"></script> -->

<!-- Notifications js -->
<link href="{{URL::asset('assets/plugins/notify-growl/css/jquery.growl.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/notify-growl/css/notifIt.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/plugins/bootbox/bootbox.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify-growl/js/rainbow.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify-growl/js/jquery.growl.js')}}"></script>

<!-- validator js -->
<script src="{{URL::asset('assets/plugins/validator/js/jquery.validate.min.js')}}"></script>

<!--- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

<!--- Internal Treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />

<!-- mwz master js css -->
<link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
<script src="{{ mix('js/mwz.js')  }}"></script>

<!-- define group role on js -->
<script type="text/javascript">
	var groups_default_role = [];
	<?php
	foreach($groups as $group){
		if(json_decode($group->default_role)){
			?>
			groups_default_role[<?=$group->id?>]=JSON.parse('<?=$group->default_role?>');
		<?php }} ?>
	</script>
	<!-- module js css -->
	<link rel="stylesheet" href="{{ mix('css/user.css') }}">
	<script src="{{ mix('js/user.js')  }}"></script>

	@endsection