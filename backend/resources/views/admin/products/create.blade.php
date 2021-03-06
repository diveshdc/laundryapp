@extends('layouts.admin')
@section('content')
@include('notification')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.product.title_singular') }}
    </div>

    <div class="card-body">
        <form role="form" id="add_product" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            <meta name="_token" content="{{ csrf_token() }}" />
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.product.fields.name') }}*</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                    </span>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            </div>       
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.product.fields.price') }}*</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-pound-sign"></i>
                        </span>
                    </span>
                <input type="text" id="price" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            </div>

             <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.product.fields.sale_price') }}</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-pound-sign"></i>
                        </span>
                    </span>
                <input type="text" id="sale_price" name="sale_price" class="form-control" value="{{ old('sale_price', isset($product) ? $product->sale_price : '') }}">
                @if($errors->has('sale_price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('sale_price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.product.fields.description') }}</label>
                 <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-file-text"></i>
                        </span>
                    </span>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.description_helper') }}
                </p>
            </div>
            </div>  
            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
               <!--  <label for="category_name">{{ trans('global.product.fields.category') }}*
                    <span class="btn btn-info btn-xs select-all">Select all</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect all</span>
                </label> -->
                 
                <select name="category[]" id="category" class="form-control">

                    @foreach($category as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('category', [])) || isset($user) && $user->category->contains($id)) ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.roles_helper') }}
                </p>
            </div>
            <div class="panel-body">
              <div class="form-group">
                    <label class="col-md-3 control-label">
                        Upload Product Image
                     <span class="required">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="file" name="image" id="image" />
                    </div>
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