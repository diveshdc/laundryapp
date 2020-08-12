@extends('layouts.admin')
@section('content')
@can('user_create')
<div style="margin-bottom: 10px;" class="row">
<!--   <div class="col-lg-12">
    <a class="btn btn-success" href="{{ route('admin.drivers.create') }}">
      {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.driver.title_singular') }}
    </a>
  </div> -->
</div>
@endcan
<div class="card">
  <div class="card-header">
    {{ trans('global.driver.title_singular') }} {{ trans('global.requests') }}
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
            <th>
              {{ trans('global.driver.fields.roles') }}
            </th>
            <th>
              {{ trans('global.driver.fields.vehicle_number') }}
            </th>
             <th>
              {{ trans('global.active_dactive') }}
            </th>
            <th>
             {{ trans('global.action') }}
           </th>
         </tr>
       </thead>
       <tbody>
        @foreach($driver_request as $key => $driver)
        <tr data-entry-id="{{ $driver->id }}">
          <td>

          </td>
          <td>
            {{ $driver->first_name ?? '' }}
          </td>
           <td>
            {{ $driver->last_name ?? '' }}
          </td>
          <td>
            {{ $driver->email ?? '' }}
          </td>
          <td>
            {{ $driver->phone_number ?? '' }}
          </td>
          <td>  
          @foreach($driver->roles as $role)     
           <span class="badge badge-info">{{ $role->title }}</span>
           @endforeach
         </td>
         <td>       
           {{ $driver->vehicle_number ?? '' }}
         </td>
        <td>    
         <label class="switch switch-primary">                           
          <input data-id="{{$driver->id}}" class="switch-input toggle-class" type="checkbox" data-onstyle="success" data-on="0" data-off="1" {{ $driver->is_request == '0' ? 'checked' : '' }}>
           <span class="switch-slider"></span>

        </td>
       <td>

     <!--    @can('user_show')
        <a class="btn btn-xs btn-primary" href="{{ route('admin.drivers.show', $driver->id) }}">
          {{ trans('global.view') }}
        </a>
        @endcan -->
      <!--   @can('user_edit')
        <a class="btn btn-xs btn-info" href="{{ route('admin.drivers.edit', $driver->id) }}">
          {{ trans('global.edit') }}
        </a>
        @endcan -->
        @can('user_delete')
        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
       $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? '0' : '1'; 
        var user_id = $(this).data('id'); 
        console.log(status,user_id);
        $.ajax({
            headers: {'x-csrf-token': _token},
            type: "POST",
            dataType: "json",
            url: '/admin/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
@endsection
@endsection