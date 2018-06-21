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
                <h2>NEWS</h2>            </div>
        </div>
    </div>
<!-- Breadcrumb -->
        <!-- Blog List -->
        <div class="tc-padding">
            <div class="container">
                <div class="row">
                    
                    <!-- Content -->
                    <div class="col-lg-9 col-md-8 col-xs-12">

                        @foreach($data as $row)
                        <!-- List Blog -->
                        <div class="blog-list">
                            <div class="list-blog">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <img src="{{ asset ('public/uploads/news/image/'.$row->image)}}" alt="">
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="blog-detail">
                                            <h3>{{$row->title}}</h3>
                                            
                                            <p>{{$row->description}}</p>
                                            <a href="{{route('news-detail',['locale'=>$locale, 'slug'=>$row->slug])}}" class="btn-1 shadow-0 sm">Learn more<i class="fa fa-arrow-circle-right"></i></a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ $data->links('vendor.pagination.frontend-html') }}
                        </div>
                        <!-- List Blog -->
                        @endforeach
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