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
        @if (session()->get('type_menu') == 1)
        <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.header_menu')}}</li>
        @else
        <li class="breadcrumb-item active" aria-current="page">{{__('menu_admin.footer_menu')}}</li>
        @endif
    </ol><!-- End breadcrumb -->
    <div class="ml-auto">
        <div class="input-group">
            <a href="{{ route('admin.menu.menu.add') }}" class="btn btn-secondary text-white mr-2 btn-sm" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Add">
                <span>
                    <i class="fa fa-plus" aria-hidden="true"></i> {{__('menu_admin.add')}}
                </span>
            </a>
        </div>
    </div>
</div>
<!-- End page-header -->

<!-- row opened -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <!-- <div class="card-title">File export Datatable</div> -->
            </div>
            <div class="card-body pt-0">

                <ol class="breadcrumb1">
                    <li class="breadcrumb-item1">
                        <a class="{{ session()->get('type_menu') == '' || session()->get('type_menu') == 1 ? 'text-gray' : '' }}" href="{{ route('admin.menu.menu.type_menu', 1) }}">{{__('menu_admin.header_menu')}}</a>
                    </li>
                    <li class="breadcrumb-item1">
                        <a class="{{ session()->get('type_menu') == 2 ? 'text-gray' : '' }}" href="{{ route('admin.menu.menu.type_menu', 2) }}">{{__('menu_admin.footer_menu')}}</a>
                    </li>
                </ol>

                <div class="table-responsive">
                    <table id="menu-datatable" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0" width="5%">{{__('menu_admin.sequence')}}</th>
                                <th class="border-bottom-0" width="30%">{{__('menu_admin.name_menu_th')}}</th>
                                <th class="border-bottom-0" width="30%">{{__('menu_admin.name_menu_en')}}</th>
                                <th class="border-bottom-0" width="20%">{{__('menu_admin.update_at')}}</th>
                                <th class="border-bottom-0" width="5%">{{__('menu_admin.sort')}}</th>
                                <th class="border-bottom-0" width="5%">{{__('menu_admin.manage')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->

{{-- <div class="mt-2 df aic fwp mx-n2">
        <div class="nev-qty m-2"><a class="min button-qty">-</a>
            <input class="qty form-style" type="text" id="qty" name="qty" maxlength="5" value="1"
                readonly><a class="plus button-qty">+</a>
        </div>
        
    </div> --}}
@endsection

@section('scripts')

<!--Jquery Sparkline js-->
<script src="{{ URL::asset('assets/plugins/vendors/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle js-->
<script src="{{ URL::asset('assets/plugins/vendors/circle-progress.min.js') }}"></script>

<!--Time Counter js-->
<script src="{{ URL::asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/counters/counter.js') }}"></script>

<!---Tabs js-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/tabs/tabs.js') }}"></script>

<!-- INTERNAL Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/plugins/datatable/datatable-2.js') }}"></script> -->

<!-- Notifications js -->
<link href="{{ URL::asset('assets/plugins/notify-growl/css/jquery.growl.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/notify-growl/css/notifIt.css') }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootbox/bootbox.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify-growl/js/rainbow.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify-growl/js/jquery.growl.js') }}"></script>

<!-- mwz member js css -->
<link rel="stylesheet" href="{{ mix('css/mwz.css') }}">
<script src="{{ mix('js/mwz.js') }}"></script>

<!-- module js css -->
<link rel="stylesheet" href="{{ mix('css/menu.css') }}">
<script src="{{ mix('js/menu.js') }}"></script>

{{-- <script>
        var j = jQuery;
        var addInput = '.qty';

        // alert("joe");
        console.log("jjooee");

        //On click add 1 to n
        j('.plus').on('click', function() {
            console.log("++++");
            var n = j(this).parent().find(addInput).val()
            j(this).parent().find(addInput).val(++n);
        })

        j('.min').on('click', function() {
            //If n is bigger or equal to 1 subtract 1 from n
            console.log("----");
            var n = j(this).parent().find(addInput).val()
            if (j(this).parent().find(addInput).val() >= 1) {
                j(this).parent().find(addInput).val(--n);
            } else {
                //Otherwise do nothing 
            }
        });
    </script> --}}

@endsection