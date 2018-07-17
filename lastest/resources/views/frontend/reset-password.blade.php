@extends('frontend/layouts.master')

@section('title', 'KHEMARAKSMEY | Reset Password')
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
                                <strong style="padding-left: 40%;">Reset Password</strong>
                               @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('reset', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <input class="form-control" required="required" name="email" placeholder="Email Address">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" required="required" placeholder="Password">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password_confirmation" required="required" placeholder="Confirmed Password">
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <p class="terms">Back To <a href="{{ route('login', $locale) }}"> Login</a></p>
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