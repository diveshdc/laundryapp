  // Jquery validations for edit driver form
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

$.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
});
        $('#edit_driver').validate({

          rules: {
           name:{
            required :true,
            lettersonly:true
           },
            email: {
              required: true,
              email: true
            },
            postcode : {
                required : true,
                onlyalphanumric:true
            },
            password : {
                required : true,
                minlength: 5
            },
            "roles[]": {
                required: true
            },
          },

          messages: {
            name:{ 
              required:'Please enter name.',  
            lettersonly:'Name should be only alphabet'
          },
            email : {
                required : "Please enter a email id.",
                email: "Please enter valid email id."
            },
            postcode : {
                required : "Please enter postal code." ,
                onlyalphanumric:'Post code can not be special characters'
                
            },
            password : {
                required : "Please enter password.",
                minlength: "Password must have atleast 5 characters."

            },
            "roles[]": {
                required : "Please select role."
            },        
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });