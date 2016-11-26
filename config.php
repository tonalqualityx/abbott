<?php
//Config file to setup database & such
$dbname = 'abbottcrm';
$dblocation = 'localhost';
$dbuser = 'abbot';
$dbpass = 'abbottpass';
$db = new mysqli($dblocation, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}