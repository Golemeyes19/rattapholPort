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
            <li class="breadcrumb-item"><a
                    href="{{ route('admin.websetting.websetting.edit') }}">{{ __('admin.homepage') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.websetting') }}</li>
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form id="setting_frm" name="setting_frm" method="POST" onsubmit="setSave(); return false;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($setting->id) ? $setting->id : '0' }}">

                <div class="panel panel-primary">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1 ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="___class_+?10___"><a href="#tab5" class="active"
                                        data-toggle="tab">{{ __('admin.websetting') }}</a></li>
                                <li><a href="#tab6" data-toggle="tab">{{ __('websetting_admin.seo') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">

                                <div class="panel panel-primary">
                                    {{-- start tap --}}
                                    <div class="tab_wrapper first_tab">
                                        <ul class="tab_list">
                                            {{-- header tap 1 --}}
                                            <li class="icons-list-item" style="height: 36px;">
                                                {{ __('websetting_admin.logo_header') }}</i>
                                            </li>
                                            {{-- header tap 2 --}}
                                            <li class="icons-list-item" style="height: 36px;">
                                                {{ __('websetting_admin.logo_footer') }}
                                            </li>
                                        </ul>
                                        <div class="content_wrapper">
                                            {{-- tap 1 --}}
                                            <div class="tab_content active">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{-- start input --}}
                                                        <div class="alert alert-default" role="alert" title="ภาษาไทย">
                                                            <span class="alert-inner--icon"><i
                                                                    class="fe fe-bell"></i></i></span>
                                                            <span
                                                                class="alert-inner--text">{{ __('websetting_admin.edit_image_header') }}
                                                                <strong>Header</strong></span>
                                                        </div>
                                                        @if (empty($setting->logo_header))
                                                            <div class="card">
                                                                <div class="card-header pb-0">
                                                                    <h3 class="mb-0 card-title">
                                                                        {{ __('websetting_admin.upload_image_header') }}
                                                                    </h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="file" name="logo_header"
                                                                        class="dropify" data-default-file="" />
                                                                </div>
                                                                <label
                                                                    class="ml-5">{{ __('websetting_admin.image_size_header') }}</label>
                                                            </div>
                                                        @else
                                                            <div class="demo-gallery card">
                                                                <div class="card-header pb-0">
                                                                    <div class="card-title">
                                                                        {{ __('websetting_admin.image_at_upload') }}
                                                                    </div>
                                                                </div>
                                                                <div class="card-body row">
                                                                    <div class="col-md-5"></div>
                                                                    <div class="col-md-2">
                                                                        <ul id="lightgallery" class="list-unstyled">
                                                                            <li data-responsive="{{ $setting->logo_header }}"
                                                                                data-src="{{ $setting->logo_header }}">
                                                                                <a href="">
                                                                                    <img class="img-responsive"
                                                                                        src="{{ $setting->logo_header }}"
                                                                                        alt="Thumb-1">
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-5"></div>
                                                                    <label>{{ __('websetting_admin.image_size_header') }}</label>
                                                                    <button type="button" onclick="DeleteImage('1')"
                                                                        class="btn btn-outline-danger btn-block">{{ __('websetting_admin.delete_image') }}</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        {{-- end input --}}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end tap 1 --}}
                                            {{-- tap 2 --}}
                                            <div class="tab_content">
                                                {{-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-default" role="alert" title="ภาษอังกฤษ">
                                                            <span class="alert-inner--icon"><i
                                                                    class="fe fe-bell"></i></i></span>
                                                            <span class="alert-inner--text">{{ __('websetting_admin.edit_image_footer') }}
                                                                <strong>Footer</strong></span>
                                                        </div>
                                                        @if (empty($setting->logo_footer))
                                                            <div class="card">
                                                                <div class="card-header pb-0">
                                                                    <h3 class="mb-0 card-title">{{ __('websetting_admin.image_at_upload') }}</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="file" name="logo_footer"
                                                                        class="dropify" data-default-file="" />
                                                                </div>
                                                                <label class="ml-5">{{ __('websetting_admin.image_size_footer') }}</label>
                                                            </div>
                                                        @else
                                                            <div class="demo-gallery card">
                                                                <div class="card-header pb-0">
                                                                    <div class="card-title">{{ __('websetting_admin.image_at_upload') }}</div>
                                                                </div>
                                                                <div class="card-body row">
                                                                    <div class="col-md-5"></div>
                                                                    <div class="col-md-2">
                                                                        <ul id="lightgallery_2" class="list-unstyled">
                                                                            <li data-responsive="{{ $setting->logo_footer }}"
                                                                                data-src="{{ $setting->logo_footer }}">
                                                                                <a href="">
                                                                                    <img class="img-responsive"
                                                                                        src="{{ $setting->logo_footer }}"
                                                                                        alt="Thumb-1">
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-5"></div>
                                                                    <label>{{ __('websetting_admin.image_size_footer') }}</label>
                                                                    <button type="button" onclick="DeleteImage('2')"
                                                                        class="btn btn-outline-danger btn-block">{{ __('websetting_admin.delete_image') }}</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                {{-- start tap --}}
                                                {{-- <div class="tab_wrapper first_tab mt-3">
                                                    <ul class="tab_list">
                                                        <li class="icons-list-item" style="height: 36px;"><i
                                                                class="flag flag-th"></i>
                                                        </li>
                                                        <li class="icons-list-item" style="height: 36px;"><i
                                                                class="flag flag-gb"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="content_wrapper">
                                                        <div class="tab_content active">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="alert alert-default" role="alert"
                                                                        title="ภาษาไทย">
                                                                        <span class="alert-inner--icon"><i
                                                                                class="fe fe-bell"></i></i></span>
                                                                        <span
                                                                            class="alert-inner--text">{{ __('websetting_admin.edit_data') }}
                                                                            <strong>{{ __('websetting_admin.thai') }}</strong></span>
                                                                    </div>
                                                                    <div class="form-group" title="ชื่อบริษัท (TH)">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.name_company_th') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="companyname_th"
                                                                            placeholder="ชื่อบริษัท (TH)"
                                                                            value="{{ !empty($setting->companyname_th) ? $setting->companyname_th : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.head_office_th') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="head_office_th"
                                                                            placeholder="ที่ตั้งสำนักงานใหญ่ (TH)"
                                                                            value="{{ !empty($setting->head_office_th) ? $setting->head_office_th : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.factory_th') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="factory_th"
                                                                            placeholder="ที่ตั้งโรงงาน (TH)"
                                                                            value="{{ !empty($setting->factory_th) ? $setting->factory_th : '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="tab_content">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="alert alert-default" role="alert"
                                                                        title="ภาษอังกฤษ">
                                                                        <span class="alert-inner--icon"><i
                                                                                class="fe fe-bell"></i></i></span>
                                                                        <span
                                                                            class="alert-inner--text">{{ __('websetting_admin.edit_data') }}
                                                                            <strong>{{ __('websetting_admin.english') }}</strong></span>
                                                                    </div>
                                                                    <div class="form-group" title="ชื่อบริษัท (EN)">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.name_company_en') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="companyname_en"
                                                                            placeholder="ชื่อบริษัท (EN)"
                                                                            value="{{ !empty($setting->companyname_en) ? $setting->companyname_en : '' }}">
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.head_office_en') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="head_office_en"
                                                                            placeholder="ที่ตั้งสำนักงานใหญ่ (EN)"
                                                                            value="{{ !empty($setting->head_office_en) ? $setting->head_office_en : '' }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label
                                                                            class="form-label">{{ __('websetting_admin.factory_en') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="factory_en"
                                                                            placeholder="ที่ตั้งโรงงาน (EN)"
                                                                            value="{{ !empty($setting->factory_en) ? $setting->factory_en : '' }}">
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="form-group">
                                                    <label class="form-label" title="Copyright">เบอร์โทร</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="phone"
                                                        value="{{ !empty($setting->phone) ? $setting->phone : '' }}">
                                                </div> --}}
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        title="Copyright">{{ __('websetting_admin.copyright') }}</label>
                                                    <input type="text" class="form-control" name="link_login"
                                                        placeholder="Copyright"
                                                        value="{{ !empty($setting->link_login) ? $setting->link_login : '' }}">
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label class="form-label"
                                                        title="Facebook">{{ __('contact_us_admin.facebook') }}</label>
                                                    <input type="text" class="form-control" name="fb"
                                                        placeholder="{{ __('contact_us_admin.facebook') }}"
                                                        value="{{ !empty($setting->fb) ? $setting->fb : '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        title="Line">{{ __('contact_us_admin.line') }}</label>
                                                    <input type="text" class="form-control" name="line"
                                                        placeholder="{{ __('contact_us_admin.line') }}"
                                                        value="{{ !empty($setting->line) ? $setting->line : '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        title="Twitter">{{ __('contact_us_admin.youtube') }}</label>
                                                    <input type="text" class="form-control" name="youtube"
                                                        placeholder="{{ __('contact_us_admin.youtube') }}"
                                                        value="{{ !empty($setting->youtube) ? $setting->youtube : '' }}">
                                                </div> --}}
                                            </div>
                                            {{-- end tap 2 --}}

                                            {{-- end tap --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane " id="tab6">
                                <div class="alert alert-default" role="alert">
                                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
                                    <span class="alert-inner--text">{{ __('websetting_admin.seo_alert') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                        title="ชื่อเว็บไซต์">{{ __('websetting_admin.meta_title') }}</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        placeholder="โปรดระบุชื่อเว็บไซต์"
                                        value="{{ !empty($setting->meta_title) ? $setting->meta_title : '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                        title="คีย์เวิร์ด">{{ __('websetting_admin.meta_keywords') }}</label>
                                    <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3"
                                        placeholder="โปรดระบุคีย์เวิร์ด">{{ !empty($setting->meta_keywords) ? $setting->meta_keywords : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                        title="รายละเอียดเว็บไซต์">{{ __('websetting_admin.meta_description') }}</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
                                        placeholder="โปรดระบุรายละเอียดเว็บไซต์">{{ !empty($setting->meta_description) ? $setting->meta_description : '' }}</textarea>
                                </div>
                                @if (empty($setting->seo_image))
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <h3 class="mb-0 card-title">{{ __('websetting_admin.upload_image_header') }}
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="seo_image" class="dropify"
                                                data-default-file="" />
                                        </div>
                                        <label
                                            class="ml-5">{{ __('websetting_admin.image_appropriate') }}</label>
                                    </div>
                                @else
                                    <div class="demo-gallery card">
                                        <div class="card-header pb-0">
                                            <div class="card-title">{{ __('websetting_admin.image_at_upload') }}
                                            </div>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-2">
                                                <ul id="lightgallery_3" class="list-unstyled">
                                                    <li data-responsive="{{ $setting->seo_image }}"
                                                        data-src="{{ $setting->seo_image }}">
                                                        <a href="">
                                                            <img class="img-responsive" src="{{ $setting->seo_image }}"
                                                                alt="Thumb-1">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5"></div>
                                            <label>{{ __('websetting_admin.image_appropriate') }}</label>
                                            <button type="button" onclick="DeleteImage('3')"
                                                class="btn btn-outline-danger btn-block">{{ __('websetting_admin.delete_image') }}</button>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-label"
                                        title="Google Analytics, Facebook Pixel">{{ __('websetting_admin.google_analytics') }}</label>
                                    <textarea class="form-control" id="google_analytics" name="google_analytics" rows="6"
                                        placeholder="">{{ !empty($setting->google_analytics) ? $setting->google_analytics : '' }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
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
    <link rel="stylesheet" href="{{ mix('css/websetting.css') }}">
    <script src="{{ mix('js/websetting.js') }}"></script>
@endsection
