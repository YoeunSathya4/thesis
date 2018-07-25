@extends('frontend.profile-tab')

@section('title', 'KHEMARAKSMEY | Order History')
@section('order-history', 'profile-active')


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
						@if($orders)
						<div class="panel panel-default">
			                <div class="panel-heading">
			                    <h3 class="panel-title"><strong>{{__('general.order-history')}}</strong></h3>
			                </div>
			                <div class="panel-body">
			                    <div class="table-responsive">
			                        <table class="table table-condensed">
			                            <thead>
			                                <tr>
			                                	<td><strong>{{__('general.no')}}</strong></td>
			                                    <td><strong>{{__('general.name')}}</strong></td>
			                                    <td class="text-center"><strong>{{__('general.payment-id')}}</strong></td>
			                                    <td class="text-center"><strong>{{__('general.address')}}</strong></td>
			                                    <td class="text-right"></td>
			                                    
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
			                                @php($i = 1)
			                                @foreach( $orders as $row)
			                                <tr>
			                                	<td>{{$i++}} </td>
			                                    <td>{{$row->customer->name}} </td>
			                                    <td class="text-center">{{$row->payment_id}}</td>
			                                    <td class="text-center">{{$row->customer->address}}</td>
			                                    <td class="text-right"> <a href="{{route('order-history-detail',['locale'=>$locale, 'id'=>$row->id])}}" type="button" class="btn btn-primary btn-sm">{{__('general.view-invoice')}}</a> </td>
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
				                <h2>{{__('general.no-history-order')}}!</h2>
				            </div>
				        </div>

				     @endif
					</div>
					<!-- Content -->
        
@endsection