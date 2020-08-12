@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.user.title') }}
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.user.fields.first_name') }}
                    </th>
                    <td>
                        {{ $user->first_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.last_name') }}
                    </th>
                    <td>
                        {{ $user->last_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.email') }}
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.phone_number') }}
                    </th>
                    <td>
                        {{ $user->phone_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.building_name_no') }}
                    </th>
                    <td>
                        {{ $user->building_name_no }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.street_name') }}
                    </th>
                    <td>
                        {{ $user->street_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.town') }}
                    </th>
                    <td>
                        {{ $user->town }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.user.fields.post_code') }}
                    </th>
                    <td>
                        {{ $user->post_code }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Roles
                    </th>
                    <td>
                        @foreach($user->roles as $id => $roles)
                            <span class="label label-info label-many">{{ $roles->title }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection