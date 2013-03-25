<?php
session_start();
require_once('../../jr_config.php');
require_once('../../jr_connection.php');
require_once('../../module_controll/jr_quote_handler.php');
require_once('../../module_controll/jr_xss_clean.php');

if(!isset($_SESSION['jrsystem']) && !isset($_SESSION['loggedip']) && !isset($_SESSION['jrlevel']) && !isset($_SESSION['jrdatelog']) 
|| $_SESSION['jrsystem']=="" || $_SESSION['jrsystem']==NULL && $_SESSION['loggedip']=="" || $_SESSION['loggedip']==NULL 
&& $_SESSION['jrlevel']="" || $_SESSION['jrlevel']==NULL && $_SESSION['jrdatelog']="" || $_SESSION['jrdatelog']==NULL){
	session_destroy();
	header('Location:../../jr_login.php');
}
else{
	$query="";
	if(isset($_POST['add']) && $_POST['add']=="true"){
		if($_POST['page_name']=="" || $_POST['page_visible']==""){
			header('Location:../mod_page.php?message=errordata');
		}else{
		$query="INSERT INTO `jr_page`(`page_name`, `page_visible`, `page_module`, `page_content`, `page_date_add`)
			VALUES ('".xss_clean(delete($_POST['page_name']))."','".xss_clean(delete($_POST['page_visible']))."','".xss_clean(delete($_POST['page_module']))."','".$_POST['page_content']."','".date("Y-m-d H:i:s")."')";
		}
	}elseif(isset($_POST['edit']) && $_POST['edit']=="true"){
		$query="UPDATE `jr_page` SET `page_name`='".xss_clean(delete($_POST['page_name']))."',`page_visible`='".xss_clean(delete($_POST['page_visible']))."',
		`page_module`='".xss_clean(delete($_POST['page_module']))."',`page_content`='".$_POST['page_content']."' WHERE `page_id`='".$_POST['page_id']."'";
	}elseif(isset($_GET['deletepage']) && xss_clean(delete($_GET['deletepage']))=="true" && isset($_GET['page_id'])){
		if(delete($_GET['page_id'])==1){
			header('Location:../mod_page.php?message=restrictdata');
		}
		elseif(delete($_GET['page_id'])!=1){
			$query="DELETE FROM `jr_page` WHERE `page_id`='".delete($_GET['page_id'])."'";
		}
	}
	if(!$raw=$conn->query($query)){
		if(delete($_GET['page_id'])==1){
			header('Location:../mod_page.php?message=restrictdata');
		}
		else{
		header('Location:../mod_page.php?message=errorsql');
		}
	}else{
		if($raw){
			header('Location:../mod_page.php?message=success');
		}
		else{
			header('Location:../mod_page.php?message=errorsql');
		}
	}
}

?>