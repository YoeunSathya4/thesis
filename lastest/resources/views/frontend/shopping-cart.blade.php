@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Sign Up')
@section('register', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
     @if(Session::has('cart'))

         <div style="padding-top: 50px;" class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{__('general.shopping-cart')}}</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>{{__('general.item')}}</strong></td>
                                    <td class="text-center"><strong>{{__('general.price')}}</strong></td>
                                    <td class="text-center"><strong>{{__('general.quantity')}}</strong></td>
                                    <td class="text-right"><strong>{{__('general.total')}}</strong></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                @foreach( $products as $product)
                                <tr>
                                    <td>{{$product['item'][$locale.'_name']}}</td>
                                    <td class="text-center">${{$product['price']}}</td>
                                    <td class="text-center">
                                       
                                    </td>
                                    <td class="text-center">
                                         <a href="{{route('reduce',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-minus"></i></a>
                                        {{$product['qty']}}
                                        <a href="{{route('plus',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                    </td>

                                    <td class="text-right">${{$product['price'] }}</td>
                                    <td class="text-center">
                                        <!-- <a href="{{route('reduce',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-danger">{{__('general.remove')}}</a> -->
                                         <a href="{{route('remove',['locale'=>$locale, 'id'=>$product['item']['id']])}}" type="button" class="btn btn-danger">{{__('general.remove-all')}}</a>
                                    </td>
                                </tr>
                                @endforeach

                                
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>{{__('general.total')}}</strong></td>
                                    <td class="no-line text-right">${{$totalPrice}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong></strong></td>
                                    <td class="no-line text-right"><a href="{{route('checkout',$locale)}}" type="button" class="btn btn-success">{{__('general.check-out')}}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div  class="row">
            <div style="float: right;" class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                
            </div>
        </div>
     @else

        <div style="padding-top: 50px;" class="row">
            <div style="text-align: center;" class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>{{__('general.no-items-in-cart')}}!</h2>
            </div>
        </div>

     @endif

   
      
@endsection