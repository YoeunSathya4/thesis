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
                                <strong style="padding-left: 40%;padding-top: 10px;">{{__('general.verify-code')}}</strong>
                               @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form style="padding: 20px;" action="{{ route('submit-code', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control" type="text" required="required" name="code" placeholder="{{__('general.code')}}">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    
                                    <p class="terms">{{__('general.back-to')}} <a href="{{ route('login', $locale) }}"> {{__('general.login')}}</a></p>
                                    <button type="submit" class="btn-1 shadow-0 full-width">{{__('general.verify-now')}}</button>
                                </form>
                            </div>
                    </div>
                    <div class="col-sm-3">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Contant Holder -->  
        @if(Auth::guard('customer')->user())
        <script type="text/JavaScript">
        window.location.replace('{{ route('profile',$locale) }}');
        </script>
         @endif
      
@endsection