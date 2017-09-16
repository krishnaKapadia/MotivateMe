
<div id="mySidenav" class="sidenav">
	<div class="container-fluid">

			<div class="row">
				<!-- <div class="col-sm-4"> -->
					<input id="closeSidebarBtn" class="animated rotateIn" type="image" state="unclicked"  src="images/arrow.svg" onclick="closeNav();"></input>
				<!-- </div> -->

				<!-- <div class="col-sm-8"> -->
					<h4 class="center title sidebarContent">User Area</h4>
					<hr class="horizontal sidebarContent">

				<!-- </div> -->
			</div>
		<div class="sidebarContent">
			<div class="row">
				<!-- Image -->
				<!-- <span> <img id="sideBarImage" class="img img-rounded img-responsive" src="'.$_SESSION['profile_image_path'].'" /> </span> -->
				<?php if(isset($_SESSION['username'])) echo '<img id="sideBarImage" class="img img-rounded img-responsive" src="'.$_SESSION['profile_image_path'].'" /> '; ?>
			</div>

			<div class="row">
				<?php  echo '<h4 class="center">@'.$_SESSION['username'].'</h4>'; ?>
				<!-- <hr class="horizontal"> -->
			</div>

			<!-- <br> -->

			<hr class="horizontal">
			<div class="row">
				<?php
					$num = getTotalNumPhotos($_SESSION['username']);
					echo '<h4 class="center">Photos: '.$num.'</h4>'; ?>
					<!-- <hr class="horizontal"> -->
			</div>

			<div class="row">
				<?php
					$num = getTotalNumSaved($_SESSION['username']);
					echo '<h4 class="center">Saved: '.$num.'</h4>';
				?>
			</div>

			<div class="row">
				<?php
					$totalHearts = getTotalNumHearts($_SESSION['username']);
					echo '<h4 class="center">Total hearts: '.$totalHearts.' '; ?>
					<hr class="horizontal">
			</div>

			<br>
			<div class="row foot center">
				<?php
					echo '<li><h4 class="hvr-grow center"><a href="index.php?profile='.$_SESSION['username'].'">My Profile</a></h4></li>';
					echo '<li><h4 class="hvr-grow center"><a href="index.php?profile='.$_SESSION['username'].'&display=saved">My Saved</a></h4></li>';
					echo '<li><h4 class="hvr-grow center"><a data-remodal-target="logoutModal" href="#">Sign Out</a></h4></li>'
				?>
			</div>
		</div>

	</div>
</div>




<script type="text/javascript">
	/* Set the width of the side navigation to 250px */
	function openNav() {
		$("#closeSidebarBtn").attr("src", "images/arrowRight.svg");
		document.getElementById("mySidenav").style.width = "20%";
		document.getElementById("mySidenav").style.borderLeft= "7px solid #f2f2f2";
		$(".sidebarContent").fadeIn(100);
		// document.getElementById("mySidenav").style.display = "";
		// document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

	/* Set the width of the side navigation to 0 */
	function closeNav() {
		$(".sidebarContent").fadeOut(100);
		// document.getElementById("mySidenav").style.display = "none";
		document.getElementById("mySidenav").style.width = "0";
		document.body.style.backgroundColor = "white";
		document.getElementById("mySidenav").style.borderLeft= "";

	}

</script>
