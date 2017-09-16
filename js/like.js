$(".displayRowContainer").on("click", "#heartBtn", function() {
    var element   = this;
    var photo_id  = $(this).attr('photo_id');
    var state     = $(this).attr('state');
    var likes     = $(this).attr('value');

    if(state == "inactive") {
        $(element).attr('src', "images/heartIconFilled.svg");
        $("#" + photo_id).text("Likes: " + (++likes));
    }else {
        $(element).attr('src', "images/heartIcon.svg");
        $("#" + photo_id).text("Likes: " + (likes));
    }

    $.ajax({
        type:           "POST",
        url:            "included/likeScript.php",
        data:           { photo_id: photo_id, state: state, likes: likes },

        beforeSend: function() {
            console.log("sending the like query");
        },

        success: function(response) {
            if(response == "Successful") {
                // console.log("worked!!!!!!!!!");
                //Change image to show state, active or not
                if(state == "inactive") {
                    // $(element).attr('src', "images/heartIconFilled.svg");
                    $(element).attr('state', "active");
                    // $("#" + photo_id).text("Likes: " + (++likes));
                } else {
                    // $(element).attr('src', "images/heartIcon.svg");
                    $(element).attr('state', "inactive");
                    // $("#" + photo_id).text("Likes: " + (likes));
                }

            } else console.log(response);
        },

        error: function(exception) {
            console.log('ERROR');
            console.log(exception);
        }

    });

});


$(document).on('click', '#heartIcon', function() {
    var element   = this;
    var photo_id  = $(this).attr('photo_id');
    var state     = $(this).attr('state');
    var likes     = $(this).attr('value');

    if(state === "inactive") {
        $(element).attr('src', "images/heartIconFilled.svg");
        $(".likesOut").text("Likes: " + (++likes));
    }else {
        $(element).attr('src', "images/heartIcon.svg");
        $(".likesOut").text("Likes: " + (likes));
    }

    $.ajax({
        type:           "POST",
        url:            "included/likeScript.php",
        data:           { photo_id: photo_id, state: state, likes: likes },

        beforeSend: function() {
        },

        success: function(response) {
            if(response == "Successful") {
                //Change image to show state, active or not
                if(state == "inactive") {
                    // $(element).attr("src", "images/heartIconFilled.svg");
                    $(element).attr("state", "active");
                    // $(".likesOut").text("Likes: " + (++likes));
                } else {
                    // $(element).attr("src", "images/heartIcon.svg");
                    $(element).attr("state", "inactive");
                    // $(".likesOut").text("Likes: " + (likes));
                }

            } else console.log(response);
        },

        error: function(exception) {
            console.log('ERROR');
            console.log(exception);
        }
    });
});
