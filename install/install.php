<?php
$db_host = $_POST["hostname"];
$db_user = $_POST["username"];
$db_pass = $_POST["password"];
$db_name = $_POST["dbname"];

$conn = new mysqli(dbhost,dbuser,dbpassword,dbname);
$feedback_msg = array();
if($conn->connect_errno) {
    $feedback_msg["status"] = "failure";
    $feedback_msg["error_message"] = 'could not connect to the specify server with error "'.$conn->connect_error.'"';
	echo json_encode($feedback_msg);
}
?>