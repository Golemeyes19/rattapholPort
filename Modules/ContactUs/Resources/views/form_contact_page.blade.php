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
            <li class="breadcrumb-item active" aria-current="page">{{__('contact_us_admin.contact_us_list_edit')}}</li>
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="contactpage_frm" name="contactpage_frm" method="POST" onsubmit="setSaveContactPage(); return false;">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($contact_page->id) ? $contact_page->id : '0' }}">

                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">

                                <div class="panel panel-primary">

                                    {{-- start tap --}}
                                    <div class="tab_wrapper first_tab mt-3">
                                        {{-- <ul class="tab_list">
                                            <li class="icons-list-item" style="height: 36px;"><i class="flag flag-th"></i>
                                            </li>
                                            <li class="icons-list-item" style="height: 36px;"><i class="flag flag-gb"></i>
                                            </li>
                                        </ul> --}}
                                        <div class="content_wrapper">
                                            {{-- tap 1 --}}
                                            <div class="tab_content active">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{-- start input --}}
                                                        <div class="alert alert-default" role="alert" title="ภาษาไทย">
                                                            <span class="alert-inner--icon"><i
                                                                    class="fe fe-bell"></i></i></span>
                                                            <span class="alert-inner--text">{{__('contact_us_admin.you_are_edit_the_display')}}
                                                                <strong>{{__('contact_us_admin.lang_thai')}}</strong></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.description')}} (TH)</label>
                                                            <textarea id="description_th" class="form-control texteditor"
                                                            name="description_th" rows="4" placeholder="{{__('contact_us_admin.description_placeholder')}} (TH)">
                                                            {{ !empty($contact_page->description_th) ? $contact_page->description_th : '' }}
                                                            </textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.head_office')}} (TH)</label>
                                                            <input type="text" class="form-control" name="head_office_th"
                                                                placeholder="{{__('contact_us_admin.head_office_placeholder')}} (TH)"
                                                                value="{{ !empty($contact_page->head_office_th) ? $contact_page->head_office_th : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.factory')}} (TH)</label>
                                                            <input type="text" class="form-control" name="factory_th"
                                                                placeholder="{{__('contact_us_admin.factory_placeholder')}} (TH)"
                                                                value="{{ !empty($contact_page->factory_th) ? $contact_page->factory_th : '' }}">
                                                        </div>
                                                        {{-- end input --}}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end tap 1 --}}
                                            {{-- tap 2 --}}
                                            <div class="tab_content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{-- start input --}}
                                                        <div class="alert alert-default" role="alert" title="ภาษอังกฤษ">
                                                            <span class="alert-inner--icon"><i
                                                                    class="fe fe-bell"></i></i></span>
                                                            <span class="alert-inner--text">{{__('contact_us_admin.you_are_edit_the_display')}}
                                                                <strong>{{__('contact_us_admin.lang_eng')}}</strong></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.description')}} (EN)</label>
                                                            <textarea id="description_en" class="form-control texteditor"
                                                            name="description_en" rows="4" placeholder="{{__('contact_us_admin.description_placeholder')}} (EN)">
                                                            {{ !empty($contact_page->description_en) ? $contact_page->description_en : '' }}
                                                            </textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.head_office')}} (EN)</label>
                                                            <input type="text" class="form-control" name="head_office_en"
                                                                placeholder="{{__('contact_us_admin.head_office_placeholder')}} (EN)"
                                                                value="{{ !empty($contact_page->head_office_en) ? $contact_page->head_office_en : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label">{{__('contact_us_admin.factory')}} (EN)</label>
                                                            <input type="text" class="form-control" name="factory_en"
                                                                placeholder="{{__('contact_us_admin.factory_placeholder')}} (EN)"
                                                                value="{{ !empty($contact_page->factory_en) ? $contact_page->factory_en : '' }}">
                                                        </div>
                                                        {{-- end input --}}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end tap 2 --}}
                                        </div>
                                    </div>
                                    {{-- end tap --}}
                                    <div class="card mt-3">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label class="form-label" title="Facebook">{{__('contact_us_admin.phone_office')}}</label>
                                                <input type="text" class="form-control" name="phone_head_office" placeholder="{{__('contact_us_admin.phone_office')}}"
                                                    value="{{ !empty($contact_page->phone_head_office) ? $contact_page->phone_head_office : '' }}" maxlength="10">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" title="Facebook">{{__('contact_us_admin.phone_factory')}}</label>
                                                <input type="text" class="form-control" name="phone_factory" placeholder="{{__('contact_us_admin.phone_factory')}}"
                                                    value="{{ !empty($contact_page->phone_factory) ? $contact_page->phone_factory : '' }}" maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">{{__('contact_us_admin.description')}}</label>
                                                <textarea id="description_th" class="form-control texteditor"
                                                name="description_th" rows="4" placeholder="{{__('contact_us_admin.description_placeholder')}}">
                                                {{ !empty($contact_page->description_th) ? $contact_page->description_th : '' }}
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" title="Facebook">{{__('contact_us_admin.facebook')}}</label>
                                                <input type="text" class="form-control" name="fb" placeholder="{{__('contact_us_admin.facebook')}}"
                                                    value="{{ !empty($contact_page->fb) ? $contact_page->fb : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" title="Twitter">{{__('contact_us_admin.twitter')}}</label>
                                                <input type="text" class="form-control" name="youtube" placeholder="{{__('contact_us_admin.twitter')}}" value="{{ !empty($contact_page->youtube) ? $contact_page->youtube : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" title="Line">{{__('contact_us_admin.line')}}</label>
                                                <input type="text" class="form-control" name="line" placeholder="{{__('contact_us_admin.line')}}"
                                                    value="{{ !empty($contact_page->line) ? $contact_page->line : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" title="E-mail">{{__('contact_us_admin.email_head_office')}}</label>
                                                <input type="text" class="form-control" name="email_head_office" placeholder="{{__('contact_us_admin.email_head_office')}}"
                                                    value="{{ !empty($contact_page->email_head_office) ? $contact_page->email_head_office : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" title="E-mail">{{__('contact_us_admin.email_factory')}}</label>
                                                <input type="text" class="form-control" name="email_factory" placeholder="{{__('contact_us_admin.email_factory')}}"
                                                    value="{{ !empty($contact_page->email_factory) ? $contact_page->email_factory : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">{{__('contact_us_admin.gmaps')}}</label>
                                                <textarea id="gmaps" class="form-control" name="gmaps" rows="4" placeholder="{{__('contact_us_admin.gmaps')}}">{{ !empty($contact_page->gmaps) ? $contact_page->gmaps : '' }}</textarea>
                                            </div>

                                            <div class="form-group mt-5">
                                                <div class="btn-list">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="ion-checkmark-circled mr-1"></i>{{__('contact_us_admin.save')}}</button>
                                                </div>
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
    <link rel="stylesheet" href="{{ mix('css/contactus.css') }}">
    <script src="{{ mix('js/contactus.js') }}"></script>

@endsection
