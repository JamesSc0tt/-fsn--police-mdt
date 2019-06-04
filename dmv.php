<?php
$curpage = 'dmv';
include "includes/header.php"; // local

?>
<div class="container">

    <div class="row">
        <div class="col s12">
            <h5 class="d_h5">Search Vehicles</h5>
            <hr class="hr_title">
        </div>
        <form class="col s12" method="get" action="dmv.php">
            <div class="input-field col s12">
                <input id="search" name="search" type="text" class="validate">
                <label for="search">Plate</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit" style="width:100%;">Submit</button>
        </form>
    </div>
	<?php if (isset($_GET['search'])) { 
		if (strlen($_GET['search']) < 3) {
			die("<div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>Searches need to be at least 3 characters long.</div>");
		}
		
	1?>
		<div class="row">
			<div class="col s12">
				<h5 class="d_h5">Results</h5>
				<hr class="hr_title">
			</div>
			<div>
				<?php
					$maincon = new PDO('mysql:dbname=zap406648-1;host=mysql-mariadb-dal01-9-101.zap-hosting.com', 'zap406648-1', 'dyaxalyfywMwFRa6');
					//$maincon = new PDO('mysql:dbname=fsn_liveserver;host=fsn.life', 'root', 'SuckMyAss123');
					$plate = $_GET['search'];
					foreach($maincon->query("SELECT * from fsn_vehicles WHERE veh_plate LIKE '%$plate%'") as $car) {
						$colours = json_decode($car['veh_colours'], true);
				?>
					<p style="font-size:20px;color:#fff;font-weight:0.6;margin-bottom:0px;"><?php echo $car['veh_name'].' in '.$colours['primary'].'/'.$colours['secondary']; ?></p>
					<table class="striped d_table">
						<thead class="d_table_head">
							<tr>
								<th style="width:20%">Name</th>
								<th>Owner</th>
								<th>Plate</th>
								<th style="width:8%"></th>
							</tr>
						</thead>
				
						<tbody>
							<tr>
								<td><?php echo $car['veh_name'] ?></td>
								<td><?php
									$charid = $car['char_id'];
									foreach($maincon->query("SELECT * from fsn_characters WHERE char_id = '$charid'") as $char) {
										echo $char['char_fname'].' '.$char['char_lname'];
									}
								?></td>
								<td><?php echo $car['veh_plate'] ?></td>
								<td><a href="dmv.php?plate=<?php echo $car['veh_plate'] ?>" class="waves-effect waves-light btn">VIEW</a></td>
							</tr>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<?php if (isset($_GET['plate'])) { ?>
		<div class="row">
			<div class="col s12">
				<h5 class="d_h5">Actions</h5>
				<hr class="hr_title">
			</div>
			<div class="col s12">
				<h5 class="d_h5">Owner Details</h5>
				<hr class="hr_title">
			</div>
			<div class="col s12">
				<h5 class="d_h5">Vehicle Details</h5>
				<hr class="hr_title">
			</div>
			<div>
				<?php
					$maincon = new PDO('mysql:dbname=zap406648-1;host=mysql-mariadb-dal01-9-101.zap-hosting.com', 'zap406648-1', 'dyaxalyfywMwFRa6');
					$plate = $_GET['plate'];
					foreach($maincon->query("SELECT * from fsn_vehicles WHERE veh_plate = '$plate'") as $car) {
				?>
					<p style="font-size:20px;color:#fff;font-weight:0.6;"><?php echo '' ?></p>
					<table class="striped d_table">
						<thead class="d_table_head">
							<tr>
								<th></th>
							</tr>
						</thead>
				
						<tbody>
							<tr>
								<td></td>
							</tr>
						</tbody>
					</table>
				<?php }?>
			</div>
			
			<div class="col s12">
				<h5 class="d_h5">Vehicle History</h5>
				<hr class="hr_title">
			</div>
		</div>
	<?php } ?>