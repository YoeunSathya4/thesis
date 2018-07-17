@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY')
@section('home', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
        <!--BANNER-->
        <div id="main-slider" class="main-slider">

            @foreach($slides as $slide)
            <div class="item">
                <img src="{{ asset ('public/uploads/slide/image/'.$slide->image) }}" alt="">
            </div>
            @endforeach

        </div>
        <!--BANNER-->
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
                                    @foreach($products->chunk(4) as $chunk)
                                        <div class="row">
                                        @foreach($chunk as $product)
                                        <div class="col-lg-3">
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css" src="{{ asset ('public/uploads/product/image/'.$product->image) }}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" href="{{route('add-to-cart',['locale'=>$locale, 'id'=>$product->id])}}"><span class="fa fa-shopping-cart"></span> {{__('general.add-to-cart')}}</a>
                                                            <br>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" href="{{route('product-detail',['locale'=>$locale, 'slug'=>$product->slug])}}">{{__('general.quick-view')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="{{route('product-detail',['locale'=>$locale, 'slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                                                <span><b>Price:</b> ${{$product->unit_price}}</span>
                                            </div>
                                        </div>
                                       @endforeach
                                     </div>
                                    @endforeach
                                
                                <!-- Collection Content -->


                            </div>

                        </div>
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>
        <!-- Book Collections --> 


    
      
@endsection