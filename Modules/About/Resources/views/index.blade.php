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
            <li class="breadcrumb-item"><a href="{{ route('admin.homepage') }}">{{ __('admin.homepage')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('admin.banner.banner.index') }}">{{__('about_admin.about')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('about_admin.manage_data')}}</li>
        </ol>
    </div>
    <!-- End page-header -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="about_frm" name="about_frm" method="POST" onsubmit="setSave(); return false;"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($about->id) ? $about->id : '0' }}">
                <!-- <div class="card"> -->
                    <div class="card-header pb-0">
                        <h3 class="card-title">{{__('about_admin.about_data')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="panel panel-primary">
                          <div class="form-group mt-3">
                              <div class="card">
                                  <div class="card-header pb-0">
                                      <h3 class="mb-0 card-title">{{__('about_admin.upload_image_header')}}</h3>
                                  </div>
                                  <div class="card-body">
                                      <input type="file" id="image_top" name="image_top" class="dropify"
                                          data-default-file="{{ !empty($about->image_top) ? $about->image_top : '' }}" />
                                      <input type="hidden" id="image_4_old" name="image_1_old" value="{{ !empty($about->image_top) ? $about->image_top : '' }}">
                                      <input type="hidden" id="is_delete_image_4" name="is_delete_image_4" value="0">
                                  </div>
                              </div>
                          </div>

                          <div class="form-group mt-3">
                              <div class="card">
                                <div class="card-header pb-0">
                                    <h3 class="card-title">{{__('about_admin.data_zone_1')}}</h3>
                                </div>
                                <br>
                                <div class="card-body">
                                  <div class="row">
                            {{-- Start Tap --}}
                            <div class="tab_wrapper first_tab col-6">
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
                                            <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                <strong>{{__('about_admin.thai_lang')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.title_name_th1')}}</label>
                                            <input type="text" class="form-control" name="name_th" id="name_th"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($about->name_th) ? $about->name_th : '' }}">
                                            <input id="param" type="hidden" class="form-control" name="params" value=""
                                                placeholder="param">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.title_name_th2')}}</label>
                                            <input type="text" class="form-control" name="name1_th" id="name1_th"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($about->name1_th) ? $about->name1_th : '' }}">
                                            <input id="param" type="hidden" class="form-control" name="params" value=""
                                                placeholder="param">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.description_th')}}</label>
                                            <textarea id="description_on_th" class="form-control texteditor"
                                                name="description_on_th" rows="4"
                                                placeholder="description">{{ !empty($about->description_on_th) ? $about->description_on_th : '' }}</textarea>
                                        </div>
                                        {{-- End Input --}}
                                    </div>
                                    {{-- End Tap 1 --}}
                                    {{-- Tap 2 --}}
                                    <div class="tab_content">
                                        {{-- Start Input --}}
                                        <div class="alert alert-default" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                            <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                <strong>{{__('about_admin.eng_lang')}}</strong></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.title_name_en1')}}</label>
                                            <input type="text" class="form-control" name="name_en" id="name_en"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($about->name_en) ? $about->name_en : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.title_name_en2')}}</label>
                                            <input type="text" class="form-control" name="name1_en" id="name1_en"
                                                placeholder="โปรดระบุชื่อหัวข้อ"
                                                value="{{ !empty($about->name1_en) ? $about->name1_en : '' }}">
                                            <input id="param" type="hidden" class="form-control" name="params" value=""
                                                placeholder="param">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{__('about_admin.description_en')}}</label>
                                            <textarea id="description_on_en" class="form-control texteditor"
                                                name="description_on_en" rows="4"
                                                placeholder="description">{{ !empty($about->description_on_en) ? $about->description_on_en : '' }}</textarea>
                                        </div>
                                        <!-- </div> -->
                                        {{-- End Input --}}
                                    </div>
                                    {{-- End Tap 2 --}}
                                </div>
                              </div>
                              <div class="form-group mt-6 col-6">
                                  <div class="card h-100">
                                      <div class="card-header pb-0">
                                          <h3 class="mb-0 card-title">{{__('about_admin.upload_image')}}</h3>
                                      </div>

                                      <div class="card-body mb-12">
                                          <input type="file" id="image_on" name="image_on" class="dropify form-control-lg"
                                              data-default-file="{{ !empty($about->image_on) ? $about->image_on : '' }}" />
                                          <input type="hidden" id="image_1_old" name="image_1_old" value="{{ !empty($about->image_on) ? $about->image_on : '' }}">
                                          <input type="hidden" id="is_delete_image_1" name="is_delete_image_1" value="0">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group mt-6 col-12">
                                <div class="card">
                                <div class="form-group">
                                <div class="card-body">
                                    <label class="form-label">{{__('about_admin.video')}}</label>
                                    <textarea id="video_1" class="form-control texteditor"
                                        name="video_1" rows="4"
                                        placeholder="description">{{ !empty($about->video_1) ? $about->video_1 : '' }}</textarea>
                                </div>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                            {{-- End Tap --}}
                            <div class="form-group mt-3">
                                <div class="card">
                                  <div class="card-header pb-0">
                                      <h3 class="card-title">{{__('about_admin.data_zone_2')}}</h3>
                                  </div>
                                  <br>
                                  <div class="card-body">
                                    <div class="row">
                                      <div class="form-group mt-6 col-6">
                                          <div class="card h-100">
                                              <div class="card-header pb-0">
                                                  <h3 class="mb-0 card-title">{{__('about_admin.upload_image')}}</h3>
                                              </div>
                                              <div class="card-body h-100">
                                                  <input type="file" id="image_center" name="image_center" class="dropify"
                                                      data-default-file="{{ !empty($about->image_center) ? $about->image_center : '' }}" />
                                                  <input type="hidden" id="image_2_old" name="image_2_old" value="{{ !empty($about->image_center) ? $about->image_center : '' }}">
                                                  <input type="hidden" id="is_delete_image_2" name="is_delete_image_2" value="0">
                                              </div>
                                          </div>
                                      </div>
                                      {{-- Start Tap --}}
                                      <div class="tab_wrapper first_tab col-6">
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
                                                      <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                          <strong>{{__('about_admin.thai_lang')}}</strong></span>
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.title_th')}}</label>
                                                      <input type="text" class="form-control" name="name2_th" id="name2_th"
                                                          placeholder="โปรดระบุชื่อหัวข้อ"
                                                          value="{{ !empty($about->name2_th) ? $about->name2_th : '' }}">
                                                      <input id="param" type="hidden" class="form-control" name="params" value=""
                                                          placeholder="param">
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.description_th')}}</label>
                                                      <textarea id="description_center_th" class="form-control texteditor"
                                                          name="description_center_th" rows="4"
                                                          placeholder="description">{{ !empty($about->description_center_th) ? $about->description_center_th : '' }}</textarea>
                                                  </div>
                                                  {{-- End Input --}}
                                              </div>
                                              {{-- End Tap 1 --}}
                                              {{-- Tap 2 --}}
                                              <div class="tab_content">
                                                  {{-- Start Input --}}
                                                  <div class="alert alert-default" role="alert">
                                                      <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                      <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                          <strong>{{__('about_admin.eng_lang')}}</strong></span>
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.title_en')}}</label>
                                                      <input type="text" class="form-control" name="name2_en" id="name2_en"
                                                          placeholder="โปรดระบุชื่อหัวข้อ"
                                                          value="{{ !empty($about->name2_en) ? $about->name2_en : '' }}">
                                                      <input id="param" type="hidden" class="form-control" name="params" value=""
                                                          placeholder="param">
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.description_en')}}</label>
                                                      <textarea id="description_center_en" class="form-control texteditor"
                                                          name="description_center_en" rows="4"
                                                          placeholder="description">{{ !empty($about->description_center_en) ? $about->description_center_en : '' }}</textarea>
                                                  </div>
                                                  {{-- End Input --}}
                                              </div>
                                              {{-- End Tap 2 --}}
                                              </div>
                                          </div>
                                          <div class="form-group mt-6 col-12">
                                          <div class="card">
                                            <div class="form-group mt-3">
                                              <div class="form-group">
                                                <div class="card-body">
                                                  <label class="form-label">{{__('about_admin.video')}}</label>
                                                  <textarea id="video_2" class="form-control texteditor"
                                                      name="video_2" rows="4"
                                                      placeholder="description">{{ !empty($about->video_2) ? $about->video_2 : '' }}</textarea>
                                                </div>
                                              </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            {{-- End Tap --}}
                            <div class="form-group mt-3">
                                <div class="card">
                                  <div class="card-header pb-0">
                                      <h3 class="card-title">{{__('about_admin.data_zone_3')}}</h3>
                                  </div>
                                  <br>
                                  <div class="card-body">
                                    <!-- <div class="row"> -->
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
                                                      <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                          <strong>{{__('about_admin.thai_lang')}}</strong></span>
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.description_th')}}</label>
                                                      <textarea id="description_lower_th" class="form-control texteditor"
                                                          name="description_lower_th" rows="4"
                                                          placeholder="คำอธิบาย">{{ !empty($about->description_lower_th) ? $about->description_lower_th : '' }}</textarea>
                                                  </div>
                                                  {{-- End Input --}}
                                              </div>
                                              {{-- End Tap 1 --}}
                                              {{-- Tap 2 --}}
                                              <div class="tab_content">
                                                  {{-- Start Input --}}
                                                  <div class="alert alert-default" role="alert">
                                                      <span class="alert-inner--icon"><i class="fe fe-bell"></i></i></span>
                                                      <span class="alert-inner--text">{{__('about_admin.form_alert')}}
                                                          <strong>{{__('about_admin.eng_lang')}}</strong></span>
                                                  </div>
                                                  <div class="form-group col-12">
                                                      <label class="form-label">{{__('about_admin.description_en')}}</label>
                                                      <textarea id="description_lower_en" class="form-control texteditor"
                                                          name="description_lower_en" rows="4"
                                                          placeholder="description">{{ !empty($about->description_lower_en) ? $about->description_lower_en : '' }}</textarea>
                                                  </div>
                                                  <!-- </div> -->
                                                  {{-- End Input --}}
                                              </div>
                                              {{-- End Tap 2 --}}
                                              </div>
                                          </div>
                                          <div class="form-group mt-6">
                                              <div class="card h-100">
                                                  <div class="card-header pb-0">
                                                      <h3 class="mb-0 card-title">{{__('about_admin.upload_image')}} </h3>
                                                  </div>
                                                  <div class="card-body">
                                                      <input type="file" id="image_lower" name="image_lower" class="dropify"
                                                          data-default-file="{{ !empty($about->image_lower) ? $about->image_lower : '' }}" />
                                                      <input type="hidden" id="image_3_old" name="image_3_old" value="{{ !empty($about->image_lower) ? $about->image_lower : '' }}">
                                                      <input type="hidden" id="is_delete_image_3" name="is_delete_image_3" value="0">
                                                  </div>
                                              </div>
                                          </div>
                                        <!-- </div> -->
                                      </div>
                                    </div>
                                  </div>
                            {{-- End Tap --}}

                            <div class="form-group">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>{{__('about_admin.save')}}</button>
                                    <button onclick="mwz_redirect('{{ route('admin.about.about.index') }}');"
                                        type="button" class="btn btn-warning"><i class="fa fa-undo"
                                            aria-hidden="true"></i>{{__('about_admin.cancel')}}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                <!-- </div> -->
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
    <link rel="stylesheet" href="{{ mix('css/about.css') }}">
    <script src="{{ mix('js/about.js') }}"></script>

@endsection
