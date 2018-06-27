@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Porfile')
@section('my-profile', 'profile-active')


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
    <script>
        
        var btnCust = ''; 
        $("#image").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            removeLabel: '',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-2',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="@if($data->image != '') {{ asset('public/uploads/customers/image/'.$data->image) }} @else http://via.placeholder.com/200x165 @endif" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be .jpg or .png type</i></span>',
            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
    </script>
@endsection

@section ('content')
    <!-- Event List -->
		<div class="tc-padding">
			<div class="container">
				<div class="row">
					
					<!-- Content -->
					<div class="col-lg-9 col-md-8 col-xs-12 pull-right pull-none">
						<h1 style="padding-left: 50%;"> {{__('general.my-profile')}}</h1><br/>

						<form style="padding-left: 40px;" id="form" action="{{ route('update-profile') }}" name="form" method="POST"  enctype="multipart/form-data">
					        {{ csrf_field() }}
					        {{ method_field('POST') }}
					        <input type="hidden" name="id" value="{{ $data->id }}">

					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.name')}}</label>
					            <div class="col-sm-10">
					                <input  id="name"
					                        name="name"
					                        value = "{{ $data->name }}"
					                        type="text"
					                        placeholder = "{{__('general.ex')}}. {{__('general.sovan')}}"
					                        class="form-control">
					            </div>
					        </div>
					        
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="email">{{__('general.email')}}</label>
					            <div class="col-sm-10">
					                <input  id="email"
					                        name="email"
					                        value = "{{ $data->email }}"
					                        type="text"
					                        placeholder = "{{__('general.ex')}}. you@example.com"
					                        class="form-control"
					                        data-validation="[EMAIL]">
					            </div>
					        </div>
					        
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="phone">{{__('general.phone')}}</label>
					            <div class="col-sm-10">
					                <input  id="phone"
					                        name="phone"
					                        value = "{{ $data->phone }}"
					                        type="text" 
					                        placeholder = "{{__('general.ex')}}. 093123457"
					                        class="form-control"
					                        data-validation="[L>=9, L<=10, numeric]"
					                        data-validation-message="$ is not correct." 
					                        data-validation-regex="/(^[00-9].{8}$)|(^[00-9].{9}$)/"
					                        data-validation-regex-message="$ must start with 0 and has 10 or 11 digits" />
					                        
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="location">{{__('general.location')}}</label>
					            <div class="col-sm-10">
					                <input  id="location"
					                        name="location"
					                        value = "{{ $data->location }}"
					                        type="text"
					                        placeholder = "{{__('general.ex')}}. {{__('general.chom-chav')}}"
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="address">{{__('general.address')}}</label>
					            <div class="col-sm-10">
					                <input  id="address"
					                        name="address"
					                        value = "{{ $data->address }}"
					                        type="text"
					                        placeholder = "{{__('general.ex')}}. #7A,street 428 Sangkat Boeng Trabeak, Khan Chamkamorn, Phnom Penh"
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="email">{{__('general.image')}}</label>
					            <div class="col-sm-10">
					                <div class="kv-avatar center-block">
					                    <input id="image" name="image" type="file" class="file-loading">
					                </div>
					            </div>
					        </div>
					    
					    
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label"></label>
					            <div class="col-sm-10">
					                <button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> {{__('general.update')}}</button>
					                
					            </div>
					        </div>
					    </form>

					</div>
					<!-- Content -->

					<!-- Aside -->
					<aside style="background: #f16162;" class="col-lg-3 col-md-4 col-xs-12 pull-left pull-none">

						<!-- Aside Widget -->
						<div class="aside-widget">
							<h6 style="padding-top: 20px; font-size: 20px; color: #ffffff;"> <b> {{__('general.profile-menu')}} </b></h6>
							<ul class="s-arthor-list">
								
								<li class="@yield('my-profile')">
									<a id="hover-id" href="{{route('profile',$locale)}}">
									<h6 id="profileMenu">{{__('general.my-profile')}}</h6>
									</a>
								</li>
								<li>
									<a  href="#">
										<h6 id="profileMenu">{{__('general.favorite-product')}}</h6>
									</a>
								</li>
								<li>
									<a  href="#">
										<h6 id="profileMenu">{{__('general.panding-order')}}</h6>
									</a>
								</li>
								<li>
									<a  href="#">
										<h6 id="profileMenu">{{__('general.order-history')}}</h6>
									</a>
								</li>
								
							</ul>
						</div>
						<!-- Aside Widget -->

					</aside>
					<!-- Aside -->
					
				</div>
			</div>
		</div>
		<!-- Event List -->
    
      		<style type="text/css">
      			.profile-active{
      				background: #2e3192;
    				padding: 5px;
      			}
      			a:hover{
      				    color: #0082c6;
    					text-decoration: none;
      			}
      		</style>
      		<!-- Contant Holder -->  
        
@endsection