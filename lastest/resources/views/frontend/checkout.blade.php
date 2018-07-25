@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Checkout')
@section('register', 'active')

@section ('appbottomjs')
<script src="https://js.stripe.com/v2/"></script>
<script src="{{asset('public/frontend/js/checkout.js')}}"></script>

@endsection

@section ('content')
    
<div style="padding-top: 20px" class="container">
    <div class=" panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{__('general.favorite-product')}}</strong></h3><br>
            <h4>{{__('general.your-total')}}: $ {{$total}}</h4>
        </div>
        <div class="panel-body">
            <div id="charge-error" class="alert alert-danger" {{ !Session::has('error') ? 'hidden' : '' }}>
                {{Session::get('error')}}
            </div>
            <form action="{{route('checkouts',$locale)}}" method="post" id="checkout-form">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="en_name">{{__('general.name')}}</label>
                    <div class="col-sm-10">
                        <input  id="name"
                                name="name"
                                value = ""
                                type="text"
                                placeholder = "{{__('general.ex')}}. {{__('general.sovan')}}"
                                class="form-control">
                    </div>
                </div> -->
                <!-- <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="address">{{__('general.address')}}</label>
                    <div class="col-sm-10">
                        <input  id="address"
                                name="address"
                                value = ""
                                type="text"
                                placeholder = "{{__('general.ex')}}. #7A,street 428 Sangkat Boeng Trabeak, Khan Chamkamorn, Phnom Penh"
                                class="form-control">
                    </div>
                </div> -->

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="card-name">{{__('general.card-holder-name')}}</label>
                    <div class="col-sm-10">
                        <input  id="card-name"
                                name="card-name"
                                value = ""
                                type="text"
                                placeholder = "Enter your Card name"
                                class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="card-number">{{__('general.credit-card-number')}}</label>
                    <div class="col-sm-10">
                        <input  id="card-number"
                                name="card-number"
                                value = ""
                                type="text"
                                placeholder = "ex: 42424242424242"
                                class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="card-expiry-month">{{__('general.expiration-month')}}</label>
                    <div class="col-sm-10">
                        <input  id="card-expiry-month"
                                name="card-expiry-month"
                                value = ""
                                type="text"
                                placeholder = "ex: 04"
                                class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="card-expiry-year">{{__('general.expiration-year')}}</label>
                    <div class="col-sm-10">
                        <input  id="card-expiry-year"
                                name="card-expiry-year"
                                value = ""
                                type="text"
                                placeholder = "ex: 22"
                                class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="card-cvc">CVC</label>
                    <div class="col-sm-10">
                        <input  id="card-cvc"
                                name="card-cvc"
                                value = ""
                                type="text"
                                placeholder = "ex: 123"
                                class="form-control">
                    </div>
                </div>
                <button style="float: right;" type="submit" class="btn btn-success">{{__('general.buy-now')}}</button>
            </form>
        </div>
    </div>
</div>
    @if(!Auth::guard('customer')->user())
        <script type="text/JavaScript">
        window.location.replace('{{ route('login',$locale) }}');
        </script>
    @endif

      
@endsection