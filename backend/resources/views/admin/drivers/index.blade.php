@extends('layouts.admin')
@section('content')
@can('user_create')
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-success" href="{{ route('admin.drivers.create') }}">
      {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.driver.title_singular') }}
    </a>
  </div>
</div>
@endcan
<div class="card">
  <div class="card-header">
    {{ trans('global.driver.title_singular') }} {{ trans('global.list') }}
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
              {{ trans('global.driver.fields.first_name') }}
            </th>
            <th>
              {{ trans('global.driver.fields.last_name') }}
            </th>
            <th>
              {{ trans('global.driver.fields.email') }}
            </th>
             <th>
              {{ trans('global.driver.fields.phone_number') }}
            </th>
            <!-- <th>
              {{ trans('global.driver.fields.roles') }}
            </th> -->
            <th>
              <!-- {{ trans('global.driver.fields.vehicle_number') }} -->
              Vehicle #
            </th>
            <th>
              <!-- {{ trans('global.driver.fields.vehicle_number') }} -->
            Task History
            </th>
            <th>
              <!-- {{ trans('global.driver.fields.vehicle_number') }} -->
              Status
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
            <!-- {{$key+1}} -->
          </td>
          <td>
            {{ $user->first_name ?? '' }}
          </td>
           <td>
            {{ $user->last_name ?? '' }}
          </td>
          <td>
            {{ $user->email ?? '' }}
          </td>
          <td>
            {{ $user->phone_number ?? '' }}
          </td>
          <!-- <td>
          @foreach($user->roles as $role)
           <span class="badge badge-info">{{ $role->title }}</span>
           @endforeach
         </td> -->
         <td>
           {{ $user->vehicle_number ?? '' }}
         </td>
         <td>
           @can('user_show')
        <a class="btn btn-xs btn-success" href="{{ route('admin.viewtask', $user->id) }}">
          {{ trans('global.view') }}
        </a>
        @endcan
         </td>
         <td>
          @if($user->is_status==true)
           <span class="badge badge-success">Online</span>
           @endif()
           @if($user->is_status==false)
           <span class="badge badge-danger">Offline</span>
           @endif()
         </td>
         
       <td>
          <input data-id="{{$user->id}}" class="block-unblock-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Unblock" data-off="Block" {{ $user->blocked ? 'checked' : '' }}>

        @can('user_edit')
        <a class="btn btn-xs btn-info" href="{{ route('admin.drivers.edit', $user->id) }}">
          {{ trans('global.edit') }}
        </a>
        @endcan
        @can('user_delete')
        <form action="{{ route('admin.drivers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" class="btn btn-xs btn-warning" value="{{ trans('global.delete') }}">
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
});
</script>
@endsection
@endsection
