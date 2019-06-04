<?php
$incorrect = false;
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid']!=''){session_destroy();header("Location:https://gov.fsn.life/index.php?logout");}
	$dbh=new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'root', 'SuckMyAss123');
	$email=$_POST['user'];
	$password=$_POST['pass'];
	if(isset($_POST) && $email!='' && $password!=''){
		$sql=$dbh->prepare("SELECT * FROM users WHERE username=?");
		$sql->execute(array($email));

		while($r=$sql->fetch()){
			$p=$r['password'];
			$p_salt=$r['psalt'];
			$id=$r['id'];
			$uname=$r['username'];
			$dept=$r['role'];
			$level=$r['level'];
			$status=$r['status'];
			$playerid=$r['player_id'];
			$steamid=$r['forums_id'];
		}

		$site_salt = "subinsblogsalt"; // salty daddy

		$salted_hash = hash('sha256',$password.$site_salt.$p_salt);
		if($p==$salted_hash){
			$_SESSION['userid']=$id;
			$_SESSION['username']=$uname;
			$_SESSION['dept']=$dept;
			$_SESSION['level']=$level;
			$_SESSION['status']=$status;
			$_SESSION['playerid']=$playerid;
			$_SESSION['steamid']=$steamid;
			header("Location:https://gov.fsn.life/index.php");
		}else{
			header("Location:https://gov.fsn.life/index.php?incorrect");
		}
	}

if ($incorrect) {  }

if (isset($_GET['logout'])) {
	session_destroy();
	header("Location:https://gov.fsn.life/index.php?logout");
}

?>
