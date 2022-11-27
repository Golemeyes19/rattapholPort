@extends('frontend::layouts.master')

@section('title')

@section('style')

@endsection

@section('content')

<body class="no-page-loader page-home">
  <div id="wrapper">
    

        <section class="banner"> 
            <!-- Inspiro Slider -->
            <div id="slider" class="inspiro-slider slider-fullscreen arrows-large arrows-creative dots-creative" data-height-xs="360">
                <!-- Slide 1 -->
                <div class="slide background-overlay-dark" style="background-image: url(assets/images/banner-2.jpg);">
                    <div class="container">
                        <div class="slide-captions text-center text-light">
                            <!-- Captions -->
                            <span data-animation="fadeInUp" data-animation-delay="300" class="strong"><a href="#" class="business"><span class="business">Let's Do This</span></a>
                            </span>
                            <h1 data-animation="fadeInUp" data-animation-delay="600">We’re ICT Agency & Creative<br>Markating Production and Design</h1>
                            <a data-animation="fadeInUp" data-animation-delay="900" class="btn btn-rounded btn-light">Discover More</a>

                            <!-- end: Captions -->
                        </div>
                    </div>
                </div>
                <!-- end: Slide 1 -->
            </div>
            <!--end: Inspiro Slider -->
        </section>

        <section class="about">
            <div class="container">
                <blockquote class="blockquote-fancy">
                    <h2>About Us</h2> 
                <blockquote>
                <p class="sub-detail">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <a href="#" class="read-more">READ MORE</a>
            </div>
        </section>

        <section class="services"> 
            <div class="banner carousel" data-items="3" data-arrow="false" data-autoplay="false" data-loop="true">
                <div class="slide">
                    <a href="#">
                        <div class="inner">
                            <div class="img-ser"><img src="{{ asset('assets/images/ser-1.png') }}"></div>
                            <div class="ser-deatil">
                                <h1 class="services-n">01</h1> 
                                <h3 class="services-h">Digital Marketing</h3>
                                <p class="services-detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="read-more services" href="">READ MORE</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="slide">
                    <a href="#">
                        <div class="inner">
                            <div class="img-ser"><img src="{{ asset('assets/images/ser-2.png') }}"></div>
                            <div class="ser-deatil">
                                <h1 class="services-n">02</h1> 
                                <h3 class="services-h">Branding Design</h3>
                                <p class="services-detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="read-more services" href="">READ MORE</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="slide">
                    <a href="#">
                        <div class="inner">
                            <div class="img-ser"><img src="{{ asset('assets/images/ser-3.png') }}"></div>
                            <div class="ser-deatil">
                                <h1 class="services-n">03</h1> 
                                <h3 class="services-h">Graphic & Multimedia</h3>
                                <p class="services-detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="read-more services" href="">READ MORE</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="slide">
                    <a href="#">
                        <div class="inner">
                            <div class="img-ser"><img src="{{ asset('assets/images/ser-4.png') }}"></div>
                            <div class="ser-deatil">
                                <h1 class="services-n">04</h1> 
                                <h3 class="services-h">Websit & Application</h3>
                                <p class="services-detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="read-more services" href="">READ MORE</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="slide">
                    <a href="#">
                        <div class="inner">
                            <div class="img-ser"><img src="{{ asset('assets/images/ser-3.png') }}"></div>
                            <div class="ser-deatil">
                                <h1 class="services-n">05</h1> 
                                <h3 class="services-h">Video Production</h3>
                                <p class="services-detail">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                <a class="read-more services" href="">READ MORE</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- <section class="background-grey portfolio">
            <div class="container">
                <div class="rowcarousel-description-clients carousel-description-style ">
                    <div class="col-md-4">
                        <div class="description">
                            <h2>Portfolio</h2> 
                            <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra.</p>
                            <a href="#" class="read-more port">View more</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="carousel" data-items="3">
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-1.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-2.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-3.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-4.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-2.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-3.png') }}">
                                </a>
                            </div>
                            <div>
                                <a href="#"><img alt="" src="{{ asset('assets/images/p-4.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section> -->


        <section class="background-grey portfolio">
            <div class="container">
                <div class="description m-b-40">
                    <h2>Portfolio</h2> 
                    <div class="row">
                       <div class="col-md-6">
                            <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui.</p>
                       </div>

                       <div class="col-md-6">
                            <a href="#" class="read-more port">View more</a>
                       </div>
                    </div>
                </div>
                <div class="port-inner no-padding">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img class="w-100" src="{{ asset('assets/images/pb-4.jpg') }}" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <div>
                                        <a href="portfolio-page-grid-gallery.html">
                                            <h3>Let's Go Outside</h3>
                                            <span>Illustrations / Graphics</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="carousel" data-items="1">
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-1.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-2.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-3.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-4.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-2.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-3.jpg') }}"></a></div>
                                <div><a href="#"><img class="w-100" alt="" src="{{ asset('assets/images/pn-4.jpg') }}"></a></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img class="w-100" src="{{ asset('assets/images/pb-1.jpg') }}" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a href="portfolio-page-grid-gallery.html">
                                        <h3>Let's Go Outside</h3>
                                        <span>Illustrations / Graphics</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img class="w-100" src="{{ asset('assets/images/pb-2.jpg') }}" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a href="portfolio-page-grid-gallery.html">
                                        <h3>Let's Go Outside</h3>
                                        <span>Illustrations / Graphics</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img class="w-100" src="{{ asset('assets/images/pb-3.jpg') }}" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a href="portfolio-page-grid-gallery.html">
                                        <h3>Let's Go Outside</h3>
                                        <span>Illustrations / Graphics</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news">
            <div class="container">
                <div class="description m-b-40">
                    <h2>News & Activity </h2> 
                    <div class="row">
                       <div class="col-md-6">
                            <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui.</p>
                       </div>

                       <div class="col-md-6">
                            <a href="#" class="read-more port">View more</a>
                       </div>
                    </div>
                </div>
                <div class="carousel" data-items="4">
                    <div>
                        <div class="inner">
                            <a href="#">
                               <div class="news-img">
                                 <img class="w-100" alt="" src="{{ asset('assets/images/ns-1.jpg') }}">
                               </div>
                               <div class="detial-news">
                                    <p class="htitle">Aliquam enim enim</p>
                                    <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at</p>
                                    <a class="read-more-news" href="#">Read More</a>
                               </div>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="inner">
                            <a href="#">
                               <div class="news-img">
                                 <img class="w-100" alt="" src="{{ asset('assets/images/ns-2.jpg') }}">
                               </div>
                               <div class="detial-news">
                                    <p class="htitle">Aliquam enim enim</p>
                                    <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at</p>
                                    <a class="read-more-news" href="#">Read More</a>
                               </div>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="inner">
                            <a href="#">
                               <div class="news-img">
                                 <img class="w-100" alt="" src="{{ asset('assets/images/ns-3.jpg') }}">
                               </div>
                               <div class="detial-news">
                                    <p class="htitle">Aliquam enim enim</p>
                                    <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at</p>
                                    <a class="read-more-news" href="#">Read More</a>
                               </div>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="inner">
                            <a href="#">
                               <div class="news-img">
                                 <img class="w-100" alt="" src="{{ asset('assets/images/ns-4.jpg') }}">
                               </div>
                               <div class="detial-news">
                                    <p class="htitle">Aliquam enim enim</p>
                                    <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at</p>
                                    <a class="read-more-news" href="#">Read More</a>
                               </div>
                            </a>
                        </div>
                    </div>

                    <div>
                        <div class="inner">
                            <a href="#">
                               <div class="news-img">
                                 <img class="w-100" alt="" src="{{ asset('assets/images/ns-5.jpg') }}">
                               </div>
                               <div class="detial-news">
                                    <p class="htitle">Aliquam enim enim</p>
                                    <p class="sup-detail">Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euis od urna non pharetra. Aliquam enim enim, pharetra in sodales at</p>
                                    <a class="read-more-news" href="#">Read More</a>
                               </div>
                            </a>
                        </div>
                    </div>
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

       <!-- Go to top button -->
        <a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>  

    </body>

@endsection

@section('script')

@endsection

