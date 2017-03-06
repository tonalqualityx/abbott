<?php
//Create or add to the .htaccess file
$myfile = fopen(".htaccess", "w") or die("Unable to open/create htaccess!");
$txt = "";
fwrite($myfile, $txt);
fclose($myfile);
//SQL for Initial Setup
$sql = "CREATE TABLE IF NOT EXISTS " . $table_prefix . "users (user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(45) UNIQUE, password VARCHAR(255), email VARCHAR(255));";
$sql .= "INSERT INTO " . $table_prefix . "users (username, password, email) VALUES ('$user', '$pass', '$email');";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "customers (customer_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, first_name VARCHAR(45), last_name VARCHAR(45), mailing_st VARCHAR(255), mailing_st2 VARCHAR(255), mailing_city VARCHAR(45), mailing_state VARCHAR(45), mailing_zip VARCHAR(5));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "phone_numbers (phone_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, phone VARCHAR(12), phone_type VARCHAR(45), primary_phone BOOLEAN,
 customer_id INT, FOREIGN KEY (customer_id) REFERENCES " . $table_prefix . "customers(customer_id));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "special_pricing (sp_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, pricing_details VARCHAR(255), customer_id INT, FOREIGN KEY (customer_id) REFERENCES " . $table_prefix . "customers(customer_id));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "service_locations (location_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, location_st VARCHAR(255), location_st2 VARCHAR(255), location_city VARCHAR(255), location_state VARCHAR(45), location_zip VARCHAR(5));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "customers_to_locations (ctl_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, customer_id INT, location_id INT, FOREIGN KEY (customer_id) REFERENCES " . $table_prefix . "customers(customer_id), FOREIGN KEY (location_id) REFERENCES " . $table_prefix . "service_locations(location_id));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "tanks (tank_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, tank_size INT, location_id INT, FOREIGN KEY (location_id) REFERENCES " . $table_prefix . "service_locations(location_id));";
$sql .= "CREATE TABLE IF NOT EXISTS " . $table_prefix . "service (service_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, tank_id INT, call_date DATE, paid BOOLEAN, service_request_date DATE, service_performed_date DATE, FOREIGN KEY (tank_id) REFERENCES " . $table_prefix . "tanks(tank_id));";
$sql .= "CREATE TABLE IF NOT EXISTS {$table_prefix}notes (note_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, note TEXT NOT NULL, customer_id INT, service_id INT, note_time TIMESTAMP, FOREIGN KEY (customer_id) REFERENCES {$table_prefix}customers(customer_id), FOREIGN KEY (service_id) REFERENCES {$table_prefix}service(service_id));";

//Run this giant mess
$result = mysqli_multi_query($mysqli, $sql);
$errors = '';

if ($result) {
    do {
        // grab the result of the next query
        if (($result = mysqli_store_result($mysqli)) === false && mysqli_error($mysqli) != '') {
            $errors .= mysqli_error($mysqli) . "<br />";
        }
    } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli)); // while there are more results
} else {
    $errors .= mysqli_error($mysqli) . "<br />";
}