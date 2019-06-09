<?php
$curpage = '999';
include "includes/header.php"; // local
?>
<div class="container">
	<?php
		if (isset($_GET['new'])) {
			if (isset($_GET['link'])) {
				?>
					<input id="linkWith" type="hidden" value="<?php echo $_GET['link'] ?>">
					<input id="linkID" type="hidden" value="<?php echo $_GET['lid'] ?>">
				<?php
			} else {
				?>
					<input id="linkWith" type="hidden" value="false">
					<input id="linkID" type="hidden" value="-1">
				<?php
			}
	?>
		<h5 class="d_h5">Create report</h5>
		<hr class="hr_title">
		<p>When the report has been created you will receive a reference # for you to lookup the report at a later date, this is the number you give to a
		civilian for them to discuss the report with an officer</p>
		<hr class="hr_title">
		<div class="row">
			<div class="row">
				<div class="input-field col s6" style="width:100%">
					<i class="material-icons prefix">mode_edit</i>
					<input name="report" id="reportTitle" class="materialize-textarea" style="width:94%" data-length="300" placeholder="REPORT TITLE"></input>
				</div>
			</div>
			<div class="row">
				<!-- Include stylesheet -->
				<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
				<style>
					.ql-toolbar {
						background-color:rgba(255,255,255,0.6);
					}
					#editor {
						background-color:rgba(255,255,255,0.1);
					}
				</style>
				<!-- Create the editor container -->
				<div id="editor">

				</div>
				<!-- Include the Quill library -->
				<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

				<!-- Initialize Quill editor -->
				<script>
				  var quill = new Quill('#editor', {
					theme: 'snow'
				  });
				</script>
			</div>
			<div class="row">
				<a class="btn waves-effect waves-light" onclick="submitReport()" style="width:100%;">CREATE REPORT</a>
				<script>
					function submitReport() {
						var linkWith = $('#linkWith').val()
						var linkID = $('#linkID').val()
						var title = $('#reportTitle').val()
						if (title == '') {
							window.createNotification({
								closeOnClick: true,
								displayCloseButton: true,
								theme: 'error'
							})({
								title: 'System Error',
								message: 'A title is required for a report.'
							});
							return;
						}
						var content = document.querySelector(".ql-editor")
						if (content == '' || content == '<p><br></p>') {
							window.createNotification({
								closeOnClick: true,
								displayCloseButton: true,
								theme: 'error'
							})({
								title: 'System Error',
								message: 'Your report cannot be empty'
							});
							return;
						}
						content = content.innerHTML.replace(/</g, "#REPL101").replace(/>/g, "#REPL102")
						//console.log(content);
						post('js_system/addReport.php', {
							linkWith: linkWith,
							linkID: linkID,
							title: title,
							content: content
						});
						//window.location.href = "999.php";
					}
				</script>
			</div>
		</div>
	<?php
		} elseif (isset($_GET['viewid'])) {
				$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
				$report = $maincon->query("SELECT * from reports WHERE `r_id` = ".$_GET['viewid'])->fetch();
				if (isset($_GET['posted'])) {
					?>
						<div class='card-panel green lighten-4' style='color:black'><b>Request Completed</b><br>Comment posted</div>
					<?php
				}
	?>
				<h5 class="d_h5"><?php echo $report['r_title']?></h5>
				<hr class="hr_title">
				<div class="d_chargeoverview reportCSS" style="max-width:100%;">
					<p>
						<?php echo formatReport($report['r_report']);?>
					</p>
				</div>
				<p style="margin-top:4px;padding-left:10px;padding-right:10px;">Report submitted by: <?php echo getUserDetails($report['r_userid'])['rpname'] ?> <span style="float:right;">Report submitted: <?php echo $report['r_date'] ?></span></p>
				<h5 class="d_h5" style="margin-top:40px;">Comments (<?php echo $report['r_numcomments'] ?>)</h5>
				<hr class="hr_title">
					<?php
						if (intval($report['r_numcomments']) > 0) {
							foreach($maincon->query("SELECT * from report_replies WHERE `c_report` = ".$report['r_id']) as $comment) {
								?>
									<div class="d_chargeoverview reportCSS" style="max-width:100%;margin-top:30px;">
										<p>
											<?php echo formatReport($comment['c_comment']);?>
										</p>
									</div>
									<p style="margin-top:4px;padding-left:10px;padding-right:10px;">Commented by: <?php echo getUserDetails($comment['c_user'])['rpname'] ?> <span style="float:right;">Report submitted: <?php echo $comment['c_date'] ?></span></p>
								<?php
							}
						} else {
							echo '<center><p style="color:white;font-weight:bold;margin-top:50px;margin-bottom:50px;">There are no comments on this report</p></center>';
						}
					?>
				<h5 class="d_h5">New Comment</h5>
				<hr class="hr_title">
				<!-- Include stylesheet -->
				<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
				<style>
					.ql-toolbar {
						background-color:rgba(255,255,255,0.6);
					}
					#editor {
						background-color:rgba(255,255,255,0.1);
					}
				</style>
				<!-- Create the editor container -->
				<?php
					if ($report['r_status'] == 'resolved') {
						echo '<center><p style="color:red;font-weight:bold;margin-top:50px;margin-bottom:50px;">This report has been closed so no more replies can be posted.</p></center>';
					} else {
				?>
					<div id="editor">
					</div>
					<a class="waves-effect waves-light btn" style="width:100%;margin-top:40px;" onclick="submitComment()">Comment</a>
					<script>
						function submitComment() {
							var report = <?php echo $report['r_id'] ?>;
							var content = document.querySelector(".ql-editor");
							if (content == '' || content == '<p><br></p>' || content == '<p></p>') {
								window.createNotification({
									closeOnClick: true,
									displayCloseButton: true,
									theme: 'error'
								})({
									title: 'System Error',
									message: 'Your comment cannot be empty'
								});
								return;
							}
							content = content.innerHTML.replace(/</g, "#REPL101").replace(/>/g, "#REPL102")
							//console.log(content);
							post('js_system/addComment.php', {
								report: report,
								comment: content
							});
							//window.location.href = "999.php";
						}
					</script>
					<!-- Include the Quill library -->
					<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

					<!-- Initialize Quill editor -->
					<script>
					  var quill = new Quill('#editor', {
						theme: 'snow'
					  });
					</script>
					<?php
						}
						if ($isadmin) { ?>
						<div style="margin-top:30px;">
							<h5 class="d_h5">Admin options</h5>
							<hr class="hr_title">
							<form action="js_system/setReportStatus.php" method="POST">
								<input type="hidden" name="report" value="<?php echo $report['r_id'] ?>">
							  <select class="browser-default" name="status">
							    <option value="open" disabled selected>Set report status</option>
							    <option value="open">Open</option>
							    <option value="inprogress">In Progress</option>
							    <option value="resolved">Resolved</option>
							  </select>
								<button class="btn waves-effect waves-light" type="submit" style="width:100%;margin-top:15px;">Submit</button>
							</form>
						</div>
					<?php } ?>
	<?php
		} else {
			if (isset($_GET['submitted'])) {
			?>
				<div class='card-panel green lighten-4' style='color:black'><b>Request Completed</b><br>The report has been submitted.</div>
			<?php
			}
	?>
		<a class="btn waves-effect waves-light" href="?new" style="width:100%;">NEW REPORT</a>
		<h5 class="d_h5">OPEN REPORTS</h5>
		<hr class="hr_title">
		<p>These reports are awaiting resolving, if you resolve one please contact High Command/Command/DoJ to change it's status.</p>
		<table class="striped d_table">
			<thead class="d_table_head">
				<tr>
					<th style="padding-left:30px;width:40%;">Title</th>
					<th style="padding-left:30px">Creator</th>
					<th style="padding-left:30px">Replies</th>
					<th style="padding-left:30px">Date</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
					foreach($maincon->query("SELECT * from reports WHERE `r_status` = 'open'") as $report) {
				?>
					<tr>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_title'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo getUserDetails($report['r_userid'])['rpname'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_numcomments'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_date'] ?></td>
						<td><a class="waves-effect waves-light btn" href="?viewid=<?php echo $report['r_id']?>">View</a></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>

		<h5 class="d_h5" style="padding-top:40px;">IN PROGRESS REPORTS</h5>
		<hr class="hr_title">
		<p>These are ongoing reports/investigations that cannot be discussed outside of the police.</p>
		<table class="striped d_table">
			<thead class="d_table_head">
				<tr>
					<th style="padding-left:30px;width:40%;">Title</th>
					<th style="padding-left:30px">Creator</th>
					<th style="padding-left:30px">Replies</th>
					<th style="padding-left:30px">Date</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
					foreach($maincon->query("SELECT * from reports WHERE `r_status` = 'inprogress'") as $report) {
				?>
					<tr>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_title'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo getUserDetails($report['r_userid'])['rpname'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_numcommentst'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_date'] ?></td>
						<td><a class="waves-effect waves-light btn" href="?viewid=<?php echo $report['r_id']?>">View</a></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>

		<h5 class="d_h5" style="padding-top:40px;">RESOLVED REPORTS</h5>
		<hr class="hr_title">
		<p>Reports that have been marked as resolved by High Command/Command/DoJ.</p>
		<table class="striped d_table">
			<thead class="d_table_head">
				<tr>
					<th style="padding-left:30px;width:40%;">Title</th>
					<th style="padding-left:30px">Creator</th>
					<th style="padding-left:30px">Replies</th>
					<th style="padding-left:30px">Date</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
					foreach($maincon->query("SELECT * from reports WHERE `r_status` = 'resolved'") as $report) {
				?>
					<tr>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_title'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo getUserDetails($report['r_userid'])['rpname'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_numcommentst'] ?></td>
						<td style="font-size:15px;font-color:#fff;padding-left:30px"><?php echo $report['r_date'] ?></td>
						<td><a class="waves-effect waves-light btn" href="?viewid=<?php echo $report['r_id']?>">View</a></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	<?php } ?>
</div>
<script>
	$(document).ready(function() {
		$('input#input_text, textarea#textarea2').characterCounter();
	});
</script>
