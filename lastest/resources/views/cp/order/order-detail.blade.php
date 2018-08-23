@extends($route.'.main')
@section ('section-title', 'All Customers')

@section ('section-css')

@endsection
@section ('section-js')
	<script type="text/javascript">
	$(document).ready(function() {
			$("#btn-search").click(function(){
				search();
			})
			
		});
		

	

		
	</script>	
@endsection

@section ('section-content')

<form id="form" action="#" name="form" method="POST"  enctype="multipart/form-data">
	<div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Invoice ID</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "00000{{$data->id}}"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div>						
	<div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Customer</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "{{$data->customer->name}}"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Phone</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "{{$data->customer->phone}}"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Address</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "{{ $data->address }}"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div>
	<!-- <div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Delivery Time</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "{{ $data->delivery_time }}"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div> -->
	<div class="form-group row">
		<label class="col-sm-2 form-control-label" for="name">Discount</label>
		<div class="col-sm-10">
			<input 	id="name"
					name="name"
					disabled="" 
				   	value = "{{ $data->discount }} %"
				   	type="text"
				   	placeholder = ""
				   	class="form-control"
				   	data-validation="[L>=1, L<=200]"
					 />
					
		</div>
	</div>
</form>
<br>
<h2> <u>Order Detail</u></h2>
<br>
<div class="table-responsive">
	<table id="table-edit" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Unit Price ($)</th>
				<th>Quantity</th>
				<th>Price ($)</th>
			</tr>
		</thead>
		<tbody>
			@php($total_amount = 0)
			@php($sumExtra = 0)
			@php($total = 0)
			@php ($i = 1)
			@foreach ($details as $row)
			 	@php($total_amount += $row->unit_price * $row->qty)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$row->product->en_name}}</td>
					<td>{{ $row->unit_price }} $</td>
					<td>{{ $row->qty }}</td>
					<td>{{$row->unit_price * $row->qty}} $</td>
					
					
				</tr>

			@endforeach
			<tr>
				<td class="no-line" colspan="3" style="text-align: right; border:0px solid black;"></td>
				<td>Total in USD</td>
				<td>$ {{$total_amount + $sumExtra}}</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right;border:0px solid black;"></td>
				<td>Discount</td>
				<td>% {{$data->discount}}</td>
			</tr>
			<tr class="no-line">
				<td colspan="3" style="text-align: right;border:0px solid black;"></td>
				<td>You have to Paid</td>
				<td>$ 
					@if($data->discount==0) 
					{{$total_amount + $sumExtra}}
					@else
					@php($discountAmonut = $total_amount * $data->discount / 100)
					{{$total_amount + $sumExtra -  $discountAmonut }}
					@endif
				</td>
			</tr>
			
		</tbody>
	</table>
</div>

@endsection