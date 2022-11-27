@extends('layouts.app')

@section('styles')

    <!---Tabs css-->
    <link href="{{ URL::asset('assets/plugins/tabs/tabs-style.css') }}" rel="stylesheet" />

    <!--Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

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
            <li class="breadcrumb-item"><a href="{{ route('admin.websetting.websetting.edit') }}">{{ __('admin.homepage') }}</a></li>
            <li class="breadcrumb-item"><a href="#">Privacy Policy</a></li>
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="privacy_frm" name="privacy_frm" method="POST" onsubmit="setSavePrivacy(); return false;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($privacy->id) ? $privacy->id : '0' }}">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
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
                                                <div class="form-group">
                                                    <label class="form-label">รายละเอียด (TH)</label>
                                                    <textarea id="privacy_description_th" class="form-control texteditor"
                                                        name="privacy_th" rows="4"
                                                        placeholder="description">{{ !empty($privacy->privacy_th) ? $privacy->privacy_th : '' }}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">รายละเอียด (EN)</label>
                                                    <textarea id="privacy_description_en" class="form-control texteditor"
                                                        name="privacy_en" rows="4"
                                                        placeholder="description">{{ !empty($privacy->privacy_en) ? $privacy->privacy_en : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary"><i
                                        class="ion-checkmark-circled mr-1"></i>{{ __('websetting_admin.save') }}</button>
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

    <!-- Notifications js -->
    <link href="{{ URL::asset('assets/plugins/notify-growl/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/notify-growl/css/notifIt.css') }}" rel="stylesheet" />
    <script src="{{ URL::asset('assets/plugins/bootbox/bootbox.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify-growl/js/rainbow.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify-growl/js/jquery.growl.js') }}"></script>

    <!-- validator js -->
    <script src="{{ URL::asset('assets/plugins/validator/js/jquery.validate.min.js') }}"></script>

    <!-- Tabs js -->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script> -->

    <!-- mwz master js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js') }}"></script>

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/websetting.css') }}">
    <script src="{{ mix('js/websetting.js') }}"></script>

@endsection
