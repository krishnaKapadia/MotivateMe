<?php

    function likeUpdate(btn) {
        // Image
        var src = "images/heartIconFilled.svg";

        if(btn.state === "clicked") {
            $likes = '.$cell['likes']++.';
            src = "images/heartIcon.svg";
            btn.state = "unclicked";

        } else {
            $likes = '.$cell['likes']--.';
            btn.state = "clicked";
        }
        btn.src = src;

        // Database update
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");
        $sql = "UPDATE photos SET likes = $likes WHERE photos.photo_id = '.$cell['photo_id'].' ";
        mysqli_query($sql);

        return true;
    }

?>

$(document).ready
