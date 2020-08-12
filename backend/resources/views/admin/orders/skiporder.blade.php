@extends('layouts.admin')
@section('content')
@can('order_create')
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-success" href="{{ route('admin.order.create') }}">
      {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.order.title_singular') }}
    </a>
  </div>
</div>
@endcan
<div class="card">
  <div class="card-header">
    {{ trans('global.order.title_singular') }} {{ trans('global.list') }}
     <a style="margin-left: 69%;" href="{{ route('admin.order.index') }}">{{ trans('global.order.with_order') }} {{ trans('global.list') }}</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <span class="status_msg"></span>
      <table class=" table table-bordered table-striped table-hover datatable">
        <thead>
          <tr>
            <th width="5">
            </th>
            <th>
              {{ trans('global.order.fields.name') }}
            </th> 
             <th>
              {{ trans('global.order.fields.date') }}
            </th>
            <th>
              {{ trans('global.order.fields.order_status') }}
            </th>
            <th>
              {{ trans('global.order.fields.ship_to') }}
            </th>
            <th>
              {{ trans('global.order.fields.order_total') }}
            </th>
            <th>
             {{ trans('global.action') }}
           </th>
         </tr>
       </thead>
       <tbody>
        @foreach($orders as $key => $order)
        <tr>
          <td>
          </td>
          <td style="color: blue;">
          <a href="{{ route('admin.order.show',$order->id)}}">{{'#'. $order->id }} Patric </a>            
          </td>
           <td>
            {{ $order->date ?? '' }}
          </td>
           <td>
            {{ $order->status?? '' }}
          </td>
           <td>
            {{ $order->ship_to ?? '' }}
          </td>
           <td>
            {{'£'.$order->order_total ?? '' }}
          </td>
           <td>
        @can('order_show')
        <a class="btn btn-xs btn-primary" href="{{ route('admin.order.show', $order->id) }}">
          {{ trans('global.view') }}
        </a>
        @endcan
        @can('order_edit')
        <a class="btn btn-xs btn-info" href="{{ route('admin.order.edit', $order->id) }}">
          {{ trans('global.edit') }}
        </a>
        @endcan
        @can('order_delete')
        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
