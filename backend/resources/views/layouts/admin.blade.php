<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('global.site_title') }}</title>
 <!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" /> -->
    <link href="{{ asset('css/admin/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/admin/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/admin/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/admin/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/admin/select.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/coreui.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/admin/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('icon/coreui-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('icon/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" rel="stylesheet" type="text/css">
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span class="navbar-brand-full" style="font-weight: 900;font-size: 30px; color: #20a8d8">Spotlex</span>
            <span class="navbar-brand-minimized" style="font-weight: 900;font-size: 30px; color: #20a8d8">SP</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            @if(count(config('panel.available_languages', [])) > 1)
            <li class="nav-item dropdown d-md-down-none">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                    <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                    @endforeach
                </div>
            </li>
            @endif
        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">


            <div style="padding-top: 20px" class="container-fluid">

                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/popper.min.js') }}"></script>
    <script src="{{ asset('js/admin/coreui.min.js') }}"></script>
    <script src="{{ asset('js/admin/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/admin/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/admin/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/admin/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/admin/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/admin/pdfmake.min.js')}}"></script>
    <script src="{{ asset('js/admin/vfs_fonts.js')}}"></script>
    <script src="{{ asset('js/admin/jszip.min.js')}}"></script>
    <script src="{{ asset('js/admin/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/admin/ckeditor.js')}}"></script>
    <script src="{{ asset('js/admin/moment.min.js')}}"></script>
    <script src="{{ asset('js/admin/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap-toggle.min.js')}}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
     <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>

     <script src="{{ asset('js/admin/formvalidation/add_product_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/add_product_form_submit.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_category_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_coupon_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_driver_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_permission_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_rules_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/create_user_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_category_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_coupon_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_driver_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_permission_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_product_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_rules_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/edit_user_form.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/user_status.js') }}"></script>
     <script src="{{ asset('js/admin/formvalidation/add_postcode_form.js') }}"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        $(function() {
          let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
          let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
          let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
          let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
          let printButtonTrans = '{{ trans('global.datatables.print') }}'
          let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

          let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
              url: languages.{{ app()->getLocale() }}
          },
          columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }, {
            orderable: false,
            searchable: false,
            targets: -1
        }],
        select: {
          style:    'multi+shift',
          selector: 'td:first-child'
      },
      order: [],
      scrollX: true,
      pageLength: 100,
      dom: 'lBfrtip<"actions">',
      buttons: [
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
      }
  },
  {
    extend: 'csv',
    className: 'btn-default',
    text: csvButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'excel',
    className: 'btn-default',
    text: excelButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'pdf',
    className: 'btn-default',
    text: pdfButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'print',
    className: 'btn-default',
    text: printButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'colvis',
    className: 'btn-default',
    text: colvisButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
]
});
        $.fn.dataTable.ext.classes.sPageButton = '';
    });
        $('.pound').mask('999,999,999');
  function duplicateEmail(element){
  var email = $(element).val();
  console.log(email);
  $.ajax({
      type: "POST",
      url: '{{url('checkemail')}}',
      data: {email:email},
      dataType: "json",
      success: function(res) {
          if(res.exists){
              alert('true');
          }else{
              alert('false');
          }
      },
      error: function (jqXHR, exception) {

      }
  });
}
        function checkEmailIsAlready(element){
            var email = $(element).val();
            console.log(email);
            $.ajax({
                type: "POST",
                url: '/admin/checkEmailIsAlready',
                data: {
                    email:email,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(res) {
                    if(res.exists){
                        $('#is_exists').text('This email already registered with us try another');
                        $('input.create_user').attr("disabled", true);
                        console.log('yes')
                    }else{
                        console.log('no')
                        $('#is_exists').text('');
                        $('input.create_user').attr("disabled", false);
                    }
                },
                error: function (jqXHR, exception) {

                }
            });
        }

        // show error message function
function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            // $.each( msg, function(key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
            // });
        }

                // show error message function
function printSuccessMsg (msg) {
            $(".print-success-msg").find("ul").html('');
            $(".print-success-msg").css('display','block');
            // $.each( msg, function(key, value ) {
                $(".print-success-msg").find("ul").append('<li>'+msg+'</li>');
            // });
        }

    $('.block-unblock-class').change(function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var user_id = $(this).data('id'); 
     
    $.ajax({
        type: "POST",
        headers: {'x-csrf-token': _token},
        dataType: "json",
        url: "{{ route('admin.blockuser') }}",
        data: {'status': status, 'user_id': user_id},
        success: function(data){
          console.log(data.success)
        }
    });
})

 $('.unpublish-publish-class').change(function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var postcode_id = $(this).data('id'); 
     
    $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        url: "{{ route('admin.post_code_publish_unpublish') }}",
        data: {
             '_token': "{{ csrf_token() }}",
             'status': status,
             'postcode_id': postcode_id
         },
        success: function(data){
          console.log(data)
          window.location.reload();
        }
    });
})

 $('.request-unpublish-publish-class').change(function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var postcode_id = $(this).data('id'); 
     
    $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        url: "{{ route('admin.post_code_publish_unpublish') }}",
        data: {
             '_token': "{{ csrf_token() }}",
             'status': status,
             'postcode_id': postcode_id
         },
        success: function(data){
          console.log(data)
          window.location.reload();
        }
    });
})
    </script>
    @yield('scripts')
</body>

</html>
