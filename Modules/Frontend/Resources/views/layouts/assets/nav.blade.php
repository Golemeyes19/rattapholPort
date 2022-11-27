        <header id="header" class="header-transparent dark menu-split">
            <div id="header-wrap">
                <div class="container">
                    <!--Logo-->
                    <div id="logo">
                        <a href="{{url('/')}}" class="logo" data-dark-logo="{{ asset('assets/images/logo.png') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Polo Logo">
                        </a>
                    </div>
                    <!--End: Logo-->
                    
                    <!--Top Search Form-->
                    <div id="top-search">
                        <form action="search-results-page.html" method="get">
                            <input type="text" name="q" class="form-control" value="" placeholder="Start typing & press  &quot;Enter&quot;">
                        </form>
                    </div>
                    <!--end: Top Search Form-->

                    <!--Header Extras-->
                    <div class="header-extras">
                        <ul>
                            <li>
                                <!--top search-->
                                <a id="top-search-trigger" href="#" class="toggle-item">
                                    <i class="fa fa-search"></i>
                                    <i class="fa fa-close"></i>
                                </a>
                                <!--end: top search-->
                            </li>
                            <li class="hidden-xs">
                               <div class="language">
                                <a href="#" class="language-en active">EN</a>
                                <span class="border"></span>
                                <a href="#" class="language-th">TH</a>
                               </div>
                            </li>
                        </ul>
                    </div>
                    <!--end: Header Extras--> 

                    <!--Navigation Resposnive Trigger-->
                    <div id="mainMenu-trigger">
                        <button class="lines-button x"> <span class="lines"></span> </button>
                    </div>
                    <!--end: Navigation Resposnive Trigger-->

                    <!--Navigation-->
                    <div id="mainMenu" class="light">
                        <div class="container">
                            <nav>
                                <!--Left menu-->
                                <ul>
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li class=""> <a href="{{url('/about')}}">About Us</a></li>
                                    <li class=" mega-menu-item"> <a href="{{url('/services')}}">Services</a></li>
                                </ul>
                                <ul>
                                    <li class=""> <a href="{{url('/portfolio')}}">Portfolio</a></li>        
                                    <li class=" mega-menu-item"> <a href="{{url('/news')}}">News</a></li>
                                    <li class=" mega-menu-item"> <a href="{{url('/contact')}}">Contact</a></li>
                                </ul>
                                
                            </nav>
                        </div>
                    </div>
                    <!--end: Navigation-->
                </div>
            </div>
        </header>