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
                                <strong style="padding-left: 40%;padding-top: 10px;">Login</strong>
                               @if ($errors->has('email'))
                                    <div style="max-width: 322px; margin: 0 auto">
                                        <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            {{ $errors->first('email') }}
                                        </div>  
                                    </div>
                                <?php endif; ?>
                                <form style="padding: 20px;" action="{{ route('submit-login', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control" required="required" name="email" placeholder="Email Address">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" required="required" placeholder="Password">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <p class="terms">Not yet have account <a href="{{ route('sign-up', $locale) }}">Sign Up</a> | <a href="{{ route('forgot-password', $locale) }}">Forgot Password</a></p>
                                    <button type="submit" class="btn-1 shadow-0 full-width">Login account</button>
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