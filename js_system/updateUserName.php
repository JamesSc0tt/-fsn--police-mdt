<?php
include "../includes/header.php"; // local
if ($logged == false) {
	echo 'ERROR: You have to be logged in to change an RP name.';
	die;
} else {
	if (isset($_POST)) {
    $maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
  	$sql=$maincon->prepare("UPDATE users SET rpname = ? WHERE id = ?");
  	$sql->execute(array($_POST['rpname'], $_SESSION['userid']));
  	$databaseErrors = $sql->errorInfo();
    print_r($databaseErrors);
  	header('Location: http://gov.fsn.life/js_system/checkLogin.php?logout');
  }
}
?>
