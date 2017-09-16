<?php

    //This script updates the photo's likes
    if (isset($_POST['photo_id']) && isset($_POST['state']) && isset($_POST['likes'])) {
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        $photo_id   = $_POST['photo_id'];
        $state      = $_POST['state'];
        $likes      = $_POST['likes'];

        //Create query based of state
        if($state == "inactive"){
            //Likes + 1
            $likes = $likes + 1;
        }else{
            //Likes - 1
            $likes = $likes;
        }

        $sql = "UPDATE photos SET likes = $likes
                WHERE photos.photo_id = $photo_id";

        $result = mysqli_query($dbc, $sql);

        if($result) echo "Successful";
        else echo $sql;

    }

    //This script returns the likes of a spesific photo
    if(isset($_GET['id'])){
        echo "nakjwndjakwndjk";
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        $query = "SELECT likes FROM photos WHERE photos.photo_id = '$photo_id' LIMIT 1";

        $result = mysqli_query($dbc, $query);

        echo "likes=".json_encode($result);
    }

?>
