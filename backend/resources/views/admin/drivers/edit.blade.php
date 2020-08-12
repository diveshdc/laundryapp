@extends('layouts.admin') @section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.driver.title_singular') }}
    </div>
    <div class="card-body">
         <form id="edit_driver" action="{{ route('admin.drivers.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}"> @if($errors->has('first_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </em> @endif
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
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}"> @if($errors->has('last_name'))

                    <em class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </em> @endif

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
                    <input type="email" id="email" name="email" readonly="readonly" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}"> @if($errors->has('email'))

                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em> @endif

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
                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', isset($user) ? $user->phone_number : '') }}"> @if($errors->has('phone_number'))

                    <em class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.phone_number_helper') }}
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
                    <input type="password" id="password" name="password" class="form-control"> @if($errors->has('password'))

                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.password_helper') }}
                    </p>
                </div>
            </fieldset>
            <fieldset class="form-group {{ $errors->has('vehicle_number') ? 'has-error' : '' }}">
                <label for="vehicle_number">{{ trans('global.user.fields.vehicle_number') }}</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-car"></i>
                                            </span>
                    </span>
                    <input type="vehicle_number" id="vehicle_number" value="{{ old('vehicle_number', isset($user) ? $user->vehicle_number : '') }}" name="vehicle_number" class="form-control"> @if($errors->has('vehicle_number'))

                    <em class="invalid-feedback">
                        {{ $errors->first('vehicle_number') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.vehicle_number_helper') }}
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
                        <option value="{{ $id }}" {{ (in_array($id, old( 'roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}> {{ $roles }}
                        </option>
                        @endforeach

                    </select>
                    @if($errors->has('roles'))

                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em> @endif

                    <p class="helper-block">
                        {{ trans('global.user.fields.roles_helper') }}
                    </p>
                </div>
            </fieldset>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection