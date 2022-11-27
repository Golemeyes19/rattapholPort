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
								<li class="breadcrumb-item"><a href="#">ผู้ใช้งาน</a></li>
								<li class="breadcrumb-item active" aria-current="page">ฟอร์มกลุ่มผู้ใช้งาน</li>
							</ol>
						</div>
						<!-- End page-header -->

						<!-- row -->
						<div class="row">
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header pb-0">
										<h3 class="mb-0 card-title">ฟอร์มกลุ่ม</h3>
									</div>
									<form id="user_group_frm" name="user_group_frm" method="POST" onsubmit="setSaveGroup(this); return false;" enctype="multipart/form-data" >
	                        			@csrf
	                        			<input type="hidden" name="id" value="{{ !empty($group->id) ? $group->id :'0' }}">
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">ชื่อ</label>
														<input type="text" class="form-control" name="name" placeholder="ชื่อ" value="{{ !empty($group->name) ? $group->name :'' }}">
													</div>
													<div class="form-group">
														<label class="form-label">คำอธิบาย</label>
														<textarea id="user_group_description" class="form-control texteditor" name="description" rows="2" placeholder="text here..">{{ !empty($group->description) ? $group->description :'' }}</textarea>
													</div>
													<div class="form-group ">
														<label class="form-label">กลุ่มหลัก</label>
														<select name="parent_id" class="form-control select2-show-search" data-placeholder="Choose Parent">
																<option value="0">-- ไม่มี --</option>
																@foreach ($parents as $parent)
																	@if ( !empty($group->id) && $parent->id == $group->parent_id)
																		<option value="{{ $parent->id  }}" selected="selected">{{ $parent->name }}</option>
																	@else
																		<option value="{{ $parent->id  }}" >{{ $parent->name }}</option>
																	@endif
	
																@endforeach
														</select>
													</div>
													
													<div class="form-group">
														<label class="form-label">สถานะ</label>
															<div class="form-check form-check-inline">
															  	@if ( empty($group->status) || (!empty($group->status)&&$group->status == 1 ))
															  	<input class="form-check-input" type="radio" name="status" checked="checked" id="status_enable" value="1" >
															  	<label class="form-check-label" for="status_enable">เปิด</label>
															  	<input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
															  	<label class="form-check-label" for="status_disable">ปิด</label>
															  	@else
															  	<input class="form-check-input" type="radio" name="status" id="status_enable" value="1" >
															  	<label class="form-check-label" for="status_enable">เปิด</label>
															  	<input class="form-check-input" type="radio" name="status" id="status_disable" value="0" checked="checked">
															  	<label class="form-check-label" for="status_disable">ปิด</label>
															  	@endif
															  	
															</div>
															
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<label class="form-label">สิทธิ์</label>
													<ul id="show_roles" class="treeview">
													<?php foreach($roles as $rm_k => $rm_p){ ?>
													<li><a href="#"><?=$rm_k?></a>
														<ul>
															<?php foreach($rm_p as $rmm_k => $rmm_p){ 
																$all_check = '';
																if(!empty($group->default_role[$rm_k][$rmm_k])){
																	$all_check = (in_array('all',$group->default_role[$rm_k][$rmm_k]))?'checked="checked"':'';
																 }
																?>
																<li><div class="form-check form-check-inline"><input class="form-check-input <?=$rm_k?>_<?=$rmm_k?>" name="role[<?=$rm_k?>][<?=$rmm_k?>][all]" type="checkbox" id="<?=$rm_k?>_<?=$rmm_k?>_all" value="all" onclick="setCheckAllPermission(this,'<?=$rm_k?>_<?=$rmm_k?>');" <?=$all_check?> ></div><strong><?=$rmm_k.' :  '?></strong>
																	<?php foreach($rmm_p as $rmmm_k => $rmmm_p){ 

																		$module_role_checked= '';
																		if(!empty($group->default_role[$rm_k][$rmm_k])){
																			$module_role_checked = (in_array($rmmm_k,$group->default_role[$rm_k][$rmm_k]))?'checked="checked"':'';
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
												</div>
												<div class="col-md-12 ">
													<div class="form-group mb-1">
														<div class="btn-list">
															<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
															<button onclick="mwz_redirect('{{ route('admin.user.group.index') }}');" type="button" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>ยกเลิก</button>
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

		<!-- module js css -->
		<link rel="stylesheet" href="{{ mix('css/user.css') }}">
		<script src="{{ mix('js/user.js')  }}"></script>

@endsection