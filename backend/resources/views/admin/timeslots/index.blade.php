@extends('layouts.admin')
@section('content')
<!-- @can('role_create') -->
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.timeslot.create') }}">
                {{ trans('global.edit') }} {{ trans('global.timeslot.title_singular') }}
            </a>
        </div>
    </div>
<!-- @endcan -->
<div class="card">
    <div class="card-header">
        {{ trans('global.timeslot.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            {{ trans('global.timeslot.fields.collection_date') }}
                        </th>
                         <th>
                            {{ trans('global.timeslot.fields.collection_time_slot') }}
                        </th>
                        <th>Collection free slots</th>
                        <th>
                            {{ trans('global.timeslot.fields.delivery_date') }}
                        </th>
                        <th>
                            {{ trans('global.timeslot.fields.delivery_time_slot') }}
                        </th>
                            <th>Delivery free slots</th>
                        <!-- <th>
                            {{ trans('global.action') }}
                        </th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeslots as $key => $timeslot)
                        <tr data-entry-id="{{ $timeslot->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $timeslot['collection_date'] ?? '' }}
                            </td>
                             <td>
                            {{ $timeslot['collection_time_start'] ?? '' }} - {{ $timeslot['collection_time_end'] ?? '' }}
                            </td>
                            <td>{{ $timeslot['is_free_collection_limit'] ?? '' }}</td>
                            <td>
                                {{ $timeslot['delivery_date'] ?? '' }}
                            </td>
                             <td>
                                {{ $timeslot['delivery_time_start'] ?? '' }} - {{ $timeslot['delivery_time_end'] ?? '' }}
                            </td>
                            <td>{{ $timeslot['is_free_delivery_limit'] ?? '' }}</td>  
                            <!-- <td> -->
                               <!--  @can('role_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.timeslot.show', $timeslot->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan -->
                                  <!--   <a class="btn btn-xs btn-info" href="{{ route('admin.timeslot.edit', $timeslot->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.timeslot.destroy', $timeslot->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                            </td> -->

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
    url: "{{ route('admin.timeslot.massDestroy') }}",
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
@can('timeslot_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection