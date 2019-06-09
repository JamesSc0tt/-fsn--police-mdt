<?php
$curpage = 'booking';
include "includes/header.php"; // local
  $chargees = Array();
?>
<div class="container">

    <div class="row">
        <div class="col s6">
            <h5 class="d_h5">Criminal's Details</h5>
            <hr class="hr_title">
        </div>
        <div class="col s6">
            <h5 class="d_h5">Criminal's Charges</h5>
            <hr class="hr_title">
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <form class="">
            <div class="row">
                <div class="input-field col s3">
                    <input id="sus_id" type="number" class="validate">
                    <label for="sus_id">Character ID</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                <input id="sus_name" type="text" class="validate">
                <label for="sus_name">Suspect Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                <input id="sus_mug" type="url" class="validate">
                <label for="sus_mug">Suspect Mugshot</label>
                </div>
            </div>
        </div>

        <div class="col s6">
			<?php
				$catno = 0;
				$maincon = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
				$categories = Array();
				foreach($maincon->query("SELECT * from penalcode_cats") as $cat) {
					$catno = $catno+1;
			?>
				<div class="acc_cont">
					<a class="accordion">S<?php echo $catno.'.0 : '.$cat['c_name'] ?></a>
					<div class="d_panel">
						<?php
							foreach($maincon->query("SELECT * from penalcode_charges WHERE p_cat = ".$cat['c_id']) as $charge) {
                $charge['jsonid'] = count($chargees);
                array_push($chargees, $charge);
						?>
							<p><?php echo $charge['p_crime'] ?><span class="charge-controls"><a class="pos" onclick="addCharge(<?php echo $charge['jsonid']?>)">+</a><a class="neg" onclick="removeCharge(<?php echo $charge['jsonid']?>)">-</a></span></p>
						<?php
							}
						?>
					</div>
				</div>
			<?php
				}
			?>
        </div>
        <script>
          var charges = <?php echo json_encode($chargees) ?>;
        </script>
        <div class="col s12">
            <h5 class="d_h5">Booking Overview</h5>
            <hr class="hr_title">
            <p>Selected charges</p>
            <div class="d_chargeoverview">
                <p></p>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea validate"></textarea>
                    <label for="textarea1">Additional Details</label>
                </div>
            </div>
            <a class="waves-effect waves-light btn">Submit</a>
        </div>
    </div>

</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
acc[i].addEventListener("click", function() {
    this.classList.toggle("acc_active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
    panel.style.display = "none";
    } else {
    panel.style.display = "block";
    }
});
}
</script>

</body>
</html>
