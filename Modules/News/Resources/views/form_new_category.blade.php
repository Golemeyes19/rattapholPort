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
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('admin.news.news.index_news_category') }}">{{__('news_admin.news_category')}}</a></li>
            @if (empty($news_category->id))
                <li class="breadcrumb-item active" aria-current="page">{{__('news_admin.add_news_category')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('news_admin.edit_news_category')}}</li>
            @endif
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="news_category_frm" name="news_category_frm" method="POST" onsubmit="setSaveNewsCategory(); return false;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($news_category->id) ? $news_category->id : '0' }}">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="card-title">{{__('news_admin.data_news_category')}}</h3>
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

                                                <div class="alert alert-default" role="alert">
                                                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                    <span class="alert-inner--text">{{__('news_admin.you_are_edit_the_display')}}
                                                        <strong>{{__('news_admin.lang_thai')}}</strong></span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="card">
                                                        <div class="card-header pb-0">
                                                            <h3 class="mb-0 card-title">{{__('news_admin.upload_image')}} (TH)</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="file" id="image_th" name="image_th" class="dropify"
                                                                data-default-file="{{ !empty($news_category->image_th) ? $news_category->image_th : '' }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.name_category')}} (TH)</label>
                                                    <input type="text" class="form-control" id="name_th" name="name_th"
                                                        placeholder="โปรดระบุชื่อหัวข้อ"
                                                        value="{{ !empty($news_category->name_th) ? $news_category->name_th : '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.description')}} (TH)</label>
                                                    <textarea id="description_th" class="form-control texteditor"
                                                        name="description_th" rows="4"
                                                        placeholder="โปรดระบุคำอธิบาย">{{ !empty($news_category->description_th) ? $news_category->description_th : '' }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.name_url')}} (TH)</label>
                                                    <input type="text" class="form-control" id="slug_th" name="slug_th"
                                                        placeholder="โปรดระบุชื่อหัวข้อ"
                                                        value="{{ !empty($news_category->slug_th) ? $news_category->slug_th : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="alert alert-default" role="alert">
                                                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                    <span class="alert-inner--text">{{__('news_admin.you_are_edit_the_display')}}
                                                        <strong>{{__('news_admin.lang_eng')}}</strong></span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="card">
                                                        <div class="card-header pb-0">
                                                            <h3 class="mb-0 card-title">{{__('news_admin.upload_image')}} (EN)</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="file" id="image_en" name="image_en" class="dropify"
                                                                data-default-file="{{ !empty($news_category->image_en) ? $news_category->image_en : '' }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.name_category')}} (EN)</label>
                                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                                        placeholder="โปรดระบุชื่อหัวข้อ"
                                                        value="{{ !empty($news_category->name_en) ? $news_category->name_en : '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.description')}} (EN)</label>
                                                    <textarea id="description_en" class="form-control texteditor"
                                                        name="description_en" rows="4"
                                                        placeholder="โปรดระบุคำอธิบาย">{{ !empty($news_category->description_en) ? $news_category->description_en : '' }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{__('news_admin.name_url')}} (EN)</label>
                                                    <input type="text" class="form-control" id="slug_en" name="slug_en"
                                                        placeholder="โปรดระบุชื่อหัวข้อ"
                                                        value="{{ !empty($news_category->slug_en) ? $news_category->slug_en : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="form-label">{{__('news_admin.parent_menu')}}</label>
                                <select name="parent_id" class="form-control select2-show-search" data-placeholder="Choose Parent">
                                    <option value="0">-- no parent --</option>
                                    @foreach ($list['data_parent'] as $parent)
                                        @if ( !empty($parent['id']) )
                                            <option value="{{ $parent['id']  }}" @if ( !empty($news_category->parent_id) == $parent['id'] && $news_category->parent_id == $parent['id']) selected @endif>{{ $parent['name'] }}</option>
                                        @elseif ( empty($parent['id']) )
                                            <option value="{{ $parent['id']  }}" >{{ $parent['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">{{__('news_admin.display_status')}}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_enable" value="1"
                                    {{ isset($news_category->status) ? ($news_category->status == 1 ? 'checked' : '') : 'checked' }}>
                                <label class="form-check-label" for="status_enable">{{__('news_admin.status_enable')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_disable" value="0"
                                    {{ isset($news_category->status) ? ($news_category->status == 0 ? 'checked' : '') : '' }}>
                                <label class="form-check-label" for="status_disable">{{__('news_admin.status_disable')}}</label>
                            </div>
                            </label>
                        </div>
                        <div class="form-group mb-1">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    {{__('news_admin.save')}}</button>
                                <button onclick="mwz_redirect('{{ route('admin.news.news.index_news_category') }}');" type="button"
                                    class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('news_admin.cancel')}}</button>
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


    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script> -->

    <!-- mwz master js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js') }}"></script>

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/news.css') }}">
    <script src="{{ mix('js/news.js') }}"></script>

@endsection
