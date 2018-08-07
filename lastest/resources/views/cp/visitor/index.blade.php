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
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div id="from-cnt" class='input-group date'>
                    <input id="from" type='text' class="form-control" value="{{ isset($appends['from'])?$appends['from']:'' }}" placeholder="From" />
                <span class="input-group-addon">
                    <i class="font-icon font-icon-calend"></i>
                </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <div id="till-cnt" class='input-group date' >
                    <input id="till" type='text' class="form-control" value="{{ isset($appends['till'])?$appends['till']:''  }}" placeholder="Till" />
                    <span class="input-group-addon">
                        <i class="font-icon font-icon-calend"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <button onclick="search()"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-search"></span></button>
        </div>
    </div><!--.row-->
                
        
    <div class="table-responsive">
        <table id="table-edit" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date & Time</th>
                    <th>Broswer</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>

                @php ($i = 1)
                @foreach ($visitors as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->broswer }}</td>
                        <td>{{ $row->ip }}</td>
                    </tr>
                
                @endforeach
                
                
            </tbody>
        </table>

    </div >
    
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

            {{ $visitors->appends($appends)->links('vendor.pagination.custom-html') }}
        </div>
    </div>
    
  
@endsection