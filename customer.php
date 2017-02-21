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
	$phone_insert = "INSERT INTO " . $table_prefix . "phone_numbers (phone, phone_type, customer_id) VALUES ('$phone', '$phone_type',customer_id)";
	$query = mysqli_query($mysqli, $phone_insert);
	$tank_insert = "INSERT INTO " . $table_prefix . "tanks (tank_size, location_id) VALUES ($tank_size, $loc_id)";
	$query = mysqli_query($mysqli, $tank_insert);
}
include('header.php'); ?>
<div class="row">
	<div class="small-12 column">
		<h2>Customer Name</h2>
	</div>
</div>

<?php include('footer.php'); ?>