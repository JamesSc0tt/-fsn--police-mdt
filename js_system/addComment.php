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
	$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
	$sql=$maincon->prepare("INSERT INTO `report_replies` (`c_id`, `c_report`, `c_user`, `c_comment`, `c_date`, `c_edited`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP, NULL)");
	$sql->execute(array($_POST['report'], $_SESSION['userid'], $_POST['comment']));
	$databaseErrors = $sql->errorInfo();

  // other shit
  $report = $maincon->query("SELECT * from reports WHERE `r_id` = ".$_POST['report'])->fetch();
  $newnum = intval($report['r_numcomments'])+1;

  $sequel=$maincon->prepare("UPDATE `reports` SET `r_numcomments` = ? WHERE `r_id` = ?;");
  $sequel->execute(array($newnum, $_POST['report']));

	header('Location: http://gov.fsn.life/999.php?viewid='.$_POST['report'].'&posted');
}
?>
