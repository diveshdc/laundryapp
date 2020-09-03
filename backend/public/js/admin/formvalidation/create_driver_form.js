 // Jquery validations for create driver form
  $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

$.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
});
$('#phone_number').mask('999 9999 9999');

        $('#create_driver').validate({

          rules: {
            first_name:{
              required:true,
              lettersonly:true
            },
            last_name:{
              required:true,
              lettersonly:true
            },
            email: {
              required: true,
              email: true
            },
            phone_number : {
                required : true,
                // onlyalphanumric:true
            },
            password : {
                required : true,
                minlength: 5
            },
            vehicle_number: {
                required : true,
                minlength: false
            },
            "roles[]": {
                required: true
            },
          },
          messages: {
            first_name: {
              required: 'Please enter first name.',
              lettersonly:'first name should be alphabet only'
            },
            last_name: {
              required: 'Please enter last name.',
              lettersonly:'last name should be alphabet only'
            },
            email : {
                required : "* Please enter a email id.",
                email: "Please enter valid email id."
            },
            phone_number : {
                required : "* Please enter phone number." ,
                // onlyalphanumric: "phone number can not be special character"
                
            },
            password : {
                required : "* Please enter password.",
                minlength: "Password must have atleast 5 characters."

            },
            vehicle_number : {
                required : "* Please enter vehicle number.",
                minlength: "Password must have atleast 30 characters."

            },
            "roles[]": {
                required : "* Please select role."
            },        
          },
          submitHandler: function(form) {           
                form.submit();
          }
      });