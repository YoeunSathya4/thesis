@extends($route.'.main')
@section ('section-title', 'All Orders')
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
			restaurant 	= $('#restaurant_id').val();
			category	= $('#category_id').val();
			type 	= $('#type_id').val();
			d_from 		= $('#from').val();
			d_till 		= $('#till').val();
			limit 		= $('#limit').val();

			url="?limit="+limit;
			if(key!=""){
				url+='&key='+key;
			}
			if(isDate(d_from)){
				if(isDate(d_till)){
					url+='&from='+d_from+'&till='+d_till;
				}
			}
			$(location).attr('href', '{{ route($route.'.all-order') }}'+url);
		}

	function orderData(id){
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

@section ('section-content')

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-3">
		<div class="form-group">
			
			<input  type="text" class="form-control" id="key" placeholder="Invoice ID or Payment ID" value="{{ isset($appends['key'])?$appends['key']:'' }}">
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group">
				<div id="from-cnt" class='input-group date'>
					<input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
				<span class="input-group-addon">
					<i class="font-icon font-icon-calend"></i>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group">
				<div id="till-cnt" class='input-group date ' >
					<input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''}}" placeholder="Till" />
					<span class="input-group-addon">
						<i class="font-icon font-icon-calend"></i>
					</span>
				</div>
			</div>
		</div>
	<div class="col-xs-12 col-sm-6 col-md-3">
		<button id="btn-search" class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
	</div>
</div>

@if(sizeof($data) > 0)
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Invoice ID</th>
				<th>Payment ID</th>
				<th>Customer</th>
				<th>Product</th>
				<th>Quatity</th>
				<th>Price</th>
				<th>Total Price</th>
				<th></th>
				
			</tr>
		</thead>
		<tbody>
			@php($total_amount = 0)
			@php ($i = 1)
			@foreach ($data as $row)
				<tr>
					<td>{{ $i++ }}</td>
					<td>00000{{ $row->id }}</td>
					<td>{{ $row->payment_id }}</td>
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
					<td>
						<ul>
							@foreach($details as $detail)
							@php($total_amount += $detail->unit_price * $detail->qty)
							<li>{{$detail->unit_price * $detail->qty}} $</li>
							@endforeach
						</ul>
					</td>
					<td><a href="{{route('cp.order.all-order-detail',$row->id)}}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a></td>
				</tr>
				
			@endforeach
				<tr class="no-line">
					<td colspan="6" style="text-align: right;border:0px solid black;"></td>
					<td>You have to Paid</td>
					<td>$ {{$total_amount}}</td>
				</tr>
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