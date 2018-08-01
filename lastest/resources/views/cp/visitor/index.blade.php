@extends($route.'.main')
@section ('section-title', 'Visitor')
@section ('hide-btn-back', 'display:none')
@section ('section-css')

@endsection
@section ('section-js')

	
@endsection

@section ('section-content')
	<div class="row">
        <div class="col-sm-6">
            <article class="statistic-box red">
                <div>
                    <div class="number">{{ $today_data }}</div>
                    <div class="caption"><div>Today</div></div>
                    <div class="percent">
                       
                    </div>
                </div>
            </article>
        </div><!--.col-->
       
        <div class="col-sm-6">
            <article class="statistic-box yellow">
                <div>
                    <div class="number">{{ $data }}</div>
                    <div class="caption"><div>All Visitor</div></div>
                    <div class="percent">
                       
                    </div>
                </div>
            </article>
        </div><!--.col-->
       
    </div><!--.row-->
@endsection