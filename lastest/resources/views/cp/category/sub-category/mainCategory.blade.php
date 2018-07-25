@extends('cp.category.sub-category.tabForm')
@section ('section-title', 'Size')
@section ('tab-active-sub-category', 'active')
@section ('about-active-main-category', 'active')


@section ('imageuploadjs')
   
@endsection

@section ('tab-js')
	<script type="text/javascript">
		function showIsDelete(id){
			active = 0;
			$.ajax({
			        url: "{{ route('cp.category.sub-category.update-main-category-delete-status') }}",
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
@endsection

@section ('about')
	<br />
	<div>
		<div class="col-md-12">
			<a style="float: right;margin-bottom: 10px;margin-top: -10px;" href="{{ route('cp.category.sub-category.create-mainCategory',['id'=>$id, 'subcategory_id'=>$subcategory_id]) }}"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-plus"></span></a>
		</div>
	</div><!--.row-->
	@if(count($data)>0)
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name in Khmer</th>
					<th>Name in English</th>
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
						<td>{{ $row->kh_name }}</td>
						<td>{{ $row->en_name }} </td>
						@if(Auth::user()->position_id == 1)
							<td>@if($row->updater != '') {{ $row->creator->name }}  @else no Creator @endif</td>
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
	                           		<a href="{{ route('cp.category.sub-category.edit-mainCategory', ['category_id'=>$id,'subcategory_id'=>$subcategory_id,'maincategory_id'=>$row->id]) }}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a>
	                           		

	                           		@if(Auth::user()->position_id == 1)
	                           			<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.delete-mainCategory', $row->id) }}', '{{ route('cp.category.sub-category.mainCategory',['category_id'=>$id,'subcategory_id'=>$subcategory_id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
	                           		@else
		                           		<a href="#" onclick="deleteConfirm('{{ route('cp.category.sub-category.trash-mainCategory', $row->id) }}', '{{ route('cp.category.sub-category.mainCategory',['category_id'=>$id,'subcategory_id'=>$subcategory_id]) }}')" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none;"><span class="glyphicon glyphicon-trash"></span></a>
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
	No Data
	@endif
@endsection