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