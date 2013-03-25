<?php
session_start();
require_once('../../jr_config.php');
require_once('../../jr_connection.php');
require_once('../../module_controll/jr_quote_handler.php');
require_once('../../module_controll/jr_xss_clean.php');
require_once('../../module_controll/jr_get_ipaddress.php');

if(!isset($_SESSION['jrsystem']) && !isset($_SESSION['loggedip']) && !isset($_SESSION['jrlevel']) && !isset($_SESSION['jrdatelog']) 
|| $_SESSION['jrsystem']=="" || $_SESSION['jrsystem']==NULL && $_SESSION['loggedip']=="" || $_SESSION['loggedip']==NULL 
&& $_SESSION['jrlevel']="" || $_SESSION['jrlevel']==NULL && $_SESSION['jrdatelog']="" || $_SESSION['jrdatelog']==NULL){
	session_destroy();
	header('Location:../../jr_login.php');
}
else{
	$query="";
	if(isset($_POST['add']) && $_POST['add']=="true"){
		if($_POST['user_name']=="" || $_POST['user_password']=="" || $_POST['full_name']=="" || $_POST['user_email']=="" || $_POST['user_level']==""){
			header('Location:../mod_user.php?message=errordata');
		}else{
			$query="INSERT INTO `jr_user`(`user_name`, `user_password`, `user_full_name`, `user_email`, `user_level`, `user_date_register`, `user_ipaddress_register`)
		 VALUES ('".xss_clean(delete($_POST['user_name']))."','".sha1(xss_clean(delete($_POST['user_password'])).salt)."','".xss_clean(delete($_POST['full_name']))."','".xss_clean(delete($_POST['user_email']))."','".xss_clean(delete($_POST['user_level']))."','".date("Y-m-d H:i:s")."','".ip()."')";
		}
	}elseif(isset($_POST['edit']) && $_POST['edit']=="true"){
		if($_POST['user_password']==""){
			$query="UPDATE `jr_user` SET `user_name`='".xss_clean(delete($_POST['user_name']))."',`user_full_name`='".xss_clean(delete($_POST['full_name']))."',`user_email`='".xss_clean(delete($_POST['user_email']))."',`user_level`='".xss_clean(delete($_POST['user_level']))."' WHERE `user_id`='".(delete($_POST['user_id']))."'";
		}elseif($_POST['user_password']!=""){
			$query="UPDATE `jr_user` SET `user_name`='".xss_clean(delete($_POST['user_name']))."',`user_password`='".sha1(xss_clean(delete($_POST['user_password'])).salt)."',`user_full_name`='".xss_clean(delete($_POST['full_name']))."',`user_email`='".xss_clean(delete($_POST['user_email']))."',`user_level`='".xss_clean(delete($_POST['user_level']))."' WHERE `user_id`='".(delete($_POST['user_id']))."'";
		}
	}elseif(isset($_GET['deletepost']) && xss_clean(delete($_GET['deletepost']))=="true" && isset($_GET['user_id'])){
		$query="DELETE FROM `jr_user` WHERE `user_id`='".delete($_GET['user_id'])."'";
	}
	if(!$raw=$conn->query($query)){
		header('Location:../mod_user.php?message=errorsql');
	}else{
		if($raw){
			header('Location:../mod_user.php?message=success');
		}
		else{
			header('Location:../mod_user.php?message=errorsql');
		}
	}
	
}

?>