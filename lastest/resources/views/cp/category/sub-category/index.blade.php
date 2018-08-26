@extends('cp.category.tab')
@section ('section-title', 'Category')
@section ('tab-active-sub-category', 'active')

@section ('tab-js')
<script type="text/javascript">
	function search(){
		
		key 	= $('#key').val();
		category_id 	= $('#category_id').val();
		limit 	= $('#limit').val();

		url="?limit="+limit;
		if(category_id!=0){
			url=url+"category_id="+category_id;
		}
		if(key!=""){
			url=url+"&key="+key;
		}
		$(location).attr('href', '{{ route('cp.category.sub-category.index', $id) }}'+url);
	}

	function showIsDelete(id){
			active = 0;
			$.ajax({
			        url: "{{ route('cp.category.sub-category.update-sub-category-delete-status') }}",
			        method: 'POST',
			        data: {id:id, active:active },
			        success: function( response ) {
			            if ( response.status === 'success' ) {
			            	swal("Nice!", response.msg ,"success");
			            	location.reload();
			            }else{
			            	swal("Error!", "Sorry there is an error happens. " ,"error");
			            }
			        },
			        error: function( response ) {
			           swal("Error!", "Sorry there is an error happens. " ,"error");
			        }
				});
		}
	
</script>

@section ('tab-content')
	

	<div class="row">

		<div class="col-md-3">
			<input type="text" placeholder="Sub Category name" id="key" class="form-control" value="{{isset($_GET['key'])?$_GET['key']:''}}" />
		</div>
		
		
		<div class="col-md-3">
			<button onclick="search()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
			<a href="{{ route('cp.category.sub-category.create', ['id'=>$id]) }}" class="tabledit-delete-button btn btn-sm btn-primary" ><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	<br />
	
	@if(sizeof($data) > 0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name in Khmer</th>
					<th>Name in English</th>
					<th>Image</th>
					@if(Auth::user()->position_id == 1)
						<th>Created By</th>
						<th>Created By</th>
						<th>Updated By</th>
						@endif
					<th>Updated Date</th>
					@if(Auth::user()->position_id == 1)
					<th>Delete By</th>
					<th>Delete Date</th>
					@endif
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{$row->kh_name}}</td>
						<td>{{$row->en_name}}</td>
						

						<td>
							@if($row->image!="")
								<img src="{{asset('public/uploads/subcategory/image/'.$row->image)}}" class="img img-responsive" />
							@else
								No Image Avaiable
							@endif
						</td>
						@if(Auth::user()->position_id == 1)
							<td>{{ $row->creator->name }}</td>
							<td>{{ $row->created_at }}</td>
							<td>@if($row->updater != '') {{ $row->updater->name }} @else no updater @endif</td>
							@endif
						<td>{{ $row->updated_at }}</td>
						@if(Auth::user()->position_id == 1)
							<td>@if($row->deleter != '') {{ $row->deleter->name }} @else no deleter @endif</td>
							<td>{{ $row->deleted_at }}</td>
						@endif
						<td style="white-space: nowrap; width: 1%;">
							<div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
	                           	<div class="btn-group btn-group-sm" style="float: none;">
	                           		
	                           		<a href="{{ route('cp.category.sub-category.edit', ['id'=>$id, 'menu_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		
	                           		@if(Auth::user()->position_id == 1)
	                           			<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.delete', ['subcategory_id'=>$row->id]) }}', '{{ route('cp.category.sub-category.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		@else
		                           		<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash', ['subcategory_id'=>$row->id]) }}', '{{ route('cp.category.sub-category.index', ['id'=>$id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
		                           		@endif
		                           		@if(Auth::user()->position_id == 1)
		                           			@if($row->is_deleted == 1)
 											<button onclick="showIsDelete({{$row->id}})" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none;"> <span class="fa fa-check"></span> Restore</button>
 											@endif
		                           		@endif
	                           		
	                           	</div>
	                       </div>
	                    </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div >

	@else
	<span>No data</span>
	@endif
	<div class="row">
		<div class="col-xs-2">
			<select id="limit" onchange="search()" class="form-control" style="margin-top: 15px;width:50%">
				@if(isset($appends['limit']))
				<option>{{ $appends['limit'] }}</option>
				@endif
				<option>10</option>
				<option>20</option>
				<option>30</option>
				<option>40</option>
				<option>50</option>
				<option>60</option>
				<option>70</option>
				<option>80</option>
				<option>90</option>
				<option>100</option>
			</select>
		</div>
		<div class="col-xs-10">

			{{ $data->appends($appends)->links('vendor.pagination.custom-html') }}
		</div>
	</div>
@endsection