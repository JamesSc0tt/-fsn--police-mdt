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
	$sql=$maincon->prepare("INSERT INTO `reports` (`r_id`, `r_userid`, `r_status`, `r_title`, `r_report`, `r_numcomments`, `r_lastcomment`, `r_date`, `r_link`, `r_linkid`) VALUES (NULL, ?, 'open', ?, ?, '0', '{}', CURRENT_TIMESTAMP, ?, ?);");
	$sql->execute(array($_SESSION['userid'], $_POST['title'], $_POST['content'], $_POST['linkWith'], intval($_POST['linkID'])));
	$databaseErrors = $sql->errorInfo();
	header('Location: http://gov.fsn.life/999.php?submitted');
}
?>