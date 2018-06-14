@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY')
@section('home', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
        <!--BANNER-->
        <div id="main-slider" class="main-slider">

            <!-- Item -->
            <div class="item">
                <img src="{{ asset ('public/frontend/images/banner/bg-1-1.jpg')}}" alt="">
            </div>
            <!-- Item -->

            <!-- Item -->
            <div class="item">
                <img src="{{ asset ('public/frontend/images/banner/bg-2.jpg')}}" alt="">
                
            </div>
            <!-- Item -->

        </div>
        <!--BANNER-->
        

        <!-- Best Seller Products -->
<!-- Book Collections -->
        <section class="book-collection">
            <div class="container">
                <div class="row">
                            <div class="collection">

                                <!-- Secondary heading -->
                                <div class="sec-heading">
                                    <h3>Shop <span class="theme-color">Books</span> Collection</h3>
                                </div>
                                <!-- Secondary heading -->

                                <!-- Collection Content -->
                                <div class="collection-content">
                                    <ul>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css" src="{{ asset ('public/frontend/images/products-collection/img-01.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Ramadan Kareem</a></h6>
                                                <span>Richard Matherson</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-02.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Mars Club</a></h6>
                                                <span>Eden Lepucki</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-03.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Festa Junnai</a></h6>
                                                <span>George R.R. Martin</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-04.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Beer Fsstivak</a></h6>
                                                <span>Micheal Circhton</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-05.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Rock Festival</a></h6>
                                                <span>Richard Matherson</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-06.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Summer Festival</a></h6>
                                                <span>Edgar Rice Burroghs</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-07.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Festa JUnnai</a></h6>
                                                <span>Max Brooks</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-08.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Summer Festival</a></h6>
                                                <span>J.R.R. Tolkien</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-09.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">New Year Collection</a></h6>
                                                <span>Henry Rollins</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-10.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Happy Halloween</a></h6>
                                                <span>Lily King</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Collection Content -->


                            </div>

                    
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>
        <!-- Book Collections --> 

        <!-- Add Banners -->
        <!-- <section class="add-banners-holder tc-padding-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-sm-12">
                        <div class="add-banner add-banner-1">
                            <div class="z-inedex-2 p-relative">
                                <h3>Celebrate the Book Authors</h3>
                                <p>How to Write a Book Review Request to Bloggers, a guide for authors</p>
                                <hr>
                                <strong class="font-merriweather">Buy Now 280.99 <sup>$</sup></strong>
                            </div>
                            <img class="adds-book" src="{{ asset ('public/frontend/images/add-banners/add-books/img-01.png')}}" alt="">
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-12">
                        <div class="add-banner add-banner-2">
                            <div class="z-inedex-2 p-relative">
                                <strong>Look Books 2016</strong>
                                <h3>Up to 20% off</h3>
                                <hr>
                                <p>of advance enternce exam Books</p>
                            </div>
                            <img class="adds-book" src="{{ asset ('public/frontend/images/add-banners/add-books/img-02.png')}}" alt="">
                        </div>
                    </div>
                

                </div>
            </div>
        </section> -->
        <!-- Add Banners -->

    
      
@endsection