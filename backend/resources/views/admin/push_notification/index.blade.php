@extends('layouts.admin')
@section('content')
@can('user_create')
<style>
  .label:after {
  content:"*";color:red;
}
</style>
<div class="card-header">
 <h3> <strong>{{trans('global.pushnotification.title_singular')}}</strong></h3>
  <h6>{{trans('global.pushnotification.title_singular')}}</h6>
</div>

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif


  <form id="edit_user" action="{{ route('admin.sendpush') }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
      @method('POST')
  <h3>{{trans('global.pushnotification.fields.send')}}</h3><br>
    <div class="row">
      <div class="form-group col-sm-4">
      <label class="label" for="type"><strong>Notification Type:</strong></label>
      </div>
      <div class="form-group col-sm-8">
          <div class="form-group form-check" style="margin-left: 14px;">
            <div class="row all-user-row">
            <label class="form-check-label">
              <input onchange="valueChanged()" class="form-check-input" type="checkbox" id="check_users" name="check_users" > Check the box to select all Users.
              <div class="invalid-feedback">Check this checkbox to continue.</div>
            </label> 
            </div>
          <div class="row all-driver-row">
            <label class="form-check-label">
              <input onchange="valueChangedDriver()" class="form-check-input" type="checkbox" id="check_drivers" name="check_drivers" > Check the box to select all Drivers.
              <div class="invalid-feedback">Check this checkbox.</div>
            </label>
          </div>
        </div>
        <div class="select-one select-ones">
           <div class="row user-select">
              <div class="form-group col-sm-3 user-dropdown">
            <label class="form-check-label">Single User:</label>
              </div>
              <div class="form-group col-sm-3">
                <!-- required -->
                 <select name="users" id="users_selection" class="custom-select">
                     <option value="">
                            Select User
                        </option>
                    @foreach($users as $user)
                        <option value="{{ $user['id'] }}">
                            {{ $user['first_name'] }} {{ $user['last_name'] }}
                        </option>
                    @endforeach
                </select>
                </div>
              </div>
        <div class="row driver-select">
          <div class="form-group col-sm-3 driver-dropdown">
            <label class="form-check-label">Single Driver:</label>
          </div>
             <div class="form-group col-sm-3">
              <!-- required -->
              <select name="drivers" id="drivers_selection" class="custom-select">
                     <option value="">
                            Select driver
                        </option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver['id']}}">
                            {{ $driver['first_name'] }} {{ $driver['last_name'] }}
                        </option>
                    @endforeach
                </select>
               </div>
          <!-- <div class="invalid-feedback">Please select type.</div> -->
    </div>
  </div>
  </div>
  </div>

    <div class="row">
        <div class="form-group col-sm-4">
          <label class="label" for="message"><strong>Message:</strong></label>
        </div>
        <div class="form-group col-sm-8">
          <textarea class="form-control" id="message" placeholder="Enter Message" name="message" required></textarea>
          <div class="invalid-feedback">Please enter message.</div>
        </div>
   </div>
        <div class="form-group col-sm-8">
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
  </form>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.pushnotification.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
            <span class="status_msg"></span>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                   <tr>
                    <th>
                       
                        </th>
                        <th>
                          Sr no.
                        </th>
                        <th>
                           Type
                        </th>
                        <th>
                          Message
                        </th>
                        <th>
                          Created At
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pushNotification  as $key => $notification)
                        <tr data-entry-id="{{ $notification->id }}">
                          <td></td>
                            <td>
                              {{$key+1}}
                            </td>
                            <td>
                                {{ $notification->type ??'N/A' }}
                            </td> 
                            <td>
                                {{ $notification->notification? $notification->notification: N/A }}
                            </td> 
                            
                            <td>
                              {{ \Carbon\Carbon::parse($notification->created_at)->format('d/M/Y')}}
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

<script>
  $(document).ready(function(){
    $(".alert-success").delay(3000).slideUp(300);


    $('#drivers_selection').on('change', function() {
      if($(this).find(":selected").val() ==''){
       $('#users_selection').prop('disabled', false);
      $('.user-dropdown').show();
      }
      if($(this).find(":selected").val() !=''){
       $('#users_selection').prop('disabled', true);
          $('.user-dropdown').hide();
      }
      
});
    $('#users_selection').on('change', function() {
       if($(this).find(":selected").val() ==''){
       $('#drivers_selection').prop('disabled', false);
      $('.driver-dropdown').show();
    } if($(this).find(":selected").val() !=''){
       $('#drivers_selection').prop('disabled', true);
      $('.driver-dropdown').hide();

    }
});


});
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function valueChanged(){
         if($('#check_users').is(":checked")){
             $('#drivers_selection').prop('disabled', true);
             $('#users_selection').prop('disabled', true);    

            $(".select-one").hide();
            $(".all-driver-row").hide();
            }else{
             $('#drivers_selection').prop('disabled', false); 
             $('#users_selection').prop('disabled', false);       
            $(".select-one").show();
            $(".all-driver-row").show();
            }

    }
function valueChangedDriver(){
       if($('#check_drivers').is(":checked")){
             $('#drivers_selection').prop('disabled', true);    
             $('#users_selection').prop('disabled', true);    
            $(".select-one").hide();
            $(".all-user-row").hide();
        }else{
             $('#drivers_selection').prop('disabled', false); 
             $('#users_selection').prop('disabled', false);       
            $(".select-one").show();
            $(".all-user-row").show();
        }

    }
</script>
@endsection
@endsection