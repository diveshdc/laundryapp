// Jquery validations for create coupon form
 
 var regex = "^\d+$";
 $.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || regex.test(value);
});
        $('#create_coupon').validate({

          rules: {
            "coupon_code": 'required',
            // "price": {
            //     required : true,
            //     onlyalphanumric : true
            // },
            // expiry_date: {
            //     required : true,
            //      date : true
            // },
            // description:{
            // required: true,
            // },
            // discount_type:{
            //     required:true,
            // }, 
          },
          messages: {
            coupon_code: 'Please enter coupon code.',  
            // price: {
            //     required : 'Please enter price.',
            //     onlyalphanumric : 'Amount should be number only.'
            // },
            // expiry_date: {
            //     required : 'Please enter expiry date.',
            //     date : 'Date format invalid, Please use format like:(mm/dd/yyyy).'
            // },
            // description:{
            //  required: 'Please enter description.',       
            // },
            // discount_type:{
            //     required: 'Please select discount type',
            // },
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });

         $('.genarate_coupon_code').click(function(event) {
          document.getElementById('coupon_code').value= Math.random().toString(10).substring(10);

   });

           
     