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

    <!-- Gallery css -->
    <link href="{{ URL::asset('assets/plugins/gallery/gallery.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- page-header -->
    <div class="page-header">
        <ol class="breadcrumb">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{__('admin.homepage')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.contactus.contactus.subject_index') }}">{{__('contact_us_admin.subject_contact_us')}}</a></li>
            @if (empty($contactus_subject->id))
                <li class="breadcrumb-item active" aria-current="page">{{__('contact_us_admin.add_subject_contact_us')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('contact_us_admin.edit_subject_contact_us')}}</li>
            @endif
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="contactsubject_frm" name="contactsubject_frm" method="POST" onsubmit="setSaveContactSubject(); return false;">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($contactus_subject->id) ? $contactus_subject->id : '0' }}">

                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">
                                <div class="panel panel-primary">
                                    <div class="tab_wrapper first_tab">
                                        <ul class="tab_list">
                                            <li class="icons-list-item" style="height: 36px;"><i class="flag flag-th"></i></li>
                                            <li class="icons-list-item" style="height: 36px;"><i class="flag flag-gb"></i></li>
                                        </ul>
                                        <div class="content_wrapper">
                                            {{-- Tap 1 --}}
                                            <div class="tab_content active">
                                                <div class="alert alert-default" role="alert">
                                                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                    <span class="alert-inner--text">{{__('banner_admin.form_alert')}}
                                                        <strong>{{__('banner_admin.th')}}</strong></span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label required">{{__('contact_us_admin.subject_th')}}</label>
                                                    <input type="text" class="form-control" name="subject" placeholder="{{__('contact_us_admin.subject_th')}}" 
                                                    value="{{ !empty($contactus_subject->subject) ? $contactus_subject->subject :'' }}" >
                                                </div>
                                            </div>
                                            {{-- End Tap 1 --}}
                                            {{-- Tap 2 --}}
                                            <div class="tab_content">
                                                <div class="alert alert-default" role="alert">
                                                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                    <span class="alert-inner--text">{{__('banner_admin.form_alert')}}
                                                        <strong>{{__('banner_admin.en')}}</strong></span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label required">{{__('contact_us_admin.subject_en')}}</label>
                                                    <input type="text" class="form-control" name="subject_en" placeholder="{{__('contact_us_admin.subject_en')}}" 
                                                    value="{{ !empty($contactus_subject->subject_en) ? $contactus_subject->subject_en :'' }}" >
                                                </div>
                                                </div>
                                            </div>
                                            {{-- End Tap 2 --}}
                                        </div>
                                    </div>
                                    {{-- End Tap --}}
                                        <div class="card-body">
                                            {{-- <div class="form-group col-md-12">
                                                <label class="form-label required">{{__('contact_us_admin.subject')}}</label>
                                                <input type="text" class="form-control" name="subject" placeholder="{{__('contact_us_admin.subject')}}" 
                                                value="{{ !empty($contactus_subject->subject) ? $contactus_subject->subject :'' }}" >
                                            </div>--}}
                                            <div class="form-group col-md-12">
                                                <label class="form-label" title="E-mail">{{__('contact_us_admin.to_email')}} <span style="color: red" >*</span></label>
                                                <input type="text" class="form-control" name="to_email" placeholder="{{__('contact_us_admin.to_email')}}"
                                                    value="{{ !empty($contactus_subject->to_email) ? $contactus_subject->to_email : '' }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" title="E-mail" >{{__('contact_us_admin.cc_email')}} <span style="color: red" >*</span></label>
                                                <input type="text" class="form-control" name="cc_email" placeholder="{{__('contact_us_admin.cc_email')}}"
                                                    value="{{ !empty($contactus_subject->cc_mail) ? $contactus_subject->cc_mail : '' }}">
                                            </div> 
                                            <div class="form-group col-md-12">
                                                <label class="form-label">{{__('contact_us_admin.sequence')}}</label>
                                                <input type="number" class="form-control" name="sequence" placeholder="{{__('contact_us_admin.sequence')}}" value="{{ !empty($contactus_subject->sequence) ? $contactus_subject->sequence :'' }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label">{{__('contact_us_admin.display_status')}}</label>
                                                <div class="form-check form-check-inline">
                                                    @if ( empty($user->status) || $user->status == 1  )
                                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" checked="checked">
                                                    @else
                                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1" >
                                                    @endif
                                                    <label class="form-check-label" for="status_enable">{{__('contact_us_admin.status_enable')}}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    @if ( !empty($user->status) && $user->status != 1  )
                                                    <input class="form-check-input" type="radio" name="status" checked="checked" id="status_disable" value="0">
                                                    @else
                                                    <input class="form-check-input" type="radio" name="status" id="status_disable"  value="0">
                                                    @endif
                                                    <label class="form-check-label" for="status_disable">{{__('contact_us_admin.status_disable')}}</label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-2">
                                                <div class="btn-list">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="ion-checkmark-circled mr-1"></i>Save</button>
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
    <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script>

    <!-- Gallery js -->
    <script src="{{ URL::asset('assets/plugins/gallery/picturefill.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lightgallery.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-pager.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-autoplay.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-fullscreen.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-zoom.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-hash.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/lg-share.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/gallery.js') }}"></script>

    <!-- mwz master js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js') }}"></script>

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/contactus.css') }}">
    <script src="{{ mix('js/contactus.js') }}"></script>

@endsection
