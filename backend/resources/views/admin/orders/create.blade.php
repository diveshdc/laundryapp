@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('global.new') }} {{ trans('global.order.title_singular') }}
        </div>
        <div class="card-body">
            <form id="create_driver" action="{{ route('admin.order.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
               
                <fieldset class="form-group {{ $errors->has('order_date') ? 'has-error' : '' }}">
                    <label>{{ trans('global.order.fields.order_date') }}</label>
                    <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-shopping-bag"></i>
                        </span>
                    </span>
                        <input type="date" class="form-control" name="order_date"
                               id="order_date"> @if($errors->has('order_date'))

                            <em class="invalid-feedback">
                                {{ $errors->first('order_date') }}
                            </em> @endif

                        <p class="helper-block">
                            {{ trans('global.order.fields.order_date_helper') }}
                        </p>
                    </div>
                </fieldset>
                <fieldset class="form-group {{ $errors->has('order_status') ? 'has-error' : '' }}">
                    <label for="order_status">{{ trans('global.order.fields.order_status') }}</label>
                    <div class="input-group">
                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-key"></i>
                                        </span>
                    </span>
                    <select id="order_status" name="order_status" class="form-control" >
                            <option value="0">Select Order Status</option>
                            <option value="1">Cancelled</option>
                            <option value="2">On Hold</option>
                    </select>
                               @if($errors->has('order_status'))

                            <em class="invalid-feedback">
                                {{ $errors->first('order_status') }}
                            </em> @endif

                        <p class="helper-block">
                            {{ trans('global.order.fields.order_status_helper') }}
                        </p>
                    </div>
                </fieldset>
                <fieldset class="form-group {{ $errors->has('ship_to') ? 'has-error' : '' }}">
                    <label for="ship_to">{{ trans('global.order.fields.ship_to') }}</label>
                    <div class="input-group">
                    <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-car"></i>
                                            </span>
                    </span>
                        <input type="text" id="ship_to" name="ship_to"
                               class="form-control"> @if($errors->has('ship_to'))

                            <em class="invalid-feedback">
                                {{ $errors->first('ship_to') }}
                            </em> @endif

                        <p class="helper-block">
                            {{ trans('global.order.fields.ship_to_helper') }}
                        </p>
                    </div>
                </fieldset>
                  <fieldset class="form-group {{ $errors->has('order_total') ? 'has-error' : '' }}">
                    <label for="order_total">{{ trans('global.order.fields.order_total') }}</label>
                    <div class="input-group">
                    <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-pound-sign"></i>
                                            </span>
                    </span>
                        <input type="text" id="order_total" name="order_total"
                               class="form-control"> @if($errors->has('order_total'))

                            <em class="invalid-feedback">
                                {{ $errors->first('order_total') }}
                            </em> @endif

                        <p class="helper-block">
                            {{ trans('global.order.fields.order_total_helper') }}
                        </p>
                    </div>
                </fieldset>
                <div>
                    <input class="btn btn-danger create_user" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
