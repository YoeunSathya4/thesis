@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Login')
@section('login', 'active')

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
                                <strong style="padding-left: 40%;padding-top: 10px;">{{__('general.login')}}</strong>
                               @if ($errors->has('phone'))
                                    <div style="max-width: 322px; margin: 0 auto">
                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            {{ $errors->first('phone') }}
                                        </div>  
                                    </div>
                                <?php endif; ?>
                                <form style="padding: 20px;" action="{{ route('submit-login', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control" required="required" name="phone" placeholder="{{__('general.enter-your-phone-number')}}">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" required="required" placeholder="{{__('general.password')}}">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <p class="terms">{{__('general.not-yet-have-account')}} <a href="{{ route('sign-up', $locale) }}">{{__('general.sign-up')}}</a> | <a href="{{ route('forgot-password', $locale) }}">{{__('general.forgot-password')}}</a></p>
                                    <button type="submit" class="btn-1 shadow-0 full-width">{{__('general.login-account')}}</button>
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