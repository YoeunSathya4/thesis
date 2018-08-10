@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY')
@section('home', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
        <!--BANNER-->
       <!--  <div id="main-slider" class="main-slider">

            @foreach($slides as $slide)
            <div class="item">
                <img src="{{ asset ('public/uploads/slide/image/'.$slide->image) }}" alt="">
            </div>
            @endforeach

        </div> -->
        <!--BANNER-->




@include('frontend.layouts.sidebar.slides')

        @include('frontend.layouts.sidebar.product_search')
        <section class="book-collection">
            <div class="container">
                <div class="row">
                        <div class="col-xs-12">
                           <div class="collection">

                                <!-- Secondary heading -->
                                <div class="sec-heading">
                                    <h3>{{__('general.product-category')}}</h3>
                                </div>
                                <!-- Secondary heading -->

                                <div class="row">
                                @foreach($categories as $category)  
                                  <div class="col-lg-3">
                                    <a href="{{ route('product', $locale) }}?category={{ $category->id }}" class="thumbnail">
                                        <img class="rounded-circle" style="width: 100%;" src="{{asset('public/uploads/category/image/'.$category->image)}}" alt="Generic placeholder image" width="140" height="140">
                                    </a>
                                    <a href="#">
                                        <h3 style="text-align: center;"> {{$category->name}} </h3>
                                    </a>
                                  </div><!-- /.col-lg-4 -->
                                @endforeach
                            </div>

                        </div>
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>

        <!-- Best Seller Products -->
<!-- Book Collections -->
        <section class="book-collection">
            <div class="container">
                <div class="row">
                        <div class="col-xs-12">
                           <div class="collection">

                                <!-- Secondary heading -->
                                <div class="sec-heading">
                                    <h3>{{__('general.feature-product')}}</h3>
                                </div>
                                <!-- Secondary heading -->

                                <!-- Collection Content -->
                                    @foreach($products->chunk(3) as $chunk)
                                        <div style="padding-bottom: 30px;" class="row">
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
                                                        <a class="btn-1 sm shadow-0" data-toggle="modal" href="{{route('add-to-cart',['locale'=>$locale, 'id'=>$product->id])}}"><span class="fa fa-shopping-cart"></span> {{__('general.add-to-cart')}}</a>
                                                    </div>
                                                    <div class="col-xs-6">
                                                       
                                                       

                                                        @if($product->favorites()->first() == null)
                                                           @php($favorite = 0) 
                                                        @else
                                                            @php($favorite = 1)
                                                        @endif
                                                        @if(Auth::guard('customer')->user())
                                                        @if($favorite == 1)
                                                        <a href="{{route('remove-from-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0 blank"><i class="fa fa-heart"></i> {{__('general.favorite')}} </a>
                                                        @else
                                                            <a style="background: #b09b9b;" href="{{route('add-to-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0"><i class="fa fa-heart"></i> {{__('general.favorite')}} </a>
                                                        @endif
                                                        @else
                                                            <a style="background: #b09b9b;" href="{{route('add-to-favorite',['locale'=>$locale, 'id'=>$product->id])}}" class="btn-1 sm shadow-0"><i class="fa fa-heart"></i> {{__('general.favorite')}} </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @endforeach
                                     </div>
                                    @endforeach
                                
                                <!-- Collection Content -->
                                

                            </div>

                        </div>
                        <div style="padding-top: 20px;" class="col-lg-12">
                                    <div class="col-lg-4">
                                    </div>
                                    
                                    <div style="    padding-left: 96px;" class="col-lg-4">
                                        <a href="{{route('product',$locale)}}" class="btn-1 sm shadow-0"> {{__('general.view-more')}} <i aria-hidden="true" class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>
        <!-- Book Collections --> 


    
      
@endsection