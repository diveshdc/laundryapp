@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.category.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.category.fields.name') }}
                    </th>
                    <td>
                        {{ $category->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.category.fields.description') }}
                    </th>
                    <td>
                        {{ $category->description }}
                    </td>
                </tr>
                 <tr>
                    <th>
                        {{ trans('global.category.fields.image') }}
                    </th>
                    <td>
                        <img src="{{ $category->image ?? '' }}" width="50"; height="60";>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection