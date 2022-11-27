@extends('layouts.app')

@section('styles')
    <!-- Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
    <!-- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- Tabs css-->
    <link href="{{ URL::asset('assets/plugins/tabs/tabs-style.css') }}" rel="stylesheet" />

@endsection

@section('content')
    <!-- page-header -->
    <div class="page-header">
        <ol class="breadcrumb">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{__('admin.homepage')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.menu.index') }}">{{__('menu_admin.menu')}}</a></li>
            @if (empty($menu->id))
                @if ($type == 1)
                    <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.add_menu_header')}}</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.add_menu_footer')}}</li>
                @endif
            @else
                @if ($type == 1)
                    <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.edit_menu_header')}}</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.edit_menu_footer')}}</li>
                @endif
                {{-- <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.edit_menu')}}</li> --}}
            @endif
        </ol><!-- End breadcrumb -->
    </div>

    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <form id="menu_frm" name="menu_frm" method="POST" onsubmit="setSaveMenu(); return false;"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ !empty($menu->id) ? $menu->id : '0' }}">
                    <input type="hidden" name="type" value="{{ $type }}" />
                    <div class="card-body mr-3 ml-3">
                        <div class="panel panel-primary">
                            {{-- start tap --}}
                            <div class="tab_wrapper first_tab">
                                <ul class="tab_list">
                                    <li class=""><img style="height: 16px;"
                                            src="{{ URL::asset('assets/images/flags/th.svg') }}"></li>
                                    <li><img style="height: 16px;" src="{{ URL::asset('assets/images/flags/gb.svg') }}">
                                    </li>
                                </ul>
                                <div class="content_wrapper">
                                    {{-- tap 1 --}}
                                    <div class="tab_content active">
                                        <div class="alert alert-default" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                            <span class="alert-inner--text">{{__('menu_admin.edit')}}
                                                <strong>{{__('menu_admin.lang_thai')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">{{__('menu_admin.name_menu_th')}}</label>
                                            <input type="text" class="form-control" id="name_th" name="name_th"
                                                placeholder="โปรดระบุชื่อเมนู"
                                                value="{{ !empty($menu->name_th) ? $menu->name_th : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">{{__('menu_admin.name_url_th')}}</label>
                                            <input type="text" class="form-control" id="slug_th" name="slug_th"
                                                placeholder="โปรดระบุชื่อ URL"
                                                value="{{ !empty($menu->slug_th) ? $menu->slug_th : '' }}">
                                        </div>
                                    </div>
                                    {{-- end tap 1 --}}
                                    {{-- tap 2 --}}
                                    <div class="tab_content">
                                        <div class="alert alert-default" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                            <span class="alert-inner--text">{{__('menu_admin.edit')}}
                                                <strong>{{__('menu_admin.lang_eng')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">{{__('menu_admin.name_menu_en')}}</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en"
                                                placeholder="โปรดระบุชื่อเมนู"
                                                value="{{ !empty($menu->name_en) ? $menu->name_en : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">{{__('menu_admin.name_url_en')}}</label>
                                            <input type="text" class="form-control" id="slug_en" name="slug_en"
                                                placeholder="โปรดระบุชื่อ URL"
                                                value="{{ !empty($menu->slug_en) ? $menu->slug_en : '' }}">
                                        </div>
                                    </div>
                                    {{-- end tap 2 --}}
                                </div>
                            </div>
                            {{-- end tap --}}

                            {{-- @empty($menu->id) --}}
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-label">{{__('menu_admin.parent_menu')}}</label>
                                    <select name="parent_id" class="form-control select2-show-search" data-placeholder="Choose Parent">
                                        <option value="" selected>-- no parent --</option>
                                            @foreach ($list['data_parent'] as $parent)   
                                                @if ( !empty($parent['id']) )                                             
                                                    <option value="{{ $parent['id'] }}" @if ( !empty($menu->parent_id) == $parent['id'] && $menu->parent_id == $parent['id']) selected @endif >{{ $parent['name'] }}</option>
                                                @elseif ( empty($parent['id']) )
                                                    <option value="{{ $parent['id'] }}" >{{ $parent['name'] }}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- @endempty --}}

                            <div class="form-group mt-2 col-md-6">
                                <label class="form-label required">{{__('menu_admin.sequence_menu')}}</label>
                                <input type="text" class="form-control" id="sequence" name="sequence"
                                    placeholder="โปรดระบุลำดับการแสดงผล"
                                    value="{{ !empty($menu->sequence) ? $menu->sequence : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('menu_admin.status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_enable" value="1"
                                        {{ isset($menu->status) ? ($menu->status == 1 ? 'checked' : '') : 'checked' }}>
                                    <label class="form-check-label" for="status_enable">{{__('menu_admin.enable')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_disable" value="0"
                                        {{ isset($menu->status) ? ($menu->status == 0 ? 'checked' : '') : '' }}>
                                    <label class="form-check-label" for="status_disable">{{__('menu_admin.disable')}}</label>
                                </div>
                                </label>
                            </div>
                            
                            <div class="form-group mb-1">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary" onclick="$(this).closest('form').submit();"><i class="fa fa-save"></i>{{__('menu_admin.save')}}</button>
                                    <button onclick="mwz_redirect('{{ route('admin.menu.menu.index') }}');" type="button"
                                        class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>{{__('menu_admin.cancel')}}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!--Jquery Sparkline js-->
    <script src="{{ URL::asset('assets/plugins/vendors/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle js-->
    <script src="{{ URL::asset('assets/plugins/vendors/circle-progress.min.js') }}"></script>

    <!--Time Counter js-->
    <script src="{{ URL::asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counters/counter.js') }}"></script>

    <!--ckeditor js-->
    <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/js/formeditor.js') }}"></script> -->

    <!-- Notifications js -->
    <link href="{{ URL::asset('assets/plugins/notify-growl/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/notify-growl/css/notifIt.css') }}" rel="stylesheet" />
    <script src="{{ URL::asset('assets/plugins/bootbox/bootbox.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify-growl/js/rainbow.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify-growl/js/jquery.growl.js') }}"></script>

    <!---Tabs js-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script>

    <!-- validator js -->
    <script src="{{ URL::asset('assets/plugins/validator/js/jquery.validate.min.js') }}"></script>

    <!-- mwz menu js css -->
    <link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
    <script src="{{ mix('js/mwz.js') }}"></script>

    <!--Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <!-- <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script> -->

    <!-- module js css -->
    <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
    <script src="{{ mix('js/menu.js') }}"></script>

@endsection
