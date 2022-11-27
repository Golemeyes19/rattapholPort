@extends('frontend::layouts.master')

@section('title')

@section('style')

@endsection

@section('content')

<body class="no-page-loader page-about">
  <div id="wrapper">

       <section class="subpage-content">
            <div class="container">
                <div class="row">

                    <!-- .about-style-1 -->
                    <div class="about-style-1">
                    

                        <div class="col-xs-12 col-sm-12 col-md-12 blog-icons ">
                             <div class="col-md-12 cRight">
                                <h2 class="headtitle m-b-30 liner-bottom lnLeft">Our Service</h2>
                                <p class="sub-title">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                            </div>
                            <div class="col-md-12 cLeft">
                                <div class="row">
                                    <ul class="list">
                                        <li class="list-item box-icon-list active">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Digital Marketing</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>
                                        <li class="list-item box-icon-list">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Branding Design</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>
                                        <li class="list-item box-icon-list">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Graphic & Multimedia</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>
                                        <li class="list-item box-icon-list">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Websit & Application</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>

                                         <li class="list-item box-icon-list">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Video Production</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>

                                         <li class="list-item box-icon-list">
                                            <img src="{{ asset('assets/images/icon.png') }}">
                                            <h4 class="htitle">Event & Exhibition</h4>
                                            <p class="desp">Lorem Ipsum has been the industry's standard dummy</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                           
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 blog-quote">
                            <img src="{{ asset('assets/images/trophy.png') }}" class="blog-quote-icon">
                            <div class="blockquote blockquote-fancy m-b-40">
                                <p class="text-md font-weight-600">The best solution<br>for business</p>
                            </div>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                            <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                        </div>
                    </div>
                    <!-- .about-style-1 -->

                </div>
            </div>
        </section>

          <div class="call-to-action background-image p-t-80 p-b-80" style="background-image:url(assets/images/bg-contact.jpg)">
            <div class="container">
                <div class="col-md-12">
                    <h3 class="text-light">start A project with us</h3>
                    <p class="text-light">This is a simple hero unit, a simple call-to-action-style component for calling extra attention to featured content.</p>
                </div>
                <div class="col-md-2"> <a class="btn btn-light btn-outline">Call us now!</a> </div>
            </div>
        </div>
     
  </div>
 <!-- end: Wrapper -->

 <!-- Go to top button -->
 <a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>


</body>
@endsection

@section('script')

@endsection

