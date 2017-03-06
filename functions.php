<?php
function TableExists($table, $mysqli) {
  $sql = "SHOW TABLES LIKE '$table';";
  $query = mysqli_query($mysqli, $sql);
  if($query !== false) {
  	return true;
  }
  else {
  	return false;
  }
}

function getModal($modals) {
	
}

function newServiceLocation($includeTank = false) { ?>
	<div class="small-12 column">
		<label>Service Street Address Line 1:
			<input type="text" placeholder="12 Cloverfield Lane" name="service_addy1">
		</label>
	</div>
	<div class="small-12 column">
		<label>Service Street Address Line 2:
			<input type="text" placeholder="12 Cloverfield Lane" name="service_addy2">
		</label>
	</div>
	<div class="small-12 medium-6 column">
		<label>Service City:
			<input type="text" name="service_city" placeholder="Gotham">
		</label>
	</div>
	<div class="small-12 medium-3 column">
		<label>Service State:
			<input type="text" name="service_state" placeholder="NH">
		</label>
	</div>	
	<div class="small-12 medium-3 column">
		<label>Service Zip:
			<input type="text" name="service_zip" placeholder="03603">
		</label>
	</div>		

	<?php if($includeTank) { ?>
		<div class="small-12 medium-6 large-4 column end">
			<label>Tank Size (in Gallons)
				<input type="number" name="tank_size">
			</label>
		</div>
	<?php }
}
function phoneNumber($phone) {
	$length = strlen($phone);
	if(!strpos($phone, '-')){
		switch ($length) {
			case 7:
				$number = substr($phone, 0, 3) . '-' . substr($phone, 2);
				break;
			case 10:
				$number = substr($phone, 0, 3) . '-' . substr($phone, 2, 3) . '-' . substr($phone, 5);
				break;
			default:
				$number = substr($phone, 0, 1) . '-' . substr($phone, 1, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6);
				break;
		}
	}//endif
	else {
		$number = $phone;
	} ?>
	<a href="tel:<?php echo $phone; ?>"><?php echo $number; ?></a>
<?php }
function properCase($string) {
	$newString = strtoupper(substr($string, 0, 1)) . substr($string, 1);
	echo $newString;
}