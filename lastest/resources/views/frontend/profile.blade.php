@extends('frontend.profile-tab')

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

@section ('profile')
     <!-- Content -->
					<div class="col-lg-9 col-md-8 col-xs-12 pull-right pull-none">
						<div class="panel panel-default">
							<div class="panel-heading">
			                    <h3 class="panel-title"><strong>{{__('general.my-profile')}}</strong></h3>
			                </div>

			                <div class="panel-body">
			                		@if (count($errors) > 0)
						    
									    <div style="max-width: 322px; margin: 0 auto">
			                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
			                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                                                <span aria-hidden="true">×</span>
			                                            </button>
			                                            <ul>
												            @foreach ($errors->all() as $error)
												                <li>{{ $error }}</li>
												            @endforeach
												        </ul>
			                                        </div>  
			                                    </div>    
									@endif

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
						</div>


						<div class="panel panel-default">
							<div class="panel-heading">
			                    <h3 class="panel-title"><strong>{{__('general.change-password')}}</strong></h3>
			                </div>
			                <div class="panel-body">
			                	@if (count($errors) > 0)
						    
						    <div style="max-width: 322px; margin: 0 auto">
                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
									            @foreach ($errors->all() as $error)
									                <li>{{ $error }}</li>
									            @endforeach
									        </ul>
                                        </div>  
                                    </div>
						@endif
					    <form style="padding-left: 40px;" id="form" action="{{ route('change-password') }}" name="form" method="POST"  enctype="multipart/form-data">
					        {{ csrf_field() }}
					        {{ method_field('POST') }}
					        <input type="hidden" name="id" value="{{ $data->id }}">

					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.current-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="old_password"
					                        name="old_password"
					                        value = ""
					                        type="password"
					                        placeholder = "Enter your current password"
					                        class="form-control">
					            </div>
					        </div>
					    	<div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.new-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="new_password"
					                        name="new_password"
					                        value = ""
					                        type="password"
					                        placeholder = "Enter your new password"
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.confirm-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="confirm_password"
					                        name="confirm_password"
					                        value = ""
					                        type="password"
					                        placeholder = "Enter your password agian"
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label"></label>
					            <div class="col-sm-10">
					                <button type="submit" class="btn btn-primary"> <fa class="fa fa-cog"></i> {{__('general.change')}} </button>
					                
					            </div>
					        </div>
					    </form>
			                </div>
			            </div>
						<!-- <div id="profile-rop">
							<h2 style="padding-left: 40%;color:white;padding-top: 10px;"> {{__('general.my-profile')}}</h2>
						</div>
						<br/>
						@if (count($errors) > 0)
						    
						    <div style="max-width: 322px; margin: 0 auto">
                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
									            @foreach ($errors->all() as $error)
									                <li>{{ $error }}</li>
									            @endforeach
									        </ul>
                                        </div>  
                                    </div>
						@endif

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
					    <hr>
					    <div id="profile-rop">
							<h2 style="padding-left: 40%;color:white;padding-top: 10px;">  {{__('general.change-password')}}</h2>
					    </div>
						<br/>
					    
					    @if (count($errors) > 0)
						    
						    <div style="max-width: 322px; margin: 0 auto">
                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
									            @foreach ($errors->all() as $error)
									                <li>{{ $error }}</li>
									            @endforeach
									        </ul>
                                        </div>  
                                    </div>
						@endif
					    <form style="padding-left: 40px;" id="form" action="{{ route('change-password') }}" name="form" method="POST"  enctype="multipart/form-data">
					        {{ csrf_field() }}
					        {{ method_field('POST') }}
					        <input type="hidden" name="id" value="{{ $data->id }}">

					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.current-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="old_password"
					                        name="old_password"
					                        value = ""
					                        type="password"
					                        placeholder = ""
					                        class="form-control">
					            </div>
					        </div>
					    	<div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.new-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="new_password"
					                        name="new_password"
					                        value = ""
					                        type="password"
					                        placeholder = ""
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label" for="en_name">{{__('general.confirm-password')}}</label>
					            <div class="col-sm-10">
					                <input  id="confirm_password"
					                        name="confirm_password"
					                        value = ""
					                        type="password"
					                        placeholder = ""
					                        class="form-control">
					            </div>
					        </div>
					        <div class="form-group row">
					            <label class="col-sm-2 form-control-label"></label>
					            <div class="col-sm-10">
					                <button type="submit" class="btn btn-primary"> <fa class="fa fa-cog"></i> {{__('general.change')}} </button>
					                
					            </div>
					        </div>
					    </form> -->
					</div>
					<!-- Content -->
        
@endsection