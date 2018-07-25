@extends('cp/layouts.app')
@section('active-main-menu-dashboard', 'opened')
@section('title')
	Dashboard: @yield('section-title')
@endsection

@section ('appheadercss')
	@yield('section-css')
@endsection


@section ('appbottomjs')
	@yield('section-js')
@endsection

@section ('page-content')
	<header class="page-content-header">
		<div class="container-fluid">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Dashboard</h3> 
					</div>
					
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid">

		<div class="box-typical box-typical-padding">
			
			@yield('section-content')
		</div>	
	</div>

@endsection