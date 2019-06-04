<?php
$curpage = 'admin';
include "includes/header.php"; // local

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

	if (isset($_GET['modifyuser'])) {
		echo 'shit';
	} else {
?>

<div class="container">

    <div class="row">
        <div class="col s12">
            <h5 class="d_h5">Add New User</h5>
            <hr class="hr_title">
        </div>
		<form style="padding:50px;" method="post" action="?createuser">
			<p>Username: <input name="username" type="text"/></p>
			<p>Department: <input name="role" type="text"/></p>
			<p>CharID: <input name="charid" type="text"/></p>
			<p>SteamID64: <input name="forumid" type="text"/></p>
			<p>Password:  <b><i>Take note of this</i></b><input name="pass" type="password"/><br>Reccomended: <?php echo randomPassword(); ?></p>
			<button name="submit" class="waves-effect waves-light btn" style="float: right;">Register</button>
		</form>
		<?php
			if (isset($_GET['createuser']) && isset($_POST['username'])) {
				$dbh=new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'root', 'SuckMyAss123');
				if(isset($_POST['username']) && isset($_POST['pass'])){
					$user = $_POST['username'];
					$password=$_POST['pass'];
					
					$sql=$dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `username`=?");
					$sql->execute(array($user));
					$databaseErrors = $sql->errorInfo();
					if( true == false ){  
						$errorInfo = print_r($databaseErrors, true); # true flag returns val rather than print
						$errorLogMsg = "error info: $errorInfo"; # do what you wish with this var, write to log file etc...
						die("<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>".$errorLogMsg."</div>");
					}
					if($sql->fetchColumn()!=0){
						die("<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>A user with this username already exists</div>");
					} else {
						function rand_string($length) {
							$str="";
							$chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
							$size = strlen($chars);
							for($i = 0;$i < $length;$i++) {
								$str .= $chars[rand(0,$size-1)];
							}
							return $str;
						}

						$p_salt = rand_string(20);
						$site_salt="subinsblogsalt";
						$salted_hash = hash('sha256', $password.$site_salt.$p_salt);
						$sql=$dbh->prepare("INSERT INTO `users` (`id`, `username`, `password`, `psalt`, `role`, `level`, `status`, `player_id`, `forums_id`) VALUES (NULL, ?, ?, ?, ?, 0,1, ?, ?);");
						$sql->execute(array($user, $salted_hash, $p_salt, $_POST['role'], $_POST['charid'], $_POST['forumid']));
						//echo "<div class='ui secondary segment'><p><b>Successfully Registered.</b></p><p>Username: $user </p> <p>Password: $password</p></div>";
						echo '<div class="card-panel green lighten-4" style="color:black">
							<p><b>User created:</b><br>
							Username: '.$_POST['username'].'<br>
							Department: '.$_POST['role'].'<br>
							Password: '.$_POST['pass'].'
						</div>';
					}
				}
			}
		?>
	</div>
	
	<div class="row">
        <div class="col s12">
            <h5 class="d_h5">Current Users</h5>
            <hr class="hr_title">
        </div>
		<table class="striped d_table" style="width:97%;margin-left:auto;margin-right:auto;">
			<thead class="d_table_head">
				 <tr>
					<th>ID</th>
					<th>Username</th>
					<th>Department</th>
					<th>Status</th>
					<th>Level</th>
					<th>CharID</th>
					<th>SteamID</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
	
			<tbody>
				<?php
					$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
					foreach($maincon->query("SELECT * FROM `users`") as $usr) {
						echo '<tr>
							<td>'.$usr['id'].'</td>
							<td>'.$usr['username'].'</td>
							<td>'.$usr['role'].'</td>
							<td>'.$usr['status'].'</td>
							<td>'.$usr['level'].'</td>
							<td>'.$usr['player_id'].'</td>
							<td>'.$usr['forums_id'].'</td>
							<td><a class="waves-effect waves-light btn">View</a></td>
						</tr>';
					}
				?>
			</tbody>
		</table>
		
	</div>
	<?php } ?>