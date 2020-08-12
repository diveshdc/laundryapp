@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.driver.title_singular') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.driver.fields.first_name') }}
                    </th>
                    <td>
                        {{ $user->first_name }}
                    </td>
                </tr>
                 <tr>
                    <th>
                        {{ trans('global.driver.fields.last_name') }}
                    </th>
                    <td>
                        {{ $user->last_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.driver.fields.email') }}
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                         {{ trans('global.driver.fields.phone_number') }}
                    </th>
                    <td>
                        {{ $user->phone_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                       {{ trans('global.driver.fields.vehicle_number') }}
                    </th>
                    <td>
                        {{ $user->vehicle_number }}
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