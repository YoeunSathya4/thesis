@extends('frontend/layouts.master')

@section('title', 'ABOUT US| KHEMARAKSMEY')
@section('about-us', 'active')

@section ('appbottomjs')
@endsection

@section ('content')

@include('frontend.layouts.sidebar.slides')
<!-- breadcrumb -->

        <div class="container tc-padding-top">
            <div class="inner-page-heading h-white style-2">
                <h2 style="color: black;">{{__('general.about-us')}}</h2>
            </div>
        </div>

<!-- Breadcrumb -->
    
        <!-- Service And Mission -->
        <section class="service-nd-mission white-bg">
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