<?php
include "../includes/header.php"; // local
if ($logged == false) {
	echo 'ERROR: You have to be logged in to submit a report.';
	die;
} else {
	if (isset($_POST)) {
		print_r($_POST);
		//die;
	}
  if ($isadmin == false) {
    die('you are not an admin');
  }
  if (!isset($_POST['status'])) {
    $_POST['status'] = 'open';
  }
	$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
	$sql=$maincon->prepare("UPDATE reports SET r_status = ? WHERE r_id = ?");
	$sql->execute(array($_POST['status'], $_POST['report']));
	$databaseErrors = $sql->errorInfo();
	header('Location: http://gov.fsn.life/999.php');
}
?>
