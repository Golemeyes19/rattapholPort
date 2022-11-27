@extends('layouts.app')

@section('styles')
	<!-- Data table css -->
	<link href="{{URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
	<link href="{{URL::asset('assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
	<!-- Select2 css -->
	<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
        @section('content')<!-- page-header -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="#">Menu Group</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Edit</li>
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
                      <form id="menu_frm" name="menu_frm" method="POST" onsubmit="setSave(); return false;" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ !empty($menu->id) ? $menu->id :'0' }}">
                        <div class="row">
                            <div class="form-group col-md-4">
                              <label class="form-label">Name</label>
                              <input type="text" class="form-control" name="name" placeholder="Name" value="{{ !empty($menu->name) ? $menu->name :'' }}">
                            </div>
                            <div class="form-group col-md-12">
                              <label class="form-label">Description</label>
                              <textarea class="form-control" name="description" rows="6" placeholder="description here..">{{ !empty($menu->description) ? $menu->description :'' }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                              <label class="form-label">{{__('menu_admin.status')}}</label>
                                <div class="form-check form-check-inline">
                                    @if ( empty($menu->status) || $menu->status == 1  )
                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" checked="checked">
                                    @else
                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" >
                                    @endif
                                    <label class="form-check-label" for="status_enable">{{__('menu_admin.enable')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    @if ( !empty($menu->status) && $menu->status != 1  )
                                    <input class="form-check-input" type="radio" name="status" checked="checked" id="status_disable" value="0">
                                    @else
                                    <input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
                                    @endif
                                    <label class="form-check-label" for="status_disable">{{__('menu_admin.disable')}}</label>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-12 ">
                            <div class="form-group mb-1">
                              <div class="btn-list">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('menu_admin.save')}}</button>
                                <button onclick="mwz_redirect('{{ route('admin.menu.menugroup.index') }}');" type="button" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('menu_admin.cancel')}}</button>
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

		<!-- Chart Circle js-->
		<script src="{{URL::asset('assets/plugins/vendors/circle-progress.min.js')}}"></script>
		
        <!--Time Counter js-->
		<script src="{{URL::asset('assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/counters/counter.js')}}"></script>
		
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

		<!-- mwz menu js css -->
		<link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
		<script src="{{ mix('js/mwz.js')  }}"></script>

		<!-- module js css -->
		<link rel="stylesheet" href="{{ mix('css/menu.css') }}">
		<script src="{{ mix('js/menu.js')  }}"></script>

@endsection
