<?php
function ip()
{ 
if(isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) 
	return $_SERVER['HTTP_CLIENT_IP'];
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'])
	return $_SERVER['HTTP_X_FORWARDED_FOR']; 
if(isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']) 
	return $_SERVER['HTTP_X_FORWARDED']; 
if(isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']) 
	return $_SERVER['HTTP_FORWARDED_FOR']; 
if(isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']) 
	return $_SERVER['HTTP_FORWARDED']; 
if(isset($_SERVER['HTTP_X_COMING_FROM']) && $_SERVER['HTTP_X_COMING_FROM']) 
	return $_SERVER['HTTP_X_COMING_FROM']; 
if(isset($_SERVER['HTTP_COMING_FROM']) && $_SERVER['HTTP_COMING_FROM']) 
	return $_SERVER['HTTP_COMING_FROM'];
if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) 
	return $_SERVER['REMOTE_ADDR']; 
return ''; 
}
?>