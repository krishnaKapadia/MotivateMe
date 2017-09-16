$(document).ready(function(){

    $("#creationSubmit").click(function(e){
        var title = $("#imgTitleInput").html();

        //First clear any formatting on the inputs
        $('#imgTitleInput').css("border","");
        $('#imgTitleInput').css("box-shadow","");

        //Validation to user for username and passwords
        if(title == 'Image title...' || title == ''){
            $('#imgTitleInput').css("color","red");
            $('#imgTitleError').html("Please enter a image title!").css("color","red");
        }else{
            //Clear any existing error styling
            $('#imgTitleInput').css("color","");
            $('#imgTitleError').hide();

            //We need: image title and the canvas image as a text string for php to build into image
            var canvasStrURI = canvas.toDataURL();
            canvasStrURI = canvasStrURI.substr(22, canvasStrURI.length);

            $.ajax({
                type:   "POST",
                url:    "included/creationScript.php",
                data:   { str: canvasStrURI, imgTitle: title },

                beforeSend: function(){
                    // console.log("sending");
                    $("#creationSubmit").hide();
                    $("#creationSubmit").promise().done(function() {
                        $("#loadingAnimation").show('fast');
                    });
                },

                success: function(response){
                    if(response == "Created"){
                        console.log("IT WORKED");
                        $("#loadingAnimation").hide();
                        //submit the form
                        $("#creation").fadeOut();
                        $("#SuccessfulCreation").show();

                    }else{
                        console.log(response);
                        $("#loadingAnimation").hide();
                        $('#imgTitleError').html("Please try again!").css("color","red");
                        $("#loadingAnimation").promise().done(function() {
                            $("#creationSubmit").show('fast');
                        });
                    }
                },

                error: function(exception){
                    alert(exception);
                    $("#loadingAnimation").hide();
                }

            });

        }

    });
});
