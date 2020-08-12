@extends('layouts.admin')
@section('content')
 <!-- <link rel="icon" href="{{ url('public/image/w3path-favicon.png') }}" sizes="32x32" /> -->
 <style>
   .container{
    padding: 0.5%;
   } 
   img {
  border-radius: 50%;
  max-width: 100%; 
  height: auto;
  display:block
}
.profile-img{width:112px;height:112px;border-radius: 50%;overflow: hidden;}
.profile-img img{width:100%;height:100%;object-fit: cover;}
.file-select{background-color:#bbcccc;color: #fff;padding:6px 15px;border-radius: 3px;}
</style>
<div class="card">
   <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.user.title_singular') }}
    </div>

    <div class="card-body">
        <form id="edit_user" action="{{ route('admin.users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('global.user.fields.first_name') }}*</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                    </span>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}">
                @if($errors->has('first_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.first_name_helper') }}
                </p>
            </div>
            </fieldset>

            <fieldset class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('global.user.fields.last_name') }}*</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                    </span>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}">
                @if($errors->has('last_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.last_name_helper') }}
                </p>
            </div>
            </fieldset>

            <fieldset class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.user.fields.email') }}*</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </span>
                <input type="email" readonly="readonly" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.email_helper') }}
                </p>
            </div>
            </fieldset>

            <fieldset class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                <label>{{ trans('global.user.fields.phone_number') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="phone_number" id="phone_number"  value="{{ old('phone_number', isset($user) ? $user->phone_number : '') }}"> @if($errors->has('phone_number'))

                    <em class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.phone_number_helper') }}
                    </p>
                </div>
            </fieldset>
             <fieldset class="form-group {{ $errors->has('building_name_no') ? 'has-error' : '' }}">
                <label>{{ trans('global.user.fields.building_name_no') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                       <i class="fa fa-home" aria-hidden="true"></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="building_name_no" id="building_name_no"  value="{{ old('building_name_no', isset($user) ? $user->building_name_no : '') }}"> @if($errors->has('building_name_no'))

                    <em class="invalid-feedback">
                        {{ $errors->first('building_name_no') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.building_name_no_helper') }}
                    </p>
                </div>
            </fieldset>


            <fieldset class="form-group {{ $errors->has('street_name') ? 'has-error' : '' }}">
                <label>{{ trans('global.user.fields.street_name') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-street-view" aria-hidden="true"></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="street_name" id="street_name"  value="{{ old('street_name', isset($user) ? $user->street_name : '') }}"> @if($errors->has('street_name'))

                    <em class="invalid-feedback">
                        {{ $errors->first('street_name') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.street_name_helper') }}
                    </p>
                </div>
            </fieldset>


            <fieldset class="form-group {{ $errors->has('town') ? 'has-error' : '' }}">
                <label>{{ trans('global.user.fields.town') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-home "></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="town" id="town"  value="{{ old('town', isset($user) ? $user->town : '') }}"> @if($errors->has('town'))

                    <em class="invalid-feedback">
                        {{ $errors->first('town') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.town_helper') }}
                    </p>
                </div>
            </fieldset>

            <fieldset class="form-group {{ $errors->has('loyalty_point') ? 'has-error' : '' }}">
                <label>Loyalty Point</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-trophy" aria-hidden="true"></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="loyalty_point" id="loyalty_point"  value="{{ old('loyalty_point', isset($user) ? $user->loyalty_point : '') }}"> @if($errors->has('loyalty_point'))

                    <em class="invalid-feedback">
                        {{ $errors->first('loyalty_point') }}
                    </em> @endif

                    <p class="helper-block">
                        <!-- loyalty point -->
                        <!-- {{ trans('global.user.fields.town_helper') }} -->
                    </p>
                </div>
            </fieldset>
            <fieldset class="form-group {{ $errors->has('post_code') ? 'has-error' : '' }}">
                <label>{{ trans('global.user.fields.post_code') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-map-pin" aria-hidden="true"></i>
                                    </span>
                    </span>
                    <input type="text" class="form-control" name="post_code" id="post_code"  value="{{ old('post_code', isset($user) ? $user->post_code : '') }}"> @if($errors->has('post_code'))

                    <em class="invalid-feedback">
                        {{ $errors->first('post_code') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.post_code_helper') }}
                    </p>
                </div>
            </fieldset>

            <fieldset class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('global.user.fields.password') }}</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                    </span>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.password_helper') }}
                </p>
            </div>
            </fieldset>
            <fieldset class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                 <div class="input-group">
                    <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users"></i>
                                    </span>
                    </span>
                <select name="roles[]" id="roles" class="form-control">
                    <option value="">Select Role</option>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                            {{ $roles }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
            </fieldset>

             <fieldset class="form-group" >
       <p>Where did you hear about Spotlex?</p>
                   <select name="reference_from" id="reference_from" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" data-live-search-placeholder="Test">
                   <option data-subtext="Rep California">{{$user->reference_from}}</option>
               </select>
               </fieldset>
   <fieldset class="form-group" >
        <div>
         <input type="checkbox" name="send_mail" class="" id="send_mail">
         <label>Notify user about account update?</label>
     </div>
 </fieldset>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
   <div class="container" style="margin-right: 30%"> 
   <div class="alert" id="message" style="display: none"><span style="color:green;">Image has been uploaded successfully</span></div>
  <form  method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >
                  <input type="hidden" value="{{$user->id}}" name="user_id">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="profile-img">
                @if($user->image_upload)
                <img id="image_preview_container" src="{{$user->image_upload}}"
                    alt="preview image" class="img-responsive"  style="max-height: 112px;">
                    @endif()
                    @if(!$user->image_upload)
                      <img id="image_preview_container" src="{{ asset('images/profile_picture/usericon.svg') }}"
                    alt="preview image" class="img-responsive"  style="max-height: 112px;">
                    @endif()
                    </div>
                   <!--  <div class="profile-img">    
                    @if(!$user->image_upload)
                <img id="image_preview_container" src="{{ asset('public/images/image/default_user.png') }}"
                    alt="preview image" class="img-responsive" style="max-height: 112px;">
                    @endif()
                </div> -->
                </div>
                <div class="col-md-12" style="margin-left: 20px">
                    <div class="form-group">
                        <label for="image" class="file-select">Upload FIle</label>
                        <input type="file" name="image" placeholder="Choose image" id="image" class="d-none">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
                  
                  
                <div class="col-md-12" style="margin-left: 20px">
                    <button type="submit" class="btn btn-primary">upload image</button>
                </div>
            </div>     
    </form>
   <br />
   <span id="uploaded_image"></span>
  </div>
  </div>

@endsection
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
   $(document).ready(function (e) {
  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $('#image').change(function(){
             var val = $(this).val().toLowerCase(),
            regex = new RegExp("(.*?)\.(jpg|jpeg|JPG|JPEG|PNG|png)$");

        if (!(regex.test(val))) {
            $(this).val('');
            alert('Please select correct file format');
        }
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
 
        });
 
        $('#upload_image_form').submit(function(e) {
            e.preventDefault();
 
            var formData = new FormData(this);
 
            $.ajax({
                type:'POST',
                url: "{{ url('admin/save-photo')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    $('#message').show();
                     $("#message").fadeOut(3000);
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
</script>