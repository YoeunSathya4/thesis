@section('product-search')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-search").submit(function(e){
              e.preventDefault();
              search();
            })
        })
          function search(){
            key    = $("#key").val();
            min     = $('#min').val();
            max     = $('#max').val();

            limit     = 10;

            url="?limit="+limit;
            
            if(key != ""){
              url += '&key='+key;
            }
            if(min != ""){
              url += '&min='+min;
            }
            if(max != ""){
              url += '&max='+max;
            }

            
            
            $(location).attr('href', '{{ route('search-product',$locale) }}'+url);
          }
    </script>
    <style type="text/css">
        input[type="text"]#text-color::-webkit-input-placeholder {
              color: #fff;
            }
    </style>
@endsection

    
<section class="book-collection">
            <div class="container">
                <div class="row">
                        <div class="col-xs-12">
                           <div class="collection">

                                <!-- Secondary heading -->
                                <div class="sec-heading">
                                    <h3>{{__('general.search-product')}}</h3>
                                </div>
                                <!-- Secondary heading -->



                                <div style=" padding: 21px; background: #283891;border-radius: 11px;" class="row">
                                    <form style="padding-left: 40px;" id="frm-search" name="form">
                                    

                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                
                                                <input style="color: white;border: 1px solid #fff;"  type="text" class="form-control" id="key" placeholder="{{__('general.key')}}" value="{{isset($appends['key'])?$appends['key']:''}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                
                                                <input  style="color: white;border: 1px solid #fff;" type="text" class="form-control" id="min" placeholder="{{__('general.minimun-price')}}" value="{{isset($appends['min'])?$appends['min']:''}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                
                                                <input style="color: white;border: 1px solid #fff;" type="text" class="form-control" id="max" placeholder="{{__('general.maximun-price')}}" value="{{isset($appends['max'])?$appends['max']:''}}">
                                            </div>
                                        </div>
                                        <div class="ccol-xs-12 col-sm-12 col-md-3">
                                            <button id="btn-search" class="tabledit-delete-button btn btn btn-primary" style="float: none;    width: 50px;height: 48px;"><span class="fa fa-search"></span></button>
                                        </div>
                                    </form>
                                </div>

                        </div>
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>