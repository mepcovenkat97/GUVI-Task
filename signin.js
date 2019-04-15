
$(document).ready(function() {

    // process the form
    $('form').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'name'        : $('input[name=name]').val(),
            'email'       : $('input[name=email]').val(),
            'mobile'      : $('input[name=phone]').val(),
            'dob'         : $('input[name=dob]').val(),
            'department'  : $('input[name=department]').val(),
            'college'     : $('input[name=college]').val(),
            'password'    : $('input[name=password]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', 
            url         : 'signin.php', 
            data        : formData, 
            dataType    : 'json', 
            encode      : true
        })
            
            .done(function(data) {
                console.log(data);
                if(data.success==true)
                {
                    window.location.href = "index.html";
                }
                else
                {
                     // add the error class to show red input
                    $('#superhero-group').append('<div class="help-block"> Each and Every Field is Mandatory </div>');
                }
                console.log(formData.email);
            });

            $('.form-group').removeClass('has-error'); // remove the error class
            
            $('.help-block').remove(); // remove the error text

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
