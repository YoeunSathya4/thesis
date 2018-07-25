@extends($route.'.main')
@section ('section-title', 'All Tracking')
@section ('display-btn-add-new', 'display:none')
@section ('section-css')



@endsection
@section ('section-js')
	<script type="text/javascript">
	$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
		});
		function search(){
			key 	= $('#key').val();
			user 	= $('#user_id').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();

			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(user != 0){
				url += '&user='+user;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			$(location).attr('href', '{{ route($route.'.index') }}'+url);
		}
		
			
	</script>	
@endsection

@section ('section-content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Key" value="{{ isset($appends['key'])?$appends['key']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-2">
		<div class="form-group">
			<select id="user_id" name="user_id" class="select2 select2-hidden-accessible" class="form-control">
				<option value="0" >Select Your User</option>
				@foreach( $users as $row )
						<option value="{{ $row->id }}" >{{ $row->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''  }}" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="ccol-xs-12 col-sm-12 col-md-3">
		<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
	</div>
</div>
@if(sizeof($data) > 0)
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>User</th>
				<th>Description</th>
				<th>Created Date</th>
			</tr>
		</thead>
		<tbody>
		
			
			@php ($i = 1)
			@foreach ($data as $row)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $row->user->name }}</td>
					<td>{{ $row->description }}</td>
					<td>{{ $row->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div >
@else
	<span>No Data</span>
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