// Jquery validations for edit product form
        $('#edit_product').validate({

          rules: {
            "name": 'required',
            "price": 'required',
            "description": 'required',
          },
          messages: {
            name: 'Please enter name.',  
            price: 'Please enter price.',  
            description: 'Please enter description.',       
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });