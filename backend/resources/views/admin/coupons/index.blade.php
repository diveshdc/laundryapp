@extends('layouts.admin')
@section('content')
@can('coupon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href=" {{ route('admin.coupons.create') }} ">
                {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.coupon.coupon') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.coupon.title_singular') }} {{ trans('global.list') }}
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
                            {{ trans('global.coupon.fields.coupon_code') }}
                        </th>
                        <th>
                            {{ trans('global.coupon.fields.coupontype')}}
                        </th>
                          <th>
                            {{ trans('global.coupon.fields.price')}}
                        </th>
                        <th>
                            {{ trans('global.coupon.fields.description')}}
                        </th>
                       <!--  <th>
                            {{ trans('global.coupon.fields.startdate')}}
                        </th> -->
                        <!-- <th>
                            {{ trans('global.coupon.fields.product_ids')}}
                        </th> -->
                        <th>
                            {{ trans('global.coupon.fields.useslimit')}}
                        </th>
                        <th>
                            {{ trans('global.coupon.fields.enddate')}}
                        </th>
			                   <th>
                           {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($coupons as $key => $coupon)
                        <tr data-entry-id="{{ $coupon->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $coupon->coupon_code ?? '' }}
                            </td>
                             <td>  
                             {{ $coupon->discount_type ?? '' }}
                            </td>
                            <td>
                                {{ $coupon->price ?? '' }}
                            </td>
                             <td>
                                {{ $coupon->description ?? '' }}
                            </td>
                            <!-- <td>  
                              {{12}}
                            </td> -->
                            <td>  
                                {{ $coupon->usage_limit_per_coupon ?? '' }}
                            </td>
                             <td>
                                {{ date('m-d-Y', strtotime($coupon->expiry_date)) ?? '' }}
                            </td>
                            <td>
                                @can('coupon_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.coupons.show', $coupon->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('coupon_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.coupons.edit', $coupon->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('coupon_delete')
                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.coupons.massDestroy') }}",
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
@can('coupon_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})




</script>
@endsection
@endsection