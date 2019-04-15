
$(document).ready(function() {

    // process the form
    $('form').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'email'       : $('input[name=email]').val(),
            'password'    : $('input[name=password]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', 
            url         : 'login.php', 
            data        : formData, 
            dataType    : 'json', 
            encode      : true
        })
            
            .done(function(data) {
                console.log(data);
                if(data.success==true)
                {
                    window.location.href = "userdata.html";
                }
                else
                {
                    $('#email-group').addClass('has-error');
                    $('#password-group').addClass('has-error'); // add the error class to show red input
                    $('#password-group').append('<div class="help-block"> Username or Password is Wrong </div>');
                }
                console.log(formData.email);
            });

            $('.form-group').removeClass('has-error'); // remove the error class
            
            $('.help-block').remove(); // remove the error text

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
