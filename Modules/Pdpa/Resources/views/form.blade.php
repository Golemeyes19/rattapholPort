@extends('layouts.app')

@section('styles')

    <!---Tabs css-->
    <link href="{{URL::asset('assets/plugins/tabs/tabs-style.css')}}" rel="stylesheet" />

    <!--Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

    <!-- Datetime Picker css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.css')}}">

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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.pdpa.pdpa.index') }}">{{__('pdpa_admin.pdpa')}}</a></li>
            @if (empty($pdpa->id))
                <li class="breadcrumb-item active" aria-current="page">{{__('pdpa_admin.add_pdpa')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('pdpa_admin.edit_pdpa')}}</li>
            @endif
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="pdpa_frm" name="pdpa_frm" method="POST" onsubmit="setSave(); return false;" >
                @csrf
                <input type="hidden" name="id" value="{{ !empty($pdpa->id) ? $pdpa->id :'0' }}">
                <div class="card">
                  <div class="card-header pb-0">
                    <h3 class="mb-0 card-title">{{__('pdpa_admin.pdpa')}}</h3>
                  </div>
                    <div class="card-body">
                      <div class="panel panel-primary">
                          <div class="tab_wrapper first_tab">
                              <ul class="tab_list">
                                  <li class="icons-list-item"  style="height: 36px;" ><i class="flag flag-th"></i></li>
                                  <li class="icons-list-item"  style="height: 36px;" ><i class="flag flag-gb"></i></li>
                              </ul>
                              <div class="content_wrapper">
                                  <div class="tab_content active">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.name')}} (TH) <span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control" id="pdpa_title_th" name="pdpa_title_th" placeholder="{{__('pdpa_admin.name_placeholder')}}" value="{{ !empty($pdpa->pdpa_title_th) ? $pdpa->pdpa_title_th :'' }}">
                                              </div>
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.detail')}} (TH) <span class="text-danger">*</span></label>
                                                  <textarea id="pdpa_detail_th" class="form-control texteditor" name="pdpa_detail_th" rows="4" placeholder="{{__('pdpa_admin.detail_placeholder')}}">{{ !empty($pdpa->pdpa_detail_th) ? $pdpa->pdpa_detail_th :'' }}</textarea>
                                              </div>
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.detail_long')}} (TH) <span class="text-danger">*</span></label>
                                                  <textarea id="pdpa_detail_long_th" class="form-control texteditor" name="pdpa_detail_long_th" rows="4" placeholder="{{__('pdpa_admin.detail_long_placeholder')}}">{{ !empty($pdpa->pdpa_detail_long_th) ? $pdpa->pdpa_detail_long_th :'' }}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="tab_content">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.name')}} (EN) <span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control" id="pdpa_title_en" name="pdpa_title_en" placeholder="{{__('pdpa_admin.name_placeholder')}}" value="{{ !empty($pdpa->pdpa_title_en) ? $pdpa->pdpa_title_en :'' }}">
                                              </div>
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.detail')}} (EN) <span class="text-danger">*</span></label>
                                                  <textarea id="pdpa_detail_en" class="form-control texteditor" name="pdpa_detail_en" rows="4" placeholder="{{__('pdpa_admin.detail_placeholder')}}">{{ !empty($pdpa->pdpa_detail_en) ? $pdpa->pdpa_detail_en :'' }}</textarea>
                                              </div>
                                              <div class="form-group">
                                                  <label class="form-label">{{__('pdpa_admin.detail_long')}} (TH) <span class="text-danger">*</span></label>
                                                  <textarea id="pdpa_detail_long_en" class="form-control texteditor" name="pdpa_detail_long_en" rows="4" placeholder="{{__('pdpa_admin.detail_long_placeholder')}}">{{ !empty($pdpa->pdpa_detail_long_en) ? $pdpa->pdpa_detail_long_en :'' }}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group col-12">
                                      <label class="form-label">{{__('pdpa_admin.display_status')}}</label>
                                      <div class="form-check form-check-inline">
                                          @if (!empty($pdpa->status) && $pdpa->status == 1)
                                              <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" checked="checked">
                                              <label class="form-check-label" for="status_enable">{{__('pdpa_admin.status_enable')}}</label>&nbsp;
                                              <input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
                                              <label class="form-check-label" for="status_disable">{{__('pdpa_admin.status_disable')}}</label>
                                          @else
                                              <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" >
                                              <label class="form-check-label" for="status_enable">{{__('pdpa_admin.status_enable')}}</label>&nbsp;
                                              <input class="form-check-input" type="radio" name="status" checked="checked" id="status_disable" value="0">
                                              <label class="form-check-label" for="status_disable">{{__('pdpa_admin.status_disable')}}</label>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="form-group col-12">
                                      <div class="btn-list">
                                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('pdpa_admin.save')}}</button>
                                          <button onclick="mwz_redirect('{{ route('admin.pdpa.pdpa.index') }}');" type="button" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('pdpa_admin.cancel')}}</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                    </div>
                </div>
            </form>
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

    <!-- Datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/datetime-picker/moment.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Notifications js -->
    <link href="{{URL::asset('assets/plugins/notify-growl/css/jquery.growl.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/notify-growl/css/notifIt.css')}}" rel="stylesheet" />
    <script src="{{URL::asset('assets/plugins/bootbox/bootbox.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify-growl/js/rainbow.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify-growl/js/jquery.growl.js')}}"></script>

    <!-- validator js -->
    <script src="{{URL::asset('assets/plugins/validator/js/jquery.validate.min.js')}}"></script>

    <!-- Tabs js -->
    <script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
    <!-- <script src="{{URL::asset('assets/plugins/tabs/tabs.js')}}"></script> -->

    <!-- mwz master js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js')  }}"></script>

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/pdpa.css') }}">
    <script src="{{ mix('js/pdpa.js')  }}"></script>

@endsection
