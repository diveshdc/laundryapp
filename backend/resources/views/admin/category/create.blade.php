@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.category.title_singular') }}
    </div>

    <div class="card-body">
        <form id="create_category" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.category.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.category.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.category.fields.description') }}*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($category) ? $category->description : '') }}">
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.category.fields.description_helper') }}
                </p>
            </div>
                <div class="panel-body">
              <div class="form-group">
                    <label class="col-md-3 control-label">
                        Upload Category Image
                     <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="file" name="image" id="product_image" />
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection