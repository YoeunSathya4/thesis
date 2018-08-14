@extends($route.'.tab')
@section ('section-title', "Customer's order records")
@section ('tab-active-order', 'active')
@section ('tab-css')

@endsection

@section ('tab-js')
<script type="text/javascript">
	function orderDetail(id){
		$.ajax({
	        url: "{{ route($route.'.order-data') }}",
	        type: 'GET',
	        data: {id:id },
	        success: function( response ) {
	            $("#order-data-cnt").html(response) 
	        },
	        error: function( response ) {
	           swal("Error!", "Sorry there is an error happens. " ,"error");
	        }
	
		});
	}
</script>

@endsection

@section ('tab-content')
				
		
	<div class="table-responsive">
		<table id="table-edit" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Invoice ID</th>
					<th>Customer</th>
					<th>Product</th>
					<th>Quatity</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@php ($i = 1)
				@foreach ($data as $row)
					<tr>
					<td>{{ $i++ }}</td>
					<td>00000{{ $row->id }}</td>
					<td>{{$row->customer->name}}</td>
					<td >
						<ul>
							@php($details = $row->details)
							@foreach($details as $detail)
							<li>{{$detail->product->en_name}}</li>
							@endforeach
						</ul>
					</td>
					<td>
						<ul>
							@foreach($details as $detail)
							<li>{{$detail->qty}}</li>
							@endforeach
						</ul>
					</td>
					<td>
						<ul>
							@foreach($details as $detail)
							<li>{{$detail->unit_price}} $</li>
							@endforeach
						</ul>
					</td>
						<td><a href="#" onclick="orderDetail({{$row->id}})" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="modal" data-target="#orderDetail" style="float: none;"><span class="fa fa-eye"></span></a></td>
					</tr>
				
				@endforeach
				
				
			</tbody>
		</table>

	</div >
<!-- Modal -->
	<div id="orderDetail" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Order</h4>
	      </div>
	      <div class="modal-body">
	        		<div id="order-data-cnt" class="container-fluid">
						
						
					</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
@endsection