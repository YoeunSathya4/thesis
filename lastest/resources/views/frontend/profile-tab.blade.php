@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Porfile')



@section ('css')
    <link href="{{ asset ('public/cp/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/cp/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <!-- some CSS styling changes and overrides -->
    <style>
        .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            text-align: center;
        }
        .kv-avatar .file-input {
            display: table-cell;
            max-width: 220px;
        }
        #profileMenu{
        	color: #ffffff;font-size: 18px;text-align: center;
        }
    </style>
@endsection

@section ('appbottomjs')
<script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
   
@endsection

@section ('content')
    <!-- Event List -->
		<div class="tc-padding">
			<div class="container">
				<div class="row">
					<!-- Aside -->
					<aside style="background: #f16162; border-radius: 25px;" class="col-lg-3 col-md-4 col-xs-12 pull-left pull-none">

						<!-- Aside Widget -->
						<div class="aside-widget">
							<h6 style="padding-top: 20px; font-size: 20px; color: #ffffff;"> <b> {{__('general.profile-menu')}} </b></h6>
							<ul class="s-arthor-list">
								
								<li class="@yield('my-profile')">
									<a id="hover-id" href="{{route('profile',$locale)}}">
									<h6 id="profileMenu">{{__('general.my-profile')}}</h6>
									</a>
								</li>
								<li class="@yield('favorite-product')">
									<a  href="{{route('favorite-product',$locale)}}">
										<h6 id="profileMenu">{{__('general.favorite-product')}}</h6>
									</a>
								</li>
								<li class="@yield('panding-order')">
									<a  href="{{route('panding-order',$locale)}}">
										<h6 id="profileMenu">{{__('general.panding-order')}}</h6>
									</a>
								</li>
								<li class="@yield('order-history')">
									<a  href="{{route('order-history',$locale)}}">
										<h6 id="profileMenu">{{__('general.order-history')}}</h6>
									</a>
								</li>
								
							</ul>
						</div>
						<!-- Aside Widget -->

					</aside>
					<!-- Aside -->

					@yield('profile')

					

					
					
				</div>
			</div>
		</div>
		<!-- Event List -->
    
      		<style type="text/css">
      			.profile-active{
      				background: #2e3192;
    				padding: 5px;
    				border-radius: 25px;
    				padding-top: 19px;
      			}
      			a:hover{
      				    color: #0082c6;
    					text-decoration: none;
      			}
      		</style>
      		<!-- Contant Holder -->  
        
@endsection