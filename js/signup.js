$(document).ready(function(){
    $("#registerSubmit").click(function(e){
        // e.preventDefault();
        // e.stopPropagation();
        var emailField    = $("#emailInputRegister").val();
        var usernameField = $("#usernameInputRegister").val();
        var passwordField = $("#passwordInputRegister").val();

        //First clear any formatting on the inputs
        $('input[type="text"],input[type="password"],input[type="email"]').css("border","");
        $('input[type="text"],input[type="password"],input[type="email"]').css("box-shadow","");
        $('#usernameErrorRegister').html("").css("color","");
        $('#passwordErrorRegister').html("").css("color","");
        $('#emailErrorRegister').html("").css("color","");

        //Validation to user for username and passwords
        if(usernameField == "" || passwordField == "" || emailField == "") {
            if(usernameField == ''){
                $('input[type="text"]').css("border","2px solid red");
                $('input[type="text"]').css("box-shadow","0 0 3px red");
                $('#usernameErrorRegister').html("Please enter username!").css("color","red");
            }else{
                $('input[type="text"]').css("border","");
                $('input[type="text"]').css("box-shadow","");
                $('#usernameErrorRegister').html("").css("color","");
            }

            if(passwordField == ''){
                $('input[type="password"]').css("border","2px solid red");
                $('input[type="password"]').css("box-shadow","0 0 3px red");
                $('#passwordErrorRegister').html("Please enter password!").css("color","red");
            }else{
                $('input[type="password"]').css("border","");
                $('input[type="password"]').css("box-shadow","");
                $('#passwordErrorRegister').html("").css("color","");
            }

            if(emailField == ''){
                $('input[type="email"]').css("border","2px solid red");
                $('input[type="email"]').css("box-shadow","0 0 3px red");
                $('#emailErrorRegister').html("Please enter email!").css("color","red");
            }else{
                $('input[type="email"]').css("border","");
                $('input[type="email"]').css("box-shadow","");
                $('#emailErrorRegister').html("").css("color","");
            }

        }else{
            //Validated

            //Send post request through ajax to the login script to check for correct user credentials
            $.ajax( {
                type:           "POST",
                url:            "included/registerScript.php",
                data:           { email: emailField, username: usernameField, password: passwordField },

                beforeSend: function() {
                    $("#registerSubmit").hide();
                    $("#registerSubmit").promise().done(function(){
                        $("#loadingAnimationRegister").show('fast');
                    });
                },

                success: function(response) {
                    if(response == "success") {

                        $("#registerForm").submit();
                    }else{
                        // Clear's user input errors
                        $('#usernameErrorRegister').html("").css("color","");
                        $('#passwordErrorRegister').html("").css("color","");
                        $('#emailErrorRegister').html("").css("color","");

                        //Brings back the submit button and hides loader animation
                        $("#loadingAnimationRegister").hide();
                        // $("#loadingAnimation").promise().done(function(){
                            $("#registerSubmit").show('fast');
                        // });

                        alert(response);
                        $('input[type="text"],input[type="password"],input[type="email"]').css("border","2px solid red");
                        $('input[type="text"],input[type="password"],input[type="email"]').css("box-shadow","0 0 3px red");
                        $('#usernameErrorRegister').html("Incorrect username!").css("color","red");
                        $('#passwordErrorRegister').html("Incorrect password!").css("color","red");
                        $('#emailErrorRegister').html("Incorrect email!").css("color", "red")
                    }
                },

                error:function(exception) {
                    $("#loadingAnimationRegister").hide();
                }

            });

        }

    });


    $('#emailInputRegister').keypress(function (e) {
        var key = e.which;
        if(key == 13)  {
            $("#registerSubmit").click();
        }
    });

    $('#usernameInputRegister').keypress(function (e) {
        var key = e.which;
        if(key == 13)  {
            $("#registerSubmit").click();
        }
    });

    $('#registerButtonDiv').keypress(function (e) {
        var key = e.which;
        if(key == 13)  {
            $("#registerSubmit").click();
        }
    });


});
