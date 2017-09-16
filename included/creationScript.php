<?php

    if(isset($_POST['str']) && isset($_POST['imgTitle'])) {
        //Ajax request therefore need to restart session to access the data
        if (session_status() == 1) session_start();

        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        //Get all required items, image string, image name and the target save location
        $imageString = base64_decode($_POST['str']);
        $username = $_SESSION['username'];
        $targetUrl = "../images/$username/";

        //Using image name, hashes the image to make saving titles easier and also removes sql injection
        $imgName   = $_POST['imgTitle'];
        $imgName = str_replace(' ', '_', $imgName);
        $imgName = md5($imgName);
        $imgExtention = ".png";

        //Create the image from the string
        $image = imagecreatefromstring($imageString);

        // //Fail check
        if($image){
            //Write permissions
            chmod("../images/",0777);

            //Check if directory exists, if not create it.
            if (!file_exists("$targetUrl")) {
                mkdir("$targetUrl", 0777, true);
            }

            //Create and save image from string data at spesified
            imagepng($image, $targetUrl.$imgName.$imgExtention, 0);
            imagedestroy($image);

            $targetUrl = "images/$username/";
            // echo " '".$targetUrl.$imgName.$imgExtention."' ";
            $sql = "INSERT INTO photos
                    VALUES (NULL, '".$_SESSION['user_id']."', '0', '".$imgName."','".$targetUrl.$imgName.$imgExtention."', now())";

            $result = mysqli_query($dbc, $sql);

            if($result) echo "Created";
            else echo "Problem";

        }else{
            echo "Not working";
        }
    }




?>
