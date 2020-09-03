@extends('layouts.admin')
@section('content')
@can('postcode_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.postcode.create') }}">
                {{ trans('global.add') }} {{ trans('global.postcode.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.postcode.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                          #
                        </th>
                        <th>
                            {{ trans('global.postcode.fields.name') }}
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postcodes as $key => $postcode)
                        <tr data-entry-id="{{ $postcode->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $postcode->post_code ?? 'Not Available' }}
                            </td> 
                            <td>
                              @if($postcode->publish_unpublish == 1)
                              <span style="color: green;"> Publish</span>
                              @endif()
                                @if($postcode->publish_unpublish ==0)
                              <span style="color: red;"> Unpublish</span>
                              @endif()
                            </td>                               
                            <td>
                                @can('postcode_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.postcode.edit', $postcode->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                 <input data-id="{{$postcode->id}}" class="unpublish-publish-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="on" data-off="off" {{ $postcode->publish_unpublish ? 'checked' : '' }}>
                                   @can('postcode_delete')
                                    <form action="{{ route('admin.postcode.destroy', $postcode->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.postcode.massDestroy') }}", //postcode
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
@can('postcode_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection