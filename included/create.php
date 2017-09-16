<?php

    include("included/creationScript.php");
?>

<div id="creationModal" class="remodal" data-remodal-id="creationModal">
    <button data-remodal-action="close" class="remodal-close"></button>

    <div id="creation" class="">
        <small id="imgTitleError" class="center" style="position: absolute; top: 3%; left: 40%;"></small>

        <div class="avatar">
            <h1 id="imgTitleInput" contenteditable="true">Image title...</h1>
            <hr>
        </div>

        <div class="container-center">
            <canvas id="c" class="centerCanvas" width="440" height="440"></canvas>
        </div>

        <input type="file" id="uploadBtn"></input>
        <br>

        <div class="row">
            <button id="cancelSubmit" data-remodal-action="cancel" class="remodal-cancel">Cancel</button>

            <button id="creationSubmit" type="button"
            class="remodal-confirm margin-left" data-remodal-action="submit">Next</button>

            <img id="loadingAnimation" data-remodal-action="submit" hidden="hidden" src="images/loadingCircle.gif" width="50px" height="50px" />
        </div>

    </div>

    <div id="SuccessfulCreation" hidden="hidden">
        <div class="avatar">
            <h1>Creation Successful!</h1>
            <hr>
        </div>

        <div class="row">

            <?php //Redirects user to their profile page to see the new image that they created
                echo '<a href="index.php?profile='.$_SESSION['username'].'">
                        <button id="cancelSubmit" class="remodal-cancel">To Profile</button>
                      </a>';
            ?>

            <button id="Done" type="button"
            class="remodal-confirm margin-left" data-remodal-action="cancel">Done</button>
        </div>
    </div>

</div>
