// Jquery validations for add product form
           $('#add_postcode').validate({
          rules: {
            "post_code": {
             required:true,
           },
          },
          messages: {
            post_code: {
            required:'Please enter postcode.',  
            },
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });