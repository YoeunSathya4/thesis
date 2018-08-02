@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Checkout')
@section('register', 'active')

@section ('appbottomjs')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{asset('public/frontend/js/checkout.js')}}"></script>

@endsection

@section ('content')
    
<div style="padding-top: 20px;padding-bottom: 100px;" class="container">
    <div class=" panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{__('general.thank')}}</strong></h3><br>
        </div>
        <div class="panel-body">
           <div class="alert alert-success" role="alert">
                {{__('general.well-done')}} <a style="font-size: 23px;
    color: #ee383a;" href="{{route('order-history',$locale)}}"> <b> {{__('general.click-to-see-invoice')}} </b></a>
            </div>
        </div>
    </div>
</div>
    @if(!Auth::guard('customer')->user())
        <script type="text/JavaScript">
        window.location.replace('{{ route('login',$locale) }}');
        </script>
    @endif

      
@endsection