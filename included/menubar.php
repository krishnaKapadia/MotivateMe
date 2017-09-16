<!-- Main menu Bar -->
<div class="col-xs-5 col-sm-4 col-md-3 col-lg-3 menu sidebar-offcanvas" role="navigation">
  <div class="menuContainer">

    <!-- Title -->
    <div class="title">
      <h1 class="center">Motivate.me</h1>
    </div>

    <!-- Quote -->
    <div class="quote">
      <p>“If you can dream it, you can do it.” ~ Walt Disney</p>
    </div>

    <!-- Menu Items -->
    <ul class="menuList">
      <li><h4 class="hvr-forward"><a href="index.php?popular">Popular</a></h4></li>
      <li><h4 class="hvr-forward"><a href="index.php?latest">Latest</a></h4></li>

      <!-- Login or Signout Based off session -->
      <?php
        if(isset($_SESSION['username'])) {
            echo '<li><h4 class="hvr-forward"><a href="#" data-remodal-target="creationModal">Create+</a></h4></li>';
            echo '<li><h4 class="hvr-forward"><a data-remodal-target="logoutModal" href="#">Sign Out</a></h4></li>';
        } else {
            echo '<li><h4 class="hvr-forward"><a data-remodal-target="loginModal" href="#">Login</a></h4></li>';
            echo '<li><h4 class="hvr-forward"><a data-remodal-target="registerModal" href="#">Sign Up</a></h4></li>';
        }
      ?>

      <?php if (false) {
          echo '
              <div class="avatar">
                  <!-- <h1>Login</h1> -->
                  <!-- <hr> -->
              </div>
          ';
      } ?>

    </ul>



</div>

    <!-- Menu Footer -->
    <!-- <footer id="menuFooter "> -->
      <!-- <h4><small>By Krishna Kapadia</small></h4> -->
    <!-- </footer> -->


</div>
