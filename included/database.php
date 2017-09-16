<?php

    //Database connection_aborted
    $dbc = mysqli_connect("localhost", "root", "", "motivateme");
    if(!$dbc){
        echo "Connection could not be established";
        exit;
    }

    //Gets all cell information
    function getImageCells($sortOrder) {
        global $dbc;

        //GET all images query
        switch ($sortOrder) {
            case 'today':
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id WHERE photos.date_created < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY photos.likes DESC";
                break;

            case 'week':
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id WHERE photos.date_created < DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY photos.likes DESC";
                break;

            case 'allTime':
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id ORDER BY photos.likes DESC";
                break;

            case 'popular':
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id ORDER BY photos.likes";
                break;

            case 'latest':
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id ORDER BY photos.date_created DESC";
                break;

            default:
                $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id WHERE photos.date_created < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY photos.likes DESC";
                break;
        }

        // $query = "SELECT * FROM photos NATURAL JOIN users";
        $result = mysqli_query($dbc, $query);

        $allCells = array();

        //Looping through each result and storing it in an array
        while($cell = mysqli_fetch_assoc($result)){
            $allCells[] = $cell;
        }

        return $allCells;
    }

    //Gets all image cells of a spesific user
    function getUserProfileCells($username){
        global $dbc;

        $query = "SELECT * FROM photos JOIN users ON photos.user_id = users.user_id WHERE users.username = '$username'";

        $result = mysqli_query($dbc, $query);
        $allCells = array();

        //Store each result in an array
        while($cell = mysqli_fetch_assoc($result)){
            $allCells[] = $cell;
        }

        return $allCells;
    }

    //Gets all image cells of a spesific user
    function getSavedCells($user_id){
        global $dbc;

        $query = "SELECT * FROM saved JOIN photos ON saved.photo_id = photos.photo_id
                    JOIN users ON users.user_id = photos.user_id
                    WHERE saved.user_id = '$user_id'";

        $result = mysqli_query($dbc, $query);
        $allCells = array();

        //Store each result in an array
        while($cell = mysqli_fetch_assoc($result)){
            $allCells[] = $cell;
        }

        return $allCells;
    }

    function getTotalNumSaved($username){
        global $dbc;

        $query = "SELECT COUNT(Q.user_id) AS 'totalSaved'
                    FROM (SELECT user_id
                          FROM saved
                          WHERE saved.user_id = (SELECT user_id
                     							  FROM users
                     							  WHERE users.username = '$username' LIMIT 1)) AS Q";

        $result = mysqli_query($dbc, $query);
        $userObject = mysqli_fetch_object($result);
        $total = $userObject -> totalSaved;
        return $total;
    }

    //Queries the database and gets the image path of the desired user
    function getProfileImage($username){
        global $dbc;

        $query = "SELECT profile_image_path FROM users WHERE users.username = '$username' ";

        $result = mysqli_query($dbc, $query);
        $userObject = mysqli_fetch_object($result);
        $imagePath = $userObject -> profile_image_path;
        return $imagePath;
    }

    //gets users id given username
    function getId($username){
        global $dbc;

        $query = "SELECT user_id FROM users WHERE users.username = '$username' ";

        $result = mysqli_query($dbc, $query);
        $userObject = mysqli_fetch_object($result);
        $user_id = $userObject -> user_id;
        return $user_id;
    }

    //Returns the number of photos that the user has uploaded
    function getTotalNumPhotos($username) {
        global $dbc;

        $query = "SELECT COUNT(Q.photo_id) AS 'imageCount'
                    FROM (SELECT photos.photo_id
                    	  FROM photos
                    	  WHERE photos.user_id = (SELECT user_id
                                            	  FROM users
                                            	  WHERE users.username = '$username' LIMIT 1)) AS Q";

        $result = mysqli_query($dbc, $query);
        $userObject = mysqli_fetch_object($result);
        $imagePath = $userObject -> imageCount;
        return $imagePath;
    }

    //Returns the total number of hearts that a user has gotten over all their photos
    function getTotalNumHearts($username) {
        global $dbc;

        $query = "SELECT SUM(Q.likes) AS 'totalHearts'
                    FROM (SELECT likes
                     	  FROM photos
                     	  WHERE photos.user_id = (SELECT user_id
                     							  FROM users
                     							  WHERE users.username = '$username' LIMIT 1)) AS Q";

        $result = mysqli_query($dbc, $query);
        $userObject = mysqli_fetch_object($result);
        $total = $userObject -> totalHearts;
        return $total;
    }

    //Returns the proile information of the given user
    function getProfile($username){
        global $dbc;

        $query = "SELECT * FROM users WHERE users.username = '$username' LIMIT 1";

        $result = mysqli_query($dbc, $query);
        $allInfo = array();

        //Store each result in an array
        while($info = mysqli_fetch_assoc($result)){
            $allInfo[] = $info;
        }

        return $allInfo;
    }

    //Returns the number of likes of a spesific photo
    function getLikes($photo_id) {
        global $dbc;

        $query = "SELECT likes FROM photos WHERE photos.photo_id = '$photo_id' LIMIT 1";

        $result = mysqli_query($dbc, $query);

        echo $photo_id.'='.$result;
    }

    //Processes the users login
    function processUserLogin($usernameInput, $passwordInput){
        global $dbc;

        $username = mysqli_real_escape_string($dbc, $_POST['username']);
        $password = mysqli_real_escape_string($dbc, $_POST['password']);

        echo "$username and $password";

        $sql = "SELECT username, hashed_password
                FROM users
                WHERE username = '$username'
                AND hashed_password = '$password' ";

        $result = mysqli_query($dbc, $sql);

        //If username or password is not found in database
        if(mysqli_num_rows($result) == 0){
            $loginResult['success'] = false;
            $loginResult['message'] = 'Username or password is incorrect!';
            // session_destroy();
            return $loginResult;
        } else {
            //Is valid
            $userData = mysqli_fetch_assoc($result);

            $loginResult['success'] = true;
            $loginResult['message'] = "Login Successful!";
            $loginResult['username'] = $username;
            return $loginResult;
        }
    }

?>
