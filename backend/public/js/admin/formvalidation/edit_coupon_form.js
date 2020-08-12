 // Jquery validations for edit coupon form
        $('#edit_coupon').validate({

          rules: {
            "coupon_code": 'required',
            "price": {
                required : true,
                number : false
            },
            "start_date": {
                required : true,
                date : true
            },
            "expiry_date": {
                required : true,
                date : true
            },
            "description": 'required',
          },
          messages: {
            coupon_code: 'Please enter coupon code.',  
            price: {
                required : 'Please enter price.',
                number : 'Please enter only numbers.'
            },
            start_date: {
                required : 'Please enter start date.',
                date : 'Date format invalid, Please use format like:(mm/dd/yyyy).'
            },
            expiry_date: {
                required : 'Please enter expiry date.',
                date : 'Date format invalid, Please use format like:(mm/dd/yyyy).'
            },
            "description": 'Please enter description.',       
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });