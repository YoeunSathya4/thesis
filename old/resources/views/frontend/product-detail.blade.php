@extends('frontend/layouts.master')

@section('title', 'NEWS | KHEMARAKSMEY')
@section('product', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    <!-- breadcrumb -->
    <div class="parallax-window inner-banner tc-padding overlay-dark" data-parallax="scroll" data-image-src="{{asset('public/frontend/images/banner.jpg')}}">
        <div class="container">
            <div class="inner-page-heading h-white style-2">
                <h2>{{__('general.product-detail')}}</h2>            
            </div>
        </div>
    </div>

    <!-- Book Detail -->
        <div style="padding-top: 20px;" class="book-detail">
            <div class="container">
                
                <!-- Alert -->
                <!-- <div class="add-cart-alert">
                    <p><i class="fa fa-check-circle"></i>The Complete Book of Vegetables </p>
                    <a class="btn-1 sm pull-right shadow-0" href="#">view cart</a>
                </div> -->
                <!-- Alert -->

                <!-- Single Book Detail -->
                <div class="single-boook-detail">
                    <div class="row">
                        
                        <!-- Book Thumnbnail -->
                        <div class="col-lg-4 col-md-5">
                            <div class="product-thumnbnail">

                                <img src="{{ asset ('public/uploads/product/image/'.$data->image) }}">
                            </div>
                        </div>
                        <!-- Book Thumnbnail -->

                        <!-- book Detail -->
                        <div class="col-lg-8 col-md-7">
                            <div class="single-product-detail">
                                <h3>{{$data->name}}</h3>
                                <span style="color: black;" class="availability">{{__('general.availability')}} :<strong>{{$data->product_qty}} {{__('general.stock')}}<i class="fa fa-check-circle"></i></strong></span>

                                <span style="color: black;" class="availability">{{__('general.price')}} :<strong>{{$data->unit_price}}<i class="fa fa-dollar"></i></strong></span>

                                
                                
                                <h4>{{__('general.description')}}</h4>
                                <p>{!! $data->description !!}</p>
                                <!-- <div class="quantity-box">
                                    <label>Qty :</label>
                                    <form id='myform' method='POST' action='http://techlinqs.com/html/bookstore-0.2/bookstore-ltr/123'>
                                        <input type='button' value='-' class='qtyminus'/>
                                        <input type='number' name='quantity' value='1' class='qty' />
                                        <input type='button' value='+' class='qtyplus'/>
                                    </form>
                                </div> -->
                                <ul class="btn-list">
                                    <li><a class="btn-1 sm shadow-0 " href="{{route('add-to-cart',['locale'=>$locale, 'id'=>$data->id])}}">{{__('general.add-to-cart')}}</a></li>
                                    <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-heart"></i></a></li>
                                    <!-- <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-repeat"></i></a></li>
                                    <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-share-alt"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- book Detail -->
                        

                    </div>

                </div>
                <!-- Single Book Detail -->
                <!-- Related Products -->
                <div class="related-products">
                    <h3 style="padding-top: 10px">{{__('general.related-product')}}</h3>
                    <div style="padding-top: 10px" class="related-produst-slider">
                        @foreach($relatedProducts as $product)
                        <a href="{{route('product-detail',['locale'=>$locale, 'slug'=>$product->slug])}}">
                            <div class="item">
                                <div class="product-box">
                                    <div class="product-img">
                                        <img src="{{ asset ('public/uploads/product/image/'.$product->image) }}" alt="">
                                        
                                    </div>
                                    <div class="product-detail">
                                        <h5>{{$product->name}}</h5>
                                        <div class="rating-nd-price">
                                            <strong>$ {{$product->unit_price}}</strong>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!-- Related Products -->
            </div>
        </div>
        <!-- Book Detail --> 
@endsection