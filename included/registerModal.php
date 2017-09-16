<?php
    include("included/registerScript.php");
?>

<div id="registerModal" class="remodal" data-remodal-id="registerModal">
    <button data-remodal-action="close" class="remodal-close"></button>

    <div id="register">
        <div class="avatar">
            <h1>Register</h1>
            <hr>
        </div>

        <div class="form-box">
            <form id="registerForm" method="post" action="#successRegisterModal">
                <div class="row margin-top">
                    <p class="text-left">Email:</p>
                    <input id="emailInputRegister" name="email" type="email" placeholder=""> <small id="emailErrorRegister"></small> </input>
                </div>

                <div class="row margin-top">
                    <p class="text-left margin-top">Username: </p>
                    <input id="usernameInputRegister" name="username" type="text" placeholder=""><small id="usernameErrorRegister"></small></input>
                    <p id="output"></p>
                </div>

                <div class="row margin-top">
                    <p class="text-left margin-top">Password:</p>
                    <input id="passwordInputRegister" name="password" type="password" placeholder=""> <small id="passwordErrorRegister"></small> </input>
                </div>

                <br>
                <div id="registerButtonDiv" >
                    <button id="cancelButton" data-remodal-action="cancel"
                    class="remodal-cancel">Cancel</button>

                    <button id="registerSubmit" type="button"
                    name="register"
                    class="remodal-confirm margin-left">OK</button>

                    <img id="loadingAnimationRegister" data-remodal-action="submit" hidden="hidden" src="images/loadingCircle.gif" width="50px" height="50px" />
                </div>
            </form>
        </div>
    </div>

</div>


<!-- Register SUCCESS Or Fail MODAL -->
<div id="successRegisterModal" class="remodal" data-remodal-id="successRegisterModal">
    <button data-remodal-action="close" class="remodal-close"></button>

    <!-- <h1>Login Succeeded</h1> -->
    <!-- <hr> -->
    <h2>Welcome back</h2>
    <hr>
    <!-- <div class="avatarCircle" style="background-image: url('images/testProfileImage.jpg')" style="background-position: center"></div> -->
    <p>Hello <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></p>

    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <a href="index.php"><button data-remodal-action="close" class="remodal-confirm">OK</button></a>
</div>
