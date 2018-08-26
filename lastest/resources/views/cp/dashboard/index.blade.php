@extends($route.'.main')

@section ('display-btn-add-new', 'display:none')
@section ('section-css')
	<link rel="stylesheet" href="{{ asset ('public/user/css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('public/user/css/main.css')}}">


@endsection
@section ('section-js')

	<script type="text/javascript" src="{{ asset ('public/user/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript" src="{{ asset ('public/user/js/lib/d3/d3.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset ('public/user/js/lib/charts-c3js/c3.min.js')}}"></script>
	

	
@endsection

@section ('section-content')

	<div class="container-fluid">
	        <div class="row">

	            <div class="col-xl-12">
	               
	                   <div class="row">

	                   	<div class="col-sm-3">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number">{{$today_customer}}</div>
	                                <div class="caption"><div>New Customer Today</div></div>
	                                <div class="percent">
	                                   
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-3">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number">{{$today_order}}</div>
	                                <div class="caption"><div>New Order Today</div></div>
	                                <div class="percent">
	                                   
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->

	                    <div class="col-sm-3">
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number">{{count($customers)}}</div>
	                                <div class="caption"><div>Total Customer</div></div>
	                                <div class="percent">
	                                   
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                   
	                    <div class="col-sm-3">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number">{{count($orders)}}</div>
	                                <div class="caption"><div>Total Order</div></div>
	                                <div class="percent">
	                                   
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <!-- <div class="col-sm-6">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number"> </div>
	                                <div class="caption"><div>Sell or Rent</div></div>
	                                <div class="percent">
	                                   
	                                </div>
	                            </div>
	                        </article>
	                    </div> -->

	                </div><!--.row-->
	               
	            </div><!--.col-->
	        </div>

	        <div class="row">
	            <div class="col-xl-12">
	                <section class="box-typical box-typical-dashboard panel panel-default">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">New Order <span class="label label-pill label-danger">{{count($new_orders)}}</span></h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th align="center"><div>N</div></th>
	                                <th align="center"><div>Customer Name</div></th>
	                                <th align="center"><div>Phone</div></th>
	                                <th align="center"><div>Address</div></th>
	                                <th align="center"> </th>
	                            </tr>
	                            @php($i = 1)
	                            @foreach($new_orders as $row)
	                            <tr>
	                            	<td align="center">{{$i++}}</td>
	                                <td align="center">{{$row->customer->name}}</td>
	                                <td align="center"> 
	                                    {{$row->customer->phone}}
	                                </td>
	                                <td align="center">{{$row->customer->address}}</td>
	                                <td align="center"> <a href="{{route('cp.order.all-order-detail',$row->id)}}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none;"><span class="fa fa-eye"></span></a> </td>
	                            </tr>
	                            @endforeach
	                            
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->

	        </div><!--.row-->
	
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Top 4 Product</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th align="center"><div>N</div></th>
	                                <th align="center"><div>Name</div></th>
	                                <th align="center"><div>Image</div></th>
	                                <th align="center"><div>Amount Sell</div></th>
	                            </tr>
	                            @php($i = 1)
	                            @foreach($top_products as $row)
	                            <tr>
	                            	<td align="center">{{$i++}}</td>
	                                <td align="center">{{$row->en_name}}</td>
	                                <td class="table-photo"> 
	                                    <img style="width: 50px;" src="{{ asset ('public/uploads/product/image/'.$row->image) }}" data-toggle="tooltip" data-placement="bottom" alt="">
	                                </td>
	                                <td align="center">{{$row->num_top_products}}</td>
	                            </tr>
	                            @endforeach
	                            
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	                
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">user activities</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <div class="contact-row-list">
	                        	@foreach($trackings as $row)
	                            <article class="contact-row">
	                                <div class="user-card-row">
	                                    <div class="tbl-row">
	                                        <div class="tbl-cell tbl-cell-photo">
	                                           
	                                                <img src="{{ asset ('public/uploads/user/image/'.$row->user->avatar) }}" alt="">
	                                            
	                                        </div>
	                                        <div class="tbl-cell">
	                                            <p class="user-card-row-name">{{$row->user->name}} : {{$row->description}}</p>
	                                        </div>
	                                        
	                                    </div>
	                                </div>
	                            </article>
	                            @endforeach
	                        </div>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	        </div>
	    </div><!--.container-fluid-->
@endsection