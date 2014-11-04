<?php
/*
$ip = getenv("REMOTE_ADDR") ; 
Echo "Your IP is " . $ip; */

define('dbhost', 'atangsutisna-juniorcms-1061955');
define('dbuser', 'atangsutisna');
define('dbpassword', '');
define('dbname', 'jr_cms');

$conn = new mysqli(dbhost,dbuser,dbpassword,dbname);
if($conn->connect_errno)
	echo 'could not connect to the specify server with error "'.$conn->connect_error.'"';
?>