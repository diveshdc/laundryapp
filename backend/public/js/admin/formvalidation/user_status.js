$(function() {
            $('.user-status').change(function() {
                var status = $(this).prop('checked') == true ? 'Unblock': 'Block' ; 
                console.log(status);
                var user_id = $(this).data('id'); 
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    type: "POST",
                    dataType: "json",
                    url: 'changeStatus',
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                      console.log(data.success)
                  }
              });
            })
        })