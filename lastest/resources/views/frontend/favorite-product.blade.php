@extends('frontend.profile-tab')

@section('title', 'KHEMARAKSMEY | Favorite Product')
@section('favorite-product', 'profile-active')


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
						@if(count($favorites) > 0)
						<div class="panel panel-default">
			                <div class="panel-heading">
			                    <h3 class="panel-title"><strong>{{__('general.favorite-product')}}</strong></h3>
			                </div>
			                <div class="panel-body">
			                    <div class="table-responsive">
			                        <table class="table table-condensed">
			                            <thead>
			                                <tr>
			                                    <td><strong>{{__('general.name')}}</strong></td>
			                                    
			                                    <td class="text-right"></td>
			                                    
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
			                                @foreach( $favorites as $row)
			                                <tr>
			                                    <td>{{$row->product->productName}} </td>
			                                    <td class="text-right"> <a href="{{route('buy',['locale'=>$locale, 'id'=>$row->product_id])}}" type="button" class="btn btn-success btn-sm">{{__('general.buy')}}</a> <a href="{{route('add-to-cart',['locale'=>$locale, 'id'=>$row->product_id])}}" type="button" class="btn btn-primary btn-sm">{{__('general.add-to-cart')}}</a> <a href="{{route('remove-from-favorite',['locale'=>$locale, 'id'=>$row->product_id])}}" type="button" class="btn btn-danger btn-sm">Remove Favorite</a></td>
			                                   
			                                </tr>
			                                @endforeach

			                                
			                                
			                            </tbody>
			                        </table>
			                    </div>
			                </div>
			            </div>
						@else

				        <div style="padding-top: 50px;" class="row">
				            <div style="text-align: center;" class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				                <h2>{{__('general.no-favorite-product')}}!</h2>
				            </div>
				        </div>

				     @endif
					</div>
					<!-- Content -->
        
@endsection