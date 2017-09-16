$(document).ready(function(){

    $("#loginSubmit").click(function(e){
        // e.preventDefault();
        // e.stopPropagation();
        var usernameField = $("#usernameInput").val();
        var passwordField = $("#passwordInput").val();

        //First clear any formatting on the inputs
        $('input[type="text"],input[type="password"]').css("border","");
        $('input[type="text"],input[type="password"]').css("box-shadow","");
        $('#usernameError').html("").css("color","");
        $('#passwordError').html("").css("color","");

        //Validation to user for username and passwords
        if(usernameField == '' || passwordField == ""){
            if(usernameField == ''){
                $('input[type="text"]').css("border","2px solid red");
                $('input[type="text"]').css("box-shadow","0 0 3px red");
                $('#usernameError').html("Please enter username!").css("color","red");
            }else{
                $('input[type="text"]').css("border","");
                $('input[type="text"]').css("box-shadow","");
                $('#usernameError').html("").css("color","");
            }

            if(passwordField == ''){
                $('input[type="password"]').css("border","2px solid red");
                $('input[type="password"]').css("box-shadow","0 0 3px red");
                $('#passwordError').html("Please enter password!").css("color","red");
            }else{
                $('input[type="password"]').css("border","");
                $('input[type="password"]').css("box-shadow","");
                $('#passwordError').html("").css("color","");
            }
        }else{
            //Validated
            //Send post request through ajax to the login script to check for correct user credentials
            //   var data = $("#login-form").serialize();
            $.ajax({
                type:           "POST",
                url:            "included/loginScript.php",
                data:           { username: usernameField, password: passwordField},

                beforeSend: function(){
                    // $("#loginSubmit").hide('slow');
                    // $("#loadingAnimation").show('show');
                    $("#loginSubmit").hide();
                    $("#loginSubmit").promise().done(function(){
                        $("#loadingAnimation").show('fast');
                    });
                },

                success: function(response){
                    if(response == "login Successful") {
                        $("#loginForm").submit();
                        // $("successModal").show();
                    }else{
                        // Clear's user input errors
                        $('#usernameError').html("").css("color","");
                        $('#passwordError').html("").css("color","");

                        //Brings back the submit button and hides loader animation
                        $("#loadingAnimation").hide();
                        // $("#loadingAnimation").promise().done(function(){
                            $("#loginSubmit").show('fast');
                        // });

                        // alert("Not logged in");
                        $('input[type="text"],input[type="password"]').css("border","2px solid red");
                        $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
                        $('#usernameError').html("Incorrect username!").css("color","red");
                        $('#passwordError').html("Incorrect password!").css("color","red");
                    }
                },


                error:function(exception){
                    alert(exception);
                    $("#loadingAnimation").hide();
                }

            });

        }
    });

    $('#usernameInput').keypress(function (e) {
        var key = e.which;
        if(key == 13)  {
            $("#loginSubmit").click();
        }
    });

    $('#passwordInput').keypress(function (e) {
        var key = e.which;
        if(key == 13)  {
            $("#loginSubmit").click();
        }
    });

});
