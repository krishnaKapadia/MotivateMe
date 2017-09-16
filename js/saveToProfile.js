$(document).ready(function(){

    //Gets the current users id, and the photo_id of the photo to be saved
    $("#saveIcon").on('click', function() {
        var user_id   = $(this).attr('user_id');
        var photo_id  = $(this).attr('photo_id');
        var state     = $(this).attr('state');

        $.ajax({
            type:           "POST",
            url:            "included/saveToProfileScript.php",
            data:           { user_id: user_id, photo_id: photo_id, state: state },

            beforeSend: function() {
                console.log("sending the save query");
            },

            success: function(response) {
                if(response == "Successful") {
                    // console.log("worked!!!!!!!!!");
                    //Change image to show state, active or not
                    if(state == "inactive") {
                        $("#saveIcon").attr('src', "images/saveIconFilled.svg");
                        $("#saveIcon").attr('state', "active");
                    } else {
                        $("#saveIcon").attr('src', "images/saveIcon.svg");
                        $("#saveIcon").attr('state', "inactive");
                    }

                } else console.log(response);
            },

            error: function(exception) {
                console.log('ERROR');
                console.log(exception);
            }

        });
    });

});
