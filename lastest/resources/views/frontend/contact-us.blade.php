@extends('frontend/layouts.master')

@section('title', 'Contact Us')
@section('contact-us', 'active')

@section ('appbottomjs')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyBbz45_RGsB8xrJtKSgdnL8jJTw0dX-nNw"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>    
    <script>
    $(document).ready(function() {
      $("#contact-form").submit(function(event){
        name = $("#name").val();
        phone = $("#phone").val();
        subject = $("#subject").val();
        message = $("#message").val();
        g =$('#g-recaptcha-response').val();
        
        if(name != ""){
            
                if(phone != 0){
                if(message != ""){
                  // if(g != ""){
                  //   //alert('Go!');
                  // }else{
                  //   error(event, "g-recaptcha-response", '{{ __('general.errorrecaptcha') }}');
                  // }
         
                }else{
                  error(event, "message", '{{ __('general.errormessage') }}');
                }
                }else{
                  error(event, "phone", '{{ __('general.errorphone') }}');
                }
              
        }else{
          error(event, "name", '{{ __('general.errorname') }}');
        }
      })

      // @if(Session::has('msg'))
      //   toastr.success("{{ __('general.contact-successful-sent') }}");
      // @endif
      // @if (count($errors) > 0)
      //   toastr.warning("{{ __('general.sorry') }}");
      // @endif

    });
    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    function error(event, obj, msg){
      event.preventDefault();
      toastr.error(msg);
      $("#"+obj).focus();
    }
   
  </script>
@endsection

@section ('content')
<!-- Main Content -->
    <main class="main-content">

        <!-- Contant Holder -->
        <div class="tc-padding">
            <div class="container">

                <!-- Address Columns -->
                <div class="tc-padding-bottom">
                    <div class="row">
                
                        <!-- Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="address-column">
                                <span class="address-icon"><i class="fa fa-map-marker"></i></span>
                                <h6>{{__('general.address')}}</h6>
                                <strong>@if($defaultData['address']) {{$defaultData['address']->content}} @endif </strong>
                                
                            </div>
                        </div>
                        <!-- Column -->

                        <!-- Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="address-column">
                                <span class="address-icon"><i class="fa fa-volume-control-phone"></i></span>
                                <h6>{{__('general.phone')}}</h6>
                                <strong>@if($defaultData['phone']) {{$defaultData['phone']->content}} @endif</strong>
                            </div>
                        </div>
                        <!-- Column -->

                        <!-- Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="address-column">
                                <span class="address-icon"><i class="fa fa-envelope"></i></span>
                                <h6>{{__('general.email')}}</h6>
                                <strong>@if($defaultData['email']) {{$defaultData['email']->content}} @endif</strong>
                                
                            </div>
                        </div>
                        <!-- Column -->

                        <!-- Column -->
                        <div class="col-lg-3 col-xs-6 r-full-width">
                            <div class="address-column">
                                <span class="address-icon"><i class="fa fa-share-alt"></i></span>
                                <h6>{{__('general.follow-us')}}</h6>
                                <ul class="social-icons">
                                    <li><a target="_blank" class="facebook" href="https://www.facebook.com/%E1%9E%94%E1%9E%8E%E1%9F%92%E1%9E%8E%E1%9E%B6%E1%9E%82%E1%9E%B6%E1%9E%9A-%E1%9E%81%E1%9F%81%E1%9E%98%E1%9E%9A%E1%9E%B6%E1%9E%9A%E1%9E%9F%E1%9F%92%E1%9E%98%E1%9E%BE-520399685084750/?modal=admin_todo_tour"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
                                </ul>
                               
                            </div>
                        </div>
                        <!-- Column -->

                    </div>
                </div>
                <!-- Address Columns -->

                <!-- Contact Map -->
                <div class="tc-padding-bottom">
                    <iframe
                              width="100%"
                              height="500"
                              frameborder="0" style="border:0"
                              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCOVmFlwfcjVJE1mgzI69HIOnIwLYEW1OM
                                &q=Khemara+Raksmey+Book+Center" allowfullscreen>
                            </iframe>
                </div>
                <!-- Contact Map -->

                <!-- Form -->
                <div class="form-holder">

                    <!-- Secondary heading -->
                    <div class="sec-heading">
                        <h3>{{__('general.contact-form')}}</h3>
                    </div>
                    <!-- Secondary heading -->

                    <br />
                    @if (count($errors) > 0)
                        <div class="form-error-text-block" style="background: #f5cdd9;padding: 21px;">
                            <h2 style="color:red"> Error Occurs</h2>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br />
                    <!-- Sending Form -->
                    <form id="contact-form" name="contact-form" class="sending-form" action="{{ route('submit-contact', ['locale'=>$locale]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input name="name" id="name" class="form-control" required="required" placeholder="{{__('general.full-name')}}">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input pattern="[0-9]*" name="phone" id="phone" class="form-control" required="required" placeholder="{{__('general.phone')}}">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <input id="email" name="email" class="form-control" required="required" placeholder="{{__('general.email')}}">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div> -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" required="required" rows="5" placeholder="{{__('general.text-here')}}"></textarea>
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                            </div>
                            <!-- <div class="col-sm-3">
                               <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6LezjGAUAAAAAO9c9Z9vR9UFtreVxfIT9urAgTM9"></div>
                               </div>
                            </div> -->
                            <div class="col-xs-12">
                                <button class="btn-1 shadow-0 sm">{{__('general.send-message')}}</button>
                            </div>
                        </div>
                    </form>
                    <!-- Sending Form -->

                </div>
                <!-- Form -->

            </div>
        </div>
        <!-- Contant Holder -->

    </main>
    <!-- Main Content -->
@endsection