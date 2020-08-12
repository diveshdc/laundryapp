// Jquery validations for create usser form
 $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

$.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
});


        $('#create_user').validate({

          rules: {
            first_name:{
              required: true,
              lettersonly: true
            },
            last_name:{
              required: true,
              lettersonly: true
            },
            email: {
              required: true,
                email: true
            },
            phone_number : {
                required : true,
                onlyalphanumric:false 

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
            first_name:{
              required :'Please enter first name.',  
              lettersonly: 'First name should be only alphabet'
            }, 
            last_name:{
              required :'Please enter last name.',  
              lettersonly: 'Last name should be only alphabet'
            },
            email : {
                required : "Please enter a email address.",
                email: "Please enter valid email address."
            },
            phone_number : {
                required : "* Please enter phone number." ,
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