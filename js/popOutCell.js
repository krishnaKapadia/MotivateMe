$(document).ready(function () {
    // document.body.style.overflow = 'hidden';

    $('.modalImage').on('click', function () {
        var image    = $(this).attr('src');
        var username = $(this).attr('username');
        var likes    = $(this).attr('likes');
        var photo_id = $(this).attr('photo_id');
        var user_id  = $(this).attr('user_id');

        // $('#modalPopup').on('show.bs.modal', function () {
            $(".emptyModal").attr("src", image);
            $(".downloader").attr('download', image);
            $(".downloader").attr('href', image);

            $('.usernameOut').text("@" + username);
            $('.likesOut').text("Likes: " + likes);

            //Used to set up like functions
            $("#heartIcon").attr("src", "images/heartIcon.svg");
            $("#heartIcon").attr("state", "inactive");

            $("#heartIcon").attr("value", likes);
            $("#heartIcon").attr("photo_id", photo_id);

            $("#saveIcon").attr("user_id", user_id);
            $("#saveIcon").attr("src", "images/saveIcon.svg");
            $("#saveIcon").attr("photo_id", photo_id);

            $('#modalPopup').fadeIn();

    });

    //Allows the user to click outside the modal, the faded area, to dismiss the modal
     $("body").on("click", ".modal", function(e) {
         if ( $(e.target).hasClass('modal-content') ||
              $(e.target).hasClass('modal-body')    ||
              $(e.target).hasClass('emptyModal')    ||
              $(e.target).hasClass('cellContent')   ||
              $(e.target).hasClass('cellInner row') ||
              $(e.target).hasClass('cellUsers col-xs-4') ||
              $(e.target).hasClass('iconRow')       ||
              $(e.target).hasClass('usernameOut')   ||
              $(e.target).hasClass('likesOut')      ||
              $(e.target).hasClass('iconPadding')
          ) {

         }else{
             $('#modalPopup').fadeOut();
             $('.modal-backdrop').fadeOut();
         }
    });

    // $('.remodal-close, #modalPopup').on('click', function(e) {
    //     $("#modalPopup").fadeOut();
    // });

    $('.remodal-close').on('click', function(e) {
        $("#modalPopup").fadeOut();
    });

    // Updating like numbers
    // $('#heartBtn').on('click', function() {
    //     alert('awd');
    //     var val = parseInt($('#heartBtn').val());
    //     $.ajax({
    //         type:   "POST",
    //         url:    "included/likeUpdate.php",
    //         data:   { value: val },
    //
    //         success: function(response) {
    //             alert(response);
    //         }
    //
    //     });
    //
    // });

    //Saves the image to the users saved images


});

// Get the modal
// var modal = document.getElementById('modalPopup');
//
// // Get the button that opens the modal
// var btn = document.getElementById("imgClick");
//
// // When the user clicks on the button, open the modal
// btn.onclick = function() {
//     modal.style.display = "block";
// }
//
// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//     modal.style.display = "none";
// }
//
// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }
