@extends('layouts.admin')
@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/admin/jquery.timepicker.min.css')}}">
    <style type="text/css">
        .datepicker, .datepicker-days{padding: 0 !important; background: #ddeeff !important; }
        .datepicker .day, .datepicker .dow{background: #ddeeff !important;padding: 7px;border:1px solid #fff;border-radius:0 !important;border-right-color: grey;border-bottom-color: grey;}}
    
        .picker-switch{font-size: 22px !important;font-weight: 600}
        .datepicker .next, .datepicker .prev{color: #000 !important;}  
        .datepicker .table-condensed {border-collapse: separate;}
        .bootstrap-datetimepicker-widget table td.active{background: #66aadd !important;}
        .bootstrap-datetimepicker-widget table thead tr:first-child th.prev{display: none !important}
        .bootstrap-datetimepicker-widget table thead tr:first-child th{}

        .bootstrap-datetimepicker-widget table thead tr:first-child th.next span{font: normal normal normal 14px/1 FontAwesome !important;}
         .bootstrap-datetimepicker-widget table thead tr:first-child th.next span:before{content: ""; width:30px;height:30px;display:block;background-image: url('{{ asset("images/rightarrow.svg") }}');background-repeat:no-repeat;background-position: right center;}

    </style>

</head>
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.timeslot.title_singular') }}
    </div>
    <div class="card-body">
        <form action="{{ route('admin.timeslot.store') }}" method="POST" enctype="multipart/form-data" id="create_role">
            @csrf
            <div class="row">
                <div class="col-6 col-md-4 col-sm-6"> 
                 <div class="form-group">
               <label for="collection_date">{{ trans('global.timeslot.fields.collection_date') }}*</label>
                 <input name="collection_date" onclick="getType('collection')"  type="text" placeholder="Collection Date" class="start form-control datepicker-custom">
                </div>
                </div>

                <div class="col-6 col-md-4 col-sm-6"> 
                     <div class="form-group">
               <label for="collection_date">{{ trans('global.timeslot.fields.delivery_date') }}*</label>
                 <input name="delivery_date" onclick="getType('delivery')" type="text" placeholder="Delivery Date" class="start form-control datepicker-custom">
                </div>
                </div>
                </div>

            <div class="modal fade" id="timeslotmodal" data-backdrop="static" data-keyboard="false" role="dialog">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="success-alert" style="height: 50px;"></div>
                    <div class="modal-header">
                      <h4 style="margin-left:20%;" class="modal-title" id="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                     <input  type="checkbox" name="" id="block-date-slot" onchange="blockDateSlot()" value=""> Tick box to lockout date <br>
                     <i class="fa fa-car" aria-hidden="true"></i>
                        <span id="time-period" >Set Delivery Period after collection 
                      </span>(Hours)<br><br>
                  <table id="records_table" border='1'>
                  <tr>
                    <th></th>
                      <th>Tick box to lock out time slot  </th>
                      <th>Set maximum number of order for time lockout</th>
                  </tr>
                </table>
                    </div>
                <div class="modal-footer">
                  <button type="button" style="margin-right: 50%;" class="btn btn-danger" onclick="closeModal()">Close</button>
                </div>
                  </div>
                </div>
              </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script  src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
   <script>
  
     var tmp = [];
     var slotType;
     var timeSlotDate;
    $('.datepicker-custom').datepicker({
        autoclose: true,
        format: 'dd/MM/yyyy',
        // daysOfWeekDisabled: "0",
        language: "en"
    }).on('changeDate', function(e) {
        var name = new Date(e.date).toLocaleDateString('en-US');
         timeSlotDate = new Date(e.date).toLocaleDateString('en-US');
        $('#timeslotmodal').modal('show');
         $(".modal-title").text(name);
          $.ajax({
              data: {slot_data:tmp,type:slotType,date:timeSlotDate},
              url: '/admin/getslotinfo',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.status ==true){
          $(function() {
            var timePeriod ='<input type="text" id="del_period" onblur="updateDeliveryPeriod()" value="'+response.timePeriod+'">'
            $('#time-period').html(timePeriod);
            var trHTML = '';
            if(response.type=='collection'){
                $.each(response.timeslot, function (i, item) {
                  trHTML += '<tr><td><input type="checkbox" id="block_time" onchange="blockTimeSlot('+item.id+')"></td><td>'+ item.collection_time_start +'-'+item.collection_time_end+ '</td><td><input id="delivery'+i+'" onblur="updateDeliveryHour('+i+','+item.id+')" type="text" value="'+item.is_free_collection_limit+'"></td></tr>';
              });
            }
           if(response.type=='delivery'){
              $.each(response.timeslot, function (i, item) {
                  trHTML += '<tr><td><input type="checkbox" id="block_time" onchange="blockTimeSlot('+item.id+')"></td><td>'+ item.delivery_time_start +'-'+item.delivery_time_end+ '</td><td><input id="delivery'+i+'" onblur="updateDeliveryHour('+i+','+item.id+')" type="text" value="'+item.is_free_delivery_limit+'"></td></tr>';
              });
            }


              $('#records_table').html(trHTML);
        });
        }
      }
      })
    });


    function updateDeliveryHour(i, id) {
      const inputId ='delivery'+i;
      let slotData = $('#'+inputId).val();
       $.ajax({
              data: {slot_id:id,value:slotData},
              url: '/admin/updatetimeslotvalues',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.status ==true){
            toastr.success(response.message);
        }
      }
      })
    };

    function blockTimeSlot(slotId) {
      const check =$('#block_time').prop('checked');
      const checkStatus = check ==true?1:0;
       $.ajax({
              data: {type:'block_timeslot', id:slotId, value:checkStatus, coll_del:slotType},
              url: '/admin/updatetimeslotvalues',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.status ==true){
            toastr.success(response.message);
        }
      }
      })

  };
    function blockDateSlot() {
      const check =$('#block-date-slot').prop('checked');
      const checkStatus = check ==true?1:0;
       $.ajax({
              data: {type:'block_dateslot',date:timeSlotDate,  value:checkStatus, coll_del:slotType},
              url: '/admin/updatetimeslotvalues',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.status ==true){
            toastr.success(response.message);
        }
      }
      })

  };

    function updateDeliveryPeriod(value) {

        let period = $('#del_period').val();
       $.ajax({
              data: {type:'period_update',value:period,date:timeSlotDate},
              url: '/admin/updatetimeslotvalues',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.status ==true){
            toastr.success(response.message);
        }
      }
      })
    };


    function selectRow(data) {
       tmp.push(data);
    };

    function getType(data) {
      slotType = data;
    };

    function closeModal() {
    $('#timeslotmodal').modal('hide');
      window.location.reload();
    };

    $('#submit_time_slot').on('click', function () {
          $.ajax({
              data: {slot_data:tmp,type:slotType,date:timeSlotDate},
              url: '/admin/create_time_slot',
              type: 'POST',
      beforeSend: function (request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
      },
      success: function(response){
        if(response.success ==true){
           window.location.href = "/admin/timeslot";
        }
      }
      })
  });
  

</script>
@endsection

