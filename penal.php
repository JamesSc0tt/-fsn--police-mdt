<?php
$curpage = 'penal';
include "includes/header.php"; // local

?>
<style>
	td:first-child {
		padding:1px !important;
		padding-left:15px !important;
	}
	th:first-child {
		padding:1px !important;
		padding-left:15px !important;
	}
	td {
		padding:1px !important;
	}
</style>
<div class="container">

    <div class="row">
        <div class="col s6">
            
        </div>
        <div class="col s6">
            
        </div>
    </div>

    <div class="row" style="margin-top:20px;">
        <div class="row">
			<h5 class="d_h5">Charge Categories</h5>
            <hr class="hr_title">
            <div class="col input-field" style="width:100%;margin-top:0px;">
				<?php if ($logged && $isadmin) { ?>
					<a class="waves-effect waves-light btn" style="width:100%;">NEW CATEGORY</a>
				<?php } ?>
			</div>
			<table class="striped d_table" style="font-size:15px;padding:0px;">
				<thead class="d_table_head">
					 <tr>
						<th style="width:8%;">ID</th>
						<th>Title</th>
						<?php if ($logged && $isadmin) { ?>
							<th style="width:8%;"></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
						$categories = Array();
						foreach($maincon->query("SELECT * from penalcode_cats") as $cat) {
							array_push($categories, $cat);
							echo '<tr>';
								echo '<td>';
									echo $cat['c_id'];
								echo '</td>';
								echo '<td>';
									echo $cat['c_name'];
								echo '</td>';
								if ($logged && $isadmin) { 
									echo '<td>';
										echo '<a class="waves-effect waves-light btn-small">EDIT</a>';
									echo '</td>';
								}
							echo '</tr>';
						}
					?>
					<div id="categories_json" style="display:none">
						<?php echo json_encode($categories) ?>
					</div>
				</tbody>
			</table>
        </div>

        <div class="row" style="margin-top:20px;">
			<h5 class="d_h5">Charges</h5>
            <hr class="hr_title">
            <div class="col input-field" style="width:100%;margin-top:0px;">
				<?php if ($logged && $isadmin) { ?>
					<a class="waves-effect waves-light btn" style="width:100%;">NEW CHARGE</a>
				<?php } ?>
			</div>
			<?php
				foreach($categories as $cat) {
					echo '<p style="font-size:20px;color:#fff;font-weight:0.6;">'.$cat['c_name'].'</p>
						<table class="striped d_table" style="font-size:13px;padding:1px;">
					<thead class="d_table_head">
						 <tr>
							<th>Title</th>
							<th>Desc</th>
							<th style="width:8%;">Jail</th>
							<th style="width:8%;">Fine</th>
							<th style="width:8%;">Cat</th>';
							if ($logged && $isadmin) {
								echo '
							<th style="width:8%;"></th>';
							}
						echo '
						</tr>
					</thead>
					<tbody>';
					$charges = Array();
					foreach($maincon->query("SELECT * from penalcode_charges WHERE p_cat = ".$cat['c_id']) as $charge) {
						array_push($charges, $charge);
					echo '<tr>';
						echo '<td style="color:#ffffff">';
							echo $charge['p_crime'];
						echo '</td>';
						echo '<td style="font-size:12px;">';
							echo $charge['p_desc'];
						echo '</td>';
						echo '<td>';
							if ($logged) { 
								echo $charge['p_time'];
							} else {
								echo '*';
							}
						echo '</td>';
						echo '<td>';
							if ($logged) { 
								echo $charge['p_fine'];
							} else {
								echo '*';
							}
						echo '</td>';
						echo '<td>';
							echo  $charge['p_cat'];;
						echo '</td>';
						if ($logged && $isadmin) { 
							echo '<td>';
								echo '<a class="waves-effect waves-light btn-small">EDIT</a>';
							echo '</td>';
						}
					echo '</tr>';
					}
					echo '</tbody>
						</table>';
				}
				
			?>
			<div id="charges_json" style="display:none">
				<?php echo json_encode($charges) ?>
			</div>
		</div>
