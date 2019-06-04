<?php

include "includes/header.php"; // local

?>
<div class="container">
	<?php if (!$logged) { 
			if (isset($_POST['title']) && isset($_POST['report'])) {
				
				die("<div class='card-panel green lighten-4' style='color:black'>Your report has been logged for review.</div>");
			}
	?>
		<h5 class="d_h5">REPORT A CRIME</h5>
		<hr class="hr_title">
		<p>Please note that this is not for emergency assistance, reports are not monitored 24/7 - call 911 if you need an officer or emergency services right now.</p>
		<div class="row">
			
			<form class="col s12" style="width:100%" action="999.php?999" method="POST">
				<div class="col input-field" style="width:100%;">
					<input name="title" id="pass" type="text" class="input-field validate">
					<label for="text" class="">Title</label>
				</div>
				<div class="row">
					<div class="input-field col s6" style="width:100%">
						<i class="material-icons prefix">mode_edit</i>
						<textarea name="report" id="icon_prefix2" class="materialize-textarea" rows="10" style="width:94%" data-length="300"></textarea>
						<label for="icon_prefix2">Write out your report... Make sure to include contact details.</label>
						<button class="btn waves-effect waves-light" type="submit" style="width:100%;">Submit</button>
					</div>
				</div>
			</form>
		</div>
	<?php 
		} else {
			if (isset($_GET['viewid'])) {
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
	?>		
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
	<?php }} ?>
</div>
<script>
	$(document).ready(function() {
		$('input#input_text, textarea#textarea2').characterCounter();
	});
</script>