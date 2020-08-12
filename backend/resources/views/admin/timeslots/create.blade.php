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

            <div class="modal fade" id="timeslotmodal" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 style="margin-left:20%;" class="modal-title" id="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                     <input  type="checkbox" name="" value=""> Tick box to lockout date <br>
                     <i class="fa fa-car" aria-hidden="true"></i>
                        <span>Set Delivery Period after collection 
                        <input style="width: 5%;
                        box-sizing: border-box;" type="text" name="delivery_period" value="48">
                    </span>(Hours)<br><br>
                    <table class="table">
                    <thead>
                      <tr>
                        <td></td>
                        <th>Tick box to lock out time slot</th>
                        <th>Set maximum number of order for time lockout</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($adminTimeslots as $key=> $slotsdata)
                      <tr>
                        <td><input class="checkbox-click" onchange="selectRow('{{$slotsdata}}')" type="checkbox" name="" value=""></td>
                        <td>{{$slotsdata->start_time}} - {{$slotsdata->end_time}}</td>
                        <td><input type="text" name="" value="{{$slotsdata->maximum_order}}"></td>
                      </tr>
                      @endforeach()
                    </tbody>
                  </table>
                    </div>
                    <div class="modal-footer">
                      <button style="margin-right: 56%" id="submit_time_slot" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
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
    });

    function selectRow(data) {
       tmp.push(data);
    };

    function getType(data) {
      slotType = data;
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

