@extends('frontend/layouts.master')

@section('title', 'PRODUCT | KHEMARAKSMEY')
@section('product', 'active')

@section ('appbottomjs')
	
@endsection

@section ('content')
@include('frontend.layouts.sidebar.slides')
    <div class="container tc-padding-top">
            <div class="inner-page-heading h-white style-2">
                <h2 style="color: black;">{{__('general.search-result')}}</h2>
            </div>
    </div>
<!-- Breadcrumb -->
@include('frontend.layouts.sidebar.product_search')
 <!-- Blog List -->
        <div class="tc-padding">
            <div class="container">

                <div class="row">
                    

                   <!-- Content -->
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    			<!-- @if(Session::has('successs'))
                    				<div id="charge-message" class="alert alert-success">
                    					{{Session::get('success')}}
                    				</div>
                    				
                    			@endif -->
                    			@if(count($data) > 0)
                    			@foreach($data->chunk(3) as $chunk)
                                        <div style="padding-bottom: 30px;"  class="row">
                                        @foreach($chunk as $product)
                                        <div class="col-lg-4">
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css" src="{{ asset ('public/uploads/product/image/'.$product->image) }}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            
                                                            
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" href="{{route('product-detail',['locale'=>$locale, 'slug'=>$product->slug])}}">{{__('general.quick-view')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 style="text-align: center;"><a href="{{route('product-detail',['locale'=>$locale, 'slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                                                <h4 style="text-align: center;" ><b >Price:</b> ${{$product->unit_price}}</h4>
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <a class="btn-1 sm " data-toggle="modal" href="{{route('add-to-cart',['locale'=>$locale, 'id'=>$product->id])}}"><span class="fa fa-shopping-cart"></span> </a>
                                                    </div>
                                                    <div class="col-xs-6">
                                                    	@if($product->favorites()->first() == null)
                                                           @php($favorite = 0) 
                                                        @else
                                                            @php($favorite = 1)
                                                        @endif
                                                        @if(Auth::guard('customer')->user())
                                                    	@if($favorite == 1)
                                                        <a href="{{route('remove-from-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0 blank"><i class="fa fa-heart"></i>  </a>
                                                        @else
                                                        	<a style="background: #b09b9b;" href="{{route('add-to-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0"><i class="fa fa-heart"></i>  </a>
                                                        @endif
                                                        @else
                                                           <a style="background: #b09b9b;" href="{{route('add-to-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0"><i class="fa fa-heart"></i>  </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @endforeach
                                     </div>
                                    @endforeach
                                    {{ $data->links('vendor.pagination.frontend-html') }}
                       			@else
                       				<h3>{{__('general.no-data-here')}}</h3>
                       			@endif
                        
                    </div>
                    <!-- Content -->


                </div>
            </div>
        </div>
        <!-- Blog List -->

    
      
@endsection