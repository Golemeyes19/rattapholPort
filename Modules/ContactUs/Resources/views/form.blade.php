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
	<li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{__('admin.homepage')}}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('admin.contactus.contactus.index') }}">{{__('contact_us_admin.contact_us_list')}}</a></li>
	<li class="breadcrumb-item active" aria-current="page">{{__('contact_us_admin.edit_contact_us_list')}}</li>
  </ol><!-- End breadcrumb -->
</div>
<!-- End page-header -->

<div class="row">
  <div class="col-md-12">
	<div class="card">
	  <div class="card-header">
		<!-- <div class="card-title">File export Datatable</div> -->
	  </div>
	  <div class="card-body pt-0">
		<div class="tab-content" id="myTabContent">
		  {{-- เนื้อหา ข้อมูลพื้นฐานของสมาชิก --}}
		  <div class="tab-pane fade p-0 active show" id="home" role="tabpanel" aria-labelledby="home-tab">
			<form id="contactus_frm" name="contactus_frm" method="POST" onsubmit="setSave(); return false;" enctype="multipart/form-data" >
			  @csrf
			  <input type="hidden" id="hnnjfn" name="id" value="{{ !empty($contactus->id) ? $contactus->id :'0' }}">
			  <div class="row">
				  <div class="form-group col-md-6">
					<label class="form-label">{{__('contact_us_admin.name')}}</label>
					<input type="text" class="form-control" name="name" placeholder="{{__('contact_us_admin.name')}}" value="{{ !empty($contactus->name) ? $contactus->name :'' }}" readonly>
				  </div>
				  <div class="form-group col-md-6">
					<label class="form-label">{{__('contact_us_admin.date')}}</label>
					<input type="text" class="form-control" name="date" placeholder="{{__('contact_us_admin.date')}}" value="{{ !empty($contactus->create_date) ? date('d-m-Y', strtotime($contactus->create_date)) :'' }}" readonly>
				  </div>
                  <div class="form-group col-md-12">
                    <label class="form-label">{{__('contact_us_admin.detail')}}</label>
                    <textarea class="form-control" name="message" rows="4" placeholder="{{__('contact_us_admin.detail')}}" readonly>{{ !empty($contactus->message) ? $contactus->message :'' }}</textarea>
                  </div>
				  <div class="form-group col-md-12">
					<label class="form-label">{{__('contact_us_admin.subject')}}</label>
					<input type="text" class="form-control" name="subject" placeholder="{{__('contact_us_admin.subject')}}" value="{{ !empty($contactus->subject) ? $contactus->subject :'' }}" readonly>
				  </div>
				  {{-- <div class="form-group col-md-12">
					<label class="form-label">{{__('contact_us_admin.reply')}}</label>
					<input type="text" class="form-control" name="reply" placeholder="{{__('contact_us_admin.reply')}}" value="{{ !empty($contactus->reply) ? $contactus->reply :'' }}">
				  </div>
                  <div class="form-group col-md-12">
                    <label class="form-label">{{__('contact_us_admin.message')}}</label>
                    <textarea class="form-control" name="message" rows="4" placeholder="{{__('contact_us_admin.message')}}">{{ !empty($contactus->message) ? $contactus->message :'' }}</textarea>
                  </div> --}}
				  <div class="form-group col-md-12">
					<label class="form-label">{{__('contact_us_admin.display_status')}}</label>
						  @if ( !empty($contactus->status) && $contactus->status == 1  )
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" checked>
                                <label class="form-check-label" for="status_enable">{{__('contact_us_admin.status_enable')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
                                <label class="form-check-label" for="status_disable">{{__('contact_us_admin.status_disable')}}</label>
                            </div>
						  @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" >
                                <label class="form-check-label" for="status_enable">{{__('contact_us_admin.status_enable')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_disable" value="0" checked>
                                <label class="form-check-label" for="status_disable">{{__('contact_us_admin.status_disable')}}</label>
                            </div>
						  @endif
					  </div>
				  </div>
				</div>
				<div class="col-md-12 ">
				  <div class="form-group mb-1">
					<div class="btn-list">
					  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('contact_us_admin.save')}}</button>
					  <button onclick="mwz_redirect('{{ route('admin.contactus.contactus.index') }}');" type="button" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('contact_us_admin.cancel')}}</button>
					</div>
				  </div>
				</div>
			</form>
		  </div>{{-- จบเนื้อหา ข้อมูลพื้นฐานของสมาชิก --}}
		</div>
	  </div>
	</div>
  </div>
</div>
@endsection

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

        <!-- INTERNAL Data tables -->
		<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
		<!-- <script src="{{URL::asset('assets/plugins/datatable/datatable-2.js')}}"></script> -->
		
		<!-- validator js -->
		<script src="{{URL::asset('assets/plugins/validator/js/jquery.validate.min.js')}}"></script>

		<!-- mwz contactus js css -->
		<link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
		<script src="{{ mix('js/mwz.js')  }}"></script>

		<!-- module js css -->
		<link rel="stylesheet" href="{{ mix('css/contactus.css') }}">
		<script src="{{ mix('js/contactus.js')  }}"></script>

@endsection