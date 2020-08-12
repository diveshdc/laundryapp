@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.postcode.title_singular') }}
    </div>
        @if($errors->any())
        <h5>{{$errors->first()}}</h5>
        @endif
    <div class="card-body">
        <form id="add_postcode" action="{{ route('admin.postcode.store') }}" method="POST" enctype="multipart/form-data">
            <meta name="_token" content="{{ csrf_token() }}" />
            @csrf
            <div class="form-group {{ $errors->has('post_code') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.postcode.fields.name') }}*</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-map-pin"></i>
                        </span>
                    </span>
                <input type="text" id="post_code" name="post_code" class="form-control" value="{{ old('post_code', isset($postcode) ? $postcode->post_code : '') }}">
                @if($errors->has('post_code'))
                    <em class="invalid-feedback">
                        {{ $errors->first('post_code') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.postcode.fields.name_helper') }}
                </p>
            </div>
            </div> 
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
</script>
@endsection