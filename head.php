<?php 
$base = dirname(__FILE__);
require_once('config.php');
$mysqli = new mysqli($dblocation, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    $dbfail = true;
}
else {
	$dbfail = false;
} 
require_once('functions.php');