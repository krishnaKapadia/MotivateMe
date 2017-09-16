<script type="text/javascript">
    // var delay = 5000;
    // var check = window.setInterval(checkLikes, delay);
    //
    // function checkLikes(){
    //     $.getJSON("likeScript.php?id='.$photo_id.'", function(result){
    //         if(result) $(".likes").text(result);
    //         alert(result);
    //     });
    // }
</script>

<?php
    //Includes any needed scripts such as the saving to profile and like script
    include("included/saveToProfileScript.php");
    include("included/likeScript.php");

    //SORT ORDERS
    if (isset($_GET['sortOrder'])) $allCells   = getImageCells($_GET['sortOrder']);
    else if(isset($_GET['popular'])) $allCells = getImageCells('allTime');
    else if(isset($_GET['latest'])) $allCells  = getImageCells('latest');
    else if(isset($_GET['profile'])) {
        $profile = getProfile($_GET['profile']);
        $user_id = null;
        foreach ($profile as &$info) {
            echo '
                <div class="profileContainer">
                    <img id="profileImage" class="img img-rounded img-responsive" src="'.$info['profile_image_path'].'" />
                    <h3>@'.$info['username'].'</h3>
                </div>
            ';

            if(isset($_SESSION['username'])){
                echo '
                    <div class="savedMenu">
                        <div class="row">
                            <h4><small class="hvr-grow left"><a href="index.php?profile='.$info['username'].'">My Photos</a></small></h4>
                            <line>
                            <h4><small class="hvr-grow right"><a href="index.php?profile='.$info['username'].'&display=saved">Saved Photos</a></small></h4>
                        </div>
                    </div>
                ';
            }
            $user_id = $info['user_id'];
        }

        if(isset($_GET['display'])) $allCells = getSavedCells($user_id);
        else $allCells  = getUserProfileCells($_GET['profile']);

    }else $allCells = getImageCells(null);

    //Build image grid
    $count = 0;
    foreach ($allCells as &$cell) {
        $username = $cell['username'];
        if(isset($_SESSION['username'])) $user_id = $_SESSION['user_id'];
        $likes    = $cell['likes'];
        $imgPath  = $cell['image_path'];
        $photo_id   = $cell['photo_id'];

        echo '
            <div class="col-sm-4 cell hvr-grow">
                <!-- IMAGE -->';
                if(isset($_SESSION['username'])) echo '<input id="imgClick" type="image" data-target="#modalPopup" photo_id="'.$photo_id.'" user_id="'.$user_id.'" username="'.$username.'" likes="'.$likes.'" class="img-rounded img modalImage" src="'.$imgPath.'"></input>';
                else echo '<input id="imgClick" type="image" data-target="#modalPopup" photo_id="'.$photo_id.'" username="'.$username.'" likes="'.$likes.'" class="img-rounded img modalImage" src="'.$imgPath.'"></input> ';
                echo '

                <!-- CONTROLS -->
                <div class="row">

                    <div class="col-xs-6 align-left">
                        <p><a href="index.php?profile='.$username.' "> @'.$username.'</a></p>
                        <p><small id="'.$photo_id.'" class="likes">Likes: '.$likes.'</small></p>
                    </div>

                    <!-- HEART BUTTON-->
                    <div class="col-xs-6 align-right">
                        <input id="heartBtn" value="'.$likes.'" class="hvr-grow" type="image" src="images/heartIcon.svg" photo_id="'.$photo_id.'" state="inactive"></input>
                    </div>

                </div>
            </div>
        ';

        $count++;
    }

    echo '
        <div id="modalPopup" class="modal">

            <div class="modal-content">
                <button class="remodal-close" data-dismiss="modal"></button>
                <div class="modal-body">
                    <img id="emptyModal" class="emptyModal img img-rounded img-responsive" src="" />

                    <div class="cellContent">
                        <div class="cellInner row">
                            <div class="cellUsers col-xs-4">
                                <h3 class="usernameOut"></h3>
                                <h4 class="likesOut"></h4>
                            </div>

                            <!-- Icons  -->
                            <div id="iconRow" class="col-xs-8 align-right iconRow">

                                <a class="downloader" href="" download="">
                                <input id="downloadIcon" class="iconPadding hvr-grow" type="image" src="images/downloadIcon.svg"></input> </a>
                                ';

                                if(isset($_SESSION['username'])){
                                    echo '<input id="saveIcon" class="iconPadding hvr-grow" type="image" src="images/saveIcon.svg" username="'.$_SESSION['username'].'" photo_id="" state="inactive"></input>';
                                }

                                echo '
                                <input id="heartIcon" class="iconPadding hvr-grow" type="image" src="images/heartIcon.svg" state="inactive"></input>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    ';

    if($count == 0){
        echo "<h1>No saved photos</h1>";
    }

?>


<!-- <div id="modalPopup" class="modal">

    <div class="modal-content">
        <button class="remodal-close" data-dismiss="modal"></button>
        <div class="modal-body">
            <img id="emptyModal" class="emptyModal img img-rounded img-responsive" src="" />

            <div class="cellContent">
                <div class="cellInner row">
                    <div class="cellUsers col-xs-4">
                        <h3 class="usernameOut"></h3>
                        <h4 id="'.$photo_id.'" class="likesOut"></h4>
                    </div>

                    <!-- Icons  -->
                    <!--<div id="iconRow" class="col-xs-8 align-right iconRow">

                        <a class="downloader" href="" download="">
                        <input id="downloadIcon" class="iconPadding hvr-grow" type="image" src="images/downloadIcon.svg"></input> </a>
                        ';

                        if(isset($_SESSION['username'])){
                            echo '<input id="saveIcon" class="iconPadding hvr-grow" type="image" src="images/saveIcon.svg" user_id="'.$user_id.'" photo_id="'.$photo_id.'" state="inactive"></input>';
                        }

                        echo '
                        <input id="heartIcon" class="iconPadding hvr-grow" type="image" src="images/heartIcon.svg" photo_id="'.$photo_id.'" state="inactive"></input>
                    </div>

                </div>
            </div>


        </div>
    </div>

</div> -->
