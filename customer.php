<?php 
require_once('head.php');
if(isset($_POST['first'])) {
	$first = $_POST['first'];
	$last = $_POST['last'];
	$bill_st_1 = $_POST['bill_addy1'];
	$bill_st_2 = $_POST['bill_addy2'];
	$bill_city = $_POST['bill_city'];
	$bill_state = $_POST['bill_state'];
	$bill_zip = $_POST['bill_zip'];
	$phone = $_POST['phone'];
	$phone_type = $_POST['phone_type'];
	if(isset($_POST['bill-service']) && $_POST['bill-service'] == 'on') {
		$service_st_1 = $bill_st_1;
		$service_st_2 = $bill_st_2;
		$service_city = $bill_city;
		$service_state = $bill_state;
		$service_zip = $bill_zip;
	}
	else {
		$service_st_1 = $_POST['service_addy1'];
		$service_st_2 = $_POST['service_addy2'];
		$service_city = $_POST['service_city'];
		$service_state = $_POST['service_state'];
		$service_zip = $_POST['service_zip'];
	}
	$tank_size = $_POST['tank_size'];
	$billing_insert = "INSERT INTO " . $table_prefix . "customers (first_name, last_name, mailing_st, mailing_st2, mailing_city, mailing_state, mailing_zip) VALUES ('$first', '$last', '$bill_st_1', '$bill_st_2', '$bill_city', '$bill_state', '$bill_zip')";
	$query = mysqli_query($mysqli, $billing_insert);
	$cust_id = mysqli_insert_id($mysqli);
	$service_insert = "INSERT INTO " . $table_prefix . "service_locations (location_st, location_st2, location_city, location_state, location_zip) VALUES ('$service_st_1', '$service_st_2', '$service_city', '$service_state', '$service_zip')";
	$query = mysqli_query($mysqli, $service_insert);
	$loc_id = mysqli_insert_id($mysqli);
	$bill_to_service = "INSERT INTO " . $table_prefix . "customers_to_locations (customer_id, location_id) VALUES ($cust_id, $loc_id)";
	$query = mysqli_query($mysqli, $bill_to_service);
	$phone_insert = "INSERT INTO " . $table_prefix . "phone_numbers (phone, phone_type, customer_id) VALUES ('$phone', '$phone_type',$cust_id)";
	$query = mysqli_query($mysqli, $phone_insert);
	$tank_insert = "INSERT INTO " . $table_prefix . "tanks (tank_size, location_id) VALUES ($tank_size, $loc_id)";
	$query = mysqli_query($mysqli, $tank_insert);
}
if(!isset($cust_id)) {
	$cust_id = $_GET['cust'];
}

include('header.php'); ?>
<?php
//Get the customer info
$sql = "SELECT first_name, last_name, mailing_st, mailing_st2, mailing_city, mailing_state, mailing_zip FROM " . $table_prefix . "customers WHERE customer_id=$cust_id";
$query = mysqli_query($mysqli, $sql);
while($row = mysqli_fetch_assoc($query)) { ?>
	<div class="row">
		<div class="medium-4 small-12 column" id="customer">
			<h2><?php echo "<span class='first-name'>" . $row['first_name'] . '</span> <span class="last-name">' . $row['last_name']; ?></span> <a href="#" class="button small-button">Edit</a></h2>
			<?php $sql = "SELECT phone_id, phone, phone_type FROM {$table_prefix}phone_numbers WHERE customer_id=$cust_id";
			$phoneQuery = mysqli_query($mysqli, $sql);
			while($phoneRow = mysqli_fetch_assoc($phoneQuery)) {
				echo properCase($phoneRow['phone_type']) . " &mdash; ";
				phoneNumber($phoneRow['phone']);
			} ?>
		</div>
		<div class="medium-4 small-12 thin-border pad-15 column">
			<p><strong>Billing Address</strong><br />
			<?php echo '<span class="street">' . $row['mailing_st']; ?></span><br />
			<?php echo $row['mailing_st2'] ? '<span class="street-2">' . $row['mailing_st2'] . '</span><br />':''; ?>
			<?php echo '<span class="city">' . $row['mailing_city'] . '</span>, <span class="state">' . $row['mailing_state'] . '</span> <span class="zip">' . $row['mailing_zip']; ?></span><br /></p>
		</div>
	</div>
<?php } ?>
<div class="row">
	<div class="small-12 column">
	</div>
</div>
<div class="row">
	<div class="small-12 medium-6 column">
		<h2>Service Locations <a href="#" class="button small-button">Add Location</a></h2>
		<div class="row" id="service-locations">
			<?php $sql = "SELECT " . $table_prefix . "customers_to_locations.customer_id, " . $table_prefix . "customers_to_locations.location_id, " . $table_prefix . "service_locations.location_st,  " . $table_prefix . "service_locations.location_st2,  " . $table_prefix . "service_locations.location_city,  " . $table_prefix . "service_locations.location_state,  " . $table_prefix . "service_locations.location_zip  FROM " . $table_prefix . "customers_to_locations LEFT JOIN " . $table_prefix . "service_locations ON " . $table_prefix . "customers_to_locations.location_id=" . $table_prefix . "service_locations.location_id WHERE " . $table_prefix . "customers_to_locations.customer_id=$cust_id"; 
				$query = mysqli_query($mysqli, $sql);
				while($row = mysqli_fetch_assoc($query)) { ?>
					<div class="small-12 column">
						<p class="location"><span class="street"><?php echo $row['location_st'] . "</span><br />";
							echo $row['location_st2'] ? "<span class='street-2'>" . $row['location_st2'] ."</span><br />": '';
							echo "<span class='city'>" . $row['location_city'] . '</span>, <span class="state">' . $row['location_state'] . '</span> <span class="zip">' . $row['location_zip']; ?></span><br />
							<a href="#" class="button small-button success">Schedule</a> <a href="#" class="button small-button">Edit</a> <a href="#" class="button small-button alert">Delete</a></p>
					</div>
				<?php }
			?>
		</div>
	</div>
	<div class="small-12 medium-6 column">
		<div class="row" id="notes">
			<div class="small-12 column">
				<h2>Notes</h2>
			</div>
		</div>
	</div>
<?php include('footer.php'); ?>