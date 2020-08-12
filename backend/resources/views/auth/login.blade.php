@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                    @endif
                    <form  id="login_form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>
                            <div class="login-logo">
                                <a href="#">
                                    {{ trans('global.site_title') }}
                                </a>
                            </div>
                        </h1>
                        <p class="text-muted">{{ trans('global.login') }}</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <lable id="is_exists" class="is_exists"></lable>
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input name="email" type="text" class="form-control" onblur="duplicateEmail(this)" placeholder="{{ trans('global.login_email') }}">
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input name="password" type="password" class="form-control" placeholder="{{ trans('global.login_password') }}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="submit" class="btn btn-primary px-4 login-btn" value='{{ trans("global.login") }}'>
                                <label class="ml-2">
                                    <input name="remember" type="checkbox" /> {{ trans('global.remember_me') }}
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/admin/jquery.min.js') }}"></script>
 <script src="{{ asset('js/admin/jquery.validate.min.js') }}"></script>
<script>
     // Jquery validations for login form
     $(document).ready(function(){
        $('#login_form').validate({

          rules: {
            "email": {
                required : true,
                email : true
            },
            "password": 'required',
          },
          messages: {
            email: {
                required : "Please enter an email id.",
                email : "Please enter a valid email id."
            },
            password: 'Please enter password.',
          },
          submitHandler: function(form) {
                form.submit();
          }
        });
     });
function duplicateEmail(element){
  var email = $(element).val();
  console.log(email);
  $.ajax({
      type: "POST",
      url: 'checkemail',
      data: {
        email:email,
         "_token": "{{ csrf_token() }}",
      },
      dataType: "json",
      success: function(res) {
        console.log(12, res);
          if(res.exists){
            console.log('yes')
              $('#is_exists').text('');
              $("input.login-btn").attr("disabled", false);
          }else{
            console.log('no')
              $('#is_exists').text('This email is not register with us');
              $("input.login-btn").attr("disabled", true);
              // $('#email-error').html('');
          }
      },
      error: function (jqXHR, exception) {

      }
  });
}

</script>
