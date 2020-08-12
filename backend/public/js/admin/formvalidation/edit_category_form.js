  // Jquery validations for edit category form
   $.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
});
        $('#edit_category').validate({

          rules: {
            name:{
             required: true,
             onlyalphanumric: false
            },
            description:{
            required:true,
            }, 
          },
          messages: {
            name: {
            required:'Please enter name.',
            onlyalphanumric:'Category can not be special characters'
            },
            description: {
            required:'Please enter description.',       
            },
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });