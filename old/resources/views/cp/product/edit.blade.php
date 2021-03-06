@extends($route.'.main')
@section ('section-title', 'Edit Product')
@section ('section-css')
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
	</style>
@endsection

@section ('imageuploadjs')
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset ('public/cp/js/plugin/fileinput/theme.js') }}" type="text/javascript"></script>
@endsection

@section ('section-js')

	<script type="text/JavaScript">
		$(document).ready(function(event){
		
			$('#form').validate({
				modules : 'file',
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			}); 

			$("#category_id").change(function(){
				getSubCategory($(this).val());
				$("#subcategory_id").html('<option id="0" >Select Sub Category</option>');
			})
			$("#subcategory_id").change(function(){
				getMainCategory($(this).val());
				$("#maincategory_id").html('<option id="0" >Select Main Category</option>');
			})
		}); 
		
		function getSubCategory(category_id){
			
			//Get Districts
			$.ajax({
			        url: "{{ route($route.'.get-sub-category') }}?category_id="+category_id,
			        type: 'GET',
			        data: {},
			        success: function( response ) {
			           $("#subcategory-cnt").html(response) 
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
						
			});
		}

		function getMainCategory(subcategory_id){
			
			//Get Districts
			$.ajax({
			        url: "{{ route($route.'.get-main-category') }}?subcategory_id="+subcategory_id,
			        type: 'GET',
			        data: {},
			        success: function( response ) {
			           $("#maincategory-cnt").html(response) 
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
						
			});
		}
	</script>
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
		    defaultPreviewContent: '<img src="{{ asset('public/uploads/product/image/'.$data->image) }}" alt="Missing Image" class="img img-responsive"><span class="text-muted">Click to select <br /><i style="font-size:12px">Image dimesion must be 870x429 with .jpg or .png type</i></span>',
		    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		    allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
@endsection

@section ('section-content')
	@include('cp.layouts.error')
	<form id="form" action="{{ route($route.'.update') }}" name="form" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('POST') }}
		<input type="hidden" name="id" value="{{ $data->id }}">
		<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Category</label>
				<div class="col-sm-10">
					<select id="category_id" name="category_id" class="select2 select2-hidden-accessible" class="form-control">
						<option value="0" >Select Your Category</option>
							
						@foreach( $categories as $row )
								
								<option value="{{ $row->id }}" @if($data->category_id == $row->id) selected @endif>{{ $row->en_name }} ({{$row->kh_name}})</option>
							
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Sub Category</label>
				<div class="col-sm-10" id="subcategory-cnt">
					<select id="subcategory_id" name="subcategory_id" class="form-control">
						<option value="{{$data->sub_category_id}}"  >{{$sub_category->en_name}}  ({{$sub_category->kh_name}})</option>
						<option value="0"  >Please Select Category First</option>
						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="type_id" class="col-sm-2 form-control-label">Main Category</label>
				<div class="col-sm-10" id="maincategory-cnt">
					<select id="maincategory_id" name="maincategory_id" class="form-control">
						@if($data->sub_sub_category_id != null)
						<option value="{{$data->sub_sub_category_id}}"  >{{$main_category->en_name}} ({{$main_category->kh_name}})</option>
						<option value="0" >Please Select Sub Category First</option>
						@else
						<option value="0" >Please Select Sub Category First</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_name">Code</label>
				<div class="col-sm-10">
					<input 	id="code"
							name="code"
						   	value = "{{$data->code}}"
						   	type="text"
						   	placeholder = "Enter Product Code"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 1 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
		<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_name">Name (KH)</label>
				<div class="col-sm-10">
					<input 	id="kh_name"
							name="kh_name"
						   	value = "{{$data->kh_name}}"
						   	type="text"
						   	placeholder = "Enter Khmer name."
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_name">Name (EN)</label>
				<div class="col-sm-10">
					<input 	id="en_name"
							name="en_name"
						   	value = "{{$data->en_name}}"
						   	type="text"
						   	placeholder = "Enter English name."
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 6 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="unit_price">Unit Price</label>
				<div class="col-sm-10">
					<input 	id="unit_price"
							name="unit_price"
						   	value = "{{$data->unit_price}}"
						   	type="number"
						   	placeholder = "Enter Product Unit Price"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 1 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="product_qty">Quatity</label>
				<div class="col-sm-10">
					<input 	id="product_qty"
							name="product_qty"
						   	value = "{{$data->product_qty}}"
						   	type="number"
						   	placeholder = "Enter Product Quatity"
						   	class="form-control"
						   	data-validation="[L>=1, L<=200]"
							data-validation-message="$ must be between 1 and 18 characters. No special characters allowed." />
							
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_description">Description (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-2">
						<textarea id="kh_description" name="kh_description" class="form-control ">{{$data->kh_description}} </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_description">Description (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-2">
						<textarea id="en_description" name="en_description" class="form-control ">{{$data->en_description}} </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Content (KH)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="kh_content" name="kh_content" class="form-control  summernote  ">{{$data->kh_content}} </textarea>
					</div>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="en_content">Content (EN)</label>
				<div class="col-sm-10">
					<div class="summernote-theme-1">
						<textarea id="en_content" name="en_content" class="form-control  summernote  "> {{$data->en_content}}</textarea>
					</div>	
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="email">Image</label>
				<div class="col-sm-10">
					<div class="kv-avatar center-block">
				        <input id="image" name="image" type="file" class="file-loading">
				    </div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Published</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input id="status-status" type="checkbox"  @if($data->is_published ==1 ) checked @endif >
						<label onclick="booleanForm('status')" for="status-status"></label>
					</div>
					<input type="hidden" name="status" id="status" value="{{ $data->is_published }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label" for="kh_content">Featured</label>
				<div class="col-sm-10">
					<div class="checkbox-toggle">
						<input id="featured-featured" type="checkbox" @if($data->is_featured ==1 ) checked @endif >
						<label onclick="booleanForm('featured')" for="featured-featured"></label>
					</div>
					<input type="hidden" name="featured" id="featured" value="{{ $data->is_featured }}">
				</div>
			</div>
		
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-success"> <fa class="fa fa-cog"></i> Update</button>
				<button type="button" onclick="deleteConfirm('{{ route($route.'.trash', $data->id) }}', '{{ route($route.'.index') }}')" class="btn btn-danger"> <fa class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</form>
@endsection