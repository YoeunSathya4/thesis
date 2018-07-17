@extends('frontend.profile-tab')

@section('title', 'KHEMARAKSMEY | Panding Order')
@section('panding-order', 'profile-active')


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

@section ('profile')
     <!-- Content -->
					<div class="col-lg-9 col-md-8 col-xs-12 pull-right pull-none">
						@if(Session::has('cart'))
						<div class="panel panel-default">
			                <div class="panel-heading">
			                    <h3 class="panel-title"><strong>{{__('general.shopping-cart')}}</strong></h3>
			                </div>
			                <div class="panel-body">
			                    <div class="table-responsive">
			                        <table class="table table-condensed">
			                            <thead>
			                                <tr>
			                                    <td><strong>{{__('general.item')}}</strong></td>
			                                    <td class="text-center"><strong>{{__('general.price')}}</strong></td>
			                                    <td class="text-center"><strong>{{__('general.quantity')}}</strong></td>
			                                    <td class="text-right"><strong>{{__('general.total')}}</strong></td>
			                                    <td></td>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
			                                @foreach( $products as $product)
			                                <tr>
			                                    <td>{{$product['item'][$locale.'_name']}}</td>
			                                    <td class="text-center">${{$product['price']}}</td>
			                                    <td class="text-center">{{$product['qty']}}</td>
			                                    <td class="text-right">${{$product['price'] }}</td>
			                                    <td class="text-center">
			                                        <a href="{{route('reduce',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-danger">{{__('general.remove')}}</a>
			                                         <a href="{{route('remove',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-danger">{{__('general.remove-all')}}</a>
			                                    </td>
			                                </tr>
			                                @endforeach

			                                
			                                <tr>
			                                    <td class="no-line"></td>
			                                    <td class="no-line"></td>
			                                    <td class="no-line text-center"><strong>{{__('general.total')}}</strong></td>
			                                    <td class="no-line text-right">${{$totalPrice}}</td>
			                                </tr>
			                                <tr>
			                                    <td class="no-line"></td>
			                                    <td class="no-line"></td>
			                                    <td class="no-line text-center"><strong></strong></td>
			                                    <td class="no-line text-right"><a href="{{route('checkout',$locale)}}" type="button" class="btn btn-success">{{__('general.check-out')}}</a></td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
						@else

				        <div style="padding-top: 50px;" class="row">
				            <div style="text-align: center;" class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				                <h2>{{__('general.no-items-in-cart')}}!</h2>
				            </div>
				        </div>

				     @endif
					</div>
					<!-- Content -->
        
@endsection