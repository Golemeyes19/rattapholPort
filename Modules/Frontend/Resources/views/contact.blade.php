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

                    <!-- .contact-style-2 -->
                    <div class="contact-style-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 headtitle-bar">
                            <h2 class="text-md m-b-20">Contact Us</h2>
                            <div class="dec-line-vertical"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 wrap-content">
                            <div class="box-contact-form">
                             <div class="col-xs-12 col-sm-12 col-md-6 box-inner-form">
                                <div class="form-contact" style="max-width: 30rem;">
                                    <h2>Contact form</h2>
                                    <p class="m-b-40">It is a long established fact that a reader will be distracted by the readable content of a page</p>
                                    <form>
                                        <input class="form-control" placeholder="Name" type="text">
                                        <input class="form-control" placeholder="Email" type="Email Address ">
                                        <select class="form-control">
                                            <option value="" disabled selected>Department for contact</option>
                                            <option value="">Support</option>
                                            <option value="">Sale</option>
                                            <option value="">Manager</option>
                                            <option value="">Product</option>
                                        </select>

                                        <input class="form-control" placeholder="Subject" type="text">
                                        <input class="form-control" type="tel" placeholder="+66 91-831-3131">
                                        <textarea class="form-control" placeholder="Message" rows="5"></textarea>
                                        <input type="submit" name="submit" class="form-control btn btn-submit btn-md">
                                    </form>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 box-inner-info">
                                <h2>Get In Touch</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>

                                <div class="cFluid box-list-contact">
                                  <div class="col-xs-12 col-sm-12 col-md-12 contact-list-item address">
                                    <h6 class="">ADDRESS</h6>
                                    <h5>1 Fortune Town 22nd Floor. <br>Ratchadapisek Road, Dindang, Bangkok 10400, Thailand</h5>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 contact-list-item phone">
                                    <h6 class="">PHONE</h6>
                                    <h5><a href="tel+66">+66 (2)-642-0405</a></h5>
                                    <h5><a href="mailto:contact@shopup.com">contact@shopup.com</a></h5>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 contact-list-item hours">
                                    <h6 class="">HOURS</h6>
                                    <h5>Mon-Sat: 8am-6pm</h5>
                                    <h5>Sun : Close</h5>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 social-icons social-icons-border social-icons-rounded social-icons-colored-hover">
                                    <ul>
                                        <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li class="social-gplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        <!-- <li class="social-line"><a href="#"><i class="fab fa-line"></i></a></li> -->
                                    </ul>
                                </div>

                                <div class="box-inner-map col-xs-12 col-sm-12 col-md-12">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31002.700189567007!2d100.56511900000001!3d13.758508000000003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7c82b5cfabbf1f4a!2z4Lif4Lit4Lij4LmM4LiI4Li54LiZ4LiX4Liy4Lin4LiZ4LmM!5e0!3m2!1sth!2sth!4v1646371179608!5m2!1sth!2sth" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>

                            <!-- <div class="box-contact-map">
                                <div class="box-inner-map col-xs-12 col-sm-12 col-md-6">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31002.700189567007!2d100.56511900000001!3d13.758508000000003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7c82b5cfabbf1f4a!2z4Lif4Lit4Lij4LmM4LiI4Li54LiZ4LiX4Liy4Lin4LiZ4LmM!5e0!3m2!1sth!2sth!4v1646371179608!5m2!1sth!2sth" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <div class="box-inner-info col-xs-12 col-sm-12 col-md-6">
                                    <h5 class="htitle">GET STARTED</h5>
                                    <p>Find us on map, pay us a visit to get started with a project</p> 
                                    <a href="https://goo.gl/maps/26w9pKKYi2f9n58p6" class="btn btn-border">View on Google map</a>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <!-- .contact-style-2 -->

                </div>
            </div>
        </section>

       
  </div>
 <!-- end: Wrapper -->

 <!-- Go to top button -->
 <a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>



</body>
@endsection

@section('script')

@endsection

