@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.user.title_singular') }}
    </div>
    <div class="card-body">
        <form id="create_user" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <input type="email" id="email" name="email" class="form-control" onblur="checkEmailIsAlready(this)" value="{{ old('email', isset($user) ? $user->email : '') }}">
                    <label class="is_exists user-create" id="is_exists"></label>
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
                    <input type="text" class="form-control" name="phone_number" id="phone_number"> @if($errors->has('phone_number'))
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
{{--    <fieldset class="form-group" >--}}
{{--        <p>Where did you hear about Spotlex?</p>--}}
{{--        <select name="reference_from" id="reference_from" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" data-live-search-placeholder="Test">--}}
{{--        <option data-subtext="Rep California">Tom Foolery</option>--}}
{{--        <option data-subtext="Sen California">Bill Gordon</option>--}}
{{--        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>--}}
{{--        <option data-subtext="Rep Alabama">Mario Flores</option>--}}
{{--        <option data-subtext="Rep Alaska">Don Young</option>--}}
{{--        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>--}}
{{--        </select>--}}
{{--        </fieldset>--}}
    <fieldset class="form-group" >
         <div>
          <input type="checkbox" name="send_mail" class="" id="send_mail">
          <label>Notify user about account creation?</label>
      </div>
  </fieldset>
            <div>
                <input class="btn btn-danger create_user" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
