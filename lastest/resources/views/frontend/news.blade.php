@extends('frontend/layouts.master')

@section('title', 'NEWS | KHEMARAKSMEY')
@section('news', 'active')

@section ('appbottomjs')
@endsection

@section ('content')

@include('frontend.layouts.sidebar.slides')
    <div class="container tc-padding-top">
            <div class="inner-page-heading h-white style-2">
                <h2 style="color: black;">{{__('general.news')}}</h2>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- Blog List -->
        <div class="">
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
                                            <a href="{{route('news-detail',['locale'=>$locale, 'slug'=>$row->slug])}}" class="btn-1 shadow-0 sm">{{__('general.learn-more')}}<i class="fa fa-arrow-circle-right"></i></a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- List Blog -->
                        @endforeach
                        {{ $data->links('vendor.pagination.frontend-html') }}
                    </div>
                    <!-- Content -->

                    <!-- Aside -->
                    <aside class="col-lg-3 col-md-4 col-xs-12">

                        <!-- Aside Widget -->
                        <div class="aside-widget">
                            <h6>{{__('general.promotion')}}</h6>
                            <ul style="height: 300px" class="books-year-list">
                                @php($promotions = $defaultData['promotions'])
                                @foreach($promotions as $promotion)
                                    <li id="list-promotion">
                                        <div class="books-post-widget">
                                            <img src="{{ asset ('public/uploads/promotion/image/'.$promotion->image)}}" id="image-show" alt="">
                                            <h6><a href="#">{{$promotion->title}}</a></h6>
                                            
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                        <!-- Aside Widget -->


                </div>
            </div>
        </div>
        <!-- Blog List -->

      
@endsection