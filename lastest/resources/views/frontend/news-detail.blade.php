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
                            <h2 id="news-title">{{$data->title}}</h2>
                            <div id="border-text">
                                <div class="large-blog-img">
                                    <img src="{{ asset ('public/uploads/news/image-detail/'.$data->image_detail)}}" alt="">
                                </div>
                                <div class="social-text">
                                    
                                    <p><?=$data->content?></p>
                                </div>
                            </div>
                        </div>
                        <!-- blog Detail -->
                        @else
                            <p>No Data</p>
                        @endif
                    </div>
                    <!-- Content -->

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


                </div>
            </div>
        </div>
        <!-- Blog List -->

      
@endsection