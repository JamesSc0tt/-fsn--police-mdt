<?php
$curpage = 'booking';
include "includes/header.php"; // local
  $chargees = Array();
?>
<div class="container">
    <?php
      if (isset($_GET['submitted'])) {
        if (isset($_GET['crimsubmit'])) {
        ?>
          <div class='card-panel green lighten-4' style='color:black'><b>Record added</b><br>The criminal was submitted.</div>
        <?php
        }
        ?>
          <div class='card-panel green lighten-4' style='color:black'><b>Record added</b><br>The case has been submitted, you probably need to create a report for this.</div>
          <h5 style="color:white">Do I need to create a report?</h5>
          <hr class="hr_title">
          <p style="color:white">Here are the cases where a report <b style="color:white;">MUST</b> be filled out:</p>
          <ul class="browser-default">
              <li>If the charges include a felony</li>
              <li>If the criminal has elluded to the fact they'll take it to court</li>
              <li>If you need command/high command/doj input moving forwards</li>
              <li>If there will be further investigations</li>
          </ul>
          <p style="color:white">Here are the cases where a report does not need be filled out:</p>
          <ul class="browser-default">
              <li>If it doesn't fall into any of the above categories</li>
              <li>If you don't feel it will go to court</li>
              <li>If it will not require any further discussion</li>
          </ul>
          <h5 style="color:white">Create a report</h5>
          <hr class="hr_title">
          <a href="999.php?new&link=charges&lid=<?php echo $_GET['submitID'] ?>" class="btn waves-effect waves-light" style="width:100%;margin-top:15px;">Create linked report</a>
        <?php
        die;
      }
      if (isset($_GET['doesnotexist'])) {
    ?>
      <div class='card-panel red lighten-4' style='color:black'><b>An error occurred</b><br>No criminal exists for this chracter, you need to create a criminal before you can submit the charges.</div>
    <?php
      }
    ?>
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
        <div class="col s6" style="padding:15px">
            <script>
              var existing = true;
              function useCriminal() {
                $('#new-criminal').hide();
                $('#existing-criminal').show();
                existing = true;
                return false;
              }
              function newCriminal() {
                $('#existing-criminal').hide();
                $('#new-criminal').show();
                existing = false;
                return false;
              }
            </script>
            <div id="new-criminal" style="display:none;">
              <form class="">
                <button type="button" class="btn waves-effect waves-light" onclick="useCriminal()" style="width:100%;margin-top:15px;">Use Existing Criminal</button>
                <center><h5> - OR -</h5></center>
                <div class="row">
                    <div class="input-field col s3" style="width:18%;float:left;">
                        <input id="sus_id" type="number" class="validate">
                        <label for="sus_id">Character ID</label>
                    </div>
                    <div class="input-field col s6" style="width:78%;float:right;">
                    <input id="sus_name" type="text" class="validate">
                    <label for="sus_name">Suspect Name</label>
                    </div>
                    <div class="input-field col s6" style="width:100%">
                    <input id="sus_mug" type="url" class="validate">
                    <label for="sus_mug">Suspect Mugshot</label>
                    </div>
                </div>
              </form>
            </div>
            <div id="existing-criminal">
              <div class="input-field col s3" style="width:100%;margin:0px;">
                  <input id="sus_id1" type="number" class="validate">
                  <label for="sus_id1">Character ID</label>
                  <center><h5> - OR -</h5></center>
                  <button type="button" class="btn waves-effect waves-light" onclick="newCriminal()" style="width:100%;margin-top:15px;">Add New Criminal</button>
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
							<p><?php echo $charge['p_crime'] ?><span class="charge-controls"><a class="pos noselect" onclick="addCharge(<?php echo $charge['jsonid']?>)">+</a><a class="neg noselect" onclick="removeCharge(<?php echo $charge['jsonid']?>)">-</a></span></p>
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
          var currentCharges = [];

          function updateCharges() {
          	var str = ''
          	if (currentCharges.length > 0) {
          		for(var i = 0; i < currentCharges.length; i++) {
          			var obj = currentCharges[i];
                console.log(charges[obj.chargeid]);
          			var chrg = charges[obj.chargeid][2]
          			var type = charges[obj.chargeid][1]
          			if (obj.amt > 0) {
          				str = '['+obj.amt+'X] '+chrg+' ('+type+') | '+str
          			}
          		}
          	}
          	$('#booking-charges').text(str)
          	booking_compute_finetime()
          }
          function addCharge(id) {
          	var pushed = false
          	if (currentCharges.length > 0) {
          		for(var i = 0; i < currentCharges.length; i++) {
          			var obj = currentCharges[i];
          			if (obj.chargeid == id) {
          				currentCharges[i].amt = currentCharges[i].amt + 1
          				pushed = true
          			}
          		}
          	}
          	if (pushed == false) {
          		var charge = charges[id].charge
          		currentCharges.push({'chargeid':id,'amt': 1})
          	}
          	console.log(JSON.stringify(currentCharges))
          	updateCharges();
          }

          function removeCharge(id) {
          	if (currentCharges.length > 0) {
          		for(var i = 0; i < currentCharges.length; i++) {
          			var obj = currentCharges[i];
          			if (obj.chargeid == id) {
          				var newish = currentCharges[i].amt - 1
          				if (newish < 0) {
          					console.log('You can\'t remove a charge that isn\'t threre!')
          				} else {
          					currentCharges[i].amt = currentCharges[i].amt - 1
          				}
          			}
          		}
          	}
          	updateCharges();
          }

          function booking_compute_finetime() {
            var jailtime = 0
            var fine = 0
          	if (currentCharges.length > 0) {
          		for(var i = 0; i < currentCharges.length; i++) {
          			var obj = currentCharges[i];
          			var chrg = charges[obj.chargeid];

          			var plustime = parseInt(chrg[5])*obj.amt
          			var plusfine = parseInt(chrg[6])*obj.amt

          			jailtime = jailtime + plustime
          			fine = fine + plusfine
          		}
          	}

          	$('#booking-time').text(jailtime)
          	$('#booking-fine').text(fine)
          }
        </script>
        <div class="col s12">
            <h5 class="d_h5">Booking Overview</h5>
            <hr class="hr_title">
            <p>Selected charges</p>
            <div class="d_chargeoverview">
              <p id="booking-charges">Start by selecting charges from the dropdowns above.</p>
            </div>
            <div style="padding-left:20px;padding-right:20px;margin-top:20px;padding-bottom:20px;height:80px;">
              <div style="width:48%; float:left;height:80px;">
                <div class="d_chargeoverview" style="width:78%;float:left;margin-top:20px;">
                  Suggested Time: <span id="booking-time"></span>
                </div>
                <div class="input-field col s3" style="width:18%;float:right;padding:0px;">
                    <input id="time" type="number" class="validate">
                    <label for="time">Applied Time</label>
                </div>
              </div>
              <div style="width:48%; float:right;height:80px;">
                <div class="d_chargeoverview" style="width:78%;float:left;margin-top:20px;">
                  Suggested Fine: $<span id="booking-fine"></span>
                </div>
                <div class="input-field col s3" style="width:18%;float:right;padding:0px;">
                    <input id="fine" type="number" class="validate">
                    <label for="fine">Applied Fine</label>
                </div>
              </div>
            </div>
            <center><p style="color:white;padding:15px;width:100%;">Once this has been submitted, you'll be prompted to create a report.</p></center>
            <button class="waves-effect waves-light btn" onclick="DOTHETHING()" style="width:100%;">Submit</button>
        </div>
    </div>
    <script>
      function DOTHETHING() {
        if (existing) {
          var sus_id = $('#sus_id1').val()
          if (sus_id == '') {
            window.createNotification({
              closeOnClick: true,
              displayCloseButton: true,
              theme: 'error'
            })({
              title: 'System Error',
              message: 'You need to put a character ID.'
            });
            return;
          }
        } else {
          var sus_id = $('#sus_id').val()
          if (sus_id == '') {
            window.createNotification({
              closeOnClick: true,
              displayCloseButton: true,
              theme: 'error'
            })({
              title: 'System Error',
              message: 'You need to put a character ID.'
            });
            return;
          }
          var sus_name = $('#sus_name').val()
          if (sus_name == '') {
            window.createNotification({
              closeOnClick: true,
              displayCloseButton: true,
              theme: 'error'
            })({
              title: 'System Error',
              message: 'You need to put a Name.'
            });
            return;
          }
          var sus_mug = $('#sus_mug').val()
        }
        if ($('#time').val() < 1 && $('#fine').val() < 1) {
          window.createNotification({
            closeOnClick: true,
            displayCloseButton: true,
            theme: 'error'
          })({
            title: 'System Error',
            message: 'There needs to be either a fine or jailtime associated with the charge.'
          });
          return;
        }
        var chargesSubmit = []
        for(var i = 0; i < currentCharges.length; i++) {
          var obj = currentCharges[i];
          var chrg = charges[obj.chargeid];

          chargesSubmit.push({'chargeid':obj.chargeid, 'charge':chrg[2] ,'type':chrg[1], 'amt': obj.amt})
        }
        if (existing) {
          post('js_system/submitCase.php', {
            sus_id: sus_id,
            time: $('#time').val(),
            fine: $('#fine').val(),
            charges: JSON.stringify(chargesSubmit)
          })
        } else {
          post('js_system/submitCase.php', {
            sus_id: sus_id,
            sus_name: sus_name,
            sus_mug: sus_mug,
            time: $('#time').val(),
            fine: $('#fine').val(),
            charges: JSON.stringify(chargesSubmit)
          })
        }
      }
    </script>
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
