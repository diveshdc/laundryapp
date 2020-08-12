@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href=" {{ route('admin.clients.create') }} ">
                {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.client.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.client.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <span class="status_msg"></span>
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                   <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.client.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.client.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.client.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('global.button_status')}}
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
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                               
                                    <span class="badge badge-info">{{ $user->title }}</span>
                              
                            </td>
                             <td>                                 
                             <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status == 'Active' ? 'checked' : '' }}>
                  
                            </td>
                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.clients.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.clients.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('user_delete')
                                    <form action="{{ route('admin.clients.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})




</script>
@endsection
@endsection