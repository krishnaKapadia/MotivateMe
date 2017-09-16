<?php
    // Start the session
    session_start();

    // unsets all variables, thererfore loged out
   if (isset($_POST['logout'])) {
       unset($_SESSION['username']);
   }

    include("included/database.php");

    include("included/head.php");

?>

<body>

    <?php include("included/menubar.php"); ?>
    <?php include("included/displayArea.php");  ?>

    <!-- All Modals that the site uses such as login modal and logoutModal -->
    <?php include("included/loginModal.php");   ?>

    <?php include("included/logoutModal.php");  ?>
    <?php include("included/registerModal.php") ?>

    <!-- Mainly Scripts as site does not have a promenent footer -->
    <?php include("included/footer.php");  ?>

</body>

</html>
