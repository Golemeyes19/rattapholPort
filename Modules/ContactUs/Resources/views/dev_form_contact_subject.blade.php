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
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <form id="send_contactsubject_frm" name="send_contactsubject_frm" method="POST" onsubmit="SendContactSubject(); return false;">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($contactus_subject->id) ? $contactus_subject->id : '0' }}">

                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab5">

                                <div class="panel panel-primary">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="form-group col-md-12">
                                                <label class="form-label">หัวข้อติดต่อเรา</label>
                                                <select name="subject_id" class="form-control select2-show-search" data-placeholder="หัวข้อติดต่อเรา">
                                                    <option value="0">-- เลือกหัวข้อติดต่อเรา --</option>
                                                    @foreach ($data_subject['subject'] as $k => $data_subject)
                                                        <option value="{{ $data_subject['id']  }}" selected="selected">{{ $data_subject['subject'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-label" title="E-mail">ชื่อ - นามสกุล</label>
                                                <input type="text" class="form-control" name="name" placeholder="ชื่อ - นามสกุล" value="joe"/>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="form-label" title="E-mail">อีเมล์</label>
                                                <input type="text" class="form-control" name="email" placeholder="E-mail" value="midgun220@gmail.com" />
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="number" class="form-control" name="phone" placeholder="เบอร์โทรศัพท์" value="0124578954"/>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="form-label">ข้อความ</label>
                                                <textarea type="text" class="form-control" id="message" name="message" placeholder="ข้อความ" value="test">test</textarea>
                                            </div>

                                            <div class="form-group mt-5">
                                                <div class="btn-list">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="ion-checkmark-circled mr-1"></i>บันทึก</button>
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
