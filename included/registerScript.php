<?php

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        $username         = mysqli_escape_string($dbc, $_POST["username"]);
        $password         = mysqli_escape_string($dbc, $_POST["password"]);
        $hashed_password  = md5($password);
        $email            = mysqli_escape_string($dbc, $_POST['email']);

        $sql = "INSERT INTO `users` (`user_id`, `username`, `hashed_password`, `email`, `profile_image_path`, `date_created`, `date_last_active`)
        VALUES (NULL, '".$username."', '".$hashed_password."', '".$email."', NULL, 'CURRENT_TIMESTAMP', 'CURRENT_TIMESTAMP')";

        if(mysqli_query($dbc, $sql)){
            $_SESSION['username'] = $username;
            echo "success";
        }else{
            echo 'failed';
        }

    }

?>
