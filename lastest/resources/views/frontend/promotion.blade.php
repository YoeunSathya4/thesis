@extends('frontend/layouts.master')

@section('title', 'PROMOTION | KHEMARAKSMEY')
@section('promotion', 'active')

@section ('appbottomjs')
@endsection

@section ('content')

@include('frontend.layouts.sidebar.slides')
    <div class="container tc-padding-top">
            <div class="inner-page-heading h-white style-2">
                <h2 style="color: black;">{{__('general.promotion')}}</h2>
            </div>
        </div>
        <!-- breadcrumb -->
  


    		<div class="container" style="padding-top: 20px;">
                <div class="tc-padding-bottom">
                    <div class="row">
                		@foreach($promotions as $row)
                        <!-- Column -->
                        <div class="col-lg-4 col-xs-12 r-full-width" >
                            <div class="address-column ">
                                <img class="promotion-css"  src="{{ asset ('public/uploads/promotion/image/'.$row->image)}}" alt="">
                                <strong id="promotion-text">{{$row->title}}</strong>
                                <p>{!! $row->description !!}</p>
                            </div>
                        </div>
                        <!-- Column -->

                        @endforeach

                    </div>
                    {{ $promotions->links('vendor.pagination.frontend-html') }}
                </div>
            </div>
    
      
@endsection