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
  @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif


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
             <a href="{{ route('admin.order.show',$order->id)}}">#{{$order->id}} {{$order['userInfo']['first_name']}} {{$order['userInfo']['last_name']}}</a>
        </td>
           <td>
            <!-- {{ $order->created_at ?? '' }} -->
            {{ \Carbon\Carbon::parse($order->created_at)->format('d/M/Y')}}
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
          <button class="label-hv dropdown-toggle launch-collection-modal" onclick="openCollection({{$order}})" type="button" id="" aria-expanded="false">
            @foreach($drivers as $driver)
             {{ $order->assign_to == $driver->id? $driver->first_name:'Assign To'}}
             @endforeach
          </button>
          </td>
       
  <td>
      <button class="label-hv dropdown-toggle launch-delivery-modal" onclick="openDelivery({{$order}})" type="button" id="" aria-haspopup="false" aria-expanded="false">
        @foreach($drivers as $driver)
         {{ $order->assign_to_delivery == $driver->id ? $driver->first_name : 'Assign To' }}
         @endforeach
     </button>
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
                  <div class="mt-2"> <img src="{{$order->receiver_image}}" lass="my-2" height="200"></div>
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
                  <div> <img src="{{$order->receiver_image}}"  class="my-2" height="200"></div>
                  <a href="#">Export</a>
                  </div>
          </div>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div id="delivery-modal" class="modal fade">
           <form id="create_user" action="{{ route('admin.assignjob') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="job_id" value="{{ $order->id }}">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body" id="delivery-data">
                       <p>
                          Order <strong id="odr-id"></strong>&nbsp;&nbsp;&nbsp;Task <span class="label-hg">Delivery</span><br>
                          <strong id="usr-info"></strong><br>
                          <p id="addr"></p>

                           <br>
                          Postcode: <strong id="pstcd"></strong><br>
                          Mobile: <strong id="usr-phn"></strong><br>
                          Date: <strong id="usr-crt"></strong><br>
                          Time slots: <strong id="odr-time"></strong><br>
                        </p>
                      </div>
                      <div class="form-group">
                  <label>Add Notes:</label>
                  <textarea class="form-control" name="admin_notes" cols="5" rows="2" ></textarea>
                </div>
                 <div class="form-group">
                  <label>Assign to Driver:</label>
                             <select class="custom-select form-control" id="delivery-task"  name="assign_delivery">        
                              <option value="">Assign Job</option>
                              @foreach($drivers as $driver)
                               <option id="{{$order->id}}" value="{{$driver}}"{{ ( $order->assign_to == $driver->id ) ? 'selected' : '' }}>{{ $driver->first_name }}</option>
                     @endforeach
                      </select>
                  </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
              </div>
               </form>
           </div>

             <div id="collection-modal" class="modal fade">
           <form id="create_user" action="{{ route('admin.assignjob') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="job_id" value="{{ $order->id }}">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body" id="collection-data">
                       <p>
                          Order <strong id="odrr-id"></strong>&nbsp;&nbsp;&nbsp;Task <span class="label-hg">Collection</span><br>
                          <strong id="usrr-info"></strong><br>
                          <p id="addrr"></p>

                           <br>
                          Postcode: <strong id="pstcdd"></strong><br>
                          Mobile: <strong id="usrr-phn"></strong><br>
                          Date: <strong id="usrr-crt"></strong><br>
                          Time slots: <strong id="odrr-time"></strong><br>
                        </p>
                      </div>
                      <div class="form-group">
                  <label>Add Notes:</label>
                  <textarea class="form-control" name="admin_notes" cols="5" rows="2" ></textarea>
                </div>
                 <div class="form-group">
                  <label>Assign to Driver:</label>
                    <select class="custom-select form-control" name="assign_collection">        
                    <option value="">Assign Job</option>
                    @foreach($drivers as $driver)
                     <option id="{{$order->id}}" value="{{$driver}}"{{ ( $order->assign_to == $driver->id ) ? 'selected' : '' }}>{{ $driver->first_name }}</option>
                     @endforeach
                      </select>
                  </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
              </div>
               </form>
           </div>
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


function openDelivery(data) {
    $('#delivery-modal').modal({
      backdrop: 'static'
    });
    $('#odr-id').html('#'+data.id);
    $('#usr-info').html(data.user_info.first_name+' '+data.user_info.last_name);
    $('#addr').html(data.user_info.building_name_no+','+data.user_info.town);
    $('#pstcd').html(data.user_info.post_code);
    $('#usr-phn').html(data.user_info.phone_number);
    $('#usr-crt').html(data.created_at);
    $('#odr-time').html(data.delivery_time);
}
function openCollection(data) {
    $('#collection-modal').modal({
      backdrop: 'static'
    });
    $('#odrr-id').html('#'+data.id);
    $('#usrr-info').html(data.user_info.first_name+' '+data.user_info.last_name);
    $('#addrr').html(data.user_info.building_name_no+','+data.user_info.town);
    $('#pstcdd').html(data.user_info.post_code);
    $('#usrr-phn').html(data.user_info.phone_number);
    $('#usrr-crt').html(data.created_at);
    $('#odrr-time').html(data.collection_time);
}
</script>
@endsection
@endsection
