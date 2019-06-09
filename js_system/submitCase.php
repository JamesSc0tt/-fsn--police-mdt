<?php
  include "../includes/header.php"; // local
  if ($logged == false) {
  	echo 'ERROR: You have to be logged in to submit a report.';
  	die;
  } else {
  	if (isset($_POST)) {
  		//print_r($_POST);
  		//die;
  	}
    $maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
    // check if the shit exists
    $sql=$maincon->prepare("SELECT COUNT(*) FROM `criminals` WHERE `char_id`=?");
    $sql->execute(array($_POST['sus_id']));

    if($sql->fetchColumn()!=0){
      $sql=$maincon->prepare("INSERT INTO `charges` (`chrg_id`, `char_id`, `user_id`, `charges`, `time`, `fine`, `comments`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
      $sql->execute(array($_POST['sus_id'],$_SESSION['userid'],$_POST['charges'],$_POST['time'],$_POST['fine'], 'thiswasremoved'));
      header('Location: http://gov.fsn.life/booking.php?submitted&submitID='.$maincon->lastInsertId());
    } else {
      if (!isset($_POST['sus_name'])) {
        header('Location: http://gov.fsn.life/booking.php?doesnotexist');
      } else {

        // insert criminal
        $sql=$maincon->prepare("INSERT INTO `criminals` (`crim_id`, `char_id`, `name`, `mugshot`, `wanted`, `violent`, `gang`, `drug`, `mental`, `comments`, `date`) VALUES (NULL, ?, ?, ?, 0, 0, 0, 0, 0, 'No comments provided', CURRENT_TIMESTAMP)");
        $sql->execute(array($_POST['sus_id'], $_POST['sus_name'], $_POST['sus_mug']));

        // insert other shit
        $sql=$maincon->prepare("INSERT INTO `charges` (`chrg_id`, `char_id`, `user_id`, `charges`, `time`, `fine`, `comments`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $sql->execute(array($_POST['sus_id'],$_SESSION['userid'],$_POST['charges'],$_POST['time'],$_POST['fine'], 'thiswasremoved'));
        header('Location: http://gov.fsn.life/booking.php?crimsubmit&submitted&submitID='.$maincon->lastInsertId());
      }
    }
  }
?>
