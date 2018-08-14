@extends('frontend/layouts.master')

@section('title', 'PRODUCT | KHEMARAKSMEY')
@section('product', 'active')

@section ('appbottomjs')
	<script type="text/javascript"> 
		/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

		for (i = 0; i < dropdown.length; i++) {
		  dropdown[i].addEventListener("click", function() {
		    this.classList.toggle("active");
		    var dropdownContent = this.nextElementSibling;
		    if (dropdownContent.style.display === "block") {
		      dropdownContent.style.display = "none";
		    } else {
		      dropdownContent.style.display = "block";
		    }
		  });
		}
	</script>
@endsection

@section ('content')
       <!-- breadcrumb -->

@include('frontend.layouts.sidebar.slides')
    <div class="container tc-padding-top">
            <div class="inner-page-heading h-white style-2">
                <h2 style="color: black;">{{__('general.product')}}</h2>
                <h4 style="color: black;">{{__('general.page')}}:@if(isset($appends['category_name'])) {{$appends['category_name']}} @endif @if(isset($appends['sub_category_name'])) <i class="fa fa-arrow-right"></i> {{$appends['sub_category_name']}} @endif @if(isset($appends['sub_sub_category_name'])) <i class="fa fa-arrow-right"></i> {{$appends['sub_sub_category_name']}} @endif</h4>
            </div>
        </div>


<!-- Breadcrumb -->
@include('frontend.layouts.sidebar.product_search')
 <!-- Blog List -->
        <div class="tc-padding">
            <div class="container">

                <div class="row">
                    
                    <!-- Content -->
                    <div style="padding-bottom: 25px;" class="col-lg-3 col-md-3 col-xs-12">

	         			<div class="sidenav">
	         			@foreach($defaultData['navbar_menu'] as $menu)
                           @if( count( $menu['subCategories'] ) == 0 )
						  <a href="{{ route('product', $locale) }}?category={{ $menu['id'] }}">{{ $menu['name'] }}</a>
						  @elseif( count( $menu['subCategories'] ) > 1 )
						  		<button class="dropdown-btn">{{ $menu['name'] }} 
							    <i class="fa fa-caret-down"></i>
							  </button>
							   <div class="dropdown-container">
							   	@foreach( $menu['subCategories'] as $subCategory)
							   <!-- 	<a href="#about">{{ $subCategory['name'] }}</a> -->
								   

								   @foreach($defaultData['navbar_tab_menu'] as $menu_tab)
			                           @if( count( $menu_tab['subSubCategories'] ) == 0 )
									  <a href="{{ route('product', $locale) }}?category={{ $menu['id'] }}&subcategory={{ $menu_tab['id'] }}">{{ $menu_tab['name'] }}</a>
									  @elseif( count( $menu_tab['subSubCategories'] ) > 1 )
									  		<button class="dropdown-btn">{{ $menu_tab['name'] }} 
										    <i class="fa fa-caret-down"></i>
										  </button>
										   <div class="dropdown-container">
										   	@foreach( $menu_tab['subSubCategories'] as $subSubCategory)
										   	<a href="{{ route('product', $locale) }}?category={{ $menu['id'] }}&subcategory={{ $menu_tab['id'] }}&maincategory={{ $subSubCategory['id'] }}">{{ $subSubCategory['name'] }}</a>
											   

											   

										    @endforeach
										   
										  </div>
									@endif
			                        @endforeach	

							    @endforeach
							   
							  </div>
						@endif
                        @endforeach	
						  <!-- <a href="#services">Services</a>
						  <a href="#clients">Clients</a>
						  <a href="#contact">Contact</a>
						  <button class="dropdown-btn">Dropdown 
						    <i class="fa fa-caret-down"></i>
						  </button>
						  <div class="dropdown-container">
						    <a href="#">Link 1</a>
						    <a href="#">Link 2</a>
							   <button class="dropdown-btn">Dropdown 
							    <i class="fa fa-caret-down"></i>
							  </button>
							   <div class="dropdown-container">
							    <a href="#">Link 1</a>
							    <a href="#">Link 2</a>
							    <a href="#">Link 3</a>
							  </div>
						    <a href="#">Link 3</a>
						  </div>
						  <a href="#contact">Search</a> -->
						</div>	
                    </div>
                    <!-- Content -->

                   <!-- Content -->
                    <div class="col-lg-9 col-md-9 col-xs-12">
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