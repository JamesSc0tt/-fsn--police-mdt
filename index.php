<?php
$curpage = 'index';
include "includes/header.php"; // local

?>
<div class="container">

    <div class="row">
        <div class="col s6">
			<?php if ($logged) { ?>
				<h5 class="d_h5">You are logged in as: <?php echo $_SESSION['username'] ?></h5>
			<?php } else { ?>
				<h5 class="d_h5">Government Login</h5>
			<?php } ?>
            <hr class="hr_title">
        </div>
        <div class="col s6">
            <h5 class="d_h5">Public Information</h5>
            <hr class="hr_title">
        </div>
    </div>

    <div class="row">
		<?php if (!$logged) { ?>
			<div class="col s6">
				<?php if (isset($_GET['logout'])) {?>
					<div class='card-panel green lighten-4' style='color:black'>You have been logged out.</div>
				<?php } ?>
				<?php if (isset($_GET['incorrect'])) {?>
					<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>The username/password provided are incorrect</div>
				<?php } ?>
				<?php if (isset($_GET['requirelogin'])) {?>
					<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>This page requires login</div>
				<?php } ?>
				<div class="col input-field" style="width:100%;">
					<form action="js_system/checkLogin.php" method="POST">
					<input name="user" id="email" type="text" class="input-field validate">
					<label for="email" class="">Email Address</label>
				</div>
				<div class="col input-field" style="width:100%;">
					<input name="pass" id="pass" type="password" class="input-field validate">
					<label for="pass" class="">Password</label>
				</div>
				<div class="col">
					<button class="btn waves-effect waves-light" type="submit" style="width:100%;">Submit</button></form>
				</div>
			</div>
		<?php } else { ?>
			<div class="col s6">
				<?php if (isset($_GET['requireadmin'])) {?>
					<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>This requires admin access</div>
				<?php } ?>
				<h6><b style="color:#ffff;">Logout:</b></h6>
				<a class="btn waves-effect waves-light" href="js_system/checkLogin.php?logout" style="width:100%;">LOG OUT</a>

        <h6 style="margin-top:30px;"><b style="color:#ffff;">Update name:</b></h6>
        <p>Your name is currently set to: "<?php echo $_SESSION['rpname'] ?>"<br><span style="font-size:10px;">When doing this you will be logged out.</span></p>
        <form action="js_system/updateUserName.php" method="POST">
          <div class="col input-field" style="width:100%;margin:0px;">
            <input name="rpname" id="name" type="text" class="input-field validate">
            <label for="name" class="">New name</label>
          </div>
          <button class="btn waves-effect waves-light" type="submit" style="width:100%;">CHANGE NAME</button>
        </form>

				<h6 style="margin-top:30px;"><b style="color:#ffff;">Change Password:</b></h6>
				<div class="col input-field" style="width:100%;margin:0px;">
					<input name="pass1" id="email" type="text" class="input-field validate">
					<label for="email" class="">New password</label>
				</div>
				<div class="col input-field" style="width:100%;margin:0px;">
					<input name="pass2" id="email" type="text" class="input-field validate">
					<label for="email" class="">Confirm password</label>
				</div>
				<button class="btn waves-effect waves-light" type="submit" style="width:100%;">CHANGE PASSWORD</button>
				<br><br><br><br><br><br>
				<p><b style="color:#ffff;">DEVELOPER REPORT INFORMATION:</b><br>
					<?php print_r($_SESSION) ?>
				</p>
			</div>
		<?php } ?>

        <div class="col s6" style="align-content:center;">
			<div class="col input-field" style="width:100%;"><center>
				<a class="waves-effect waves-light btn" style="width:100%;">Active Warrants</a>
			</div>
			<div class="col input-field" style="width:100%;"><center>
				<a class="waves-effect waves-light btn" style="width:100%;">Search Criminal DB</a>
			</center></div>
        </div>
    </div>

</div>

</body>
</html>
