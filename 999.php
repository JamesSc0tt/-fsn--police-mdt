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
	?>	
				<h5 class="d_h5">Report title</h5>
				<hr class="hr_title">
				<div class="d_chargeoverview">
					<p>
						Original comment
					</p>
				</div>
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
				<a style="float:right" class="waves-effect waves-light btn">Comment</a>
				<!-- Include the Quill library -->
				<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

				<!-- Initialize Quill editor -->
				<script>
				  var quill = new Quill('#editor', {
					theme: 'snow'
				  });
				</script>
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
					<th style="padding-left:30px">Title</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="font-size:15px;font-color:#fff;padding-left:30px">HELP MY GUNS WERE ALL STOLEN...</td>
					<td><a class="waves-effect waves-light btn">View</a></td>
				</tr>
			</tbody>
		</table>
		
		<h5 class="d_h5" style="padding-top:40px;">RESOLVED REPORTS</h5>
		<hr class="hr_title">
		<p>Reports that have been marked as resolved by High Command/Command/DoJ.</p>
		<table class="striped d_table">
			<thead class="d_table_head">
				<tr>
					<th style="padding-left:30px">Title</th>
					<th style="width:8%;"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="font-size:15px;font-color:#fff;padding-left:30px">HELP MY GUNS WERE ALL STOLEN...</td>
					<td><a class="waves-effect waves-light btn">View</a></td>
				</tr>
			</tbody>
		</table>
	<?php } ?>
</div>
<script>
	$(document).ready(function() {
		$('input#input_text, textarea#textarea2').characterCounter();
	});
</script>