<?php
$curpage = 'criminals';
include "includes/header.php"; // local

?>
        <div class="container d_colcontain">
            <!--<div class="row" style=""><a class="waves-effect waves-light btn">Register a Criminal</a></div>-->
            <div class="d_leftcol">
                <div class="d_leftcol_search">
                    <h5 class="d_title">Search Criminal Database</h5>
                    <div class="row">
                        <div class="input-field">
                            <form>
                              <input id="search" name="search" type="text" class="">
                              <label for="search">Enter Name...</label>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn">SEARCH</button>
                      </form>
                        <div class="d_profile_results">
                            <h5>Results</h5><center>
                            <?php
                              if (isset($_GET['search'])) {
                                if (strlen($_GET['search']) > 2) {
                                $maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
                                  foreach($maincon->query("SELECT * FROM criminals WHERE name LIKE '%".$_GET['search']."%'") as $crim) {
                            ?>
                                  <a class="btn waves-effect waves-light" href="" style="width:90%;margin:15px;margin-top:5px;margin-bottom:0px;"><?php echo $crim['name'] ?></a>
                            <?php
                                  }
                                } else {
                                  ?>
                                    <div class='card-panel red lighten-4' style='color:black'><b>An error occurred:</b><br>For performance, the length of your search must be more than 2 characters.</div>
                                  <?php
                                }
                              }
                            ?>
                        </center></div>
                    </div>
                </div>
            </div>
			<div class="d_rightcol">
				<?php
					if (isset($_GET['lookup_id'])) {
						$char = true;
					} else {
						$char = false;
					}
				?>
				<?php if ($char) { ?>
					<div class="d_rightcol_title">
						<h5 class="d_title">Criminal Profile</h5>
					</div>
					<div class="d_rightcol_title" style="margin-top:30px;">
						<h5 class="d_title" style="color:red;">THIS INDIVIDUAL IS WANTED<br>DO NOT APPROACH<br>REPORT WHEREABOUTS TO POLICE IMMEDIATELY</h5>
					</div>
					<div class="d_rightcol_title" style="margin-top:30px;">
						<img class="d_profile_img" src="includes/default.png" style="border:2px yellow solid;max-height:100px;">
					</div>
					<div class="d_rightcol_title" style="margin-top:5px;">
						<h5 class="d_title">NAME</h5>
					</div>
					<div class="d_rightcol_title" style="margin-top:0px;">
						<p>Brian Smith (ID#212)</p>
					</div>
					<?php if ($logged) { ?>
						<div class="d_rightcol_title" style="margin-top:5px;">
							<h5 class="d_title">DETAILS</h5>
						</div>
						<div class="d_rightcol_title" style="margin-top:0px;">
							<div class="js_detail js_red js_no">V</div>
							<div class="js_detail js_green js_no">G</div>
							<div class="js_detail js_yellow js_no">D</div>
							<div class="js_detail js_blue js_no">M</div>
						</div>
						<div class="d_rightcol_title d_pdcomments" style="margin-top:5px;">
							<p><b>PD Comments:</b></p>
							<p>these are some comments about the individual</p>
						</div>
					<?php } ?>
					<div class="d_rightcol_title" style="margin-top:5px;">
						<h5 class="d_title">Priors</h5>
					</div>
					<div>
						<table class="striped d_table">
							<thead class="d_table_head">
								 <tr>
									<th>Type</th>
									<th>Count</th>
									<th>Crime</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Infraction</td>
									<td>x2</td>
									<td>Battery</td>
								</tr>
								<tr>
									<td>Misdemeanour</td>
									<td>x1</td>
									<td>Vandalism</td>
								</tr>
								<tr>
									<td>Felony</td>
									<td>x1</td>
									<td>Being a massive cock</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php if ($logged) { ?>
						<div class="d_rightcol_title" style="margin-top:5px;">
							<h5 class="d_title">PREVIOUS ARRESTS</h5>
						</div>
						<div>
							<table class="striped d_table">
								<thead class="d_table_head">
									 <tr>
										<th>Title</th>
										<th style="width:8%;"></th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>Infraction</td>
										<td><a class="waves-effect waves-light btn">View</a></td>
									</tr>
									<tr>
										<td>Misdemeanour</td>
										<td><a class="waves-effect waves-light btn">View</a></td>
									</tr>
									<tr>
										<td>Felony</td>
										<td><a class="waves-effect waves-light btn">View</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
        <!-- <footer class="page-footer">
            <div class="container">
              <div class="row">
                <div class="col l6 s12">
                  <h5 class="white-text">Footer Title</h5>
                  <p class="grey-text text-lighten-4">Footer content.</p>
                </div>
              </div>
            </div>
            <div class="footer-copyright">
              <div class="container">
              ©
              <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
              </div>
            </div>
          </footer> -->
    </body>
</html>
