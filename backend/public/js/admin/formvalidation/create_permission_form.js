        // Jquery validations for create permission form


   $.validator.addMethod("onlyalphanumric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
});
        $('#create_permission').validate({
          rules: {
            title:{
            required:true,
            onlyalphanumric:true
            },
          },
          messages: {
            title:{ 
            required:'Please enter the title.',            
            onlyalphanumric:'permission can not be special characters' 
          },
},
          submitHandler: function(form) {           
                form.submit();
          }
        });