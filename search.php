<?php
include('head.php');
$last = htmlspecialchars($_POST['last']);
$addy = htmlspecialchars($_POST['addy']);
$where = '';
if($last != '' || $addy != ''){
	if($last != '') {
		$where .= "last_name LIKE '%" . $last . "%' ";
	}
	if($last != '' && $addy != '') {
		$where .= "AND ";
	}
	if($addy != '') {
		$where .= "mailing_st LIKE '%" . $addy . "%'";
	}
	$sql = "SELECT customer_id, first_name, last_name, mailing_st, mailing_city FROM " . $table_prefix . "customers WHERE $where";
	echo '<div class="row small-up-1 medium-up-3 large-up-4">';
	$query = mysqli_query($mysqli, $sql);
	$row_count = mysqli_num_rows($query);
	if($row_count > 0 ){
		while($row = mysqli_fetch_assoc($query)) { ?>
			<div class="column column-block">
				<div class="bordered results">
					<a href="customer.php?cust=<?php echo $row['customer_id']; ?>">	
						<h4><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h4>
						<p><?php echo $row['mailing_st'] . ', ' . $row['mailing_city']; ?></p>
					</a>
				</div>
			</div>
		<?php }
	}
	else {
		echo "<h3>No results found</h3>"; 
	}
	echo "</div><!-- END BLOCK GRID -->";
}
else {
	echo "<h3>No terms entered</h3>";
}