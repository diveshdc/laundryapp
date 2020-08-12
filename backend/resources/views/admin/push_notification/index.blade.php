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
  <form id="edit_user" action="{{ route('admin.pushnotification.create') }}" enctype="multipart/form-data" novalidate>
    @csrf
      @method('POST')
  <h3>{{trans('global.pushnotification.fields.send')}}</h3><br>
    <div class="row">
      <div class="form-group col-sm-4">
      <label class="label" for="type"><strong>Notification Type:</strong></label>
      </div>
      <div class="form-group col-sm-8">
          <div class="form-group form-check" style="margin-left: 14px;">
            <div class="row">
            <label class="form-check-label">
              <input onchange="valueChanged()" class="form-check-input" type="checkbox" id="check_users" name="check_users" > Check the box to select all Users.
              <div class="invalid-feedback">Check this checkbox to continue.</div>
            </label> 
            </div>
          <div class="row">
            <label class="form-check-label">
              <input onchange="valueChanged()" class="form-check-input" type="checkbox" id="check_drivers" name="check_drivers" > Check the box to select all Drivers.
              <div class="invalid-feedback">Check this checkbox.</div>
            </label>
          </div>
        </div>
           <div class="row user-select">
              <div class="form-group col-sm-3">
            <label class="form-check-label">Single User:</label>
              </div>
              <div class="form-group col-sm-3">
                 <select name="users" id="users_selection" class="custom-select" required >
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}">
                            {{ $user }}
                        </option>
                    @endforeach
                </select>
                </div>
              </div>
        <div class="row driver-select">
          <div class="form-group col-sm-3">
            <label class="form-check-label">Single Driver:</label>
          </div>
             <div class="form-group col-sm-3">
              <select name="drivers" id="drivers_selection" class="custom-select" required >
                    @foreach($drivers as $id => $driver)
                        <option value="{{ $id }}">
                            {{ $driver }}
                        </option>
                    @endforeach
                </select>
               </div>
          <!-- <div class="invalid-feedback">Please select type.</div> -->
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
        <div class="table-responsive">
            <span class="status_msg"></span>
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                   <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.pushnotification.fields.sr') }}
                        </th>
                        <th>
                            {{ trans('global.pushnotification.fields.type') }}
                        </th>
                        <th>
                            {{ trans('global.pushnotification.fields.message') }}
                        </th>
                        <th>
                            {{ trans('global.pushnotification.fields.time') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
              
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<!-- <script>
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




</script> -->

<script>
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

function valueChanged()
    {
        if($('#check_drivers').is(":checked")){
            $("#drivers_selection").prop('disabled', true);
            $(".driver-select").hide();
        }else{
            $("#drivers_selection").prop('disabled', false);
            $(".driver-select").show();
        }
         if($('#check_users').is(":checked")){
            $("#users_selection").prop('disabled', true);
            $(".user-select").hide();
            }else{
            $("#users_selection").prop('disabled', false);
            $(".user-select").show();
            }

    }
</script>
@endsection
@endsection