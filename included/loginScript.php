<?php

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $dbc = mysqli_connect("localhost", "root", "", "motivateme");

        $username = mysqli_escape_string($dbc, $_POST["username"]);
        $password = mysqli_escape_string($dbc, $_POST["password"]);
        $username = str_replace(" ", "", $username); //TODO: Untested line

        $hashed_password = md5($password);

        $sql = "SELECT *
        FROM users
        WHERE username = '".$username."'
        AND hashed_password = '".$hashed_password."'";

        $result = mysqli_query($dbc, $sql);

        //If username or password is not found in database
        if(mysqli_num_rows($result) == 0){
            $loginResult['success'] = false;
            $loginResult['message'] = 'Username or password is incorrect!';
            // session_destroy();
            echo "incorrect Credentials for $username";
        } else {
            //Is valid
            $userData = mysqli_fetch_assoc($result);

            $loginResult['success'] = true;
            $loginResult['message'] = "Login Successful!";
            $loginResult['username'] = $username;

            //Needed variables to save
            $_SESSION['username'] = $username;
            $_SESSION['profile_image_path'] = $userData['profile_image_path'];
            $_SESSION['user_id'] = $userData['user_id'];

            echo "login Successful";

        }
    }

?>
