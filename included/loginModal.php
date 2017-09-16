<?php
    include("included/loginScript.php");
?>

<div id="loginModal" class="remodal" data-remodal-id="loginModal">
    <button data-remodal-action="close" class="remodal-close"></button>

    <div id="login">
        <div class="avatar">
            <h1>Login</h1>
            <hr>
        </div>

        <div class="form-box">
            <form id="loginForm" method="post" action="#successModal">
                <div class="row">
                    <p class="text-left">Username: </p>
                    <input id="usernameInput" name="username" type="text" placeholder=""><small id="usernameError" class="center"></small></input>
                    <p id="output"></p>
                </div>

                <div class="row margin-top">
                    <p class="text-left margin-top">Password:</p>
                    <input id="passwordInput" name="password" type="password" placeholder=""> <small id="passwordError"></small> </input>
                </div>

                <br>
                <div id="loginButtonDiv" >
                    <button id="cancelSubmit" data-remodal-action="cancel" class="remodal-cancel">Cancel</button>

                    <button id="loginSubmit" type="button"
                    name="login"
                    class="remodal-confirm margin-left">OK</button>

                    <img id="loadingAnimation" data-remodal-action="submit" hidden="hidden" src="images/loadingCircle.gif" width="50px" height="50px" />
                </div>
            </form>
        </div>
    </div>

</div>


<!-- LOGIN SUCCESS Or Fail MODAL -->
<div id="successModal" class="remodal" data-remodal-id="successModal">
    <button data-remodal-action="close" class="remodal-close"></button>

    <!-- <h1>Login Succeeded</h1> -->
    <!-- <hr> -->
    <h2>Welcome back</h2>
    <hr>
    <div class="avatarCircle" style="background-image: url('images/testProfileImage.jpg')" style="background-position: center"></div>
    <p>Hello <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></p>

    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <a href="index.php"><button type="submit" class="remodal-confirm">OK</button></a>

</div>
