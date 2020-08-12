<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<style>
<link href="maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
.pass_show{position: relative} 
.pass_show .ptxt { 
position: absolute; 
top: 50%; 
right: 10px; 
z-index: 1; 
color: #f36c01; 
margin-top: -10px; 
cursor: pointer; 
transition: .3s ease all; 
} 

.pass_show .ptxt:hover{color: #333333;} 
	</style>
</head>
<h1 style="text-align: center">Change your password</h1>

<form action="{{ route('resetrequest') }}" method="POST" style="text-align: center">
	@csrf
<div class="container">
	<div class="row panel panel-default">
		<div class="col-sm-4 panel-body">
		       <label>New Password</label>
            <div class="form-group pass_show"> 
               <input type="password" id="password" name="password" title="New password">
                @if($errors->has('password'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </em>
                                @endif
            </div> 
		       <label>Confirm Password</label>
            <div class="form-group pass_show"> 
		<input type="password" id="password_confirmation" name="password_confirmation" title="Confirm new password">
		 @if($errors->has('password_confirmation'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </em>
                                @endif
            </div> 
            <input type="hidden" id="token" name="token" value="{{$passwordReset->token}}">
            <input type="hidden" id="email" name="email" value="{{$passwordReset->email}}">
		</div>  
	</div>
</div>
<p class="form-actions">
<input type="submit" title="Change password">
</p>
</form>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
    $('.resetPasswordError').delay(2500).fadeOut(1600);
    });
    </script>

