<!-- col-md-offset-3 -->
<div class="display col-xs-7 col-sm-8 col-md-9 animated fadeIn">
    <?php
        // $image = getProfileImage($_GET['profile']);
        // echo '
        //     <div class="profileContainer rounded">
        //         <img id="profileImage" class="img img-rounded rounded img-responsive" src="'.$image.'" />
        //         <h2></h2>
        //     </div>
        // ';
        include('included/profileSidebar.php');
        include("included/create.php");

    ?>
    <div class="displayContainer">

        <?php
            // if(isset($_SESSION['username'])) echo $_SESSION['username'];
            // else echo $_SESSION['username'];
            if(isset($_GET['latest'])){
                if(isset($_SESSION['username'])){
                    echo '
                        <div class="row sortByRow">
                            <div class="col-md-4 col-sm-4">
                                <input id="arrowBtn"  class="hvr-grow right animated rotateIn" type="image" state="unclicked" src="images/arrow.svg" onclick="openNav();"></input>
                            </div>

                        </div>
                    ';
                }
            }else if(isset($_GET['profile'])){
                if(isset($_SESSION['username'])) {
                    echo '
                        <input id="arrowBtn"  class="hvr-grow right animated rotateIn" type="image" state="unclicked" src="images/arrow.svg" onclick="openNav();"></input>
                    ';
                }
            }else{
                echo '
                <!-- Sort by row view -->
                <div class="row sortByRow">
                    <div class="col-md-8 col-sm-8">
                        <ul>
                            <h4><small>Sort by:</small></h4>
                            <li><h4><small class="hvr-forward"><a href="index.php?popular&sortOrder=today">Today</a></small></h4></li>
                            <li><h4><small class="hvr-forward"><a href="index.php?popular&sortOrder=week">This Week</a></small></h4></li>
                            <li><h4><small class="hvr-forward"><a href="index.php?popular&sortOrder=allTime">All Time</a></small></h4></li>
                        </ul>
                    </div>
                    ';
                    if(isset($_SESSION['username'])) {
                        echo '
                            <div class="col-md-4 col-sm-8">
                                <input id="arrowBtn"  class="hvr-grow right animated rotateIn" type="image" state="unclicked" src="images/arrow.svg" onclick="openNav();"></input>
                            </div>
                        ';
                    }


                echo '</div>';
            }

        ?>

        <!-- IMAGE DIAPLAY AREA -->
        <div class="displayRowContainer">
            <div class="row row-centered">

                <?php
                    include("included/imageCell.php")
                ?>
            </div>

            <hr class="horizontal">
        </div>

        <?php include("included/loginModal.php"); ?>



    </div>
</div>
