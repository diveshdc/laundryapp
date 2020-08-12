@extends('layouts.admin')
@section('content')
    @can('user_create')
    <style>
        
        .dataTables_wrapper .custom-select{min-width: 80px !important;}
    </style>
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                    {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.user.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('global.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <span class="status_msg"></span>
                <table class=" table table-bordered table-striped table-hover datatable table-responsive">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.user.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('global.loyalty_point') }}
                        </th>
                        <th>
                            {{ trans('global.referral_code')}}
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $user->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $user->last_name ?? '' }}
                            </td>
                            <td>
                                <a href="#">{{ $user->email ?? '' }}</a>
                            </td>
                            <td>
                                <a href="#">{{ $user->phone_number ?? '' }}</a>
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->title ?'Customer' :'' }}</span>
                                @endforeach
                            </td>
                            <td> {{$user->loyalty_point ?? '0'}}</td>
                            <td>
                                {{$user->referrer_code ?? ''}}
                            </td>
                            <td>
                               <input data-id="{{$user->id}}" class="block-unblock-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Unblock" data-off="Block" {{ $user->blocked ? 'checked' : '' }}>
                               <!--  @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan -->
                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('scripts')
    @parent
    <script>
        $(function () {
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}');
                        return
                    }
                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            };
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            @can('user_delete')
            dtButtons.push(deleteButton);
            @endcan

            $('.datatable:not(.ajaxTable)').DataTable({buttons: dtButtons})
        });
        function blockUsers(userId ,value)
{
    if (confirm('{{ trans('global.blockthis') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
           url: "{{ route('admin.blockuser') }}",
          data: { user_id: userId, status: value, _method: 'POST' }
        })
        .done(function () { location.reload() })
      }
}
    </script>
@endsection
@endsection
