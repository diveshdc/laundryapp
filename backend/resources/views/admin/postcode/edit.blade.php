@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.postcode.title_singular') }}
    </div>
    <div class="card-body">
        <form id="edit_postcode" action="{{ route('admin.postcode.update', $postCode->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('post_code') ? 'has-error' : '' }}">
                <label for="post_code">{{ trans('global.postcode.fields.post_code') }}*</label>
                <input type="text" name="post_code" id="post_code" post_code="post_code" class="form-control" value="{{ old('post_code', isset($postCode) ? $postCode->post_code : '') }}">
                @if($errors->has('post_code'))
                    <em class="invalid-feedback">
                        {{ $errors->first('post_code') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.postcode.fields.name_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection