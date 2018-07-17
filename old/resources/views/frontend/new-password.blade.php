@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Sign Up')
@section('register', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
     <!-- Contant Holder -->
        <div class="tc-padding">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-3">
                        
                    </div>
                    <div class="col-sm-6">
                            <div class="modal-content">
                                <strong style="padding-left: 40%;padding-top: 10px;">{{__('general.change-password')}}</strong>
                               @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form style="padding: 20px;" action="{{ route('submit-new-password', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control" type="password" required="required" name="password" placeholder="{{__('general.enter-new-password')}}">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    
                                    
                                    <button type="submit" class="btn-1 shadow-0 full-width">{{__('general.change')}}</button>
                                </form>
                            </div>
                    </div>
                    <div class="col-sm-3">
                       
                    </div>
                </div>
            </div>
        </div>

      
@endsection