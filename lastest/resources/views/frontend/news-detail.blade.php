@extends('frontend/layouts.master')

@section('title', 'NEWS | KHEMARAKSMEY')
@section('news', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    <!-- breadcrumb -->
    <div class="parallax-window inner-banner tc-padding overlay-dark" data-parallax="scroll" data-image-src="{{asset('public/frontend/images/banner.jpg')}}">
        <div class="container">
            <div class="inner-page-heading h-white style-2">
                <h2>{{__('general.news-detail')}}</h2>            
            </div>
        </div>
    </div>
<!-- Breadcrumb -->
        <!-- Blog List -->
        <div class="tc-padding">
            <div class="container">
                <div class="row">
                    
                    <!-- Content -->
                    <div class="col-lg-9 col-md-8">
                        @if($data != '')
                        <!-- blog Detail -->
                        <div class="single-blog-detail">
                            <h2>{{$data->title}}</h2>
                            <div class="large-blog-img">
                                <img src="{{ asset ('public/uploads/news/image-detail/'.$data->image_detail)}}" alt="">
                            </div>
                            <div class="social-text">
                                
                                <p><?=$data->content?></p>
                            </div>
                        </div>
                        <!-- blog Detail -->
                        @else
                            <p>No Data</p>
                        @endif
                    </div>
                    <!-- Content -->

                    <!-- Aside -->
                    <aside class="col-lg-3 col-md-4 col-xs-12">

                        <!-- Aside Widget -->
                        <div class="aside-widget">
                            <h6>Books of the Year</h6>
                            <ul class="books-year-list">
                                <li>
                                    <div class="books-post-widget">
                                        <img src="{{ asset ('public/frontend/images/books-year-list/img-01.jpg')}}" alt="">
                                        <h6><a href="#">My Brilliant Friend The Neapolitan Novels, Book One</a></h6>
                                        <span>By Elena Ferrante</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="books-post-widget">
                                        <img src="{{ asset ('public/frontend/images/books-year-list/img-02.jpg')}}" alt="">
                                        <h6><a href="#">As night fell, something stirred the darkness.</a></h6>
                                        <span>By Meg Caddy</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="books-post-widget">
                                        <img src="{{ asset ('public/frontend/images/books-year-list/img-03.jpg')}}" alt="">
                                        <h6><a href="#">The Rosie Project: Don Tillman 1</a></h6>
                                        <span>By Graeme Simsion</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="books-post-widget">
                                        <img src="{{ asset ('public/frontend/images/books-year-list/img-04.jpg')}}" alt="">
                                        <h6><a href="#">Heartbreaking, joyous, traumatic, intimate and</a></h6>
                                        <span>By Magda Szubanski</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Aside Widget -->


                </div>
            </div>
        </div>
        <!-- Blog List -->

      
@endsection