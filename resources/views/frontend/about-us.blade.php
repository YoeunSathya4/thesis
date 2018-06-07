@extends('frontend/layouts.master')

@section('title', 'ABOUT US| KHEMARAKSMEY')
@section('about-us', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
<!-- breadcrumb -->
    <div class="parallax-window inner-banner tc-padding overlay-dark" data-parallax="scroll" data-image-src="images/inner-banner/img-04.jpg">
        <div class="container">
            <div class="inner-page-heading h-white style-2">
                <h2>About Us</h2>
                <p> Spanning fifteen years of work, Everywhere I Look is a book full of unexpected moments,</p>
            </div>
        </div>
    </div>
<!-- Breadcrumb -->

        <!-- Service And Mission -->
        <section class="service-nd-mission tc-padding-top white-bg">
            <div class="container">
                
                <!-- Main Heading -->
                <div class="main-heading-holder">
                    <div class="main-heading style-1">
                        <h2>Help us Improve <span class="theme-color">our Service</span></h2>
                    </div>
                </div>
                <!-- Main Heading -->

                <!-- Services -->
                <div class="our-service tc-padding-bottom">
                    <div class="row">
                        
                        <!-- Service Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="service-column style-2">
                                <span class="service-icon"><i class="icon-amazing"></i></span>
                                <h4><a href="#">Amazing Design Quality</a></h4>
                                <p>Large online bookstores offer used books for sale, too. Individuals wishing to sell their used books</p>
                            </div>
                        </div>
                        <!-- Service Column -->

                        <!-- Service Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="service-column style-2">
                                <span class="service-icon"><i class="icon-intuitive-design"></i></span>
                                <h4><a href="#">Intuitive Design</a></h4>
                                <p>Large online bookstores offer used books for sale, too. Individuals wishing to sell their used books</p>
                            </div>
                        </div>
                        <!-- Service Column -->

                        <!-- Service Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="service-column style-2">
                                <span class="service-icon"><i class="icon-responsive"></i></span>
                                <h4><a href="#">Responsive</a></h4>
                                <p>Large online bookstores offer used books for sale, too. Individuals wishing to sell their used books</p>
                            </div>
                        </div>
                        <!-- Service Column -->

                        <!-- Service Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="service-column style-2">
                                <span class="service-icon"><i class="icon-seo-optimized"></i></span>
                                <h4><a href="#">SEO Optimized</a></h4>
                                <p>Large online bookstores offer used books for sale, too. Individuals wishing to sell their used books</p>
                            </div>
                        </div>
                        <!-- Service Column -->

                    </div>
                </div>
                <!-- Services -->

                <!-- Mission & values -->
                <div class="mission tc-padding-bottom">
                    <div class="row">

                        <!-- Mission Disc -->
                        <div class="col-lg-12 col-xs-12">
                            <div class="mission-disc">
                                <h4>Mission <span>&amp; values</span></h4>
                                <strong>Text Publishing is an independent, Melbourne-based publisher of literary fiction and non-fiction. Text won the Australian Book Industry Awards (ABIA) Small Publisher of the Year in 2012, 2013 and 2014.</strong>
                                <p>At Text we want to publish books that make a difference to people’s lives. We believe that reading should be a marvellous experience, that every book you read should somehow change your life if only by a fraction. We love the phrase ‘lost in a book’.</p>
                                <p> lost in books every day—on the tram, on the beach, in bed. Reading is what keeps the imagination supple and challenges preconceptions and prejudices.</p>
                                
                            </div>
                        </div>
                        <!-- Mission Disc -->

                        <!-- Laptop Img -->
                       <!--  <div class="col-sm-6">
                            <div class="laptop-img">
                                <img class="floating" src="images/laptop.png" alt="">
                            </div>
                        </div> -->
                        <!-- Laptop Img -->

                    </div>
                </div>
                <!-- Mission & values -->

            </div>
        </section>
        <!-- Service And Mission -->
        <!-- Team -->
        <section class="tc-padding white-bg">
            <div class="container">
                
                <!-- Main Heading -->
                <div class="main-heading-holder">
                    <div class="main-heading style-2">
                        <h2>Our <span class="theme-color">Creative Team</span></h2>
                        <p>We are committed to providing first-class services to the writers who trust us</p>
                    </div>
                </div>
                <!-- Main Heading -->   

                <!-- Team Slider -->
                <div class="team-slider">
                    
                    <!-- Team Colmun -->
                    <div class="item">
                        <div class="team-column">
                            <div class="team-img">
                                <img src="{{ asset ('public/frontend/images/team/img-01.jpg')}}" alt="">
                                <div class="overlay-padding">
                                    <div class="overlay">
                                        <ul class="position-center-center">
                                            <li>Tel: 12 0123 4567</li>
                                            <li>Mob 12 0123 4567</li>
                                            <li>Email: ch.jackson@live.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-detail">
                                <h5>Jhon Doe</h5>
                                <span>Art Director CEO</span>
                            </div>
                            <div class="team-btm">
                                <ul class="social-icons"> 
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Team Colmun -->

                    <!-- Team Colmun -->
                    <div class="item">
                        <div class="team-column">
                            <div class="team-img">
                                <img src="{{ asset ('public/frontend/images/team/img-02.jpg')}}" alt="">
                                <div class="overlay-padding">
                                    <div class="overlay">
                                        <ul class="position-center-center">
                                            <li>Tel: 12 0123 4567</li>
                                            <li>Mob 12 0123 4567</li>
                                            <li>Email: ch.jackson@live.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-detail">
                                <h5>Elizabeth Mitchell</h5>
                                <span>Graphic Designer</span>
                            </div>
                            <div class="team-btm">
                                <ul class="social-icons"> 
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Team Colmun -->

                    <!-- Team Colmun -->
                    <div class="item">
                        <div class="team-column">
                            <div class="team-img">
                                <img src="{{ asset ('public/frontend/images/team/img-03.jpg')}}" alt="">
                                <div class="overlay-padding">
                                    <div class="overlay">
                                        <ul class="position-center-center">
                                            <li>Tel: 12 0123 4567</li>
                                            <li>Mob 12 0123 4567</li>
                                            <li>Email: ch.jackson@live.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-detail">
                                <h5>Barrett Wilson</h5>
                                <span>Book Writter</span>
                            </div>
                            <div class="team-btm">
                                <ul class="social-icons"> 
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Team Colmun -->

                    <!-- Team Colmun -->
                    <div class="item">
                        <div class="team-column">
                            <div class="team-img">
                                <img src="{{ asset ('public/frontend/images/team/img-04.jpg')}}" alt="">
                                <div class="overlay-padding">
                                    <div class="overlay">
                                        <ul class="position-center-center">
                                            <li>Tel: 12 0123 4567</li>
                                            <li>Mob 12 0123 4567</li>
                                            <li>Email: ch.jackson@live.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="team-detail">
                                <h5>Josh Martin</h5>
                                <span>Josh Martin</span>
                            </div>
                            <div class="team-btm">
                                <ul class="social-icons"> 
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Team Colmun -->

                </div>
                <!-- Team Slider -->

            </div>
        </section>
        <!-- Team -->

        
       

    
      
@endsection