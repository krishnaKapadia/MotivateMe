<?php

    //This script uploads the save to the database, allowing us to get them later on
    if(isset($_POST['user_id']) && isset($_POST['photo_id']) && isset($_POST['state'])){
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        $user_id    = $_POST['user_id'];
        $photo_id   = $_POST['photo_id'];
        $state      = $_POST['state'];

        //Create query and send new insert to database
        if($state == "inactive") {
            //Insert save into database
            $sql = "INSERT INTO saved
                    VALUES (NULL, '".$user_id."', '".$photo_id."')";
        }else{
            //Delete save from database
            $sql = "DELETE FROM saved
                    WHERE saved.user_id = $user_id
                    AND saved.photo_id  = $photo_id";
        }

        $result = mysqli_query($dbc, $sql);

        if($result) echo "Successful";
        else echo $sql;
    }

?>
