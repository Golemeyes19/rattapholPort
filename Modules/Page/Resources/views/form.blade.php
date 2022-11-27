@extends('layouts.app')

@section('styles')

<!---Tabs js-->
<link href="{{ URL::asset('assets/plugins/tabs/tabs-style.css') }}" rel="stylesheet" />

<!--Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

<!-- Datetime Picker css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.css') }}">

<!-- File Uploads css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/dropify.css') }}" rel="stylesheet" type="text/css" />

<!--Mutipleselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/multipleselect/multiple-select.css') }}">

@endsection

@section('content')

<!-- page-header -->
<div class="page-header">
    <ol class="breadcrumb">
        <!-- breadcrumb -->
        <li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{__('admin.homepage')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.page.page.index') }}">{{__('page_admin.page')}}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ !empty($page->id) ? 'แก้ไขเพจ' : 'เพิ่มเพจ' }}</li>
    </ol>
</div>
<!-- End page-header -->

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <form id="page_frm" name="page_frm" method="POST" onsubmit="setSave(); return false;"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ !empty($page->id) ? $page->id : '0' }}">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title">{{ !empty($page->id) ? 'แก้ไขเพจ' : 'เพิ่มเพจ' }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h3 class="mb-0 card-title">{{__('page_admin.upload_image')}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="hide_image" value="{{ !empty($page->image) ? $page->image :'' }}" >
                                <input type="file" name="image" class="dropify" data-default-file="{{ !empty($page->image) ? $page->image :'' }}" />
                                <label class="mt-1">ขนาดรูปภาพ ... X ... px / อัพโหลดไฟล์ได้สูงสุด 5 MB</label>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li class="icons-list-item" style="height: 36px;"><i class="flag flag-th"></i></li>
                                <li class="icons-list-item" style="height: 36px;"><i class="flag flag-gb"></i></li>
                            </ul>

                            <div class="content_wrapper">
                                <div class="tab_content active">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="alert alert-default" role="alert">
                                                <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                <span class="alert-inner--text">{{__('page_admin.form_alert')}}
                                                    <strong>{{__('page_admin.th')}}</strong></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.name_th')}}</label>
                                                <input type="text" class="form-control" id="name_th" name="name_th"
                                                    placeholder="{{__('page_admin.name_placeholder_th')}}"
                                                    value="{{ !empty($page->name_th) ? $page->name_th : '' }}">
                                                <input id="param" type="hidden" class="form-control" name="params"
                                                    value="" placeholder="param">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.description_th')}}</label>
                                                <textarea id="description_th" class="form-control texteditor"
                                                    name="description_th" rows="4"
                                                    placeholder="{{__('page_admin.description_placeholder_th')}}">{{ !empty($page->description_th) ? $page->description_th : '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.detail')}}</label>
                                                <textarea id="detail_th" class="form-control texteditor"
                                                    name="detail_th" rows="4"
                                                    placeholder="โปรดระบุรายละเอียด">{{ !empty($page->detail_th) ? $page->detail_th : '' }}</textarea>
                                            </div>

                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="tab_content">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="alert alert-default" role="alert">
                                                <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                <span class="alert-inner--text">{{__('page_admin.form_alert')}}
                                                    <strong>{{__('page_admin.en')}}</strong></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.name_en')}}</label>
                                                <input type="text" class="form-control" id="name_en" name="name_en"
                                                    placeholder="{{__('page_admin.name_placeholder_en')}}"
                                                    value="{{ !empty($page->name_en) ? $page->name_en : '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.description_en')}}</label>
                                                <textarea id="description_en" class="form-control texteditor"
                                                    name="description_en" rows="4"
                                                    placeholder="{{__('page_admin.description_placeholder_en')}}">{{ !empty($page->description_en) ? $page->description_en : '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('page_admin.detail')}}</label>
                                                <textarea id="detail_en" class="form-control texteditor"
                                                    name="detail_en" rows="4"
                                                    placeholder="โปรดระบุรายละเอียด">{{ !empty($page->detail_en) ? $page->detail_en : '' }}</textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{__('page_admin.sequence')}}</label>
                        <input type="text" class="form-control" maxlength="3" onkeypress="InputValidateString()"
                            id="sequence" name="sequence" placeholder="{{__('page_admin.sequence_placeholder')}}"
                            value="{{ !empty($page->sequence) ? $page->sequence : '' }}">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">{{__('page_admin.display')}}</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_enable" value="1"
                                {{ isset($page->status) ? ($page->status == 1 ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="status_enable">{{__('page_admin.status_enable')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_disable" value="0"
                                {{ isset($page->status) ? ($page->status == 0 ? 'checked' : '') : '' }}>
                            <label class="form-check-label" for="status_disable">{{__('page_admin.status_disable')}}</label>
                        </div>
                        </label>
                    </div>
                    <div class="form-group mb-1">
                         <div class="btn-list">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    {{__('page_admin.save')}}</button>
                                <button onclick="mwz_redirect('{{ route('admin.page.page.index') }}');" type="button"
                                    class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('page_admin.cancel')}}</button>
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
<script src="{{ URL::asset('assets/plugins/vendors/jquery.sparkline.min.js') }}"></script>

<!-- File uploads js -->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/dropify.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/dropify-demo.js') }}"></script>

<!--Select2 js -->
<script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script> -->

<!--MutipleSelect js-->
<script src="{{ URL::asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

<!--ckeditor js-->
<script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/js/formeditor.js') }}"></script> -->

<!-- Datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/datetime-picker/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Notifications js -->
<link href="{{ URL::asset('assets/plugins/notify-growl/css/jquery.growl.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/notify-growl/css/notifIt.css') }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootbox/bootbox.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify-growl/js/rainbow.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify-growl/js/jquery.growl.js') }}"></script>

<!-- validator js -->
<script src="{{ URL::asset('assets/plugins/validator/js/jquery.validate.min.js') }}"></script>


<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script> -->

<!-- mwz master js css -->
<link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
<script src="{{ mix('js/mwz.js') }}"></script>

<!-- module js css -->
<link rel="stylesheet" href="{{ mix('css/page.css') }}">
<script src="{{ mix('js/page.js') }}"></script>

@endsection