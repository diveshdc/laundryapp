// Jquery validations for add product form
 var regex = "^\d+$";
 $.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || regex.test(value);
});
        $('#add_product').validate({

          rules: {
            "name": {
             required:true,
             number:false 
           },
            price:{
             required:true,
             onlyalphanumric:true

            },
            description:{
            required:true,
            }, 
            "category[]": {
                required: true
            },
            image:{
            required:'required',

            }, 
          },
          messages: {
            name: {
            required:'Please enter name.',  
            number:'Name can not be number'
            },
            price:{
              required:'Please enter price',
            onlyalphanumric:'Price should be number only.' 
            },
            description: {
              required:'Please enter description.',
          }, 
            "category[]": {
                required : "Please select atleast one category."
            },
            image: {
            required:'Please select a product image.',        

            },
          },
          submitHandler: function(form) {           
                form.submit();
          }
        });