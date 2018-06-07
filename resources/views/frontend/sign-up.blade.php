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
                                <strong style="padding-left: 40%;padding-top: 10px;">Sign Up</strong>
                               @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form style="padding: 20px;" action="{{ route('register', $locale) }}" method="POST" class="sending-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input class="form-control" type="text" required="required" name="name" placeholder="Enter Your Full Name">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" required="required" name="phone" placeholder="Phone Number EX: 09999999">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" required="required" name="email" placeholder="Email Address">
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
                                    <button type="submit" class="btn-1 shadow-0 full-width">Sign Up</button>
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