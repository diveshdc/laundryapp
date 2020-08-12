 // Jquery validations for edit rules form
        $('#edit_role').validate({

          rules: {
            "title": 'required',
            "permissions[]": 'required',
          },
          messages: {
            title: 'Please enter the title.',
            "permissions[]": 'Please select atleast one permission.'
          },

          submitHandler: function(form) {           
                form.submit();
          }
        });