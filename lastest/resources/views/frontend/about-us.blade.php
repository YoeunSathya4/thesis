@extends('frontend/layouts.master')

@section('title', 'ABOUT US| KHEMARAKSMEY')
@section('about-us', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
<!-- breadcrumb -->
    <div class="parallax-window inner-banner tc-padding overlay-dark" data-parallax="scroll" data-image-src="{{asset('public/frontend/images/banner.jpg')}}">
        <div class="container">
            <div class="inner-page-heading h-white style-2">
                <h2>{{__('general.about-us')}}</h2>
            </div>
        </div>
    </div>
<!-- Breadcrumb -->

        <!-- Service And Mission -->
        <section class="service-nd-mission tc-padding-top white-bg">
            <div  class="container">
                

                <!-- Mission & values -->
                <div class="mission tc-padding-bottom">
                    <div class="row">

                        <!-- Mission Disc -->
                        <div class="col-lg-12 col-xs-12">
                            <div class="mission-disc">
                                <h4>{{__('general.company-profile')}}</h4><hr>
                                <strong>@if($aboutUsContent != '') {!!$aboutUsContent->content!!} @else No Data Here!  @endif</strong>
                                
                            </div>
                        </div>
                        <!-- Mission Disc -->

                    </div>
                </div>
                <!-- Mission & values -->

            </div>
        </section>
        <!-- Service And Mission -->

@endsection