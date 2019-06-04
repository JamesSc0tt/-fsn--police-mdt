<!--
	thank god duck seperated this i was about to kms
-->
<?php 
	session_start();
	if(!isset($_SESSION['userid']) || $_SESSION['userid']==''){
	 $logged = false;
	} else {
	 $logged = true;
	 if ($_SESSION['level'] > 0) {
		 $isadmin = true;
	 } else {
		 $isadmin = false;
	 }
	}
	
	
	
	
	$require_log = Array('booking', 'dmv', 'warrants', 'bolos', 'admin');
	if (in_array($curpage, $require_log, false)) {
		if (!$logged) {
			header("Location:https://gov.fsn.life/index.php?requirelogin");
		}
	}
	
	$require_admin = Array('admin');
	if (in_array($curpage, $require_admin, false)) {
		if ($logged) {
			if (!$isadmin) {
				header("Location:https://gov.fsn.life/index.php?requireadmin");
			}
		} else {
			header("Location:https://gov.fsn.life/index.php?requirelogin");
		}
	}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/Fusion/Fusion-MDT/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		
		<!-- james editor stuffs -->
			<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="nav-extended">
            <div class="nav-wrapper container d_yellboard">
              <a href="#" class="brand-logo">Los Santos Police Department</a>
              <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<?php
				if ($logged) {
			?>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="js_system/checkLogin.php?logout"><?php echo $_SESSION['username'] ?> - <u>LOGOUT</u></a></li>
              </ul>
			<?php
				} else {
			?>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li style="font-size: 20px;"><a href="index.php"><u>LOGIN</u></a></li>
              </ul>
			<?php } ?>
            </div>
            <div class="nav-content container">
              <ul class="tabs tabs-transparent">
				<?php if (!$logged) { ?>
					<li class="tab"><a <?php if ($curpage == 'index') { echo 'class="active"'; }?> href="index.php">Home</a></li>
					<li class="tab"><a <?php if ($curpage == '999') { echo 'class="active"'; }?> href="999.php">Incident Report</a></li>
					<li class="tab"><a <?php if ($curpage == 'criminals') { echo 'class="active"'; }?> href="criminals.php">Criminal Database</a></li>
					<li class="tab"><a <?php if ($curpage == 'penal') { echo 'class="active"'; }?> href="penal.php">Penal Code</a></li>
				<?php } else { ?>
					<li class="tab"><a <?php if ($curpage == 'index') { echo 'class="active"'; }?> href="index.php">Home</a></li>
					<li class="tab"><a <?php if ($curpage == '999') { echo 'class="active"'; }?> href="999.php">Reports</a></li>
					<li class="tab"><a <?php if ($curpage == 'criminals') { echo 'class="active"'; }?> href="criminals.php">Criminal Database</a></li>
					<li class="tab"><a <?php if ($curpage == 'booking') { echo 'class="active"'; }?> href="booking.php">Booking</a></li>
					<li class="tab"><a <?php if ($curpage == 'dmv') { echo 'class="active"'; }?> href="dmv.php">Vehicle Database</a></li>
					<li class="tab"><a <?php if ($curpage == 'warrants') { echo 'class="active"'; }?> href="warrants.php">Warrants</a></li>
					<li class="tab"><a <?php if ($curpage == 'bolos') { echo 'class="active"'; }?> href="bolos.php">BOLOs</a></li>
					<li class="tab"><a <?php if ($curpage == 'penal') { echo 'class="active"'; }?> href="penal.php">Penal Code</a></li>
					<?php if ($_SESSION['level'] > 0) { ?>
						<li class="tab"><a <?php if ($curpage == 'admin') { echo 'class="active"'; }?> href="admin.php">ADMIN</a></li>
					<?php } ?>
				<?php } ?>
              </ul>
            </div>
          </nav>
        
          <ul class="sidenav" id="mobile-demo">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
          </ul>
        
<?php
	// global includes are here xo
	include('js_system/otherFunctions.php');
?>