@extends('layouts.admin')
@section('content')
    @can('user_create')
       
        <style>
  .drop-table .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{overflow: visible !important;}
  .drop-table .dropdown-menu{padding:1rem !important;min-width: 16rem !important;}
  .drop-table .dropdown-menu p{line-height: 20px;}
  .drop-table .dropdown-menu  textarea{min-height: 50px !important;}
  .drop-table table tbody tr td:last-child, d.rop-table table thead tr th:last-child{width: 243px !important;}
  .drop-table table tbody tr td:last-child .dropdown{display: inline-block !important;}
  .label-hv{background: #66aadd;border:0;color:#fff;padding: 5px 10px;border-radius: 4px;font-weight:600;min-width: 100px}
  .label-hv:hover{background: #000;}
  .dataTables_wrapper .custom-select{min-width: 80px !important;}
  .label-green{background: #00ff00;color:#000;}
   .label-green:hover{color:#fff;}
</style>
    @endcan
    <div class="card">
        <div class="card-header">
          Order List
        </div>
        <div class="card-body">
            <div class="table-responsive drop-table">
                <span class="status_msg"></span>
               <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            Order #
                        </th>
                        <th>
                           Name
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Phone number
                        </th>
                        <th>
                           Task Status
                        </th>
                        <th>
                           Task Type
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                           Time slot
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $key => $orderData)
                        <tr data-entry-id="">
                            <td>
                            </td>
                            <td>{{$orderData->id}}</td>
                            <td>{{$orderData['userInfo']['first_name']}}</td>
                            <td>{{$orderData->building_name_no}},{{$orderData->street_name}}, {{$orderData->post_code}}</td>
                            <td>{{$orderData['userInfo']['phone_number']}}</td>
                            <td>{{$orderData->status}}</td>
                            <td>{{$orderData->delivery_type}}</td>
                            <td>{{$orderData->created_at}}</td>
                            <!-- <td>{{$orderData->id}}</td> -->
                        </tr>
                        @endforeach()
                   
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
