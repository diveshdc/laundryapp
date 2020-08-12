@extends('layouts.admin')
@section('content')
@can('order_create')

<style>
  .drop-table .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody{overflow: visible !important;min-height: 400px;}
  .drop-table .dropdown-menu{padding:1rem !important;min-width: 16rem !important;}
  .drop-table .dropdown-menu p{line-height: 20px;}
  .drop-table .dropdown-menu  textarea{min-height: 50px !important;}
  .drop-table table tbody tr td:last-child, d.rop-table table thead tr th:last-child{width: 243px !important;}
  .drop-table table tbody tr td:last-child .dropdown{display: inline-block !important;}
  .label-hv{background: #66aadd;border:0;color:#fff;padding: 5px 10px;border-radius: 4px;font-weight:600;min-width: 100px}
  .label-hg{border:1px solid black;padding: 5px 10px;border-radius: 4px;font-weight:600;min-width: 100px}

  .label-hv:hover{background: #000;}
  .dataTables_wrapper .custom-select{min-width: 80px !important;}
  .label-green{background: #00ff00;color:#000;}
   .label-green:hover{color:#fff;}
</style>
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <a class="btn btn-success" href="{{ route('admin.order.create') }}">
      {{ trans('global.add') }} {{ trans('global.new') }} {{ trans('global.order.title_singular') }}
    </a>
  </div>
</div>
@endcan
<div class="card">
  <!-- <div class="card-header">
    {{ trans('global.order.title_singular') }} {{ trans('global.list') }}
    <a style="margin-left: 69%;" href="{{ url('admin/skiporders')}}">{{ trans('global.order.skip_order') }} {{ trans('global.list') }}</a>
  </div> -->
<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="alert alert-success print-success-msg" style="display:none">
  <ul></ul>
</div>
  <div class="card-body">
    <div class="table-responsive drop-table">
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
              {{ trans('global.order.fields.order_type') }}
            </th>
           <th>Collection Task</th> 
             <th>Delivery Task</th>
             <th>Collection Status</th>
             <th>Delivery Status</th>
           <th>Task Details</th>
         </tr>
       </thead>
       <tbody>
        @foreach($orders as $key => $order)
        <!-- <?php echo '<pre>';print_r($order);?> -->
        <tr>
          <td>
          </td>
          <td style="color: blue;">
             <a href="{{ route('admin.order.show',$order->id)}}">#{{$order->id}} {{$order['userInfo']['first_name']}}</a>
        </td>
           <td>
            {{ $order->created_at ?? '' }}
          </td>
           <td>
            {{ $order->status?? '' }}
          </td>
           <td>
            {{ $order->post_code ?? '' }} {{ $order->building_name_no ?? '' }} {{ $order->street_name ?? '' }}
          </td>
           <td>
            {{'£'.$order->final_price ?? '' }}
          </td>
          <td>
            <label class="label-hv">
              {{$order->is_skip_items == 1 ? 'Skip Item Selection' : 'With Item' }}
            </label>
            
          </td>
          <td>
                 <!-- <select class="badge badge-info assign-job">        
                    <option value="">Assign Job</option>
              @foreach($drivers as $key => $driver)
                    <option id="{{$order->id}}" value="{{$driver}}">{{ $key }}</option>
               @endforeach
                </select> -->
                <div class="dropdown">
                      <button class="label-hv dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @foreach($drivers as $key => $driver)
                         {{ $order->assign_to == $driver && $order->delivery_type =='Collection' ? $key : 'Assign To' }}
                         @endforeach
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <p>
                      Order <strong>#{{$order->id}}</strong>&nbsp;&nbsp;&nbsp;Task <span class="label-hg">Collection</span><br>
                   <strong>{{$order['userInfo']['first_name']}} {{$order['userInfo']['last_name']}}</strong><br>
                 {{ $order->building_name_no ?? '' }} {{ $order->street_name ?? '' }}<br>
                Postcode: <strong>{{ $order->post_code ?? '' }}</strong><br>
                Mobile: <strong>{{$order['userInfo']['phone_number']}}</strong><br>
                Date: <strong>{{$order->created_at}}</strong><br>
                Time slots: <strong>{{ $order->collection_time }} – {{ $order->delivery_time}}</strong><br>
                      </p>
                      <div class="form-group">
                        <label>Add Notes:</label>
                        <textarea class="form-control" cols="5" rows="2" ></textarea>
                      </div>
                       <div class="form-group">
                        <label>Assign to Driver:</label>
                        <select class="custom-select form-control assign-job">        
                        <option value="">Assign Job</option>
                        @foreach($drivers as $key => $driver)
                         <option id="{{$order->id}}" value="{{$driver}}"{{ ( $order->assign_to == $driver ) ? 'selected' : '' }}>{{ $key }}</option>
                         @endforeach
                          </select>
                      </div>

                      </div>
                  </div>
          </td>
           <!-- <td> -->
        <!-- @can('order_show')
        <a class="btn btn-xs btn-primary" href="{{ route('admin.order.show', $order->id) }}">
          {{ trans('global.view') }}
        </a>
        @endcan -->
   <!--      @can('order_edit')
        <a class="btn btn-xs btn-info" href="{{ route('admin.order.edit', $order->id) }}">
          {{ trans('global.edit') }}
        </a>
        @endcan -->
      <!--   @can('order_delete')
        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
        @endcan -->
      </td>
      <td>
        <div class="dropdown">
                      <button class="label-hv dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @foreach($drivers as $key => $driver)
                         {{ $order->assign_to == $driver && $order->delivery_type =='Delivery' ? $key : 'Assign To' }}
                         @endforeach
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <p>
                      Order <strong>#{{$order->id}}</strong>&nbsp;&nbsp;&nbsp;Task <span class="label-hg">Delivery</span><br>
                   <strong>{{$order['userInfo']['first_name']}} {{$order['userInfo']['last_name']}}</strong><br>
                 {{ $order->building_name_no ?? '' }} {{ $order->street_name ?? '' }}<br>
                Postcode: <strong>{{ $order->post_code ?? '' }}</strong><br>
                Mobile: <strong>{{$order['userInfo']['phone_number']}}</strong><br>
                Date: <strong>{{$order->created_at}}</strong><br>
                Time slots: <strong>{{ $order->collection_time }} – {{ $order->delivery_time}}</strong><br>
                      </p>
                      <div class="form-group">
                        <label>Add Notes:</label>
                        <textarea class="form-control" cols="5" rows="2" ></textarea>
                      </div>
                       <div class="form-group">
                        <label>Assign to Driver:</label>
                       <select class="custom-select form-control assign-job">        
                        <option value="">Assign Job</option>
                        @foreach($drivers as $key => $driver)
                         <option id="{{$order->id}}" value="{{$driver}}"{{ ( $order->assign_to == $driver ) ? 'selected' : '' }}>{{ $key }}</option>
                         @endforeach
                          </select>
                      </div>

                      </div>
                       </div>
                  </td>
                  <td>{{$order->status ?? ''}}</td>
                  <td>{{$order->status ?? ''}}</td>
                  <td>
                <div class="dropdown">
                          <button class="label-hv dropdown-toggle mr-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Collect
                          </button>
                          <div class="dropdown-menu "  aria-labelledby="dropdownMenuButton">
                          <p>Collection</p>   
                          <span class="label-hv label-green">Collection</span>
                          <div class="mt-2"> <img src="https://picsum.photos/id/237/200/300" lass="my-2" height="200"></div>
                          <a href="#">Export</a>
                          </div>
                      </div>
                          <div class="dropdown">
                          <button class="label-hv dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Deliver
                          </button>
                          <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                          <p>Deliver</p>   
                          <span class="label-hv label-green">Deliver</span>
                          <div> <img src="https://picsum.photos/id/237/200/300"  class="my-2" height="200"></div>
                          <a href="#">Export</a>

                          </div>
          </div>
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
  @can('order_delete')
  dtButtons.push(deleteButton)
  @endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })


    $(document).on('change', '.assign-job', function(){
        let driverId = $(this).val(); 
        console.log(driverId);
        let jobId =    $(this).find('option:selected').attr('id');
        if(driverId >0){
          $.ajax({
            headers: {'x-csrf-token': _token},
            type: "POST",
            dataType: "json",
            url: '/admin/assignjob',
            data: {'driver_id': driverId,'job_id':jobId},
            success: function(data){
              if(data.status == 'success'){
                printSuccessMsg(data.message);
                 $(".print-success-msg").fadeOut(3000);
                 window.location.reload();
              }else{
                printErrorMsg(data.message);
                 $(".print-error-msg").fadeOut(3000);
              }
              console.log(data)
            },
                error: function (jqXHR, exception) {
                }
        });
        }else{
          alert('please select a driver!');
        }
    })
})
</script>
@endsection
@endsection
