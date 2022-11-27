@extends('layouts.app')

@section('styles')

    <!---Tabs css-->
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
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('admin.banner.banner.index') }}">{{__('banner_admin.banner')}}</a></li>
            @if (empty($banner->id))
                <li class="breadcrumb-item active" aria-current="page">{{__('banner_admin.banner_add')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('banner_admin.banner_edit')}}</li>
            @endif
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="banner_frm" name="banner_frm" method="POST" onsubmit="setSave(); return false;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($banner->id) ? $banner->id : '0' }}">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="card-title">{{__('banner_admin.banner_data')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="panel panel-primary">
                            {{-- Start Tap --}}
                            <div class="tab_wrapper first_tab">
                                <ul class="tab_list">
                                    <li class="icons-list-item" style="height: 36px;"><i class="flag flag-th"></i></li>
                                    <li class="icons-list-item" style="height: 36px;"><i class="flag flag-gb"></i></li>
                                </ul>
                                <div class="content_wrapper">
                                    {{-- Tap 1 --}}
                                    <div class="tab_content active">
                                        {{-- Start Input --}}
                                        <div class="alert alert-default" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                            <span class="alert-inner--text">{{__('banner_admin.form_alert')}}
                                                <strong>{{__('banner_admin.th')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('banner_admin.name_th')}}</label>
                                            <input type="text" class="form-control" name="name_th" id="name_th"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($banner->name_th) ? $banner->name_th : '' }}">
                                            <input id="param" type="hidden" class="form-control" name="params" value=""
                                                placeholder="param">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('banner_admin.description_th')}}</label>
                                            <textarea id="description_th" class="form-control texteditor"
                                                name="description_th" rows="4"
                                                placeholder="คำอธิบาย">{{ !empty($banner->description_th) ? $banner->description_th : '' }}</textarea>
                                        </div>
                                        {{-- End Input --}}
                                    </div>
                                    {{-- End Tap 1 --}}
                                    {{-- Tap 2 --}}
                                    <div class="tab_content">
                                        {{-- Start Input --}}
                                        <div class="alert alert-default" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                            <span class="alert-inner--text">{{__('banner_admin.form_alert')}}
                                                <strong>{{__('banner_admin.en')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('banner_admin.name_en')}}</label>
                                            <input type="text" class="form-control" name="name_en" id="name_en"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($banner->name_en) ? $banner->name_en : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('banner_admin.description_en')}}</label>
                                            <textarea id="description_en" class="form-control texteditor"
                                                name="description_en" rows="4"
                                                placeholder="description">{{ !empty($banner->description_en) ? $banner->description_en : '' }}</textarea>
                                        </div>
                                        {{-- End Input --}}
                                    </div>
                                    {{-- End Tap 2 --}}
                                </div>
                            </div>
                            {{-- End Tap --}}
                            <div class="form-group mt-3">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h3 class="mb-0 card-title">{{__('banner_admin.upload_image_1')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <input type="file" id="image" name="image" class="dropify"
                                            data-default-file="{{ !empty($banner->image) ? $banner->image : '' }}" />
                                        <input type="hidden" id="image_1_old" name="image_1_old" value="{{ !empty($banner->image) ? $banner->image : '' }}">
                                        <input type="hidden" id="is_delete_image_1" name="is_delete_image_1" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h3 class="mb-0 card-title">{{__('banner_admin.upload_image_2')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <input type="file" id="image_2" name="image_2" class="dropify"
                                            data-default-file="{{ !empty($banner->image_2) ? $banner->image_2 : '' }}" />
                                        <input type="hidden" id="image_2_old" name="image_2_old" value="{{ !empty($banner->image_2) ? $banner->image_2 : '' }}">
                                        <input type="hidden" id="is_delete_image_2" name="is_delete_image_2" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h3 class="mb-0 card-title">{{__('banner_admin.upload_image_3')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <input type="file" id="image_3" name="image_3" class="dropify"
                                            data-default-file="{{ !empty($banner->image_3) ? $banner->image_3 : '' }}" />
                                        <input type="hidden" id="image_3_old" name="image_3_old" value="{{ !empty($banner->image_3) ? $banner->image_3 : '' }}">
                                        <input type="hidden" id="is_delete_image_3" name="is_delete_image_3" value="0">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-group ">
                                <label class="form-label">{{__('banner_admin.display_page')}}</label>
                                <select name="menu_id" id="menu_id" class="form-control select2-show-search"
                                    data-placeholder="Choose menu_id">
                                    <option value="0">{{__('banner_admin.select_display_page')}}</option>
                                    @foreach ($menu['data_parent'] as $parent)                                                
                                        <option value="{{ $parent['id'] }}" @if ( !empty($banner->menu_id) == $parent['id'] && $banner->menu_id == $parent['id']) selected @endif >{{ $parent['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('banner_admin.sequence')}}</label>
                                <input id="sequence" type="text" class="form-control" name="sequence"
                                    placeholder="โปรดระบุลำดับการแสดงผล" maxlength="3" onkeypress="InputValidateString()"
                                    value="{{ !empty($banner->sequence) ? $banner->sequence : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('banner_admin.display')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1"
                                        {{ isset($banner->status) ? ($banner->status == 1 ? 'checked' : '') : 'checked' }}>
                                    <label class="form-check-label" for="status_enable">{{__('banner_admin.status_enable')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_disable" value="0"
                                        {{ isset($banner->status) ? ($banner->status == 0 ? 'checked' : '') : '' }}>
                                    <label class="form-check-label" for="status_disable">{{__('banner_admin.status_disable')}}</label>
                                </div>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                        {{__('banner_admin.save')}}</button>
                                    <button onclick="mwz_redirect('{{ route('admin.banner.banner.index') }}');"
                                        type="button" class="btn btn-warning"><i class="fa fa-undo"
                                            aria-hidden="true"></i>{{__('banner_admin.cancel')}}</button>
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

    <!-- Tabs js -->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script> -->

    <!-- mwz master js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js') }}"></script>

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/banner.css') }}">
    <script src="{{ mix('js/banner.js') }}"></script>

@endsection
